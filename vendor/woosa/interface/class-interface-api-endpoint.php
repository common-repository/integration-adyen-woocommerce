<?php
/**
 * Interface API Endpoint
 *
 * @author Woosa Team
 */

namespace Woosa\Adyen;


//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;


interface Interface_API_Endpoint{


   /**
    * Retrieves API entries.
    *
    * @param array $args
    * @return array
    */
   public function get_entries(array $args = []);



   /**
    * Creates new API entries.
    *
    * @param array $args
    * @return bool
    */
   public function create_entries(array $args = []);



   /**
    * Updates API entries. If they do not exist, it will create them.
    *
    * @param array $args
    * @return bool
    */
   public function update_entries(array $args = []);



   /**
    * Deletes API entries.
    *
    * @param array $args
    * @return bool
    */
   public function delete_entries(array $args = []);
}