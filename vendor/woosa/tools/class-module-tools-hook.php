<?php
/**
 * Module Tools Hook
 *
 * @author Woosa Team
 */

namespace Woosa\Adyen;


//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;


class Module_Tools_Hook implements Interface_Hook{


   /**
    * Initiates the hooks.
    *
    * @return void
    */
   public static function init(){

      add_action('init', [__CLASS__, 'process_tools']);

      add_filter(PREFIX .'\tools\list', [__CLASS__, 'add_tool']);
   }



   /**
    * Runs each defined tool.
    *
    * @return void
    */
   public static function process_tools(){

      $items = Module_Tools::get_list();

      foreach($items as $tool){
         $tool->run_tool();
      }

   }



   /**
    * Add tool class in the list.
    *
    * @param array $items
    * @return array
    */
   public static function add_tool(array $items){

      $items[] = new Module_Tools_Clear_Cache;

      return $items;
   }

}