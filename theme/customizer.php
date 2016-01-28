<?php
add_action('customize_register', 'fx_theme_customizer');
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
	$wp_customize->add_section(ns_.'palette', array(
		'title'    => 'Theme Palette',
		'description' => 'Enter number of colours. Click save and reload the page.',
		'priority' => 50,
	));
	// inputs
	$wp_customize->add_setting(ns_.'font', array('default' => 'Raleway'));
	$wp_customize->add_control(ns_.'font', array(
		'label'    => __('Primary Font', ns_),
		'section'  => ns_.'palette',
		'type'     => 'text',
		'priority' => 5,
	));
	$wp_customize->add_setting(ns_.'colours', array('default' => '6'));
	$wp_customize->add_control(ns_.'colours', array(
		'label'    => __('Number of colours in the palette', ns_),
		'section'  => ns_.'palette',
		'type'     => 'text',
		'priority' => 10,
	));
	$colours = (get_theme_mod(ns_.'colours') == null) ? '8' : get_theme_mod(ns_.'colours');
	for ($i=1; $i<=$colours; $i++) {
		$wp_customize->add_setting(ns_.'colour'.$i, array('default' => '#FFFFFF', 'sanitize_callback' => 'sanitize_hex_color',));
		$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, ns_.'colour'.$i, array(
			'label'    => __(ns_.'colour'.$i, ns_),
			'section'  => ns_.'palette',
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

add_action('customize_save_after', 'update_dynamic_styles');
function update_dynamic_styles() {
    $styles = generate_dynamic_styles();
    file_put_contents(get_stylesheet_directory().'/css/dynamic.css', $styles);
}

function generate_dynamic_styles() {
    $styles = '';
    $font = get_theme_mod(ns_.'font');
    $colour_count = get_theme_mod(ns_.'colours');
    for ($i = 1; $i <= $colour_count; $i++) {
        ${'colour'.$i} = get_theme_mod(ns_.'colour'.$i);
        $styles .= '.text'.$i.' {color: '.${'colour'.$i}.';} ';
        $styles .= '.bg'.$i.' {background-color: '.${'colour'.$i}.';} ';
        $styles .= '.htext'.$i.':hover {color: '.${'colour'.$i}.';} ';
        $styles .= '.hbg'.$i.':hover {background-color: '.${'colour'.$i}.';} '."\n";
    }

    $styles .= <<<EOS
body, h1, h2, h3, h4, h5, h6 {font-family: "$font", sans-serif;}

/*
Dynamic colour palette
1: Menu and Footer background
2: Menu items, Buttons and Links
3: Footer text (except links)
4: Heading text and callout backgrounds
5: CTAs
6: Hero text
*/

nav.top-bar, footer {background-color: $colour1;}

a:link, a:link:hover, a:visited, a:link:focus {color: $colour2;}
button, .button {background-color: white; color: $colour2; border: 3px solid $colour2;}
button:hover, button:focus, .button:hover, .button:focus {background-color: $colour2; color: white;}

footer {color: $colour3;}

h1, h2, h3, h4, h5, h6 {color: $colour4;}

.callout-box {background-color: $colour4;}
.callout-box:nth-of-type(2n) {background-color: $colour1;}

.cta {background-color: $colour5;}

.hero h1 {color: $colour6;}

EOS;
    return $styles;
}

// Hack to load dynamic styles in head while in Customizer, so that changes show up on save without having to reload the page.
global $wp_customize;
if (isset($wp_customize)) {
    function load_customizer_css() {
        $styles = generate_dynamic_styles();
?>
        <style type="text/css">
            <?php echo $styles; ?>
        </style>
<?php
    }
    add_action('wp_head', 'load_customizer_css');
}
