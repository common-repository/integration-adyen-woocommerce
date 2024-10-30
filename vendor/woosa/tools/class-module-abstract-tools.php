<?php
/**
 * Module Abstract Tools
 *
 * @author Woosa Team
 */

namespace Woosa\Adyen;


//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;


abstract class Module_Abstract_Tools{


   /**
    * The ID of the tool.
    */
   protected $id;



   /**
    * Retrieves the id prefixed.
    *
    * @return string
    */
   public function get_id(){
      return Util::prefix($this->id);
   }


   /**
    * Name of the tool.
    *
    * @return string
    */
   abstract protected function name();



   /**
    * Description of the tool.
    *
    * @return string
    */
   abstract protected function description();



   /**
    * The message that will be displayed once the tool has been processed successfully.
    *
    * @return string
    */
   abstract protected function info_message();



   /**
    * Process the tool logic
    *
    * @return void
    */
   abstract protected function process();



   /**
    * Output the HTML.
    *
    * @return string
    */
   public function render(){

      ?>
      <tr>
         <td>
            <b><?php echo $this->name();?></b>
            <p class="description"><?php echo $this->description();?></p>
         </td>
         <td style="text-align: right;">
            <a href="<?php echo SETTINGS_URL . '&section=tools&'.$this->get_id().'=process&_wpnonce='.wp_create_nonce( 'wsa-nonce' );?>" class="button"><?php _e('Click to run', 'integration-adyen-woocommerce');?></a>
         </td>
      </tr>
      <?php
   }



   /**
    * Executes the tool logic.
    *
    * @return void
    */
   public function run_tool(){

      if( 'process' === Util::array($_GET)->get($this->get_id()) && wp_verify_nonce( Util::array($_GET)->get('_wpnonce'), 'wsa-nonce' ) ){

         $this->process();

         wp_redirect( SETTINGS_URL . '&section=tools&' . $this->get_id() . '=done' );
      }

      if( 'done' === Util::array($_GET)->get($this->get_id()) ){
         Util::show_notice($this->info_message(), 'success');
      }
   }



   /**
    * Removes all transients created by the plugin.
    *
    * @return void
    */
   protected function remove_transients(){
      global $wpdb;

      $wpdb->query("
         DELETE
            FROM `$wpdb->options`
         WHERE `option_name`
            LIKE ('_transient_".PREFIX."_%')
         OR `option_name`
            LIKE ('_transient_timeout_".PREFIX."_%')
      ");
   }

}