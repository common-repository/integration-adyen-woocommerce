<?php
/**
 * @author Woosa Team
 */

namespace Woosa\Adyen;


//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;

/**
 * @var Module_Authorization $authorization
 */

?>

<tr class="<?php echo PREFIX;?>-style">
   <td class="p-0">
      <div class="bg-white w-800 p-10">
         <p><?php printf(__('Status: %s', 'integration-adyen-woocommerce'), $status);?></p>
         <?php if (!empty($authorization->get_wiki_article_url())): ?>
         <p><em><?php
            printf(
               __('Questions about the authorization of your Adyen account? Read our %sHelp Center article%s, we will guide you step-by-step through the process.', 'integration-adyen-woocommerce'),
               sprintf(
                  '<a href="%s" target="_blank">',
                  $authorization->get_wiki_article_url()
               ),
               '</a>'
            );
         ?></em></p>
         <?php endif; ?>

         <?php do_action(PREFIX . '\authorization\output_section\fields', $authorization);?>

         <div class="pt-15">
            <button type="button" class="button button-primary" <?php echo $button['data-attr'];?>><?php echo $button['label'];?></button>
         </div>
      </div>
   </td>
</tr>