<?php
get_template_part('template-parts/admin/admin-section-template', 'page-header');
?>

<div class="site-page-status">
    <div class="sa-row justify-content-end">
        <div class="sa-col sa-col-search d-none">
            <button type="button" class="btn btn-return" onclick="window.location.href='<?php echo home_url('/dashboard');?>'"><i class="fa fa-chevron-left" aria-hidden="true"></i><span>Back</span></button>
        </div>
        <div class="sa-col sa-col-action">
            <a href="<?php echo home_url('/user-management/create');?>" class="btn btn-submit btn-theme-yellow"><span>Create</span></a>
        </div>
    </div>
</div>

<?php
$args = array(
    'role'    => 'subscriber',
    'orderby' => 'ID',
    'order'   => 'ASC',
    'number'  => -1,
);
$user_query = new WP_User_Query($args);
$subscribers = $user_query->get_results();
?>
<div class="site-page-body">
    <div class="admin-table-box">
        <div class="admin-table-wrapper table-user-management">
            <table class="w-100 mb-0">
                <thead>
                    <tr>
                        <th class="text-start">User Name</th>
                        <th class="text-center">Contact No.</th>
                        <th class="text-start">Email Address</th>
                        <th class="text-center">Status</th>
                        <th class="text-start">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if (!empty($subscribers)) {
                    foreach ($subscribers as $user) {
                        $user_id = $user->ID;
                        $fullname = $user->display_name;
                        $email = $user->user_email;
                        $acf = get_field('obituary_record', 'user_'.$user_id);
                        $contact = $acf['contact_number'];
                        $status = $acf['status'];
                        if( empty($status) ) {
                            $status = 'active';
                        }
                ?>
                    <tr>
                        <td class="text-start"><?php echo $fullname;?></td>
                        <td class="text-center"><?php echo $contact;?></td>
                        <td class="text-start"><?php echo $email;?></td>
                        <td class="text-center"><?php echo ucfirst($status);?></td>
                        <td class="text-start">
                            <div class="btn-wrapper">
                            <?php if( $status == 'active' ) {
                                echo '<button type="button" class="btn btn-data-action btn-deactivate" title="Deactivate" data-user-id="'.$user_id.'"><img src="'.admin_asset_directory_url().'/img/icon-dustbin-white.svg" /><span>Deactivate</span></button>';
                            }
                            else {
                                echo '<button type="button" class="btn btn-data-action btn-activate" title="Deactivate" data-user-id="'.$user_id.'"><span>Activate</span></button>';
                            } ?>
                            </div>
                        </td>
                    </tr>
                <?php }
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
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>