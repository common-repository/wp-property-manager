<?php
defined('ABSPATH') || die();

require_once(WL_PM_PLUGIN_DIR_PATH .'public/WL_PM_Shortcode.php');
require_once(WL_PM_PLUGIN_DIR_PATH .'public/templates/WL_PM_Template.php');
require_once(WL_PM_PLUGIN_DIR_PATH . 'public/inc/WL_PM_CPT.php');

/** Shortcode   */
add_shortcode('property_shortcode', array('Property_Shortcode','shortcode_func'));

/** Enqueue assets */
add_action('wp_enqueue_scripts', array( 'Property_Shortcode', 'shortcode_assets' ));
add_action('wp_enqueue_scripts', array( 'Property_Shortcode', 'property_single_assets' ));

// Property Template
add_action('plugins_loaded', array( 'wpm_PageTemplate', 'get_instance' ));

// single page template
add_filter('single_template', array('Property_Shortcode', 'wpm_load_property_single_page_template'));

/* Custom Post type */
add_action('init', array( 'Property_Custom_Post', 'Properties_post_type' ));