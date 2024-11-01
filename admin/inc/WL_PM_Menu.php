<?php
defined('ABSPATH') || die();

class WL_PM_Menu
{
    /* Add menu */
    public static function create_menu()
    {
        $settings = add_submenu_page('edit.php?post_type=wpm_properties', esc_html__('settings', 'wp_property_manager'), esc_html__('Settings', 'wp_property_manager'), 'manage_options', 'Property_settings', array( 'WL_PM_Menu', 'settings' ));
        add_action('admin_print_styles-' . $settings, array( 'WL_PM_Menu', 'settings_assets' ));

        // $shortcode_gen = add_submenu_page('edit.php?post_type=wpm_properties', esc_html__('Shortcode Generate', 'wp_property_manager'), esc_html__('Shortcodes', 'wp_property_manager'), 'manage_options', 'Property_shortcode_page', array( 'WL_PM_Menu', 'shortcode_gen' ));
        // add_action('admin_print_styles-' . $shortcode_gen, array( 'WL_PM_Menu', 'settings_assets' ));
    }

    /* Dashboard submenu assets */
    public static function cpt_assets()
    {
        global $post;
        if (! in_array($post->post_type, array(
            'wpm_properties',
        ))) {
            return;
        }
            
        /* Enqueue styles */
        wp_enqueue_style('bootstrap', WL_PM_PLUGIN_URL.'assets/css/bootstrap.min.css');
        wp_enqueue_style('font-awesome-5', WL_PM_PLUGIN_URL.'assets/css/all.min.css');
        wp_enqueue_style('wlpm-admin', WL_PM_PLUGIN_URL.'assets/css/wlpm-admin.css');
        wp_enqueue_style('bs-meta-css', WL_PM_PLUGIN_URL.'assets/css/ris-meta.css');
        wp_enqueue_script('media-upload');
        // wp_enqueue_media();
        
        /* Enqueue scripts */
        wp_enqueue_script('popper-js', WL_PM_PLUGIN_URL.'assets/js/popper.min.js', array( 'jquery' ), true, false);
        wp_enqueue_script('bootstrap-js', WL_PM_PLUGIN_URL.'assets/js/bootstrap.min.js', array( 'jquery' ), true, false);
        wp_enqueue_script('wlpm-admin-js', WL_PM_PLUGIN_URL.'assets/js/wlpm-admin.js', array( 'jquery' ), true);
        wp_enqueue_script('bs-media-uploader-js', WL_PM_PLUGIN_URL.'assets/js/rpgp-multiple-media-uploader.js', array('jquery'));
        wp_enqueue_script('wlpm-map-js', WL_PM_PLUGIN_URL.'assets/js/wpm_custom_admin_mapapi.js', array('jquery'));
    }
    
    /* Settings submenu */
    public static function settings()
    {
        require_once(WL_PM_PLUGIN_DIR_PATH . 'admin/inc/WL_PM_Settings.php');
    }

    public static function shortcode_gen()
    {
        require_once(WL_PM_PLUGIN_DIR_PATH . 'admin/inc/WL_PM_Shortcode_gen.php');
    }
    
    /* Settings submenu assets */
    public static function settings_assets()
    {
        /* Enqueue styles */
        wp_enqueue_style('bootstrap', WL_PM_PLUGIN_URL.'assets/css/bootstrap.min.css');
        wp_enqueue_style('font-awesome-5', WL_PM_PLUGIN_URL.'assets/css/all.min.css');
        wp_enqueue_style('wlpm-admin', WL_PM_PLUGIN_URL.'assets/css/wlpm-admin.css');
        wp_enqueue_style('bs-meta-css', WL_PM_PLUGIN_URL.'assets/css/ris-meta.css');
        wp_enqueue_style('wlpm-admin', WL_PM_PLUGIN_URL.'assets/css/wlpm-admin.css');
        
        wp_enqueue_style('wlpm-admin', WL_PM_PLUGIN_URL . 'assets/css/wlpm-admin.css');
        wp_enqueue_style('toastr', WL_PM_PLUGIN_URL . 'assets/css/toastr.min.css');
        
        /* Enqueue scripts */
        wp_enqueue_script('wlpm-admin', WL_PM_PLUGIN_URL . 'assets/js/wlpm-admin.js', array( 'jquery' ), true, true);
        wp_enqueue_script('toastr', WL_PM_PLUGIN_URL . 'assets/js/toastr.min.js', array( 'jquery' ), true, true);
        wp_enqueue_script('media-upload');
        wp_enqueue_script('popper-js', WL_PM_PLUGIN_URL.'assets/js/popper.min.js', array( 'jquery' ), true, false);
        wp_enqueue_script('bootstrap-js', WL_PM_PLUGIN_URL.'assets/js/bootstrap.min.js', array( 'jquery' ), true, false);
        wp_enqueue_script('wlpm-admin-js', WL_PM_PLUGIN_URL.'assets/js/wlpm-admin.js', array( 'jquery' ), true);
        wp_enqueue_script('wlpm-map-js', WL_PM_PLUGIN_URL.'assets/js/wpm_custom_admin_mapapi.js', array('jquery'));
        wp_enqueue_script('wlpm-custom-js', WL_PM_PLUGIN_URL.'assets/js/wpm_custom.js', array('jquery'));
    }
}
