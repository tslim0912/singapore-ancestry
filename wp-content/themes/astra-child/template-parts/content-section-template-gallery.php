<?php
$obituary_id = get_query_var('obituary_id');
$obituary_title = get_the_title($obituary_id);
$slug = get_post_field( 'post_name', $obituary_id);
$share_link = get_query_var('share_link');
$gallery = get_field('gallery', $obituary_id);
$slides = $gallery['slideshow'];
$private = $gallery['private'];
$first_gallery = '';
$hidden_gallery = '';
foreach($slides as $key=>$slide) {
    if( $key===0 ) {
        $first_gallery = $slide['url'];
    }
    else {
        $hidden_gallery .= '<a href="'.$slide['url'].'" class="fancybox" data-fancybox="gallery-'.$slug.'" ><span class="d-none">Gallery - '.$obituary_title.' ('.$i.')</span></a>';
    }
}
?>
<div class="obituary-inner">
    <div class="ob-gallery-header">
        <div class="ob-row">
            <div class="ob-col col-title">
                <h3>Gallery</h3>
            </div>
            <div class="ob-col col-share">
                <div class="ob-play">
                    <?php if ($private) {
                        echo '<button type="button" class="btn btn-preview" id="btn-preview" data-id="'.$obituary_id.'"><i class="fa fa-play" aria-hidden="true"></i> <span class="d-none">Share</span></button>';
                    }
                    else {
                        if( empty($slides) ) { $checking = ' disabled'; }
                        else { $checking = ''; }
                        echo '<a href="'.$first_gallery.'" data-fancybox="gallery-'.$slug.'"'.$checking.' class="btn btn-preview fancybox'.$checking.'"><i class="fa fa-play" aria-hidden="true"></i> <span class="d-none">Share</span></a>';
                        echo '<div class="d-none">'.$hidden_gallery.'</div>';
                    } ?>
                </div>
                <div class="ob-share">
                    <button type="button" class="btn btn-share" id="btn-share" data-value="<?php echo $share_link;?>"><i class="fa fa-share-alt" aria-hidden="true"></i> <span>Share</span></button>
                </div>
            </div>
        </div>
    </div>
    <div class="ob-gallery-body">
        <div class="ob-gallery-row">
        <?php 
        if( $gallery ) {
            $slides = $gallery['slideshow']; ?>
            <div class="grid grid-gallery gallery-masonry">
            <?php foreach($slides as $key=>$slide) { 
                if($private && $key>=5) {
                    break;
                }
            ?>
                <div class="grid-item grid-item-<?php echo get_row_index();?>" id="grid-item-<?php echo get_row_index();?>">
                    <div class="grid-item-inner">
                        <div class="grid-thumbnail">
                            <a class="grid-link fancybox" data-fancybox="gallery" href="<?php echo $slide['url'];?>">
                                <img decoding="async" src="<?php echo $slide['url'];?>" class="img-fluid w-100">
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
        <?php } ?>
        </div>
    </div>
</div>