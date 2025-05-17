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
            <button type="button" class="btn btn-submit btn-theme-yellow" id="btn-submit"><span>Create</span></button>
        </div>
    </div>
</div>
<div class="site-page-body admin-tabs">
    <div class="admin-tab-body fullpage-form">
        <div class="error"></div>
        <form class="wp-form admin-tab-form create-new-undertaker admin-fullpage-form p-0" id="create-new-undertaker">
            <div class="loading"><span class="loader"></span></div>
            <div class="wp-form-row row-column">
                <div class="wp-form-column column-info">
                    <h3>Company Details</h3>
                    <p>Enter company name, address and contact information.</p>
                </div>
                <div class="wp-form-column column-fields">
                    <div class="wp-form-inner">
                        <div class="wp-form-group">
                            <label for="undertaker-company-name">Company Name</label>
                            <input type="text" name="undertaker_company_name" id="undertaker-company-name" class="input-control" placeholder="Company Name"/>
                        </div>
                        <div class="wp-form-group">
                            <label for="undertaker-company-id">Company ID</label>
                            <input type="text" name="undertaker_company_id" id="undertaker-company-id" class="input-control" placeholder="Comp0001"/>
                        </div>
                        <div class="wp-form-group full">
                            <label for="undertaker-address-1">Address</label>
                            <input type="text" name="undertaker_address_1" id="undertaker-address-1" class="input-control" placeholder="Line 1"/>
                            <input type="text" name="undertaker_address_2" id="undertaker-address-2" class="input-control" placeholder="Line 2"/>
                        </div>
                        <div class="wp-form-group">
                            <label for="undertaker-postcode">Postcode</label>
                            <input type="text" name="undertaker_postcode" id="undertaker-postcode" class="input-control" placeholder="Postcode"/>
                        </div>
                        <div class="wp-form-group">
                            <label for="undertaker-city">City</label>
                            <input type="text" name="undertaker_city" id="undertaker-city" class="input-control" placeholder="City"/>
                        </div>
                        <div class="wp-form-group">
                            <label for="undertaker-state">State</label>
                            <input type="text" name="undertaker_state" id="undertaker-state" class="input-control" placeholder="State"/>
                        </div>
                        <div class="wp-form-group">
                            <label for="undertaker-country">Country</label>
                            <input type="text" name="undertaker_country" id="undertaker-country" class="input-control" placeholder="Country"/>
                        </div>
                        <div class="wp-form-group">
                            <label for="undertaker-company-contact">Contact No.</label>
                            <input type="text" name="undertaker_company_contact" id="undertaker-company-contact" class="input-control intl-phone company-mobile" placeholder="Contact No."/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wp-form-row row-column">
                <div class="wp-form-column column-info">
                    <h3>PIC Details</h3>
                    <p>Enter PIC name, address and contact information.</p>
                </div>
                <div class="wp-form-column column-fields">
                    <div class="wp-form-inner">
                        <div class="wp-form-group">
                            <label for="undertaker-fullname">Name</label>
                            <input type="text" name="undertaker_fullname" id="undertaker-fullname" class="input-control" placeholder="Name"/>
                        </div>
                        <div class="wp-form-group">
                            <label for="pic-id">PIC ID</label>
                            <input type="text" name="pic_id" id="pic-id" class="input-control" placeholder="Comp00001"/>
                        </div>
                        <div class="wp-form-group">
                            <label for="undertaker-email">User Email</label>
                            <input type="email" name="undertaker_email" id="undertaker-email" class="input-control" placeholder="Email Address"/>
                        </div>
                        <div class="wp-form-group">
                            <label for="undertaker-phone">Contact No.</label>
                            <input type="tel" name="undertaker_phone" id="undertaker-phone" class="input-control intl-phone pic-mobile"  placeholder="Contact No."/>
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
                    <div class="loading"><span class="loader"></span></div>
                    <div class="wp-form-inner">
                        <div class="wp-form-group">
                            <label for="undertaker-status">Status of this account</label>
                            <select name="undertaker_status" id="undertaker-status" class="input-control">
                                <option value="">Please select a status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>
                        <div class="wp-form-group full">
                            <label for="undertaker-remarks">Remarks</label>
                            <textarea rows="1" name="undertaker_remarks" id="undertaker-remarks" class="input-control" placeholder="Remarks"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>