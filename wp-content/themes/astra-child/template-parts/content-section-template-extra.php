<?php
$obituary_id = get_query_var('obituary_id');
$undertaker = get_field('undertaker', $obituary_id);
$pic = $undertaker['person_in_charge'];
$pic_id = $pic->ID;

$pic_name = get_the_title($pic_id);
$pic_contact = get_field('contact_number', $pic_id);
$pic_mobile = get_field('mobile__number', $pic_id);
$pic_address = get_field('address', $pic_id);
?>
<div class="undertaker-list" data-undertaker="<?php echo $pic_id;?>">
    <div class="undertaker-list-item"><span class="cn-text">五福</span> <?php echo $pic_name;?></div>
    <div class="undertaker-list-item"><span class="cn-text">電話</span> Tel: <?php echo $pic_contact;?></div>
    <div class="undertaker-list-item"><span class="cn-text">手提</span> Mobile: <?php echo $pic_mobilel?></div>
    <div class="undertaker-list-item"><span class="cn-text">地址</span> Address: <?php echo $pic_address;?></div>
</div>