<?php
// http://themefoundation.com/wordpress-theme-customizer/
function fx_theme_customizer(WP_Customize_Manager $wp_customize) {
	// Key Images (Desktop Logo, Mobile Logo and Favicon)
	$wp_customize->add_section(ns_.'theme_images_section', array(
		'title'     => __('Logos', ns_),
		'priority'  => 30,
	));
	// inputs
	// large screen
	$wp_customize->add_setting(ns_.'logo_large', array('default' => esc_url(get_template_directory_uri()).'/images/logo_large.png'));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, ns_.'logo_large', array(
		'label'    => ns_.'logo_large',
		'section'  => ns_.'theme_images_section',
		'priority' => 10,
	)));
	// medium screen
	$wp_customize->add_setting(ns_.'logo_medium', array('default' => esc_url(get_template_directory_uri()).'/images/logo_medium.png'));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, ns_.'logo_medium', array(
		'label'    => ns_.'logo_medium',
		'section'  => ns_.'theme_images_section',
		'priority' => 20,
	)));
	// small screen
	$wp_customize->add_setting(ns_.'logo_small', array('default' => esc_url(get_template_directory_uri()).'/images/logo_small.png'));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, ns_.'logo_small', array(
		'label'    => ns_.'logo_small',
		'section'  => ns_.'theme_images_section',
		'priority' => 30,
	)));
	// favicon
	$wp_customize->add_setting(ns_.'favicon', array('default' => esc_url(get_template_directory_uri()).'/images/favicon.png'));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, ns_.'favicon', array(
		'label'   	=> ns_.'favicon',
		'section'  => ns_.'theme_images_section',
		'priority' => 40,
	)));

	// Pallet
	$wp_customize->add_section(ns_.'pallet', array(
		'title'    => 'Theme Pallet',
		'description' => 'Enter number of colors. Click save and reload the page.',
		'priority' => 50,
	));
	// inputs
	$wp_customize->add_setting(ns_.'font', array('default' => 'Raleway'));
	$wp_customize->add_control(ns_.'font', array(
		'label'    => __('Primary Font', ns_),
		'section'  => ns_.'pallet',
		'type'     => 'text',
		'priority' => 5,
	));
	$wp_customize->add_setting(ns_.'colors', array('default' => '8'));
	$wp_customize->add_control(ns_.'colors', array(
		'label'    => __('Number of colors in the pallet', ns_),
		'section'  => ns_.'pallet',
		'type'     => 'text',
		'priority' => 10,
	));
	$colors = (get_theme_mod(ns_.'colors') == null) ? '8' : get_theme_mod(ns_.'colors');
	for ($i=1; $i<=$colors; $i++) {
		$wp_customize->add_setting(ns_.'color'.$i, array('default' => '#FFFFFF', 'sanitize_callback' => 'sanitize_hex_color',));
		$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, ns_.'color'.$i, array(
			'label'    => __(ns_.'color'.$i, ns_),
			'section'  => ns_.'pallet',
			'priority' => 10+$i,
		)));
    }
// Contact Details
	$wp_customize->add_section(ns_.'contacts_section', array(
		'title'    => 'Contact Details',
		'priority' => 60,
	));
	// inputs
	$wp_customize->add_setting(ns_.'contact_email');
	$wp_customize->add_control(ns_.'contact_email', array(
		'label'    => ns_.'contact_email',
		'section'  => ns_.'contacts_section',
		'type'     => 'text',
		'priority' => 10,
	));
	$wp_customize->add_setting(ns_.'contact_phone');
	$wp_customize->add_control(ns_.'contact_phone', array(
		'label'    => ns_.'contact_phone',
		'section'  => ns_.'contacts_section',
		'type'     => 'text',
		'priority' => 20,
	));

// Copyright
	$wp_customize->add_section(ns_.'copyright_section', array(
		'title'    => 'Copyright Statement',
		'priority' => 61,
	));
	// inputs
	$wp_customize->add_setting(ns_.'copyright', array('default' => 'Default copyright text'));
	$wp_customize->add_control(ns_.'copyright', array(
		'label'    => ns_.'copyright',
		'section'  => ns_.'copyright_section',
		'type'     => 'text',
		'priority' => 30,
	));

}
add_action('customize_register', 'fx_theme_customizer');

add_action('customize_save_after', 'generate_dynamic_styles');
function generate_dynamic_styles() {
    $font = get_theme_mod(ns_.'font');
    $colour_count = get_theme_mod(ns_.'pallet');
    for ($i = 1; $i <= $colour_count; $i++) {
        ${'colour'.$i} = get_theme_mod(ns_.'color'.$i);
    }

    $styles = <<<EOS
body, h1, h2, h3, h4, h5, h6 {font-family: "$font", sans-serif;}
EOS;
    file_put_contents(get_stylesheet_directory().'/css/dynamic.css', $styles);
}