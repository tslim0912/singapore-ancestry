<?php
if( is_archive() ) {
    $archive_title = get_the_archive_title();
    $page_title = str_replace( 'Archives: ', '', $archive_title );
}
else {
    $page_title = get_the_title();
}
?>
<div class="listing-page listing-obituary">
    <div class="listing-header">
        <h2><?php echo $page_title;?></h2>
        <p>Search for an obituary to find and remember your loved one. Enter a name to view details, tributes, and memories shared by family and friends.</p>
    </div>
    <div class="listing-body">
        <div class="obituary-search">
            <?php get_template_part('template-parts/content-form-template', 'obituary'); ?>
        </div>
        <div class="obituary-content">
            <div class="obituary-card">
                <div class="loading"><span class="loader"></span></div>
                <div class="obituary-inner">
                    <div class="obituary-slider-container">
                    <?php
                    $args = array(
                        'post_type' => 'obituary',
                        'post_status' => 'publish',
                        'posts_per_page' => 24,
                        'order' => 'date',
                        'orderby' => 'desc'
                    );
                    // if( isset($_GET['people']) && !empty($_GET['people']) ) {
                    //     $args['name'] = $_GET['people'];
                    // }
                    $obituary = new WP_Query($args);
                    if($obituary->have_posts()){
                    ?>
                        <div class="ob-navs ob-nav-prev"></div>
                        <div class="ob-navs ob-nav-next"></div>
                        <div class="obituary-listing-slider swiper" id="obituary-listing-slider">
                            <div class="swiper-wrapper">
                            <?php while($obituary->have_posts()){
                                $obituary->the_post();
                                $ob_id = get_the_ID();
                                set_query_var('obituary_id', $ob_id);
                                get_template_part('template-parts/content-slider-template', 'obituary');
                                
                            } wp_reset_postdata(); ?>
                            </div>
                        </div>
                        <div class="ob-pagination"></div>
                    <?php } else {
                    ?>
                        <div class="dialog-message alert">There is no record at the moment!</div>
                    <?php
                    } ?>
                    </div>

                    <div class="obituary-details"></div>
                    <div class="obituary-map-navigation"></div>
                </div>
            </div>
            <div class="obituary-extra"></div>
        </div>
    </div>
</div>