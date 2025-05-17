<?php
$current_user = wp_get_current_user();

$nickname = $current_user->nickname;
$display_name = $current_user->display_name;
get_template_part('template-parts/admin/admin-section-template', 'page-header');

?>

<div class="site-page-body">
    <p>Hi, <b><?php echo $display_name;?></b>. Welcome back...!</p>
</div>