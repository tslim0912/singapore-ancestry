<?php
$ob_id = get_query_var('obituary_id');
$ob_name = get_the_title();
$ob_slug = get_post_field( 'post_name', $ob_id );
$basic = get_field('basic_information');
$birthdate = $basic['date_of_birth'];
$deathdate = $basic['date_of_death'];
$ob_date = obituary_date_of_birth_to_death($birthdate, $deathdate);
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