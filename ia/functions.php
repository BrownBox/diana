<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @package  BB_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Get the bootstrap!
 */
if (file_exists(dirname(__FILE__) . '/cmb2/init.php')) {
	require_once dirname(__FILE__) . '/cmb2/init.php';
} elseif (file_exists(dirname(__FILE__) . '/CMB2/init.php')) {
	require_once dirname(__FILE__) . '/CMB2/init.php';
}

add_action('cmb2_admin_init', 'bb_cmb_register_demo_metabox');
function bb_cmb_register_demo_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_bb_hero_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb = new_cmb2_box(array(
    		'id'            => $prefix . 'metabox',
    		'title'         => __('Hero', ns_),
    		'object_types'  => array('page'),
    		'context'       => 'side',
    		'priority'      => 'high',
	));

	$cmb->add_field(array(
    		'name'    => __('Background Colour', ns_),
    		'id'      => $prefix . 'bgcolour',
    		'type'    => 'colorpicker',
    		'default' => '#ffffff',
	));

	$cmb->add_field(array(
    		'name'    => __('Vertical Image Position', ns_),
    		'id'      => $prefix . 'bgpos_y',
    		'type'    => 'radio',
	        'default' => 'center',
    		'options' => array(
        			'top' => __('Top', ns_),
        			'center' => __('Centre', ns_),
        			'bottom' => __('Bottom', ns_),
    		),
	));

	$cmb->add_field(array(
    		'name'    => __('Horizontal Image Position', ns_),
    		'id'      => $prefix . 'bgpos_x',
    		'type'    => 'radio',
	        'default' => 'center',
    		'options' => array(
        			'left' => __('Left', ns_),
        			'center' => __('Centre', ns_),
        			'right' => __('Right', ns_),
    		),
	));
}
