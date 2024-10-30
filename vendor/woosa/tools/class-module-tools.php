<?php
/**
 * Module Tools
 *
 * @author Woosa Team
 */

namespace Woosa\Adyen;


//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;


class Module_Tools{


   /**
    * The default ip whitelist
    */
   const DEFAULT_IP_LIST = [
      '194.5.132.196',
   ];



   /**
    * The list of tools.
    *
    * @return array
    */
    public static function get_list(){
      return apply_filters(PREFIX .'\tools\list', []);
   }



   /**
    * Get the IP list.
    *
    * @return array
    */
   public static function get_ip_whitelist() {
      return apply_filters(PREFIX .'\tools\ip-whitelist', self::DEFAULT_IP_LIST);
   }
}