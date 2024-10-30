<?php
/**
 * Swish
 *
 * Payment type     : Wallet
 * Payment flow     : QR code or redirect
 * Countries        : SE
 * Currencies       : SEK
 * Recurring        : No
 * Refunds          : Yes
 * Partial refunds  : Yes
 * Separate captures: No
 * Chargebacks      : No
 *
 * @author Team WSA
 */

namespace Woosa\Adyen;


//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;


class Swish extends Abstract_Gateway{


   /**
    * List of countries where is available.
    *
    * @since 1.1.0
    * @return array
    */
   public function available_countries(){

      return [
         'SE' => [
            'currencies' => ['SEK'],
         ],
      ];
   }



   /**
    * Gets default payment method title.
    *
    * @since 1.5.0
    * @return string
    */
   public function get_default_title(){
      return __('Adyen - Swish', 'integration-adyen-woocommerce');
   }



   /**
    * Gets default payment method description.
    *
    * @since 1.5.0
    * @return string
    */
   public function get_default_description(){
      return sprintf(__('Shoppers can pay with Swish when shopping online or in-store using our terminals. %s', 'integration-adyen-woocommerce'), '<br/>'.$this->show_supported_country());
   }



   /**
    * Gets default description set in settings.
    *
    * @since 1.5.0
    * @return string
    */
   public function get_settings_description(){}



   /**
    * Type of the payment method (e.g ideal, scheme. bcmc).
    *
    * @since 1.5.0
    * @return string
    */
   public function payment_method_type(){
      return 'swish';
   }



   /**
    * Returns the payment method to be used for recurring payments
    *
    * @since 1.5.0
    * @return void
    */
   public function recurring_payment_method(){}



   /**
    * Processes the payment.
    *
    * @since 1.1.0 - replace `_#subscription#_` with `-S`
    * @since 1.0.7 - use \WC_Order instance to manipulate metadata
    * @since 1.0.0
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
    * @since 1.2.0
    * @param object $response
    * @param \WC_Order $order
    * @return array
    */
   protected function process_payment_result( $response, $order ){

      $body        = Util::obj_to_arr($response->body);
      $result_code = Util::array($body)->get('resultCode');
      $action      = Util::array($body)->get('action');

      $result = [
         'result'   => 'success',
         'redirect' => Service_Util::get_return_page_url($order, $result_code)
      ];

      $order->update_meta_data('_' . PREFIX . '_payment_resultCode', $result_code);
      $order->update_meta_data('_' . PREFIX . '_payment_action', $action);
      $order->save();

      if( 'Pending' == $result_code ){

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


}