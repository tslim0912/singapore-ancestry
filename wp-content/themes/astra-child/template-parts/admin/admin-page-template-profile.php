<?php
get_template_part('template-parts/admin/admin-section-template', 'page-header');
?>
<div class="site-page-status">
    <div class="sa-row justify-content-end">
        <div class="sa-col sa-col-search d-none">
            <button type="button" class="btn btn-return" onclick="window.location.href='<?php echo home_url('/undertaker-management');?>'"><i class="fa fa-chevron-left" aria-hidden="true"></i><span>Back</span></button>
        </div>
        <div class="sa-col sa-col-action">
            <button type="button" class="btn btn-cancel btn-outline" onclick="window.location.href='<?php echo home_url('/undertaker-management');?>'"><span>Cancel</span></a>
            <button type="button" class="btn btn-submit btn-theme-yellow" id="btn-submit"><span>Save</span></button>
        </div>
    </div>
</div>
<?php
$user = wp_get_current_user();
$user_id = $user->ID;
$firstname = $user->user_firstname;
$email = $user->user_email;
$roles = $user->roles;
$role = $roles[0];
if( $role == 'contributor' ) { // Undertaker
    $acf = get_field('connection', 'user_'.$user_id);
    $target_post_id = $acf['undertaker_post_id'];
    $contact = $acf['contact_number'];
    $pic_details = get_field('pic_details', $target_post_id);
    $account_id = $pic_details['pic_id'];
    $role_title = 'Undertaker';
}
else if( $role == 'subscriber' ) { // User
    $acf = get_field('obituary_record', 'user_'.$user_id);
    $contact = $acf['contact_number'];
    $account_id = $acf['user_id'];
    $role_title = 'User';
}
else {
    $acf = get_field('additional', 'user_'.$user_id);
    $contact = $acf['contact_number'];
    $account_id = $user_id;
    $role_title = 'Site Admin';
}
?>
<div class="site-page-body admin-tabs" data-id="<?php echo $account_id.'-'.$role;?>">
    <div class="admin-tab-body fullpage-form">
        <div class="error"></div>
        <form class="wp-form admin-tab-form edit-account-profile admin-fullpage-form p-0" id="edit-account-profile">
            <div class="loading"><span class="loader"></span></div>
            <div class="wp-form-row row-column">
                <div class="wp-form-column column-info">
                    <h3><?php echo $role_title;?> Details</h3>
                    <p>Edit user name, email and contact no.</p>
                    <input type="hidden" name="user_role" id="user-role" value="<?php echo $role;?>"/>
                    <input type="hidden" name="user_id" id="user-id" value="<?php echo $user_id;?>"/>
                </div>
                <?php
                if( $role == 'subscriber' ) {
                ?>
                <div class="wp-form-column column-fields">
                    <div class="wp-form-inner">
                        <div class="wp-form-group">
                            <label for=""><?php echo $role_title;?> Name</label>
                            <input type="text" name="user_name" id="user-name" class="input-control" value="<?php echo $firstname;?>"/>
                        </div>
                        <div class="wp-form-group">
                            <label for="user-id"><?php echo $role_title;?> ID</label>
                            <div class="input-control"><?php echo $account_id;?></div>
                        </div>
                        <div class="wp-form-group">
                            <label for="user-email">Email Address</label>
                            <input type="text" name="user_email" id="user-email" class="input-control" value="<?php echo $email;?>"/>
                        </div>
                        <div class="wp-form-group">
                            <label for="user-phone"><?php echo $role_title;?> Contact No.</label>
                            <input type="text" name="user_phone" id="user-phone" class="input-control intl-phone user-mobile" value="<?php echo $contact;?>" data-mobile="<?php echo $contact;?>"/>
                        </div>
                    </div>
                </div>
                <?php
                } 
                else if( $role == 'contributor' ) { ?>
                <div class="wp-form-column column-fields">
                    <div class="wp-form-inner">
                        <div class="wp-form-group">
                            <label for=""><?php echo $role_title;?> Name</label>
                            <input type="text" name="user_name" id="user-name" class="input-control" value="<?php echo $firstname;?>"/>
                        </div>
                        <div class="wp-form-group">
                            <label for="user-id"><?php echo $role_title;?> ID</label>
                            <div class="input-control"><?php echo $account_id;?></div>
                        </div>
                        <div class="wp-form-group">
                            <label for="user-email">Email Address</label>
                            <input type="text" name="user_email" id="user-email" class="input-control" value="<?php echo $email;?>"/>
                        </div>
                        <div class="wp-form-group">
                            <label for="user-mobile"><?php echo $role_title;?> Contact No.</label>
                            <input type="text" name="user_mobile" id="user-mobile" class="input-control intl-phone user-mobile" value="<?php echo $contact;?>" data-mobile="<?php echo $contact;?>"/>
                        </div>
                    </div>
                </div>
                <?php }
                else { ?>
                <div class="wp-form-column column-fields">
                    <div class="wp-form-inner">
                        <div class="wp-form-group">
                            <label for=""><?php echo $role_title;?> Name</label>
                            <input type="text" name="user_name" id="user-name" class="input-control" value="<?php echo $firstname;?>"/>
                        </div>
                        <div class="wp-form-group">
                            <label for="user-id"><?php echo $role_title;?> ID</label>
                            <div class="input-control"><?php echo $account_id;?></div>
                        </div>
                        <div class="wp-form-group">
                            <label for="user-email">Email Address</label>
                            <input type="text" name="user_email" id="user-email" class="input-control" value="<?php echo $email;?>"/>
                        </div>
                        <div class="wp-form-group" data-test="<?php echo $contact;?>">
                            <label for="user-mobile"><?php echo $role_title;?> Contact No.</label>
                            <input type="text" name="user_mobile" id="user-mobile" class="input-control intl-phone user-mobile" value="<?php echo $contact;?>" data-mobile="<?php echo $contact;?>"/>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </form>
    </div>
</div>