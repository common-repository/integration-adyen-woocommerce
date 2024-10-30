# Introduction

This module inserts a section in settings which displays some useful tools related to the plugin. Default tools:

* Clear cache

## Dependencies

* [Util](https://gitlab.com/woosa/wp-plugin-modules/util)

## Setup

* Installing via composer requires only to include the `index.php` file from root in your code
* Replace all occurences of `_wsa_namespace_` with your unique namespace
* Replace all occurences of `_wsa_text_domain_` with your translation text domain

## How to use

Creating a new tool is possbile by extenting the abstract class `Module_Abstract_Tools`, here is an example:

```php
class My_Custom_Tool extends Module_Abstract_Tools{


   /**
    * The ID of the tool.
    */
   protected $id = 'custom_tool';



   /**
    * Name of the tool.
    *
    * @return string
    */
   protected function name(){
      return __('My custom tool', '_wsa_text_domain_');
   }



   /**
    * Description of the tool.
    *
    * @return string
    */
   protected function description(){
      return __('This my custom tool description.', '_wsa_text_domain_');
   }



   /**
    * The message that will be displayed once the tool has been processed successfully.
    *
    * @return void
    */
   protected function info_message(){
      return __('The tool has been processed succesfully.', '_wsa_text_domain_');
   }



   /**
    * Process the tool.
    *
    * @return void
    */
   protected function process(){
      //add the code to run when this tool is used
   }
}
```

Now you have to include the class in the tool list, here is how:

```php
add_filter(PREFIX .'\tools\list', [__CLASS__, 'add_extra_tools']);

public static function add_extra_tools($items){

   $items[] = new My_Custom_Tool;

   return $items;
}
```