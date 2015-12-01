<!doctype html>
<html>
    <head>
        <title><?php wp_title('|', true, 'right'); ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta class="swiftype" name="title" data-type="string" content="<?php the_title(); ?>">
        <meta class='swiftype' name='type' data-type='enum' content='<?php echo ucfirst(get_post_type()); ?>'>
<?php
if (has_post_thumbnail()) {
    $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
?>
        <meta class='swiftype' name='image' data-type='enum' content='<?php echo $thumbnail[0]; ?>'>
<?php
}

$favicon = get_theme_mod( ns_.'favicon' );
if( $favicon ) echo '        <link rel="icon" href="'.$favicon.'" type="image/png">'."\n";

$theme_fonts = get_option( 'theme_fonts' ); // enable font-icons from wp-admin/appearance/font settings
if( $theme_fonts[ns_."fa430"] == 'true' ) echo '        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">'."\n"; // Font Awesome 4.3.0

wp_head(); ?>
    </head>
    <body>
    <!-- start everything -->
    <div class="s-everything">
                    <header data-swiftype-index='false' class="hide-for-print">
<?php locate_template( array( 'sections/nav.php' ), true );?>
<?php bb_theme::section( 'name=top&file=top.php&inner_class=row-full' ); ?>
                    </header>
                    <section class="main-section">