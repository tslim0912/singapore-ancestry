<?php
get_template_part('template-parts/admin/admin-section-template', 'page-header');
?>
<div class="site-page-status">
    <div class="sa-row justify-content-end">
        <div class="sa-col sa-col-search d-none">
            <button type="button" class="btn btn-return" onclick="window.location.href='<?php echo home_url('/dashboard');?>'"><i class="fa fa-chevron-left" aria-hidden="true"></i><span>Back</span></button>
        </div>
        <div class="sa-col sa-col-action">
            <a href="<?php echo home_url('/undertaker-management/create-undertaker');?>" class="btn btn-submit btn-theme-yellow"><span>Create</span></a>
        </div>
    </div>
</div>
<div class="site-page-body">
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
                <?php
                $undertakers = get_users([
                    'role'    => 'contributor',
                    'orderby' => 'ID',
                    'order'   => 'DESC'
                ]);
                if( !empty($undertakers) ) { 
                    foreach( $undertakers as $user ) {
                        $user_ID = $user->ID;
                        $user_fullname = $user->fullname;
                        $connection = get_field('connection', 'user_'.$user_ID);
                        $undertaker_ID = $connection['undertaker_post_id'];
                        $company_details = get_field('company_details', $undertaker_ID);
                        $pic_details = get_field('pic_details', $undertaker_ID);
                        $account_status = get_field('account_status', $undertaker_ID);
                        $company_name = get_the_title($undertaker_ID);
                        $fullname = $pic_details['name'];
                        $contact = $pic_details['contact_number'];
                        $email = $pic_details['email'];
                        $status = get_field('status', 'user_'.$user_ID);
                        if( empty($status) ) {
                            $status = 'active';
                        }
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $company_name;?></td>
                        <td class="text-center"><?php echo $fullname;?></td>
                        <td class="text-center"><?php echo $contact;?></td>
                        <td class="text-center"><?php echo $email;?></td>
                        <td class="text-center"><?php echo ucfirst($status);?></td>
                        <td class="text-center">
                            <div class="btn-wrapper d-flex gap-2">
                            <?php
                            $buttonPending = '<button type="button" class="btn btn-data-action btn-pending pending" data-user-id="'.$user_ID.'"><span>Pending</span></button>';
                            $buttonInactive = '<button type="button" class="btn btn-data-action btn-deactivate draft" data-user-id="'.$user_ID.'"><span>Inactive</span></button>';
                            $buttonActive = '<button type="button" class="btn btn-data-action btn-activate publish" data-user-id="'.$user_ID.'"><span>Published</span></button>';
                            if( $status == 'pending' ) {
                                echo $buttonInactive . $buttonActive;
                            }
                            else if( $status == 'inactive' ) {
                                echo $buttonPending . $buttonActive;
                            }
                            else {
                                echo $buttonPending . $buttonInactive;
                            }
                            ?>
                            </div>
                        </td>
                    </tr>
                <?php 
                    }
                } else { ?>
                    <tr>
                        <td colspan="8" class="text-center">
                            <div class="entry-no-found d-inline-block mx-auto">
                                <div class="entry-thumbnail"><img src="<?php echo admin_asset_directory_url();?>/img/icon-no-found.png" class="img-fluid w-100"/></div>
                                <div class="entry-body text-center">
                                    <div class="entry-title">Ops, it is empty.</div>
                                    <div class="entry-paragragh">Click upload button to upload now</div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>