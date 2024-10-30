<?php
/**
 * Module Tools Hook Settings
 *
 * @author Woosa Team
 */

namespace Woosa\Adyen;


//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;


class Module_Tools_Hook_Settings implements Interface_Hook_Settings{


   /**
    * The id of the section.
    *
    * @return string
    */
   public static function section_id(){
      return 'tools';
   }



   /**
    * The name of the section.
    *
    * @return string
    */
   public static function section_name(){
      return __('Tools', 'integration-adyen-woocommerce');
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

      $initiate = apply_filters(PREFIX . '\tools\initiate', true);

      if($initiate){

         add_filter(PREFIX . '\settings\sections\\' . SETTINGS_TAB_ID, [__CLASS__, 'add_section'], 98);
         add_filter(PREFIX . '\settings\fields\\' . SETTINGS_TAB_ID . '\\'.self::section_id(), [__CLASS__, 'add_section_fields']);
         add_action('woocommerce_admin_field_' . PREFIX . '_tools', [__CLASS__, 'output_section']);
         add_action('woocommerce_admin_field_' . PREFIX . '_ip_list', [__CLASS__, 'output_ip_list_section']);
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

      $items = [
         [
            'title' => __('Tools', 'integration-adyen-woocommerce'),
            'id'    => PREFIX . '_tools_title',
            'type'  => 'title',
         ],
         [
            'title' => __('Woosa IP list', 'integration-adyen-woocommerce'),
            'desc' => __('In case your shop has some restrictions for inbound requests please whitelist our IPs.', 'integration-adyen-woocommerce'),
            'id'   => PREFIX .'_ip_list',
            'type' => PREFIX .'_ip_list',
         ],
         [
            'id'   => PREFIX .'_tools',
            'type' => PREFIX .'_tools',
         ],
         [
            'id'   => PREFIX . '_tools_sectionend',
            'type' => 'sectionend',
         ],
      ];

      return apply_filters( PREFIX . '\tools\add_section_fields', $items );
   }



   /**
    * Useful in conjunction with the hook `woocommerce_admin_field_{$field}` to completely render a custom content in the section.
    *
    * @param array $values
    * @return string
    */
   public static function output_section($values){

      $GLOBALS['hide_save_button'] = true;

      $path      = \dirname(__FILE__).'/templates/output-section.php';
      $incl_path = DIR_PATH.'/includes/tools/templates/output-section.php';

      if(file_exists($incl_path)){
         $path = $incl_path;
      }

      echo Util::get_template($path, [
         'tools' => Module_Tools::get_list()
      ]);

   }



   /**
    * Render the
    *
    * @param $values
    * @return void
    */
   public static function output_ip_list_section($values) {

      $GLOBALS['hide_save_button'] = true;

      $path      = \dirname(__FILE__).'/templates/output-ip-list-section.php';
      $incl_path = DIR_PATH.'/includes/tools/templates/output-ip-list-section.php';

      if(file_exists($incl_path)){
         $path = $incl_path;
      }

      echo Util::get_template($path, [
         'title' => $values['title'],
         'desc' => $values['desc'],
         'ip_whitelist' => Module_Tools::get_ip_whitelist()
      ]);

   }

}