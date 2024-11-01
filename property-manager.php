<?php
/**
Plugin Name: WP Property Manager
Plugin URI: http://weblizar.com/
Description: Add Property, Manage Properties, Search properties.
Author: Weblizar
Text Domain: wp_property_manager
Domain Path: /languages
Author URI: https://weblizar.com/
Version: 1.5
License: GPL version 2 or later
*/

defined('ABSPATH') || die();

if (! defined('WL_PM_PLUGIN_URL')) {
    define('WL_PM_PLUGIN_URL', plugin_dir_url(__FILE__));
}

if (! defined('WL_PM_PLUGIN_DIR_PATH')) {
    define('WL_PM_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));
}

if (! defined('WL_PM_PLUGIN_BASE_NAME')) {
    define('WL_PM_PLUGIN_BASE_NAME', plugin_basename(__FILE__));
}

final class WL_PM_Property_Manager
{
    private static $instance = null;

    private function __construct()
    {
        $this->initialize_hooks();
    }

    public static function get_instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function initialize_hooks()
    {
        if (is_admin()) {
            require_once(WL_PM_PLUGIN_DIR_PATH . 'admin/admin.php');
        }
        require_once(WL_PM_PLUGIN_DIR_PATH . 'public/public.php');
    }
}
WL_PM_Property_Manager::get_instance();
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'salcode_add_plugin_page_settings_link');
function salcode_add_plugin_page_settings_link( $links ) {
    $links[] = '<a href="' .
        admin_url( 'edit.php?post_type=wpm_properties&page=Property_settings' ) .
        '">' . __('Settings') . '</a>';
    return $links;
}
