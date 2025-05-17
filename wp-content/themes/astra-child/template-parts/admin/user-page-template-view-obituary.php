<?php
if( is_user_logged_in() ) {
$user = wp_get_current_user();
$user_id = $user->ID;
$user_roles = $user->roles;
$user_role = $user_roles[0];
$obituary_record = get_field('obituary_record', 'user_'.$user_id);
$post_id = $obituary_record['connection'];
?>

<div class="admin-tab-body admin-tabs">
    <div class="error"></div>
    <div class="sa-row admin-tab-row">
        <div class="admin-tab-header">
            <h3>Gallery</h3>
            <p>To upload images for the public or private view.</p>
        </div>
        <div class="admin-tab-body tab-with-form">
            <form class="wp-form admin-tab-form update-private-gallery" id="update-private-gallery">
                <div class="loading"><span class="loader"></span></div>
                <div class="wp-form-row row-column">
                    <div class="wp-form-group">
                        <div class="gallery-display" data-id="<?php echo $post_id;?>">
                        <?php
                        $gallery_field = get_field('gallery', $post_id);
                        $private = $gallery_field['private'];
                        $password = $gallery_field['slideshow_password'];
                        ?>
                            <input type="checkbox" name="private_gallery" id="private-gallery" class="input-control" <?php if ($private == 1) echo 'checked'; ?>/>
                            <label for="private-gallery">Make the gallery private?</label>
                        </div>
                        <?php
                        if( $private == 1 ) { ?>
                            <div id="password-field">
                                <input type="text" name="gallery_password" class="input-control gallery-password" id="gallery-password" <?php if( !empty($password) ){ echo "value='$password'";}?>>
                                <button type="submit" class="btn btn-theme-yellow" id="submit-private-gallery"><span>Save</span></button>
                            </div>
                        <?php }
                        ?>
                    </div>
                    <input type="hidden" name="user_id" value="<?php echo $user_id;?>"/>
                    <input type="hidden" name="post_id" value="<?php echo $post_id;?>"/>
                </div>
                <div class="error"></div>
            </form>
        </div>
    </div>
</div>
<?php
}
?>