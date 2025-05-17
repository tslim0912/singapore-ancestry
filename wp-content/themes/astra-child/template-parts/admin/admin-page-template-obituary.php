<?php
if( is_user_logged_in() ) {
    
$user = wp_get_current_user();
$user_id = $user->ID;
$user_roles = $user->roles;
$user_role = $user_roles[0];

get_template_part('template-parts/admin/admin-section-template', 'page-header');

if( $user_role == 'administrator' || $user_role == 'editor' || $user_role == 'contributor' ) { ?>
<div class="site-page-status">
    <div class="sa-row justify-content-between">
        <div class="sa-col sa-col-search">
            <form class="wp-form admin-search-obituary" id="admin-search-obituary">
                <div class="wp-form-row row-column">
                    <div class="wp-form-column column-fields">
                        <div class="wp-form-inner">
                            <div class="wp-form-group">
                                <input type="text" name="obituary_keyword" class="input-control" placeholder="Search"/>
                                <button type="submit" class="btn btn-magnify-glass"><span class="d-none">Search</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="sa-col sa-col-action">
            <a href="<?php echo home_url('/undertaker-management/create-undertaker');?>" class="btn btn-submit btn-theme-yellow"><span>Create</span></a>
        </div>
    </div>
</div>
<?php } ?>
<div class="site-page-body">
<?php

if( $user_role == 'subscriber' ) {
    get_template_part('template-parts/admin/user-page-template', 'view-obituary');
}
else {
?>
    <div class="admin-table-box">
        <div class="admin-table-wrapper">
            <table class="w-100 mb-0">
                <thead>
                    <tr>
                        <th class="text-center text-white"><a href="javascript:void(0);" class="sorting" data-orderby="title" data-order="asc">Company Name</a></th>
                        <th class="text-center text-white"><a href="javascript:void(0);" class="sorting" data-orderby="pic" data-order="asc">PIC Name</a></th>
                        <th class="text-center text-white"><a href="javascript:void(0);" class="sorting" data-orderby="contact" data-order="asc">Contact No.</a></th>
                        <th class="text-center text-white"><a href="javascript:void(0);" class="sorting" data-orderby="email" data-order="asc">Email Address</a></th>
                        <th class="text-center text-white"><a href="javascript:void(0);" class="sorting" data-orderby="status" data-order="asc">Status</a></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
<?php
}
?>
</div>
<?php
}
?>