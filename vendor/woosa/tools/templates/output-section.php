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
      <table class="bg-white w-800" data-<?php echo PREFIX;?>-tools>
         <?php foreach($tools as $tool){
            $tool->render();
         }?>
      </table>
   </td>
</tr>