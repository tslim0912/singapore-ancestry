<?php
get_template_part('template-parts/admin/admin-section-template', 'page-header');
?>
<div class="site-page-status">
    <div class="sa-row justify-content-end">
        <div class="sa-col sa-col-search d-none">
            <button type="button" class="btn btn-return" onclick="window.location.href='<?php echo home_url('/user-management');?>'"><i class="fa fa-chevron-left" aria-hidden="true"></i><span>Back</span></button>
        </div>
        <div class="sa-col sa-col-action">
            <button type="button" class="btn btn-cancel btn-outline" onclick="window.location.href='<?php echo home_url('/user-management');?>'"><span>Cancel</span></a>
            <button type="button" class="btn btn-submit btn-theme-yellow" id="btn-submit"><span>Create</span></button>
        </div>
    </div>
</div>
<div class="site-page-body admin-tabs">
    <div class="admin-tab-body tab-with-form">
        <div class="error"></div>
        <form class="wp-form admin-tab-form create-new-user admin-fullpage-form p-0" id="create-new-user">
            <div class="loading"><span class="loader"></span></div>
            <div class="wp-form-row row-column">
                <div class="wp-form-column column-info">
                    <h3>User Details</h3>
                    <p>Enter user name, address and contact information.</p>
                </div>
                <div class="wp-form-column column-fields">
                    <div class="wp-form-inner">
                        <div class="wp-form-group">
                            <label for="user-name">User Name</label>
                            <input type="text" name="user_name" id="user-name" class="input-control" placeholder="Name"/>
                        </div>
                        <div class="wp-form-group">
                            <label for="user-id">User ID</label>
                            <input type="text" name="user_id" id="user-id" class="input-control" placeholder="Comp00001"/>
                        </div>
                        <div class="wp-form-group">
                            <label for="user-email">User Email</label>
                            <input type="email" name="user_email" id="user-email" class="input-control" placeholder="Email Address"/>
                        </div>
                        <div class="wp-form-group">
                            <label for="user-phone">Contact No.</label>
                            <input type="tel" name="user_phone" id="user-phone" class="input-control intl-phone"  placeholder="Contact No."/>
                        </div>
                        <div class="wp-form-group">
                            <label for="user-password">Password</label>
                            <div class="password-wrapper">
                                <input type="password" name="user_password" id="user-password" class="input-control"  placeholder="Password"/>
                                <button type="button" class="show-password"><span class="d-none">Show Password</span><i class="fa fa-eye" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <div class="wp-form-group">
                            <label for="user-password-confirm">Repeat Password</label>
                            <div class="password-wrapper">
                                <input type="password" name="user_password_confirm" id="user-password-confirm" class="input-control"  placeholder="Repeat Password"/>
                                <button type="button" class="show-password"><span class="d-none">Show Password</span><i class="fa fa-eye" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wp-form-row row-column">
                <div class="wp-form-column column-info">
                    <h3>Account Status</h3>
                    <p>Activate or suspend this particular accounts.</p>
                </div>
                <div class="wp-form-column column-fields">
                    <div class="wp-form-inner">
                        <div class="wp-form-group">
                            <label for="user-status">Status of this account</label>
                            <select name="user_status" id="user-status" class="input-control">
                                <option value="">Please select a status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>
                        <div class="wp-form-group full">
                            <label for="user-remarks">Remarks</label>
                            <textarea rows="1" name="user_remarks" id="user-remarks" class="input-control" placeholder="Remarks"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>