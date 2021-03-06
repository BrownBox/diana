<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <meta class="swiftype" name="title" data-type="string" content="<?php the_title(); ?>">
        <meta class='swiftype' name='type' data-type='enum' content='<?php echo ucfirst(get_post_type()); ?>'>
<?php
if (has_post_thumbnail()) {
    $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
?>
        <meta class='swiftype' name='image' data-type='enum' content='<?php echo $thumbnail[0]; ?>'>
<?php
}
?>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<?php
$favicon = get_theme_mod(ns_.'favicon');
if($favicon) echo '        <link rel="icon" href="'.$favicon.'" type="image/png">'."\n";

wp_head();
?>
    </head>
    <body <?php body_class(); ?>>
    <!-- start everything -->
    <div class="everything">
        <header data-swiftype-index='false' class="hide-for-print clearfix">
<?php locate_template(array('sections/nav.php'), true );?>
<?php bb_theme::section('name=top&file=top.php&inner_class=row-full'); ?>
        </header>
        <section class="main-section">