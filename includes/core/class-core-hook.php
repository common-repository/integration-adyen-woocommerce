<?php
/**
 * Core Hook
 *
 * @author Team WSA
 */

namespace Woosa\Adyen;

use Automattic\WooCommerce\Utilities\FeaturesUtil;

//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;


class Core_Hook implements Interface_Hook{


   /**
    * Initiates the hooks.
    *
    * @return void
    */
   public static function init(){

      add_filter('woocommerce_payment_gateways', [__CLASS__, 'payment_gateway']);

      add_action('before_woocommerce_init', [__CLASS__, 'custom_order_tables_compatability']);

      add_action('admin_init', [__CLASS__, 'show_info_message'], 999);

   }



   /**
    * Adds new gateway to WooCommerce payments.
    *
    * @since 1.0.0
    * @param array $gateways
    * @return array
    */
   public static function payment_gateway($gateways) {

      $gateways[] = Ideal::class;
      $gateways[] = Sepa_Direct_Debit::class;
      $gateways[] = Credit_Card::class;
      $gateways[] = Giropay::class;
      $gateways[] = Sofort::class;
      $gateways[] = Bancontact::class;
      $gateways[] = Bancontact_Mobile::class;
      $gateways[] = Boleto::class;
      $gateways[] = Alipay::class;
      $gateways[] = Wechatpay::class;
      $gateways[] = Googlepay::class;
      $gateways[] = Applepay::class;
      $gateways[] = Klarna::class;
      $gateways[] = Klarna_PayNow::class;
      $gateways[] = Klarna_Account::class;
      $gateways[] = Paypal::class;
      $gateways[] = Blik::class;
      $gateways[] = Vipps::class;
      $gateways[] = Swish::class;
      $gateways[] = Grabpay_MY::class;
      $gateways[] = Grabpay_PH::class;
      $gateways[] = Grabpay_SG::class;
      $gateways[] = Mobilepay::class;
      $gateways[] = MOLPay_ML::class;
      $gateways[] = MOLPay_TH::class;
      $gateways[] = Online_Banking_Poland::class;
      $gateways[] = Trustly::class;

      return $gateways;
   }



   /**
    * Declare plugin is compatible with HPOS
    *
    * @return void
    */
   public static function custom_order_tables_compatability() {

      if ( class_exists( FeaturesUtil::class ) ) {

         FeaturesUtil::declare_compatibility( 'custom_order_tables', DIR_BASENAME, true );

      }

   }



   /**
    * Displays the info message.
    *
    * @return void
    */
   public static function show_info_message(){

      $msg = '<p>Dear merchant, in collaboration with Adyen we have decided to no longer offer the Adyen WooCommerce plugin for free. In this way, we are able to improve functionality even more and listen to your feedback on our <a href="https://wishlist.woosa.com/" target="_blank">wishlist.</a></p>';
      $msg .= '<p>Do you want to keep using the Adyen payment gateway for WooCommerce? Please purchase a valid license key before <b>April 1, 2024</b>. Otherwise, you will lose access to the payment gateway.</p>';
      $msg .= '<p>Purchase a valid license key <a href="https://www.woosa.com/woocommerce-plugins/adyen/" target="_blank">here.</a></p>';

      Util::show_notice(
         $msg,
         'error',
         true
      );

   }

}
