<?php
/**
 * Checkout Hook AJAX
 *
 * @author Team WSA
 */

namespace Woosa\Adyen;


//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;


class Checkout_Hook_AJAX implements Interface_Hook{


   /**
    * Initiates the hooks.
    *
    * @return void
    */
   public static function init(){

      add_action('wp_ajax_nopriv_' . PREFIX . '_additional_details', [__CLASS__, 'handle_payment_details']);
      add_action('wp_ajax_' . PREFIX . '_additional_details', [__CLASS__, 'handle_payment_details']);

   }



   /**
    * Processes the request to send payment details.
    *
    * @return string
    */
   public static function handle_payment_details(){

      //check to make sure the request is from same server
      if(!check_ajax_referer( 'wsa-nonce', 'security', false )){
         return;
      }

      $order_id     = Util::array($_POST)->get('order_id');
      $payload      = Util::array($_POST)->get('state_data');
      $order        = wc_get_order($order_id);
      $redirect_url = wc_get_endpoint_url( 'order-received', '', wc_get_page_permalink( 'checkout' ) );

      if($order instanceof \WC_Order){

         $response = Service::checkout()->send_payment_details($payload);

         if($response->status == 200){

            $body         = Util::obj_to_arr($response->body);
            $result_code  = Util::array($body)->get('resultCode');
            $redirect_url = Service_Util::get_return_page_url($order, $result_code);

         }else{

            $redirect_url = $order->get_checkout_payment_url();
         }

      }

      wp_send_json_success(['redirect' => $redirect_url]);
   }

}