<?php
/**
 * @author Woosa Team
 */

namespace Woosa\Adyen;


//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;

/**
 * @var string $title
 */
/**
 * @var string $desc
 */
/**
 * @var string $ip_whitelist
 */
?>
<tr class="<?php echo PREFIX;?>-style">
   <td class="p-0">
      <table class="bg-white w-800">
         <tr>
            <td>
               <b><?php echo $title;?></b>
               <p class="description"><?php echo $desc;?></p>
               <p class="ip-whitelist">
                  <ul style="list-style: none;">
                  <?php foreach($ip_whitelist as $ip_whitelist_item): ?>
                     <li><?php echo $ip_whitelist_item; ?></li>
                  <?php endforeach; ?>
                  </ul>
               </p>
            </td>
         </tr>
      </table>
   </td>
</tr>