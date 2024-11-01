<?php
defined('ABSPATH') || die();

// Register Custom Post Type
class Property_Custom_Post
{
    public static function Properties_post_type()
    {
        $labels = array(
            'name'                  => _x('WP Property Manager', 'wp_property_manager'),
            'singular_name'         => _x('WP Property Manager', 'wp_property_manager'),
            'menu_name'             => __('WPM Property', 'wp_property_manager'),
            'name_admin_bar'        => __('WP Property Manager', 'wp_property_manager'),
            'archives'              => __('Item Archives', 'wp_property_manager'),
            'attributes'            => __('Item Attributes', 'wp_property_manager'),
            'parent_item_colon'     => __('Parent Property:', 'wp_property_manager'),
            'all_items'             => __('All Properties', 'wp_property_manager'),
            'add_new_item'          => __('Add New Property', 'wp_property_manager'),
            'add_new'               => __('New Property', 'wp_property_manager'),
            'new_item'              => __('New Item', 'wp_property_manager'),
            'edit_item'             => __('Edit Property', 'wp_property_manager'),
            'update_item'           => __('Update Property', 'wp_property_manager'),
            'view_item'             => __('View Property', 'wp_property_manager'),
            'view_items'            => __('View Items', 'wp_property_manager'),
            'search_items'          => __('Search Properties', 'wp_property_manager'),
            'not_found'             => __('No Properties found', 'wp_property_manager'),
            'not_found_in_trash'    => __('No Properties found in Trash', 'wp_property_manager'),
            'featured_image'        => __('Featured Image', 'wp_property_manager'),
            'set_featured_image'    => __('Set featured image', 'wp_property_manager'),
            'remove_featured_image' => __('Remove featured image', 'wp_property_manager'),
            'use_featured_image'    => __('Use as featured image', 'wp_property_manager'),
            'insert_into_item'      => __('Insert into item', 'wp_property_manager'),
            'uploaded_to_this_item' => __('Uploaded to this item', 'wp_property_manager'),
            'items_list'            => __('Items list', 'wp_property_manager'),
            'items_list_navigation' => __('Items list navigation', 'wp_property_manager'),
            'filter_items_list'     => __('Filter items list', 'wp_property_manager'),
        );
        $args = array(
            'label'                 => __('Property', 'wp_property_manager'),
            'description'           => __('Property information pages.', 'wp_property_manager'),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail' ),
            // 'taxonomies'            => array( 'category', 'post_tag' ),
            'hierarchical'          => true,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_icon'          => 'dashicons-admin-home',
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
        );
        register_post_type('wpm_properties', $args);
    }
}
