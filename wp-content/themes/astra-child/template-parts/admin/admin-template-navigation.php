<?php
global $post;
$current_slug = $post ? $post->post_name : '';
$user = wp_get_current_user();
$user_id = $user->ID;
$user_roles = $user->roles;
$user_role = $user_roles[0];
?>
<header class="admin-sidebar" id="adminhead">
    <button type="button" class="mobile-toggler"><span class="d-none">Mobile Toggle Navigation</span></button>
    <nav class="navbar">
        <div class="navbar-row">
            <div class="navbar-col navbar-header">
                <a href="http://111.90.133.203/~tangstud/singapore-ancestry/dashboard/" class="custom-admin-logo">Singapore Ancestry<span class="site-title"></span></a>
            </div>
            <div class="navbar-col navbar-body">
                <div class="navbar-sidebar">
                    <ul class="nav sidebar-nav">
                    <?php
                    if( $user_role == 'editor' || $user_role == 'contributor' || $user_role == 'subscriber' ) {
                        if( $user_role == 'editor' ) {
                            $group = get_field('site_admin_access', 'option');
                            $master_items = $group['accessible_pages'];
                        }
                        else if( $user_role == 'contributor' ) {
                            $group = get_field('undertaker_access', 'option');
                            $master_items = $group['accessible_pages'];
                        }
                        else if( $user_role == 'subscriber' ) {
                            $group = get_field('user_access', 'option');
                            $master_items = $group['accessible_pages'];
                        }
                        
                        foreach ($master_items as $item) {
                            $key = $item['value'];
                            $label = $item['label'];
                            $url = home_url("/$key");
                            $active_class = ($current_slug == $key) ? ' current-page-item' : '';
                            echo '<li class="nav-item nav-item-'.$key.$active_class.'"><a href="'.$url.'" class="nav-link" title="'.$label.'"><span>'.$label.'</span></a></li>';
                        }
                    }
                    else {
                        $master_items = array(
                            'user-management' => 'User Management',
                            'undertaker-management' => 'Undertaker Management',
                            'view-obituary' => 'Obituary',
                            'profile' => 'Profile',
                            'settings' => 'Settings',
                        );
                        foreach ($master_items as $key => $label) {
                            $url = home_url("/$key");
                            $active_class = ($current_slug == $key) ? ' current-page-item' : '';
                            echo '<li class="nav-item nav-item-'.$key.$active_class.'"><a href="'.$url.'" class="nav-link" title="'.$label.'"><span>'.$label.'</span></a></li>';
                        }
                    }
                    
                    ?>
                    </ul>
                </div>
            </div>
        </div>
    
    </nav>
</header>