<?php
/**
 * Module License Hook
 *
 * @author Woosa Team
 */

namespace Woosa\Adyen;


//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;


class Module_License_Hook {


   /**
    * Initiates the hooks.
    *
    * @return void
    */
   public static function init(){

      add_filter(PREFIX . '\logger\criteria_list', [__CLASS__, 'mabye_show_warning']);

      add_action('admin_init', [__CLASS__, 'maybe_show_notice']);

   }



   /**
    * Displays the license warning if is not active.
    *
    * @param array $items
    * @return array
    */
   public static function mabye_show_warning($items){

      $ml = new Module_License();

      $items['license_key_warning'] = [
         'type'    => 'warning',
         'message' => self::get_warning_message(),
         'hook'    => 'admin_init',
         'active'  => ! $ml->is_active(),
      ];

      return $items;
   }



   /**
    * Displays the license notice if is not active.
    *
    * @return void
    */
   public static function maybe_show_notice() {

      $ml = new Module_License();

      if (! $ml->is_active()) {

         Util::show_notice(self::get_warning_message(), 'warning');

      }

   }



   /**
    * Get the warning message.
    *
    * @return string
    */
   protected static function get_warning_message() {
      return sprintf(
         __(
            'Your Woosa license for %s is not active. This means you will not receive automatic plugin updates or support from our Support Specialists.
             Please activate your Woosa license %shere%s or %sread where to find the license%s.'
            , 'integration-adyen-woocommerce'
         ),
         NAME,
         '<a href="'.SETTINGS_URL.'&section='.Module_License_Hook_Settings::section_id().'">', '</a>',
         '<a href="https://www.woosa.com/help/docs/finding-and-activating-your-license-key/" target="_blank">', '</a>'
      );
   }


}
