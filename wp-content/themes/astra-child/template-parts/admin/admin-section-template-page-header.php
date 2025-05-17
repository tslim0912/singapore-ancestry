<?php
if( is_archive() ) {
    $archive_title = get_the_archive_title();
    $page_title = str_replace( 'Archives: ', '', $archive_title );
}
else {
    $page_title = get_the_title();
}
$site_name = get_bloginfo('name');

?>
<div class="site-page-header">
    <div class="sa-col sa-col-title">
		<h3 class="site-title"><?php echo $site_name;?></h3>
		<div class="divider divider-vertical"></div>
		<h2 class="page-title"><?php echo $page_title;?></h2>
	</div>
    <div class="sa-col sa-col-logout">
		<button type="button" class="btn btn-signout" id="admin-signout"><span>Sign Out</span></button>
    </div>
</div>