<?php
/**
 * Util Convert
 *
 * @author Woosa Team
 */

namespace Woosa\Adyen;


//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;


class Util_Convert{


   /**
    * The value.
    *
    * @var string
    */
   protected $value = '0';


   /**
    * From which unit.
    *
    * @var string
    */
   protected $from_unit = '';


   /**
    * To which unit.
    *
    * @var string
    */
   protected $to_unit = '';


   /**
    * Whether or not to show the unit.
    *
    * @var string
    */
   protected $show_unit = false;



   /**
    * Construct of this class.
    *
    * @param string $value
    */
   public function __construct($value){
      $this->value = $value;
   }



   /**
    * Checks from which unit to convert.
    *
    * @param string $unit
    * @return self
    */
   public function from($unit){

      if(in_array($unit, ['kg', 'g', 'lbs', 'oz'])){

         $this->from_unit = apply_filters(PREFIX . '\util\convert\weight\from_unit', $unit);
         $this->weight_to_gram();

      }elseif(in_array($unit, ['m', 'cm', 'mm', 'in', 'yd'])){

         $this->from_unit = apply_filters(PREFIX . '\util\convert\dimension\from_unit', $unit);
         $this->dimension_to_cm();
      }

      return $this;
   }



   /**
    * Converts to specified unit.
    *
    * @param string $unit
    * @return float|string
    */
   public function to($unit, $show_unit = false){

      $this->show_unit = $show_unit;

      if(in_array($unit, ['kg', 'g', 'lbs', 'oz'])){

         $this->to_unit = apply_filters(PREFIX . '\util\convert\weight\to_unit', $unit);
         $this->weight();

      }elseif(in_array($unit, ['m', 'cm', 'mm', 'in', 'yd'])){

         $this->to_unit = apply_filters(PREFIX . '\util\convert\dimension\to_unit', $unit);
         $this->dimension();

      }elseif(in_array($unit, ['B', 'KB', 'MB', 'GB', 'TB'])){

         $this->to_unit = apply_filters(PREFIX . '\util\convert\bytes\to_unit', $unit);
         $this->bytes();
      }

      if($this->show_unit){
         return $this->value;
      }

      return floatval(number_format((float)$this->value, 4, '.', ''));

   }



   /**
    * Converts weight value from grams to the specified unit.
    *
    * @return float
    */
   protected function weight(){

      if(is_numeric($this->value) && $this->value > '0'){

         switch ($this->to_unit) {

            case 'kg':
               $this->value = $this->value * 0.001;
               break;

            case 'lbs':
               $this->value = $this->value * 0.00220462;
               break;

            case 'oz':
               $this->value = $this->value * 0.035274;
               break;
         }
      }

      $this->value = floatval(number_format((float)$this->value, 4, '.', ''));
   }



   /**
    * Converts weight to grams.
    *
    * @return float
    */
   protected function weight_to_gram(){

      if(is_numeric($this->value) && $this->value > '0'){

         switch ($this->from_unit) {

            case 'kg':
               $this->value = $this->value * 1000;
               break;

            case 'lbs':
               $this->value = $this->value * 453.5924;
               break;

            case 'oz':
               $this->value = $this->value * 28.34952;
               break;
         }
      }

      $this->value = floatval(number_format((float)$this->value, 4, '.', ''));
   }



   /**
    * Converts dimension value.
    *
    * @return float
    */
   protected function dimension(){

      if(is_numeric($this->value) && $this->value > '0'){

         switch ($this->to_unit) {

            case 'm':
               $this->value = $this->value * 0.01;
               break;

            case 'mm':
               $this->value = $this->value * 10;
               break;

            case 'in':
               $this->value = $this->value * 0.393701;
               break;

            case 'yd':
               $this->value = $this->value * 0.0109361;
               break;
         }
      }

      return floatval(number_format((float)$this->value, 4, '.', ''));
   }



   /**
    * Converts dimension to centimeters.
    *
    * @return float
    */
   protected function dimension_to_cm(){

      if(is_numeric($this->value) && $this->value > '0'){

         switch ($this->from_unit) {

            case 'm':
               $this->value = $this->value * 100;
               break;

            case 'mm':
               $this->value = $this->value * 0.1;
               break;

            case 'in':
               $this->value = $this->value * 2.54;
               break;

            case 'yd':
               $this->value = $this->value * 91.44;
               break;
         }
      }

      $this->value = floatval(number_format((float)$this->value, 4, '.', ''));
   }



   /**
    * Formats the bytes to the correct unit.
    *
    * @return string
    */
   protected function bytes() {

      $units = array('B', 'KB', 'MB', 'GB', 'TB');

      $this->value = max(wp_convert_hr_to_bytes($this->value), 0);
      $pow   = floor(($this->value ? log($this->value) : 0) / log(1024));
      $pow   = min($pow, count($units) - 1);

      // Uncomment one of the following alternatives
      $this->value /= pow(1024, $pow);
      // $this->value /= (1 << (10 * $pow));

      $this->value = round($this->value, 2);

      if($this->show_unit){
         $this->value = $this->value.$units[$pow];
      }
   }

}