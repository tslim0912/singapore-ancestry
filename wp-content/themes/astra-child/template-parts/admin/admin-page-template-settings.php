    <?php
get_template_part('template-parts/admin/admin-section-template', 'page-header');
?>
<div class="site-page-status">
    <div class="sa-row justify-content-between">
        <div class="sa-col sa-col-return">
            <button type="button" class="btn btn-return" onclick="window.location.href='<?php echo home_url('/dashboard');?>'"><i class="fa fa-chevron-left" aria-hidden="true"></i><span>Back</span></button>
        </div>
        <div class="sa-col sa-col-action">
            <button type="button" class="btn btn-cancel btn-outline" onclick="window.location.href='<?php echo home_url('/dashboard');?>'"><span>Cancel</span></a>
            <button type="button" class="btn btn-submit btn-theme-yellow" id="btn-submit"><span>Save</span></button>
        </div>
    </div>
</div>
<div class="site-page-body admin-tabs">
    <div class="sa-row admin-tab-row">
        <div class="admin-tab-header">
            <h3>Setting</h3>
            <p>Change your password.</p>
        </div>
        <div class="admin-tab-body tab-with-form">
            <form class="wp-form admin-tab-form update-password" id="update-password">
                <div class="loading"><span class="loader"></span></div>
                <div class="wp-form-row row-column">
                    <div class="wp-form-group">
                        <label for="old-password">Old Password</label>
                        <div class="password-wrapper">
                            <input type="password" class="input-control password-field" name="old_password" id="old-password" placeholder="Old Passowrd"/>
                            <button type="button" class="show-password"><i class="fa fa-eye" aria-hidden="true"></i><span class="d-none">Show Password</span></button>
                        </div>
                    </div>
                    <div class="wp-form-group">
                        <label for="new-password">New Password</label>
                        <div class="password-wrapper">
                            <input type="password" class="input-control password-field" name="new_password" id="new-password" placeholder="New Password"/>
                            <button type="button" class="show-password"><i class="fa fa-eye" aria-hidden="true"></i><span class="d-none">Show Password</span></button>
                        </div>
                    </div>
                    <div class="wp-form-group">
                        <label for="repeat-password">Confirm New Password</label>
                        <div class="password-wrapper">
                            <input type="password" class="input-control password-field" name="repeat_password" id="repeat-password" placeholder="Confirm New Password"/>
                            <button type="button" class="show-password"><i class="fa fa-eye" aria-hidden="true"></i><span class="d-none">Show Password</span></button>
                        </div>
                    </div>
                </div>
                <div class="error"></div>
            </form>
        </div>
    </div>
</div>