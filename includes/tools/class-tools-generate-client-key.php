<?php
/**
 * Tools
 *
 * @author Team WSA
 */

namespace Woosa\Adyen;


//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;


class Generate_Client_Key extends Module_Abstract_Tools{


   /**
    * The ID of the tool.
    */
   protected $id = 'generate_client_key';



   /**
    * Name of the tool.
    *
    * @return string
    */
   protected function name(){
      return __('Generate client key', 'integration-adyen-woocommerce');
   }



   /**
    * Description of the tool.
    *
    * @return string
    */
   protected function description(){
      return __('This will generate a client key for the current domain.', 'integration-adyen-woocommerce');
   }



   /**
    * The message that will be displayed once the tool has been processed successfully.
    *
    * @return string
    */
   protected function info_message(){

      return sprintf(
         __('The client key for %s has been generated!', 'integration-adyen-woocommerce' ),
         '<code>'.Service_Util::get_origin_domain().'</code>'
      );
   }



   /**
    * Process the tool.
    *
    * @return void
    */
   protected function process(){

      Service_Util::generate_origin_keys();
   }
}
