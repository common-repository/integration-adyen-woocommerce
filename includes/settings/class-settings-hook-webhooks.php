<?php
/**
 * Settings Hook Webhooks
 *
 * @author Team WSA
 */

namespace Woosa\Adyen;


//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;


class Settings_Hook_Webhooks implements Interface_Hook_Settings{


   /**
    * The id of the section.
    *
    * @return string
    */
   public static function section_id(){
      return 'webhooks';
   }



   /**
    * The name of the section.
    *
    * @return string
    */
   public static function section_name(){
      return __('Webhooks', 'integration-adyen-woocommerce');
   }



   /**
    * Initiates the hooks.
    *
    * @return void
    */
   public static function init(){

      add_filter(PREFIX . '\settings\sections\\' . SETTINGS_TAB_ID, [__CLASS__, 'add_section'], 25);
      add_filter(PREFIX . '\settings\fields\\' . SETTINGS_TAB_ID . '\\'.self::section_id(), [__CLASS__, 'add_section_fields']);

   }



   /**
    * Initiates the section under a condition.
    *
    * @return void
    */
   public static function maybe_init(){}



   /**
    * Adds the section in the list.
    *
    * @param array $items
    * @return array
    */
   public static function add_section($items){

      $items[self::section_id()] = self::section_name();

      return $items;
   }



   /**
    * Adds the fields of the section.
    *
    * @param array $items
    * @return array
    */
   public static function add_section_fields($items){

      $new_items = [
         [
            'type' => 'title',
            'desc' => self::webhooks_desc(),
            'id'   => PREFIX . '_webhooks_section_title',
         ],
         [
            'name'     => __('Username', 'integration-adyen-woocommerce'),
            'id'       => PREFIX.'_api_username',
            'autoload' => false,
            'type'     => 'text',
            'desc_tip' => __('Provide the username you set in authentication section (see step 5.)', 'integration-adyen-woocommerce'),
         ],
         [
            'name'     => __('Password', 'integration-adyen-woocommerce'),
            'id'       => PREFIX.'_api_password',
            'autoload' => false,
            'type'     => 'password',
            'desc_tip' => __('Provide the password you set in authentication section (see step 5.)', 'integration-adyen-woocommerce'),
         ],
         [
            'name'     => __('HMAC key', 'integration-adyen-woocommerce'),
            'id'       => PREFIX.'_hmac_key',
            'autoload' => false,
            'type'     => 'text',
            'desc_tip' => __('Provide HMAC key the from the Customer Area', 'integration-adyen-woocommerce'),
         ],
         [
            'type' => 'sectionend',
            'id'   => PREFIX . '_webhooks_section_sectionend',
         ],
      ];

      $items = array_merge($new_items, $items);

      return $items;
   }



   /**
    * Useful in conjunction with the hook `woocommerce_admin_field_{$field}` to completely render a custom content in the section.
    *
    * @param array $values
    * @return string
    */
   public static function output_section($values){}



   /**
    * Displays the description for `Webhooks` section.
    *
    * @return string
    */
   public static function webhooks_desc(){

      ob_start();
      ?>
      <h2><?php _e('Standard notification', 'integration-adyen-woocommerce');?></h2>
      <ol>
         <li><?php printf(__('Log in to your %s to configure notifications', 'integration-adyen-woocommerce'), '<a href="https://ca-test.adyen.com/" target="_blank">Customer Area</a>');?></li>
         <li><?php printf(__('Go to %s', 'integration-adyen-woocommerce'), '<b>Developers > Webhooks</b>');?></li>
         <li><?php printf(__('In the upper-right corner, select the %s button', 'integration-adyen-woocommerce'), '<b>+ Webhook</b>');?></li>
         <li><?php printf(__('Next to %s, click %s', 'integration-adyen-woocommerce'), '<b>Standard Notification</b>','<b>Add</b>');?></li>
         <li>
            <?php printf(__('Under %s, enter your server\'s:', 'integration-adyen-woocommerce'), '<b>Transport</b>');?>
            <ul class="<?php echo PREFIX;?>-ullist">
               <li><b>URL</b> - <code><?php echo rest_url('/woosa-adyen/payment-status');?></code></li>
               <li><b>SSL Version</b> - TLSv12</li>
               <li><b>Active</b> - Checked</li>
               <li><b>Method</b> - HTTP POST</li>
            </ul>
         </li>
         <li><?php printf(__('In the %s section, enter a username and password that will be used to authenticate Adyen notifications in your webshop.', 'integration-adyen-woocommerce'), '<b>Authentication</b>');?></li>
         <li><?php printf(__('Under %s make sure %s is checked.', 'integration-adyen-woocommerce'), '<b>Additional settings</b>', '<b>Overwrite Standard Notification Events Sent</b>');?></li>
         <li><?php printf(__('Click %s', 'integration-adyen-woocommerce'), '<b>Save Configuration</b>');?></li>
      </ol>


      <h2><?php _e('Boleto Bancario pending', 'integration-adyen-woocommerce');?></h2>
      <ol>
         <li><?php printf(__('Log in to your %s to configure notifications', 'integration-adyen-woocommerce'), '<a href="https://ca-test.adyen.com/" target="_blank">Customer Area</a>');?></li>
         <li><?php printf(__('Go to %s', 'integration-adyen-woocommerce'), '<b>Developers > Webhooks</b>');?></li>
         <li><?php printf(__('In the upper-right corner, select the %s button', 'integration-adyen-woocommerce'), '<b>+ Webhook</b>');?></li>
         <li><?php printf(__('Next to %s, click %s', 'integration-adyen-woocommerce'), '<b>Boleto Bancario Pending Notification</b>','<b>Add</b>');?></li>
         <li>
            <?php printf(__('Under %s, enter your server\'s:', 'integration-adyen-woocommerce'), '<b>Transport</b>');?>
            <ul class="<?php echo PREFIX;?>-ullist">
               <li><b>URL</b> - <code><?php echo rest_url('/woosa-adyen/boleto-payment-status');?></code></li>
               <li><b>SSL Version</b> - TLSv12</li>
               <li><b>Active</b> - Checked</li>
               <li><b>Method</b> - HTTP POST</li>
            </ul>
         </li>
         <li><?php printf(__('In the %s section, enter a username and password that will be used to authenticate Adyen notifications in your webshop.', 'integration-adyen-woocommerce'), '<b>Authentication</b>');?></li>
         <li><?php printf(__('Click %s', 'integration-adyen-woocommerce'), '<b>Save Configuration</b>');?></li>
      </ol>
      <?php

      $output = str_replace(array("\r","\n"), '', trim(ob_get_clean()));

      return $output;

   }

}