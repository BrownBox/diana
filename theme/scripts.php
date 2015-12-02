<?php

add_action('admin_enqueue_scripts', array('bb_enqueue', 'admin_scripts'));
add_action('wp_enqueue_scripts', array('bb_enqueue', 'frontend_scripts'));
class bb_enqueue {
    public static function admin_scripts() {
        wp_enqueue_style('admin', get_stylesheet_directory_uri().'/css/admin.css', array(), filemtime(get_stylesheet_directory().'/css/admin.css'));
    }

    public static function frontend_scripts() {
        // Core styles
//         wp_enqueue_style('normalize', get_stylesheet_directory_uri().'/css/normalize.css');
        wp_enqueue_style('foundation', get_stylesheet_directory_uri().'/css/foundation.min.css');

        // Custom fonts (configured under Appearance -> Fonts)
        $theme_fonts = get_option('theme_fonts');
        if ($theme_fonts[ns_.'gf1']) {
            wp_enqueue_style(ns_.'gf1', $theme_fonts[ns_.'gf1']);
        }
        if ($theme_fonts[ns_.'gf2']) {
            wp_enqueue_style(ns_.'gf2', $theme_fonts[ns_.'gf2']);
        }
        if ($theme_fonts[ns_.'gf3']) {
            wp_enqueue_style(ns_.'gf3', $theme_fonts[ns_.'gf3']);
        }

        // Theme styles
        wp_enqueue_style('theme_default', get_stylesheet_directory_uri().'/css/default.css', array(), filemtime(get_stylesheet_directory().'/css/default.css'));
        wp_enqueue_style('theme_style', get_stylesheet_directory_uri().'/css/style.css', array(), filemtime(get_stylesheet_directory().'/css/style.css'));
        wp_enqueue_style('theme_dynamic', get_stylesheet_directory_uri().'/css/dynamic.css', array(), filemtime(get_stylesheet_directory().'/css/dynamic.css'));
        wp_enqueue_style('print', get_stylesheet_directory_uri().'/css/print.css', array(), '', 'print');

        // Header scripts

        // Footer sripts
        wp_enqueue_script('what-input', get_template_directory_uri() . '/js/vendor/what-input.min.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('zurb', get_template_directory_uri() . '/js/foundation.min.js', array('jquery'), '1.0.0', true);

        // Remove admin-only styles for front end
        if (!is_admin()) {
            wp_deregister_style('thickbox');
            wp_deregister_style('tiptipCSS');
            wp_deregister_style('chosenCSS');
            wp_deregister_style('jqueryuiCSS');
            wp_deregister_style('wpclef-main');
        }
    }
}
