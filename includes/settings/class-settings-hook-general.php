<?php
/**
 * Settings Hook General
 *
 * @author Team WSA
 */

namespace Woosa\Adyen;


//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;


class Settings_Hook_General implements Interface_Hook{


   /**
    * Initiates the hooks.
    *
    * @return void
    */
   public static function init(){

      add_filter(PREFIX . '\settings\fields\\' . SETTINGS_TAB_ID . '\\', [__CLASS__, 'add_section_fields'], 11);

      add_filter('woocommerce_admin_settings_sanitize_option_' . PREFIX . '_order_reference_prefix', [__CLASS__, 'sanitize_order_reference_prefix']);

   }



   /**
    * Adds the fields of the section.
    *
    * @param array $fields
    * @return array
    */
   public static function add_section_fields($items){

      $new_items = [
         [
            'name' => __('General', 'integration-adyen-woocommerce'),
            'type' => 'title',
            'desc' => '',
            'id'   => PREFIX . '_general_section_title',
         ],
         [
            'name'     => __('Capture Mode', 'integration-adyen-woocommerce'),
            'id'       => PREFIX.'_capture_payment',
            'autoload' => false,
            'type'     => 'select',
            'desc' => self::capture_desc(),
            'default' => 'immediate',
            'options' => [
               'immediate' => __('Immediate', 'integration-adyen-woocommerce'),
               'delay' => __('With delay', 'integration-adyen-woocommerce'),
               'manual' => __('Manual', 'integration-adyen-woocommerce'),
            ]
         ],
         [
            'id'   => PREFIX .'_auto_klarna_payments',
            'name'  => __('Capture Klarna payments automatically?', 'integration-adyen-woocommerce'),
            'type'  => 'checkbox',
            'desc' => __('Yes', 'integration-adyen-woocommerce'),
            'desc_tip' => __('Before enable this you have to contact Adyen support to also set up automatic capture for Klarna payments.', 'integration-adyen-woocommerce'),
         ],
         [
            'name' => __('Reference Prefix', 'integration-adyen-woocommerce'),
            'type' => 'text',
            'desc_tip' => __('Specify a prefix (unique per webshop) for the payment reference. NOTE: Use this option only if you have a multisite installation otherwise you can leave it empty.', 'integration-adyen-woocommerce'),
            'id'   => PREFIX .'_order_reference_prefix',
            'autoload' => false,
         ],
         [
            'name' => __('Remove Customer\'s Data', 'integration-adyen-woocommerce'),
            'desc' => __('Enable', 'integration-adyen-woocommerce'),
            'type' => 'checkbox',
            'desc_tip' => sprintf(__('This allows your customers to remove their personal data (%s) attached to an order payment. This only deletes the customer-related data for the specific payment, but does not cancel the existing recurring transaction.', 'integration-adyen-woocommerce'), '<a href="https://gdpr-info.eu/art-17-gdpr/" target="_blank">GDPR</a>'),
            'default' => 'no',
            'id'   => PREFIX .'_allow_remove_gdpr',
            'autoload' => false,
         ],
         [
            'name' => __('Include Server Port', 'integration-adyen-woocommerce'),
            'desc' => __('Yes', 'integration-adyen-woocommerce'),
            'type' => 'checkbox',
            'desc_tip' => __('Generate the client key for the shop domain by including the server port as well.', 'integration-adyen-woocommerce'),
            'default' => 'yes',
            'id'   => PREFIX .'_incl_server_port',
            'autoload' => false,
         ],
         [
            'type' => 'sectionend',
            'id'   => PREFIX . '_general_section_sectionend',
         ],
      ];

      $items = array_merge($new_items, $items);

      return $items;
   }



   /**
    * Displays the description for `Capture mode` option.
    *
    * @since 1.0.0
    * @return void
    */
   public static function capture_desc(){

      ob_start();
      ?>

      <p class="description"><?php _e('NOTE: you have to enable this option in Adyen account as well!', 'integration-adyen-woocommerce');?></p>
      <p class="description"><?php _e('Manual: you need to explicitly request a capture for each payment.', 'integration-adyen-woocommerce');?></p>

      <?php

      $output = str_replace(array("\r","\n"), '', trim(ob_get_clean()));

      return $output;
   }



   /**
    * Sanitizes the value before saving it.
    *
    * @since 1.1.0
    * @param string $value
    * @return string
    */
   public static function sanitize_order_reference_prefix($value){

      $value = preg_replace('/[^a-zA-Z0-9]/', '', $value);
      $value = strtoupper(substr($value, 0, 4));

      return $value;
   }

}