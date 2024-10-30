<?php
/**
 * @author Woosa Team
 */

namespace Woosa\Adyen;


//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;


?>

<tr class="<?php echo PREFIX;?>-style">
   <td class="p-0">
      <div class="bg-white w-800 p-10">
         <p><?php printf(__('Status: %s', 'integration-adyen-woocommerce'), $status);?></p>
         <p><?php printf(__('Activations: %s', 'integration-adyen-woocommerce'), $activaion_stats);?></p>
         <div style="margin-top: 10px;">
            <input type="text" id="<?php echo $values['id'];?>" name="<?php echo $values['id'];?>" value="<?php echo $license->key;?>" placeholder="<?php _e('License Key', 'integration-adyen-woocommerce');?>" autocomplete="off">
            <button type="button" class="button button-primary" data-<?php echo PREFIX;?>-license="<?php echo $btn_action;?>"><?php echo $btn_label;?></button>
            <?php if($license->is_active()):?>
               <button type="button" class="button button-secondary" data-<?php echo PREFIX;?>-license="get_update"><?php _e('Check for update', 'integration-adyen-woocommerce');?></button>
            <?php endif;?>
         </div>
      </div>
   </td>
</tr>