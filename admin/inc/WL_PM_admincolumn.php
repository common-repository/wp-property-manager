<?php
defined('ABSPATH') || die();
class Admin_Columns {
    // GET FEATURED IMAGE IN ADMIN POST EDIT LIST
    public static function wpm_get_featured_image($post_ID)
    {
        $post_thumbnail_id = get_post_thumbnail_id($post_ID);
        if ($post_thumbnail_id) {
            $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');
            return $post_thumbnail_img[0];
        }
    }
    // ADD NEW COLUMN for Overview
    
    public static function wpm_ov_columns_head($defaults)
    {
        $defaults['over_view'] = __('Overview', 'wp_property_manager');
        $defaults['wpm_type'] = __('Type', 'wp_property_manager');
        $defaults['featured_btn'] = __('Featured', 'wp_property_manager');
        $defaults['featured_image'] = __('Featured Image', 'wp_property_manager');
        return $defaults;
    }
    
    // SHOW THE FEATURED IMAGE
    public static function wpm_ov_columns_content($column_name, $post_ID) {
        if ($column_name == 'over_view') {
            echo '<b>Price:-</b> '.get_post_meta( $post_ID, 'price', true ).'<br>';
            echo '<b>Deposit:-</b> '.get_post_meta( $post_ID, 'deposit', true ).'<br>';
            echo '<b>Area:-</b> '.get_post_meta( $post_ID, 'area', true ).'<br>';
            echo '<b>Phone No.:-</b> '.get_post_meta( $post_ID, 'phone_no', true ).'<br>';
            echo '<b>Address:-</b> '.get_post_meta( $post_ID, 'address', true ).'<br>';
        }
        if ($column_name == 'wpm_type') {
            $type = get_post_meta( $post_ID, 'property_type', true );
            if ($type == 'p_11') {
                esc_html_e('Bungalow','wp_property_manager');
            }elseif ($type == 'p_12') {
                esc_html_e('Detached Bungalow','wp_property_manager');
            }
            elseif ($type == 'p_13') {
                esc_html_e('Semi-Detached Bungalow','wp_property_manager');
            }
            elseif ($type == 'p_14') {
                esc_html_e('Terraced Bungalow','wp_property_manager');
            }
            elseif ($type == 'p_15') {
                esc_html_e('Flat / Apartment','wp_property_manager');
            }
            elseif ($type == 'p_16') {
                esc_html_e('Apartment','wp_property_manager');
            }
            elseif ($type == 'p_17') {
                esc_html_e('Duplex','wp_property_manager');
            }
            elseif ($type == 'p_18') {
                esc_html_e('Flat','wp_property_manager');
            }
            elseif ($type == 'p_19') {
                esc_html_e('Maisonette','wp_property_manager');
            }
            elseif ($type == 'p_20') {
                esc_html_e('Penthouse','wp_property_manager');
            }
            elseif ($type == 'p_21') {
                esc_html_e('Studio','wp_property_manager');
            }
            elseif ($type == 'p_22') {
                esc_html_e('Triplex','wp_property_manager');
            }
            elseif ($type == 'p_23') {
                esc_html_e('House','wp_property_manager');
            }
            elseif ($type == 'p_24') {
                esc_html_e('Cottage','wp_property_manager');
            }
            elseif ($type == 'p_25') {
                esc_html_e('Detached House','wp_property_manager');
            }
            elseif ($type == 'p_26') {
                esc_html_e('End of Terrace House','wp_property_manager');
            }
            elseif ($type == 'p_27') {
                esc_html_e('Link Detached House','wp_property_manager');
            }
            elseif ($type == 'p_28') {
                esc_html_e('Mews','wp_property_manager');
            }
            elseif ($type == 'p_29') {
                esc_html_e('Semi-Detached House','wp_property_manager');
            }
            elseif ($type == 'p_30') {
                esc_html_e('Terraced House','wp_property_manager');
            }
            elseif ($type == 'p_31') {
                esc_html_e('Town House','wp_property_manager');
            }
            elseif ($type == 'p_32') {
                esc_html_e('Other','wp_property_manager');
            }
            elseif ($type == 'p_33') {
                esc_html_e('Commercial','wp_property_manager');
            }
            elseif ($type == 'p_34') {
                esc_html_e('Garage','wp_property_manager');
            }
            elseif ($type == 'p_35') {
                esc_html_e('Land','wp_property_manager');
            }
        }
        if ($column_name == 'featured_btn') {
            $featured_text = get_post_meta( $post_ID, 'featured_wpm', true );
            if($featured_text=='on')
            {
                $featured_text = "<i class='fas fa-star' aria-hidden='true' style='color: #10cf47;font-size: 21px;'></i>";
            } else
            {
                $featured_text = "<i class='far fa-star'' aria-hidden='true' style='color: #ef1b1b;font-size: 21px;'></i>"; 
            }
            echo "<a href='javascript:void(0);' class='custom_featured_btn' data-value='".$post_ID."' >".$featured_text."</a>";
        }
        if ($column_name == 'featured_image') {
            $post_featured_image = self::wpm_get_featured_image($post_ID);
            if ($post_featured_image) {
                $featured_text = get_post_meta( $post_ID, 'featured_wpm', true );
                if($featured_text=='on')
                {
                    echo '<img style="height: 100px;width: 150px;border: 2px solid #39d046;padding: 2px;" src="' . $post_featured_image . '" />';
                } else
                {
                    echo '<img style="height: 100px;width: 150px;border: 2px solid #ef1b1b;padding: 2px;" src="' . $post_featured_image . '" />'; 
                }
            }
        }
    }

    // Font-awsome and featured
    public static function wpm_ajax_enqueue_scripts() {
        wp_enqueue_style('font-awesome-5', WL_PM_PLUGIN_URL.'assets/css/all.min.css');

        // Note that the first parameter of wp_enqueue_script() matches that of wp_localize_script.
        wp_enqueue_script( 'featured_ajax', WL_PM_PLUGIN_URL. 'assets/js/featured.js', array('jquery') );
        
        // The second parameter ('aj_ajax_url') will be used in the javascript code.
        wp_localize_script( 'featured_ajax', 'ajax_featured', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'featured_nonce' => wp_create_nonce('featured_ajax_nonce') 
        ));
    }
    
    public static function wpm_ajax_featured_process() {
        check_ajax_referer( 'featured_ajax_nonce', 'nounce' );  // This function will die if nonce is not correct.
        
        if(isset($_POST['pid'])){
            $post_id = sanitize_text_field($_POST['pid']);
            $featured_text = get_post_meta( $post_id, 'featured_wpm', true );
            if($featured_text=='on')
            {
                $featured_text = 'NOT';
                update_post_meta($post_id, 'featured_wpm', sanitize_text_field($featured_text));
            } else
            {
                $featured_text = 'on';
                update_post_meta($post_id, 'featured_wpm', sanitize_text_field($featured_text));
            }
        }
        wp_die();
    }
    
}