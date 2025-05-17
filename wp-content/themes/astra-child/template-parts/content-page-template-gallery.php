<?php
$txt = 'Abcd@1234';
?>
<div class="listing-page listing-obituary listing-gallery">
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
                                $ob_name = get_the_title();
                                $ob_slug = get_post_field( 'post_name', $ob_id );
                                $basic = get_field('basic_information');
                                $birthdate = $basic['date_of_birth'];
                                $deathdate = $basic['date_of_death'];
                                $ob_date = obituary_date_of_birth_to_death($birthdate, $deathdate);;
                            ?>
                                <div class="swiper-slide<?php echo (isset($_GET['people']) && $ob_slug==$_GET['people'] ) ? ' selected' : '';?>" data-value="<?php echo $ob_slug;?>" data-id="<?php echo $ob_id;?>">
                                <div class="swiper-slide-inner">
                                        <div class="obituary-thumbnail">
                                        <?php if ( has_post_thumbnail() ) { 
                                            echo '<img src="'.get_the_post_thumbnail_url().'" class="img-fluid w-100"/>';
                                        } ?>
                                        </div>
                                        <div class="obituary-content">
                                            <div class="obituary-prefix">In loving memories of</div>
                                            <div class="obituary-name"><?php echo $ob_name;?></div>
                                            <div class="obituary-dates"><?php echo $ob_date;?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php } wp_reset_postdata(); ?>
                            </div>
                        </div>
                        <div class="ob-pagination"></div>
                    <?php } else {
                    ?>
                        <div class="dialog-message alert">There is no record at the moment!</div>
                    <?php
                    } ?>
                    </div>
                </div>
            </div>
            
            <div class="obituary-gallery-box obituary-card">
            </div>
        </div>
    </div>
</div>