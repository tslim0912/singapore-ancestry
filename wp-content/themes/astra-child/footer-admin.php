<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
	    	</div><!-- .site-content -->
	    </div>
        <?php
            wp_footer();
            if( is_user_logged_in() ) {
                get_template_part('template-parts/admin/admin-popup-template', 'logout');
                get_template_part('template-parts/admin/popup/sg-ancestry-popup-template', 'global');
            }
        ?>
	</body>
</html>
