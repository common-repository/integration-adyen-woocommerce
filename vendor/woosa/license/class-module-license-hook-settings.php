<?php
/**
 * Module License Hook Settings
 *
 * @author Woosa Team
 */

namespace Woosa\Adyen;


//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;


class Module_License_Hook_Settings implements Interface_Hook_Settings{


   /**
    * The id of the section.
    *
    * @return string
    */
   public static function section_id(){
      return 'license';
   }



   /**
    * The name of the section.
    *
    * @return string
    */
   public static function section_name(){
      return __('License', 'integration-adyen-woocommerce');
   }



   /**
    * Initiates the hooks.
    *
    * @return void
    */
   public static function init(){

      add_action('admin_init', [__CLASS__, 'maybe_init']);

   }



   /**
    * Initiates the section under a condition.
    *
    * @return void
    */
   public static function maybe_init(){

      $initiate = apply_filters(PREFIX . '\license\initiate', true);

      if($initiate){

         add_filter(PREFIX . '\settings\sections\\' . SETTINGS_TAB_ID, [__CLASS__, 'add_section'], 95);
         add_filter(PREFIX . '\settings\fields\\' . SETTINGS_TAB_ID . '\\'.self::section_id(), [__CLASS__, 'add_section_fields']);
         add_action('woocommerce_admin_field_' . PREFIX .'_license_submission', [__CLASS__, 'output_section']);
      }

   }



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

      $GLOBALS['hide_save_button'] = true;

      $items = [
         [
            'name' => __('Automatic updates & support', 'integration-adyen-woocommerce'),
            'id'   => PREFIX . '_license_title',
            'type' => 'title',
         ],
         [
            'name' => __( 'Key', 'integration-adyen-woocommerce' ),
            'id'   => PREFIX . '_license_key',
            'type' => PREFIX . '_license_submission',
         ],
         [
            'id'   => PREFIX . '_license_sectionend',
            'type' => 'sectionend',
         ],
      ];

      return apply_filters( PREFIX . '\license\add_section_fields', $items );
   }



   /**
    * Useful in conjunction with the hook `woocommerce_admin_field_{$field}` to completely render a custom content in the section.
    *
    * @param array $values
    * @return string
    */
   public static function output_section($values){
      Module_License::render($values);
   }

}
