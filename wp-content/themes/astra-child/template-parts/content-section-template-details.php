<?php
$obituary_id = get_query_var('obituary_id');
$details = get_field('obituary', $obituary_id);
if($details) {
   $count_row = count($details);
?>
<div class="obituary-details-row">
    <h4>Obituary</h4>
    <div class="obituary-details-slider swiper" id="obituary-details-slider">
        <div class="swiper-wrapper">
        <?php foreach( $details as $row ) { 
            $image = $row['image'];
            $index = get_row_index();
            echo '<div class="swiper-slide slide-item-'.$index.'"><a href="'.$image['url'].'" class="fancybox" data-fancybox="details-'.$obotuary_id.'"><img src="'.$image['url'].'" class="img-fluid w-100"/></a></div>';
        } ?>
        </div>
    </div>
    <div class="obituary-details-pagination"></div>
</div>
<?php
}
?>