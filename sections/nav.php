    <nav class="title-bar" data-responsive-toggle="top_menu" data-hide-for="medium">
<?php
$small_logo = get_theme_mod(ns_.'logo_small');
?>
        <button class="menu-icon" type="button" data-toggle></button>
        <div class="title-bar-title"><?php echo $small_logo; ?></div>
    </nav>
    <nav class="top-bar" id="top_menu">
        <section class="top-bar-left hide-for-small">
            <ul class="menu">
<?php
$logo = get_theme_mod(ns_.'logo_large');
?>
                <li class="menu-text"><a href="/"><img id="logo" src="<?php echo $logo; ?>" alt=""></a></li>
            </ul>
        </section>
        <section class="top-bar-right">
            <ul class="menu">
<?php bb_menu('main'); ?>
            </ul>
        </section>
    </nav>