<?php
$obituary_id = get_query_var('obituary_id');
$share_link = get_query_var('share_link');
$location = get_field('location_map', $obituary_id);
$gmap = $location['google_map'];
$waze = $location['waze'];
?>
<div class="ob-row">
    <div class="ob-col col-map">
        <p class="mb-0">Location: </p>
        <div class="ob-map-nav">
            <?php 
            if( !empty($gmap) ) {
                echo '<div class="ob-map-item"><a href="'.$gmap.'" target="_blank" class="ob-map-link gmap"><span class="d-none">Google Map</span><img src="/~tangstud/singapore-ancestry/wp-content/uploads/2025/04/icon-google-map.svg" class="img-fluid w-100"/></a></div>';
            }
            if( !empty($waze) ) {
                echo '<div class="ob-map-item"><a href="'.$waze.'" target="_blank" class="ob-map-link waze"><span class="d-none">Waze</span><img src="/~tangstud/singapore-ancestry/wp-content/uploads/2025/04/icon-waze.svg" class="img-fluid w-100"/></a></div>';
            }
            ?>
        </div>
    </div>
    <div class="ob-col col-share">
        <div class="ob-share">
            <button type="button" class="btn btn-share" id="btn-share" data-value="<?php echo $share_link;?>"><i class="fa fa-share-alt" aria-hidden="true"></i> <span>Share</span></button>
        </div>
    </div>
</div>