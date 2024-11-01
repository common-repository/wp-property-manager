<?php
defined('ABSPATH') || die();

add_option('wpm_generate_shortcode');
add_option('wpm_general_settings');

require_once(WL_PM_PLUGIN_DIR_PATH . 'admin/inc/WL_PM_Menu.php');
require_once(WL_PM_PLUGIN_DIR_PATH . 'admin/inc/WL_PM_Metabox.php');
require_once(WL_PM_PLUGIN_DIR_PATH . 'admin/inc/WL_PM_admincolumn.php');

/* Create menu */
add_action('admin_menu', array('WL_PM_Menu', 'create_menu'));

/* Enqueue Assets */
// add_action('settings Assets', array('Add_Meta', 'settings_assets' ));

/** Meta Box */
// add_action('wp_thumbnail', array('Add_Meta', 'wpm_ajax_get_thumbnail_uris'));
add_action('admin_init', array('Add_Meta', 'wpm_metabox_init'));
add_action('save_post', array('Add_Meta', 'wpm_property_meta_save'));

add_action('wp_ajax_uris_get_thumbnail', array('Add_Meta', 'wpm_ajax_get_thumbnail_uris'));
add_action('save_post', array('Add_Meta', 'wpm_add_image_meta_box_save'), 9, 1);

add_action("admin_print_styles-post-new.php", array('WL_PM_Menu', 'cpt_assets'));
add_action("admin_print_styles-post.php", array('WL_PM_Menu', 'cpt_assets'));
// add_action('dashboard_assets', array('WL_PM_Menu', 'dashboard_assets' ));


// Admin Columns
add_filter('manage_wpm_properties_posts_columns', array('Admin_Columns', 'wpm_ov_columns_head'));
add_action('manage_wpm_properties_posts_custom_column', array('Admin_Columns', 'wpm_ov_columns_content'), 10, 2);

// Enqueue featured.js

add_action('admin_enqueue_scripts', array('Admin_Columns', 'wpm_ajax_enqueue_scripts'));

// action call for featurd.js
add_action('wp_ajax_nopriv_wpm_ajax_request', array('Admin_Columns', 'wpm_ajax_featured_process'));
add_action('wp_ajax_wpm_ajax_request', array('Admin_Columns', 'wpm_ajax_featured_process'));  // For logged in users.
