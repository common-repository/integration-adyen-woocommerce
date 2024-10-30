<?php
/**
 * @author Team WSA
 */

namespace Woosa\Adyen;


//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;


?>

<table style="width:100%;">
   <tr>
      <td class="pl-0" colspan="2">
         <p>
            <?php printf(__('%sOrigin domain & key:%s %s', 'integration-adyen-woocommerce'), '<b>', '</b>', $show_origin_keys);?>
         </p>

         <ul>
            <li><?php printf(__('%sHow can I get an API key ?%s', 'integration-adyen-woocommerce'), '<a href="https://docs.adyen.com/development-resources/api-credentials#generate-api-key" target="_blank">', '</a>');?></li>
            <li><?php printf(__('%sHow can I get a Live URL-prefix ?%s', 'integration-adyen-woocommerce'), '<a href="https://docs.adyen.com/development-resources/live-endpoints#live-url-prefix" target="_blank">','</a>');?></li>
         </ul>

      </td>
   </tr>
   <tr>
      <td class="pl-0" style="width:50%;">
         <?php _e('Test mode', 'integration-adyen-woocommerce');?>
         <?php echo wc_help_tip(__('Whether or not to use the test environment', 'integration-adyen-woocommerce'));?>
      </td>
      <td>
         <select name="<?php echo esc_attr(Util::prefix('testmode'));?>" data-<?php echo PREFIX;?>-has-extra-field="test_mode" <?php disabled($authorization->is_authorized());?>>
            <option value="yes" <?php selected('test', $authorization->get_env());?>><?php _e('Yes', 'integration-adyen-woocommerce');?></option>
            <option value="no" <?php selected('live', $authorization->get_env());?>><?php _e('No', 'integration-adyen-woocommerce');?></option>
         </select>
      </td>
   </tr>
</table>

<div data-<?php echo PREFIX;?>-extra-field-test_mode="no" style="<?php Util::css_display('live', $authorization->get_env(), true);?>">
   <table style="width:100%;">
      <tr>
         <td class="pl-0" style="width:50%;">
            <?php _e('Merchant Account (LIVE)', 'integration-adyen-woocommerce');?>
            <?php echo wc_help_tip(__('The Merchant Account used in production environment.', 'woosa-vidaxl-vd'));?>
         </td>
         <td>
            <input name="<?php echo esc_attr(Util::prefix('merchant_account'));?>" type="text" value="<?php echo esc_attr(Option::get('merchant_account'));?>" <?php disabled($authorization->is_authorized());?>>
         </td>
      </tr>
      <tr>
         <td class="pl-0" style="width:50%;">
            <?php _e('API Key (LIVE)', 'integration-adyen-woocommerce');?>
            <?php echo wc_help_tip(__('The API Key used in production environment.', 'woosa-vidaxl-vd'));?>
         </td>
         <td>
            <input name="<?php echo esc_attr(Util::prefix('api_key'));?>" type="password" value="<?php echo esc_attr(Option::get('api_key'));?>" <?php disabled($authorization->is_authorized());?>>
         </td>
      </tr>
      <tr>
         <td class="pl-0" style="width:50%;">
            <?php _e('URL-prefix (LIVE)', 'integration-adyen-woocommerce');?>
            <?php echo wc_help_tip(__('Provide here the LIVE URL-prefix you have from Adyen.', 'woosa-vidaxl-vd'));?>
         </td>
         <td>
            <input name="<?php echo esc_attr(Util::prefix('url_prefix'));?>" type="text" value="<?php echo esc_attr(Option::get('url_prefix'));?>" <?php disabled($authorization->is_authorized());?>>
         </td>
      </tr>
   </table>
</div>

<div data-<?php echo PREFIX;?>-extra-field-test_mode="yes" style="<?php Util::css_display('test', $authorization->get_env(), true);?>">
   <table style="width:100%;">
      <tr>
         <td class="pl-0" style="width:50%;">
            <?php _e('Merchant Account (TEST)', 'integration-adyen-woocommerce');?>
            <?php echo wc_help_tip(__('The Merchant Account used in test environment.', 'woosa-vidaxl-vd'));?>
         </td>
         <td>
            <input name="<?php echo esc_attr(Util::prefix('test_merchant_account'));?>" type="text" value="<?php echo esc_attr(Option::get('test_merchant_account'));?>" <?php disabled($authorization->is_authorized());?>>
         </td>
      </tr>
      <tr>
         <td class="pl-0" style="width:50%;">
            <?php _e('API Key (TEST)', 'integration-adyen-woocommerce');?>
            <?php echo wc_help_tip(__('The API Key used in test environment.', 'woosa-vidaxl-vd'));?>
         </td>
         <td>
            <input name="<?php echo esc_attr(Util::prefix('test_api_key'));?>" type="password" value="<?php echo esc_attr(Option::get('test_api_key'));?>" <?php disabled($authorization->is_authorized());?>>
         </td>
      </tr>
   </table>
</div>