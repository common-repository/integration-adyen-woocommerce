<?php
/**
 * Google Pay
 *
 * Payment type     : Wallet
 * Payment flow     : Direct
 * Countries        : International
 * Currencies       : Multiple
 * Recurring        : Yes
 * Refunds          : Yes
 * Partial refunds  : Yes
 * Separate captures: Yes
 * Partial captures : Yes
 * Chargebacks      : Yes
 *
 * @author Team WSA
 */

namespace Woosa\Adyen;


//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;


class Googlepay extends Abstract_Gateway{


   /**
    * Constructor of this class.
    *
    * @since 1.1.0 - add support for subscriptions
    * @since 1.0.4
    */
    public function __construct(){

      parent::__construct();

      $this->has_fields = true;

      $this->supports = array_merge($this->supports, [
         'subscriptions',
         'subscription_cancellation',
         'subscription_suspension',
         'subscription_reactivation',
         'subscription_amount_changes',
         'subscription_date_changes',
         // 'subscription_payment_method_change',
         // 'subscription_payment_method_change_customer',
         // 'subscription_payment_method_change_admin',
         'multiple_subscriptions'
      ]);
   }



   /**
    * Gets default payment method title.
    *
    * @since 1.0.4
    * @return string
    */
   public function get_default_title(){
      return __('Adyen - Google Pay', 'integration-adyen-woocommerce');
   }



   /**
    * Gets default payment method description.
    *
    * @since 1.1.0 - display supported countries
    * @since 1.0.4
    * @return string
    */
   public function get_default_description(){
      return $this->show_supported_country();
   }



   /**
    * Gets default description set in settings.
    *
    * @since 1.0.4
    * @return string
    */
   public function get_settings_description(){}



   /**
    * Type of the payment method (e.g ideal, scheme. bcmc).
    *
    * @since 1.0.4
    * @return string
    */
   public function payment_method_type(){

      $google_method = get_transient( PREFIX . '_google_method' );

      if( empty($google_method) ){

         $methods = [ 'paywithgoogle', 'googlepay' ];

         foreach(Service::checkout()->get_payment_methods() as $item){

            $method_type = Util::array($item)->get('type');

            if( in_array( $method_type, $methods ) ){
               $google_method = $method_type;
               set_transient( PREFIX . '_google_method', $method_type, \HOUR_IN_SECONDS );
            }
         }
      }

      if ( empty( $google_method ) ) {
         $google_method = 'googlepay';
         set_transient( PREFIX . '_google_method', $google_method, \HOUR_IN_SECONDS );
      }

      return $google_method;

   }



   /**
    * Returns the payment method to be used for recurring payments
    *
    * @since 1.1.0 - add recurring method type
    * @since 1.0.4
    * @return string
    */
   public function recurring_payment_method(){
      return $this->payment_method_type();
   }



   /**
    * Adds extra fields.
    *
    * @since 1.0.4
    * @return void
    */
    public function payment_fields() {

      parent::payment_fields();

      echo $this->generate_extra_fields_html();

   }



   /**
    * Generates extra fields HTML.
    *
    * @since 1.0.4
    * @return string
    */
   public function generate_extra_fields_html(){

      $description = WC()->session->get( $this->id . '_description' );
      $token = WC()->session->get( $this->id . '_token' );
      $show_desc = ! empty($description) && ! empty($token) ? 'display: block;' : '';
      ?>
      <div id="<?php echo esc_attr(PREFIX . '-googlepay-container');?>">
         <div id="<?php echo esc_attr($this->id . '_button');?>"></div>
         <div class="googlepay-description" style="<?php echo esc_attr($show_desc);?>"><?php echo esc_html($description);?></div>
         <input type="hidden" id="<?php echo esc_attr($this->id . '_token');?>" name="<?php echo esc_attr($this->id . '_token');?>" value='<?php echo esc_attr($token);?>'>
         <input type="hidden" id="<?php echo esc_attr($this->id . '_description');?>" name="<?php echo esc_attr($this->id . '_description');?>" value="<?php echo esc_attr($description);?>">

         <input type="hidden" id="<?php echo esc_attr($this->id . '_merchant_identifier');?>" value="<?php echo esc_attr($this->get_option('merchant_identifier'));?>">
         <input type="hidden" id="<?php echo esc_attr($this->id . '_testmode');?>" value="<?php echo esc_attr($this->get_option('testmode', 'yes'));?>">
      </div>
      <?php
   }



   /**
    * Validates extra added fields.
    *
    * @since 1.0.4
    * @return bool
    */
   public function validate_fields() {

      $is_valid = parent::validate_fields();
      $token = Util::array($_POST)->get($this->id.'_token');

      if(empty($token)){
         wc_add_notice(__('Sorry it looks like Google token is not generated, please refresh the page and try again!', 'integration-adyen-woocommerce'), 'error');
         $is_valid = false;
      }

      return $is_valid;
   }



   /**
    * Builds the required payment payload
    *
    * @since 1.1.0 - use parent function to get common data
    * @since 1.0.4
    * @param \WC_Order $order
    * @param string $reference
    * @return array
    */
   protected function build_payment_payload(\WC_Order $order, $reference){

      $token_raw = Util::array($_POST)->get($this->id.'_token');
      $token     = stripslashes($token_raw);
      $token     = json_decode($token);

      $payload = parent::build_payment_payload($order, $reference);

      $payment_method = $this->payment_method_type();

      $payload['paymentMethod'][ $payment_method . '.token'] = $token;

      return $payload;
   }



   /**
    * Processes the payment.
    *
    * @since 1.1.0 - add support for subscriptions
    * @since 1.0.4
    * @param int $order_id
    * @return array
    */
   public function process_payment($order_id) {

      parent::process_payment($order_id);

      $order     = wc_get_order($order_id);
      $reference = $order_id;
      $payload   = $this->build_payment_payload( $order, $reference );
      $result    = ['result' => 'failure'];

      $recurr_reference = [];
      $subscriptions    = $this->get_subscriptions_for_order( $order_id );
      $subscription_ids = [];

      //recurring payments
      if(count($subscriptions) > 0){

         foreach($subscriptions as $sub_id => $item){
            $subscription_ids[$sub_id] = $sub_id;
            $recurr_reference[] = $sub_id;
         }

         $reference = \implode('-S', $recurr_reference);
         $reference = $order_id.'-S'.$reference;
         $payload = $this->build_payment_payload( $order, $reference );

         //for tokenizing
         $payload['storePaymentMethod'] = true;

         //create a list with unpaid subscriptions
         $order->update_meta_data('_'.PREFIX.'_unpaid_subscriptions', $subscription_ids);

      }

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
    * @since 1.3.0
    * @param object $response
    * @param \WC_Order $order
    * @return array
    */
   protected function process_payment_result( $response, $order ){

      $body        = Util::obj_to_arr($response->body);
      $result_code = Util::array($body)->get('resultCode');
      $reference   = Util::array($body)->get('pspReference');
      $action      = Util::array($body)->get('action');

      $result = [
         'result'   => 'success',
         'redirect' => Service_Util::get_return_page_url($order, $result_code)
      ];

      $order->read_meta_data();
      $order_psp_reference = $order->get_meta('_'.PREFIX.'_payment_pspReference');

      if ($order_psp_reference !== $reference) {

         $order->update_meta_data('_'.PREFIX.'_payment_pspReference', $reference);

      }

      $order->update_meta_data('_'.PREFIX.'_payment_resultCode', $result_code);
      $order->update_meta_data('_'.PREFIX.'_payment_action', $action);
      $order->save();

      //clear the token from the cart session
      WC()->session->__unset( $this->id . '_token');
      WC()->session->__unset( $this->id . '_description');

      if( 'RedirectShopper' == $result_code ){

         //redirect to process payment action via Web Component
         $result = [
            'result'   => 'success',
            'redirect' => add_query_arg(
               [
                  PREFIX . '_payment_method' => $this->payment_method_type(),
                  PREFIX . '_order_id'       => $order->get_id(),
               ],
               Service_Util::get_checkout_url($order)
            )
         ];

      }

      return $result;

   }



   /**
    * Adds an array of fields to be displayed on the gateway's settings screen.
    *
    * @since 1.0.4
    * @return void
    */
   public function init_form_fields() {

      $is_enabled = parent::init_form_fields();

      if( $is_enabled === false ) return;

      $desc = sprintf(__('1. If you already have a Google Pay Developer Profile then navigate to your Profile and find your Google merchant ID otherwise you have to %srequest one here%s', 'integration-adyen-woocommerce'), '<a href="https://developers.google.com/pay/api/web/guides/test-and-deploy/request-prod-access" target="_blank">', '</a>').'</br>';
      $desc .= __('2. Register your fully qualified domains that will invoke Google Pay API', 'integration-adyen-woocommerce').'</br>';

      if( in_array( $this->payment_method_type(), ['paywithgoogle', 'googlepay'] ) ){
         $this->form_fields = array_merge($this->form_fields, array(
            'testmode'    => array(
               'title'       => __('Test mode', 'integration-adyen-woocommerce'),
               'label'       => __('Enable/Disable', 'integration-adyen-woocommerce'),
               'default' => 'yes',
               'type'        => 'checkbox',
            ),
            'merchant_identifier'    => array(
               'title'       => __('Merchant Identifier', 'integration-adyen-woocommerce'),
               'type'        => 'text',
               'description'    => $desc,
            ),
         ));
      }
   }


}