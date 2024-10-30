<?php
/**
 * Boleto
 *
 * Payment type     : Cash and ATM payment method
 * Payment flow     : Additional action (Voucher)
 * Countries        : BR
 * Currencies       : BRL
 * Recurring        : No
 * Refunds          : No
 * Separate captures: No
 * Chargebacks      : No
 *
 * @author Team WSA
 */

namespace Woosa\Adyen;

use VIISON\AddressSplitter\AddressSplitter;


//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;


class Boleto extends Abstract_Gateway{


   /**
    * Constructor of this class.
    *
    * @since 1.0.3
    */
    public function __construct(){

      parent::__construct();

      $this->has_fields = true;

      add_action('woocommerce_order_details_after_order_table', [$this, 'display_order_items']);
   }



   /**
    * List of countries where is available.
    *
    * @since 1.1.0
    * @return array
    */
   public function available_countries(){

      return [
         'BR' => [
            'currencies' => ['BRL'],
         ],
      ];
   }



   /**
    * Gets default payment method title.
    *
    * @since 1.0.3
    * @return string
    */
   public function get_default_title(){
      return __('Adyen - Boleto', 'integration-adyen-woocommerce');
   }



   /**
    * Gets default payment method description.
    *
    * @since 1.1.0 - display supported countries
    * @since 1.0.3
    * @return string
    */
   public function get_default_description(){
      return $this->show_supported_country();
   }



   /**
    * Gets default description set in settings.
    *
    * @since 1.0.3
    * @return string
    */
   public function get_settings_description(){}



   /**
    * Type of the payment method (e.g ideal, scheme. bcmc).
    *
    * @since 1.0.3
    * @return string
    */
   public function payment_method_type(){
      return 'boletobancario_santander';
   }


   /**
    * Returns the payment method to be used for recurring payments
    *
    * @since 1.0.3
    * @return string
    */
   public function recurring_payment_method(){}



   /**
    * Adds extra fields.
    *
    * @since 1.0.3
    * @return void
    */
    public function payment_fields() {

      parent::payment_fields();

      echo $this->generate_extra_fields_html();

   }



   /**
	 * Gets the transaction URL.
	 *
    * @since 1.0.3
	 * @param  WC_Order $order Order object.
	 * @return string
	 */
	public function get_transaction_url( $order ) {

      $this->view_transaction_url = $this->get_service_base_url().'/ca/ca/accounts/showTx.shtml?txType=Offer&pspReference=%s&accountKey=MerchantAccount.'.$this->api->get_merchant();

		return \WC_Payment_Gateway::get_transaction_url( $order );
   }



   /**
    * Generates extra fields HTML.
    *
    * @since 1.0.3
    * @return string
    */
   public function generate_extra_fields_html(){

      ?>
      <div class="adyen-checkout__field adyen-checkout__card__holderName">
         <label class="adyen-checkout__label">
            <span class="adyen-checkout__label__text">
               <?php _e('CPF/CNPJ number', 'integration-adyen-woocommerce');?> <abbr class="required" title="required">*</abbr>
            </span>
            <div class="adyen-checkout__input-wrapper">
               <input class="adyen-checkout__input adyen-checkout__input--text" type="text" name="<?php echo esc_attr($this->id . '_social_number');?>">
            </div>
         </label>
      </div>
      <?php
   }



   /**
    * Validates extra added fields.
    *
    * @since 1.0.3
    * @return bool
    */
   public function validate_fields() {

      $is_valid = parent::validate_fields();

      $social_number = Util::array($_POST)->get($this->id . '_social_number');
      $address = AddressSplitter::splitAddress(Util::array($_POST)->get('billing_address_1') . '' . Util::array($_POST)->get('billing_address_2'));

      if( empty($social_number) ){
         wc_add_notice(__('CPF/CNPJ number is required.', 'integration-adyen-woocommerce'), 'error');
         $is_valid = false;
      }

      if( empty(Util::array($address)->get('houseNumber')) ){
         wc_add_notice(__('Please specify the house number in the address.', 'integration-adyen-woocommerce'), 'error');
         $is_valid = false;
      }

      return $is_valid;
   }



   /**
    * Builds the required payment payload
    *
    * @since 1.1.0 - use parent function to get common data
    * @since 1.0.3
    * @param \WC_Order $order
    * @param string $reference
    * @return array
    */
   protected function build_payment_payload(\WC_Order $order, $reference){

      $social_number = Util::array($_POST)->get($this->id.'_social_number');

      $payload = parent::build_payment_payload($order, $reference);

      $payload['socialSecurityNumber'] = $social_number;

      return $payload;
   }



   /**
    * Processes the payment.
    *
    * @since 1.0.3
    * @param int $order_id
    * @return array
    */
   public function process_payment($order_id) {

      parent::process_payment($order_id);

      $order     = wc_get_order($order_id);
      $reference = $order_id;
      $payload   = $this->build_payment_payload( $order, $reference );

      $response = $this->api->checkout()->send_payment($payload);

      if($response->status == 200){

         return $this->process_payment_result( $response, $order );

      }else{

         wc_add_notice($response->body->message, 'error');
      }

      return ['result' => 'failure'];

   }



   /**
    * Processes the payment result.
    *
    * @since 1.3.2
    * @param object $response
    * @param \WC_Order $order
    * @return array
    */
   protected function process_payment_result( $response, $order ){

      $body         = Util::obj_to_arr($response->body);
      $result_code  = Util::array($body)->get('resultCode');
      $reference    = Util::array($body)->get('pspReference');
      $download_url = Util::array($body)->get('action/downloadUrl', '', false);
      $bar_code     = Util::array($body)->get('action/reference');
      $expire_date  = Util::array($body)->get('action/expiresAt');
      $action       = Util::array($body)->get('action');

      $result = [
         'result'   => 'success',
         'redirect' => Service_Util::get_return_page_url($order, $result_code)
      ];

      $order->read_meta_data();
      $order_psp_reference = $order->get_meta('_'.PREFIX.'_payment_pspReference');

      if ($order_psp_reference !== $reference) {

         $order->update_meta_data('_'.PREFIX.'_refund_pspReference', $reference);
      }

      $order->update_meta_data('_'.PREFIX.'_payment_resultCode', $result_code);
      $order->update_meta_data('_'.PREFIX.'_download_url', $download_url);
      $order->update_meta_data('_'.PREFIX.'_bar_code', $bar_code);
      $order->update_meta_data('_'.PREFIX.'_expire_date', $expire_date);
      $order->update_meta_data('_'.PREFIX.'_payment_action', $action);
      $order->save();

      if( 'PresentToShopper' === $result_code ){

         //redirect to process payment action via Web Component
         $result = [
            'result'   => 'success',
            'redirect' => add_query_arg(
               [
                  PREFIX . '_payment_method' => $this->payment_method_type(),
                  PREFIX . '_order_id'       => $order->get_id(),
               ],
               $order->get_checkout_order_received_url()//this goes to received order page since Boleto is an offline payment and the order is on-hold
            )
         ];
      }

      return $result;

   }



   /**
    * Displays extra details in customer's order.
    *
    * @since 1.0.3
    * @param WC_Order $order
    * @return string
    */
   public function display_order_items($order){

      if( $this->id !== $order->get_payment_method() ) return;

      $download_url = $order->get_meta('_'.PREFIX . '_download_url', true);
      $bar_code     = $order->get_meta('_'.PREFIX . '_bar_code', true);
      $expire_date  = $order->get_meta('_'.PREFIX . '_expire_date', true);
      $expire_date  = new \DateTime($expire_date);

      ?>
      <h2 class="woocommerce-order-details__title"><?php _e('Boleto Details', 'integration-adyen-woocommerce');?></h2>
      <table>
         <tr>
            <th><?php _e('Expiration Date', 'integration-adyen-woocommerce');?></th>
            <td><?php echo esc_html($expire_date->format('Y-m-d'));?></td>
         </tr>
         <tr>
            <th><?php _e('Barcode', 'integration-adyen-woocommerce');?></th>
            <td><?php echo esc_html($bar_code);?></td>
         </tr>
         <tr>
            <th><?php _e('PDF file', 'integration-adyen-woocommerce');?></th>
            <td><a class="button" href="<?php echo esc_attr($download_url);?>" target="_blank"><?php _e('Click to Download', 'integration-adyen-woocommerce');?></a></td>
         </tr>
      </table>
      <?php
   }



   /**
    * Adds an array of fields to be displayed on the gateway's settings screen.
    *
    * @since 1.0.3
    * @return void
    */
    public function init_form_fields() {

      parent::init_form_fields();

      $this->form_fields = array_merge(array(
         'notification_text'    => array(
            'type'        => 'notification_text',
         )
      ), $this->form_fields);
   }



   /**
    * Generates custom section for displaying notification info.
    *
    * @since 1.0.3
    * @param string $key
    * @param array $data
    * @return string
    */
   public function generate_notification_text_html( $key, $data ) {

      $url = add_query_arg([
         'section' => 'notifications',
      ], SETTINGS_URL);

		ob_start();
		?>
		<tr valign="top">
         <th><?php _e('Set Notification', 'integration-adyen-woocommerce');?></th>
			<td class="forminp">
            <?php printf(
               __('Please make sure %s is aleady set in Adyen account!', 'integration-adyen-woocommerce'),
               '<a href="'.$url.'">Boleto Bancario Pending Notification</a>'
            );?>
			</td>
		</tr>
		<?php

		return ob_get_clean();
	}


}