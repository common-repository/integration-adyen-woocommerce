<?php
/**
 * Tools Hook
 *
 * @author Team WSA
 */

namespace Woosa\Adyen;


//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;


class Tools_Hook implements Interface_Hook{


   /**
    * Initiates the hooks.
    *
    * @return void
    */
   public static function init(){

      add_filter(PREFIX .'\tools\list', [__CLASS__, 'add_extra_tools']);

   }



   /**
    * Adds extra tools in the list.
    *
    * @param array $items
    * @return array
    */
   public static function add_extra_tools($items){

      $items[] = new Generate_Client_Key;

      return $items;
   }


}