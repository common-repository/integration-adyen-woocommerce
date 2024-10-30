<?php
/**
 * Checkout Hook
 *
 * @author Team WSA
 */

namespace Woosa\Adyen;


//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;


class Checkout_Hook implements Interface_Hook{


   /**
    * Initiates the hooks.
    *
    * @return void
    */
   public static function init(){

      add_action('woocommerce_checkout_update_order_review', [__CLASS__, 'save_googlepay_fields']);

   }



   /**
    * Saves custom fields of googlepay payment method in cart session
    *
    * @since 1.0.4
    * @param string $post_data
    * @return void
    */
   public static function save_googlepay_fields($post_data){

      parse_str($post_data, $payload);

      $token = isset($payload['woosa_adyen_googlepay_token']) ? $payload['woosa_adyen_googlepay_token'] : '';
      $description = isset($payload['woosa_adyen_googlepay_description']) ? $payload['woosa_adyen_googlepay_description'] : '';

      if( ! empty($token) ){
         WC()->session->set( 'woosa_adyen_googlepay_token', $token );
      }

      if( ! empty($description) ){
         WC()->session->set( 'woosa_adyen_googlepay_description', $description );
      }

   }
}
