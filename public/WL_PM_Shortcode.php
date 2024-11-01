<?php
defined('ABSPATH') || die();


class Property_Shortcode
{
    public static function shortcode_func($atts)
    {
        ob_start();
        require_once( 'inc/WL_PM_All_Property.php');
        return ob_get_clean();
    }
    
    public static function shortcode_assets()
    {
        global $post;
        if (is_a($post, 'WP_Post')) {
            if (has_shortcode($post->post_content, 'wp_property_manager')) {
                /** Bootstrap  */
                wp_enqueue_style('boootstrap', WL_PM_PLUGIN_URL . 'assets/css/bootstrap.min.css');
                wp_enqueue_style('font-awesome', WL_PM_PLUGIN_URL . 'assets/css/all.min.css');
                wp_enqueue_style('wlpm-style', WL_PM_PLUGIN_URL . 'assets/css/wlpm-admin.css');
                
                /* Javascript */
                wp_enqueue_script('bootstrap-js', WL_PM_PLUGIN_URL . 'assets/js/bootstrap.min.js');
                wp_enqueue_script('popper-js', WL_PM_PLUGIN_URL . 'assets/js/popper.min.js');
            }
        }
    }

    public static function property_single_assets()
    {
        
                /** Bootstrap  */
                wp_enqueue_style('bootstrap', WL_PM_PLUGIN_URL . 'assets/css/bootstrap.min.css');
                wp_enqueue_style('font-awesome', WL_PM_PLUGIN_URL . 'assets/css/all.min.css');
                wp_enqueue_style('swiper', WL_PM_PLUGIN_URL . 'assets/css/swiper.min.css');
                wp_enqueue_style('wlpm-custom', WL_PM_PLUGIN_URL . 'assets/css/wlpm-admin.css');
                
                /* Javascript */
                wp_enqueue_script('jquery');
                wp_enqueue_script('bootstrap-js', WL_PM_PLUGIN_URL . 'assets/js/bootstrap.min.js', array( 'jquery' ), true, true );
                wp_enqueue_script('popper-js', WL_PM_PLUGIN_URL . 'assets/js/popper.min.js', array( 'jquery' ), true, true );
                
                // Enqueued script with localized data.
                wp_enqueue_script( 'frontend-ajax', WL_PM_PLUGIN_URL . 'assets/js/property_search.js', array('jquery'), true, true );
                
                
                wp_enqueue_script('swiper-js', WL_PM_PLUGIN_URL. 'assets/js/swiper.min.js', array( 'jquery' ), true, true );
                wp_enqueue_script('wlpm-map-js', WL_PM_PLUGIN_URL. 'assets/js/wpm_custom_admin_mapapi.js', array( 'jquery' ), true, true  );
                
                $wpm_settings = get_option('wpm_general_settings');
                if ( ! empty ( $wpm_settings['google_map_api_wpm'] ) ) {
                    wp_enqueue_script('wlpm-google-map', 'https://maps.googleapis.com/maps/api/js?key='.$wpm_settings['google_map_api_wpm'].'&callback=myMap', array( 'jquery' ), true, true  );
                }


                wp_enqueue_script('wlpm-public', WL_PM_PLUGIN_URL. 'assets/js/wlpm-public.js', array( 'jquery', 'swiper-js' ), null, true );
                
    }
    public static function wpm_load_property_single_page_template($template) {

        global $post;
        if ($post->post_type == "wpm_properties" && $template !== locate_template(array("single-wpm_properties.php"))){
            return ( WL_PM_PLUGIN_DIR_PATH. "public/templates/single-wpm_properties.php");
        }
        return $template;
    }

}
