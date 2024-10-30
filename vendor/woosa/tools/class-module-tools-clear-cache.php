<?php
/**
 * Module Tools Clear Cache
 *
 * @author Woosa Team
 */

namespace Woosa\Adyen;


//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;


class Module_Tools_Clear_Cache extends Module_Abstract_Tools{


   /**
    * The ID of the tool.
    */
   protected $id = 'clear_cache';



   /**
    * Name of the tool.
    *
    * @return string
    */
   protected function name(){
      return __('Clear cache', 'integration-adyen-woocommerce');
   }



   /**
    * Description of the tool.
    *
    * @return string
    */
   protected function description(){
      return __('This tool will clear all the caching data.', 'integration-adyen-woocommerce');
   }



   /**
    * The message that will be displayed once the tool has been processed successfully.
    *
    * @return string
    */
   protected function info_message(){
      return __('The caching data has been removed!', 'integration-adyen-woocommerce' );
   }



   /**
    * Process the tool.
    *
    * @return void
    */
   protected function process(){

      $this->remove_transients();

      do_action(PREFIX . '\tools\process_clear_cache');

      wp_cache_flush();

   }
}