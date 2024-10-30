<?php
/**
 * Interface Hook Order Details
 *
 * This interface is dedicated for processing the order items via `Order-Details` module hooks.
 *
 * @author Woosa Team
 */

namespace Woosa\Adyen;


//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;


interface Interface_Hook_Order_Details{


   /**
    * Initiates the hooks.
    *
    * @return void
    */
   public static function init();



   /**
    * Defines the list of carriers.
    *
    * @return array
    */
   public static function define_ship_carriers();



   /**
    * Defines the list of reasons.
    *
    * @return array
    */
   public static function define_refund_reasons();



   /**
    * Defines the list of reasons.
    *
    * @return array
    */
   public static function define_cancel_reasons();



   /**
    * Defines the list of return actions.
    *
    * @return array
    */
   public static function define_return_actions();



   /**
    * Processes the order items.
    *
    * @param bool|array $processed
    * @param array $fields
    * @return bool|array
    */
   public static function process_items($processed, array $fields);

}