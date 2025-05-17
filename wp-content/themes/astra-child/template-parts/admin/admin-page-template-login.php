<?php
// 1. Landing  - Get Started or Already have an account
// 2. *Sign In layout 
// 3. *Registration
//      a. Get Name
//      b. Get Email Address and Password
//      c. 
// 
// 
?>
<div class="app-card">
    <div class="loading"><span class="loader"></span></div>
    <div class="app-row">
        <div class="app-col app-header" style="background-image: url('<?php echo admin_asset_directory_url();?>/img/bg-admin-app-card.png')">
            <div class="app-logo">
            <?php 
            $logo_id = get_theme_mod( 'custom_logo' );
            $logo_url = wp_get_attachment_image_url( $logo_id , 'full' );
            echo '<div class="app-logo-box">';
                if ( $logo_url ) { 
                    echo '<img src="'.esc_url( $logo_url ).'" alt="'.bloginfo( 'name' ).'">';
                }
                echo '<span class="site-title">'.bloginfo( 'name' ).'</span>';
            echo '</div>';?>
            </div>
            <div class="app-title">Get Started with Singapore Ancestry</div>
        </div>
        <div class="app-col app-body">
            <?php get_template_part('template-parts/admin/admin-login-template', 'default'); ?>
        </div>
    </div>
</div>