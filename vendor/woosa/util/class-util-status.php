<?php
/**
 * Util Status
 *
 * @author Woosa Team
 */

namespace Woosa\Adyen;


//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;


class Util_Status{


   /**
    * The status.
    *
    * @var string
    */
   public $status = '';



   /**
    * Construct of this class.
    *
    * @param string $status
    */
   public function __construct($status){

      $this->status = $status;
   }



   /**
    * Displays the status.
    *
    * @param bool $echo
    * @param bool $icon
    * @param string $default
    * @return string
    */
   public function render($icon = false, $echo = true, $default = 'not_available'){

      $list   = self::get_list();
      $output = '<span>' . Util::array($list)->get("{$default}/title") . '</span>';

      if(isset($list[$this->status])){

         $output = '<span style="color: '. Util::array($list)->get("{$this->status}/color") . '">';

            if($icon){

               $icon = Util::array($list)->get("{$this->status}/icon");

               if( ! empty($icon) ){
                  $output .= '<span class="'.$icon.'"></span> ';
               }
            }

            $output .= Util::array($list)->get("{$this->status}/title");
         $output .='</span>';

      }

      if($echo){

         echo $output;

      }else{

         return $output;
      }
   }



   /**
    * List of available statuses.
    *
    * @return array
    */
   public static function get_list(){

      $list = apply_filters(
         PREFIX . '\util\status\list',
         [
            'not_published' => [
               'title' => __('Not published', 'integration-adyen-woocommerce'),
               'color' => '',
               'icon' => 'dashicons dashicons-minus'
            ],
            'not_available' => [
               'title' => __('Not available', 'integration-adyen-woocommerce'),
               'color' => '',
               'icon' => 'dashicons dashicons-minus'
            ],
            'in_progress' => [
               'title' => __('Processing...', 'integration-adyen-woocommerce'),
               'color' => '#18ace6',
               'icon' => 'dashicons dashicons-update',
            ],
            'processing' => [//this is for bol.com plugin (try to replace it with `in_progress`)
               'title' => __('Processing...', 'integration-adyen-woocommerce'),
               'color' => '#18ace6',
               'icon' => 'dashicons dashicons-update',
            ],
            'open' => [
               'title' => __('Open', 'integration-adyen-woocommerce'),
               'color' => '',
               'icon' => 'dashicons dashicons-yes',
            ],
            'created' => [
               'title' => __('Created', 'integration-adyen-woocommerce'),
               'color' => '',
               'icon' => 'dashicons dashicons-yes',
            ],
            'cancelled' => [
               'title' => __('Cancelled', 'integration-adyen-woocommerce'),
               'color' => '',
               'icon' => 'dashicons dashicons-yes'
            ],
            'processed' => [
               'title' => __('Processed', 'integration-adyen-woocommerce'),
               'color' => '#46b450',
               'icon' => 'dashicons dashicons-yes-alt'
            ],
            'done' => [
               'title' => __('Done', 'integration-adyen-woocommerce'),
               'color' => '#46b450',
               'icon' => 'dashicons dashicons-yes-alt'
            ],
            'registered' => [
               'title' => __('Registered', 'integration-adyen-woocommerce'),
               'color' => '#46b450',
               'icon' => 'dashicons dashicons-yes-alt'
            ],
            'published' => [
               'title' => __('Published', 'integration-adyen-woocommerce'),
               'color' => '#46b450',
               'icon' => 'dashicons dashicons-yes-alt'
            ],
            'paused' => [
               'title' => __('Paused', 'integration-adyen-woocommerce'),
               'color' => '#ffb900',
               'icon' => 'dashicons dashicons-controls-pause'
            ],
            'error' => [
               'title' => __('Error', 'integration-adyen-woocommerce'),
               'color' => '#a44',
               'icon' => 'dashicons dashicons-warning'
            ],
         ]
      );

      return $list;
   }
}