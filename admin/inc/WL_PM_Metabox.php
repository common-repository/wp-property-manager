<?php
defined('ABSPATH') || die();

class Add_Meta
{
    public static function wpm_metabox_init()
    {
        add_meta_box('wpm_property_meta', __('Property Options', 'wp_property_manager'), array('Add_Meta', 'meta_wpm_property'), 'wpm_properties', 'normal', 'high');
        add_meta_box('service_meta2', __('Property Gallery Images', 'wp_property_manager'), array('Add_Meta', 'meta_gallery'), 'wpm_properties', 'normal', 'low');
    }

    public static function meta_gallery($post)
    { ?>
        <div id="bsgallery_container">
            <ul id="bs_gallery_thumbs" class="clearfix">
                <?php
                /* load saved photos into ris */
                $WRIS_AllPhotosDetails = unserialize(base64_decode(get_post_meta($post->ID, 'bs_all_photos_details', true)));
                $TotalImages =  get_post_meta($post->ID, 'bs_total_images_count', true);
                if ($TotalImages) {
                    foreach ($WRIS_AllPhotosDetails as $WRIS_SinglePhotoDetails) {
                        $UniqueString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
                        $url = $WRIS_SinglePhotoDetails['bsp_image_url'];
                        $url1 = $WRIS_SinglePhotoDetails['bsgallery_admin_thumb'];
                        $title = $WRIS_SinglePhotoDetails['bsgallery_image_name']; ?>
                        <li class="bs-image-entry" id="bs_img">
                            <!-- <a class="gallery_remove bsgallery_remove" href="#gallery_remove" id="bs_remove_bt" ><img src="<?php '/images/Close-icon.png'; ?>" /></a> -->
                            <div class="rpp-admin-inner-div1">
                                <img src="<?php echo $url1; ?>" class="bs-meta-image" alt="" style="">
                                <input type="hidden" id="unique_string[]" name="unique_string[]" value="<?php echo esc_attr($UniqueString); ?>" />
                            </div>
                            <div class="rpp-admin-inner-div2">
                                <input type="text" id="bsp_image_url[]" name="bsp_image_url[]" class="bs_label_text" value="<?php echo $url; ?>" readonly="readonly" style="display:none;" />
                                <input type="text" id="bsgallery_admin_thumb[]" name="bsgallery_admin_thumb[]" class="bs_label_text" value="<?php echo $url1; ?>" readonly="readonly" style="display:none;" />
                                <input type="text" id="bsgallery_image_name[]" name="bsgallery_image_name[]" class="bs_label_text" value="<?php echo $url1; ?>" readonly="readonly" style="display:none;" />
                            </div>
                        </li>
                <?php
                    } // end of foreach
                } else {
                    $TotalImages = 0;
                }
                ?>
            </ul>
        </div>

        <!--Add New Image Button-->
        <div class="bs-image-entry add_bs_new_image" id="bs_gallery_upload_button" data-uploader_title="Upload Image" data-uploader_button_text="Select">
            <div class="dashicons dashicons-plus"></div>
            <p>
                <?php esc_html_e('Add New Images', 'construction'); ?>
            </p>
        </div>
        <div style="clear:left;"></div>
    <?php
    }

    public static function wpm_admin_thumb_uris($id)
    {
        $image  = wp_get_attachment_image_src($id, 'bsgallery_admin_original', true);
        $image1 = wp_get_attachment_image_src($id, 'thumbnail', true);
        $title = get_the_title($id); ?>
        <li class="bs-image-entry" id="bs_img">
            <a class="gallery_remove bsgallery_remove" href="#gallery_remove" id="bs_remove_bt"><img src="<?php echo WL_PM_PLUGIN_URL . 'assets/img/Close-icon.png'; ?>" /></a>
            <div class="rpp-admin-inner-div1">
                <img src="<?php echo $image1[0]; ?>" class="bs-meta-image" alt="" style="">
            </div>
            <div class="rpp-admin-inner-div1">
                <input type="text" id="bsp_image_url[]" name="bsp_image_url[]" class="bs_label_text" value="<?php echo $image[0]; ?>" readonly="readonly" style="display:none;" />
                <input type="text" id="bsgallery_admin_thumb[]" name="bsgallery_admin_thumb[]" class="bs_label_text" value="<?php echo $image1[0]; ?>" readonly="readonly" style="display:none;" />
                <input type="text" id="bsgallery_image_name[]" name="bsgallery_image_name[]" class="bs_label_text" value="<?php echo $title; ?>" readonly="readonly" style="display:none;" />
            </div>
        </li>
    <?php
    }

    public static function wpm_ajax_get_thumbnail_uris()
    {
        echo self::wpm_admin_thumb_uris($_POST['imageid']);
        die;
    }

    public static function wpm_add_image_meta_box_save($PostID)
    {
        if (isset($PostID) && isset($_POST['bsp_image_url'])) {
            $TotalImages = count($_POST['bsp_image_url']);
            $ImagesArray = array();
            if ($TotalImages) {
                for ($i = 0; $i < $TotalImages; $i++) {
                    $url = sanitize_text_field($_POST['bsp_image_url'][$i]);
                    $url1 = sanitize_text_field($_POST['bsgallery_admin_thumb'][$i]);
                    $image_label =  stripslashes($_POST['bsgallery_image_name'][$i]);
                    $ImagesArray[] = array(
                        'bsp_image_url' => $url,
                        'bsgallery_admin_thumb' => $url1,
                        'bsgallery_image_name' => $image_label,
                    );
                }
                update_post_meta($PostID, 'bs_all_photos_details', base64_encode(serialize($ImagesArray)));
                update_post_meta($PostID, 'bs_total_images_count', $TotalImages);
            } else {
                $TotalImages = 0;
                update_post_meta($PostID, 'bs_total_images_count', $TotalImages);
                $ImagesArray = array();
                update_post_meta($PostID, 'bs_all_photos_details', base64_encode(serialize($ImagesArray)));
            }
        }
    }

    /*WPM Property Meta Fields*/
    public static function meta_wpm_property()
    {
        global $post;
        $address = sanitize_text_field(get_post_meta(get_the_ID(), 'address', true));
        $area = sanitize_text_field(get_post_meta(get_the_ID(), 'area', true));
        $price = sanitize_text_field(get_post_meta(get_the_ID(), 'price', true));
        $deposit = sanitize_text_field(get_post_meta(get_the_ID(), 'deposit', true));
        $phone_no = sanitize_text_field(get_post_meta(get_the_ID(), 'phone_no', true));
        $featured_wpm = sanitize_text_field(get_post_meta(get_the_ID(), 'featured_wpm', true));
        $star_rate = sanitize_text_field(get_post_meta(get_the_ID(), 'star_rate', true));
        $video_ulr = sanitize_text_field(get_post_meta(get_the_ID(), 'video_ulr', true));
        $manul_map = sanitize_text_field(get_post_meta(get_the_ID(), 'manul_map', true));
        $lati_wpm = sanitize_text_field(get_post_meta(get_the_ID(), 'lati_wpm', true));
        $longi_wpm = sanitize_text_field(get_post_meta(get_the_ID(), 'longi_wpm', true));
        $map_id_admin = sanitize_text_field(get_post_meta(get_the_ID(), 'map_id_admin', true));
        $wpm_city = sanitize_text_field(get_post_meta(get_the_ID(), 'wpm_city', true));
        $wpm_state = sanitize_text_field(get_post_meta(get_the_ID(), 'wpm_state', true));
        $wpm_country = sanitize_text_field(get_post_meta(get_the_ID(), 'wpm_country', true));
        $property_type = sanitize_text_field(get_post_meta(get_the_ID(), 'property_type', true));

        $wpm_label_text = sanitize_text_field(get_post_meta(get_the_ID(), 'wpm_label_text', true));
        $wpm_features_text = sanitize_text_field(get_post_meta(get_the_ID(), 'wpm_features_text', true));

        $all_labels = unserialize($wpm_label_text);
        $all_features = unserialize($wpm_features_text);

        if (!empty($all_labels) && is_array($all_labels)) {
            $total = sizeof($all_labels);
        }



        $wpm_settings = get_option('wpm_general_settings'); ?>
        <div class="row">
            <div class="wpm_property_meta col-md-12">
                <div class="main_setting_options col-sm-6 float-left">
                    <p>
                        <h4 class="title"><?php esc_html_e('Featured Property', 'wp_property_manager'); ?></h4>

                        <div class="custom_checkbox">
                            <input type="checkbox" name="featured_wpm" id="featured_wpm" <?php if (!empty($featured_wpm)) {
                                                                                                echo 'checked';
                                                                                            } ?> /><label for="featured_wpm">Toggle</label>
                            <span style="font-style: italic;color: #878585;">Enable/Disable ( its featured property or not..!!
                                )</span>
                        </div>
                    </p>
                    <p>
                        <h4 class="title"><?php esc_html_e('Property Type', 'wp_property_manager'); ?></h4>
                    </p>
                    <p>
                        <select id="property_type" style="width: 90%;;" name="property_type" class="option_input">
                            <option value=""></option>
                            <option value="p_11" <?php if (!empty($property_type) && $property_type == 'p_11') {
                                                        echo 'selected';
                                                    } ?>>Bungalow</option>
                            <option value="p_12" <?php if (!empty($property_type) && $property_type == 'p_12') {
                                                        echo 'selected';
                                                    } ?>>- Detached Bungalow</option>
                            <option value="p_13" <?php if (!empty($property_type) && $property_type == 'p_13') {
                                                        echo 'selected';
                                                    } ?>>- Semi-Detached Bungalow</option>
                            <option value="p_14" <?php if (!empty($property_type) && $property_type == 'p_14') {
                                                        echo 'selected';
                                                    } ?>>- Terraced Bungalow</option>
                            <option value="p_15" <?php if (!empty($property_type) && $property_type == 'p_15') {
                                                        echo 'selected';
                                                    } ?>>Flat / Apartment</option>
                            <option value="p_16" <?php if (!empty($property_type) && $property_type == 'p_16') {
                                                        echo 'selected';
                                                    } ?>>- Apartment</option>
                            <option value="p_17" <?php if (!empty($property_type) && $property_type == 'p_17') {
                                                        echo 'selected';
                                                    } ?>>- Duplex</option>
                            <option value="p_18" <?php if (!empty($property_type) && $property_type == 'p_18') {
                                                        echo 'selected';
                                                    } ?>>- Flat</option>
                            <option value="p_19" <?php if (!empty($property_type) && $property_type == 'p_19') {
                                                        echo 'selected';
                                                    } ?>>- Maisonette</option>
                            <option value="p_20" <?php if (!empty($property_type) && $property_type == 'p_20') {
                                                        echo 'selected';
                                                    } ?>>- Penthouse</option>
                            <option value="p_21" <?php if (!empty($property_type) && $property_type == 'p_21') {
                                                        echo 'selected';
                                                    } ?>>- Studio</option>
                            <option value="p_22" <?php if (!empty($property_type) && $property_type == 'p_22') {
                                                        echo 'selected';
                                                    } ?>>- Triplex</option>
                            <option value="p_23" <?php if (!empty($property_type) && $property_type == 'p_23') {
                                                        echo 'selected';
                                                    } ?>>House</option>
                            <option value="p_24" <?php if (!empty($property_type) && $property_type == 'p_24') {
                                                        echo 'selected';
                                                    } ?>>- Cottage</option>
                            <option value="p_25" <?php if (!empty($property_type) && $property_type == 'p_25') {
                                                        echo 'selected';
                                                    } ?>>- Detached House</option>
                            <option value="p_26" <?php if (!empty($property_type) && $property_type == 'p_26') {
                                                        echo 'selected';
                                                    } ?>>- End of Terrace House</option>
                            <option value="p_27" <?php if (!empty($property_type) && $property_type == 'p_27') {
                                                        echo 'selected';
                                                    } ?>>- Link Detached House</option>
                            <option value="p_28" <?php if (!empty($property_type) && $property_type == 'p_28') {
                                                        echo 'selected';
                                                    } ?>>- Mews</option>
                            <option value="p_29" <?php if (!empty($property_type) && $property_type == 'p_29') {
                                                        echo 'selected';
                                                    } ?>>- Semi-Detached House</option>
                            <option value="p_30" <?php if (!empty($property_type) && $property_type == 'p_30') {
                                                        echo 'selected';
                                                    } ?>>- Terraced House</option>
                            <option value="p_31" <?php if (!empty($property_type) && $property_type == 'p_31') {
                                                        echo 'selected';
                                                    } ?>>- Town House</option>
                            <option value="p_32" <?php if (!empty($property_type) && $property_type == 'p_32') {
                                                        echo 'selected';
                                                    } ?>>Other</option>
                            <option value="p_33" <?php if (!empty($property_type) && $property_type == 'p_33') {
                                                        echo 'selected';
                                                    } ?>>- Commercial</option>
                            <option value="p_34" <?php if (!empty($property_type) && $property_type == 'p_34') {
                                                        echo 'selected';
                                                    } ?>>- Garage</option>
                            <option value="p_35" <?php if (!empty($property_type) && $property_type == 'p_35') {
                                                        echo 'selected';
                                                    } ?>>- Land</option>
                        </select>
                    </p>
                    <p>
                        <h4 class="title"><?php esc_html_e('Star Ratings', 'wp_property_manager'); ?></h4>
                    </p>
                    <p>
                        <select class="option_input" style="width: 90%;" name="star_rate" id="star_rate">
                            <option value="1" <?php if (!empty($star_rate) && $star_rate == '1') {
                                                    echo 'selected';
                                                } ?>>1</option>
                            <option value="2" <?php if (!empty($star_rate) && $star_rate == '2') {
                                                    echo 'selected';
                                                } ?>>2</option>
                            <option value="3" <?php if (!empty($star_rate) && $star_rate == '3') {
                                                    echo 'selected';
                                                } ?>>3</option>
                            <option value="4" <?php if (!empty($star_rate) && $star_rate == '4') {
                                                    echo 'selected';
                                                } ?>>4</option>
                            <option value="4.5" <?php if (!empty($star_rate) && $star_rate == '4.5') {
                                                    echo 'selected';
                                                } ?>>4.5</option>
                            <option value="5" <?php if (!empty($star_rate) && $star_rate == '5') {
                                                    echo 'selected';
                                                } ?>>5</option>
                        </select>
                    </p>
                    <p>
                        <h4 class="title"><?php esc_html_e('Price', 'wp_property_manager'); ?></h4>
                    </p>
                    <p><input class="option_input" name="price" id="price" style="width: 90%;" placeholder="" type="number" value="<?php if (!empty($price)) {
                                                                                                                                        echo esc_attr($price);
                                                                                                                                    } ?>"> </input></p>
                    <p>
                        <h4 class="title"><?php esc_html_e('Deposit', 'wp_property_manager'); ?></h4>
                    </p>
                    <p><input class="option_input" name="deposit" id="deposit" style="width: 90%;" placeholder="" type="number" value="<?php if (!empty($deposit)) {
                                                                                                                                            echo esc_attr($deposit);
                                                                                                                                        } ?>"> </input></p>
                    <p>
                        <h4 class="title"><?php esc_html_e('Area', 'wp_property_manager'); ?></h4>
                    </p>
                    <p><input class="option_input" name="area" id="area" style="width: 90%;" placeholder="Square ft." type="number" value="<?php if (!empty($area)) {
                                                                                                                                                echo esc_attr($area);
                                                                                                                                            } ?>"> </input></p>
                    <p>
                        <h4 class="title"><?php esc_html_e('Contact No.', 'wp_property_manager'); ?></h4>
                    </p>
                    <p><input class="option_input" name="phone_no" id="phone_no" style="width: 90%;" placeholder="" type="number" value="<?php if (!empty($phone_no)) {
                                                                                                                                                echo esc_attr($phone_no);
                                                                                                                                            } ?>"> </input></p>
                    <p>
                        <h4 class="title"><?php esc_html_e('Video', 'wp_property_manager'); ?></h4>
                    </p>
                    <p><input class="option_input" name="video_ulr" id="video_ulr" style="width: 90%;" placeholder="Video URL" type="text" value="<?php if (!empty($video_ulr)) {
                                                                                                                                                        echo esc_attr($video_ulr);
                                                                                                                                                    } ?>"> </input></p>
                    <p>
                        <h4 class="title"><?php esc_html_e('Property Features', 'wp_property_manager'); ?></h4>
                    </p>
                    <p>
                        <div class="input_fields_wrap_wpm">
                            <?php if (isset($total)) {
                                for ($i = 0; $i < $total; $i++) { ?>


                                    <div class="col-md-6 ">
                                        <div id="wpm_label_text_service" class="form-group">

                                            <input type="text" placeholder="Property Feature" name="wpm_label_text[]" id="wpm_label_text" class="textinput form-control option_input" value="<?php echo $all_labels[$i]; ?>" />

                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div id="wpm_features_text_service" class="form-group">

                                            <input type="text" placeholder="value" name="wpm_features_text[]" id="wpm_features_text" class="textinput form-control option_input" value="<?php echo $all_features[$i]; ?>" />

                                        </div>
                                    </div>


                            <?php }
                            } ?>
                            <div class="col-md-6 ">
                                <div id="wpm_label_text_service" class="form-group">
                                    <div class="controls "> <input type="text" placeholder="Property Feature" name="wpm_label_text[]" id="wpm_label_text" class="textinput form-control option_input" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="wpm_features_text_service" class="form-group">
                                    <div class="controls ">
                                        <input type="text" placeholder="value" name="wpm_features_text[]" id="wpm_features_text" class="textinput form-control option_input" />
                                    </div><br>

                                </div>
                            </div>


                        </div>
                        <a name="add_button" id="add_button" class="btn btn-info add-btn wpm_add_field_button" style="color: white;">Add More</a>
                        <!-- <a name="remove_field" id="remove_btton" class="btn btn-danger remove_field" style="color: white;">Remove</a> -->
                    </p>
                </div>

                <div class="map_settings_option col-md-6 float-right form-group">
                    <h4><?php esc_html_e('City', 'wp_property_manager'); ?></h4>
                    </label>
                    <input class="option_input" class="form-control" name="wpm_city" id="wpm_city" style="width: 90%;" placeholder="City" type="text" value="<?php if (!empty($wpm_city)) {
                                                                                                                                                                    echo esc_attr($wpm_city);
                                                                                                                                                                } ?>"> </input>
                    <p>
                        <h4 class="title"><?php esc_html_e('State', 'wp_property_manager'); ?></h4>
                    </p>
                    <p><input class="option_input" name="wpm_state" id="wpm_state" style="width: 90%;" placeholder="State" type="text" value="<?php if (!empty($wpm_state)) {
                                                                                                                                                    echo esc_attr($wpm_state);
                                                                                                                                                } ?>"> </input></p>
                    <p>
                        <h4 class="title"><?php esc_html_e('Country', 'wp_property_manager'); ?></h4>
                    </p>
                    <p><input class="option_input" name="wpm_country" id="wpm_country" style="width: 90%;" placeholder="Country" type="text" value="<?php if (!empty($wpm_country)) {
                                                                                                                                                        echo esc_attr($wpm_country);
                                                                                                                                                    } ?>"> </input></p>
                    <p>
                        <h4 class="title"><?php esc_html_e('Address', 'wp_property_manager'); ?></h4>
                    </p>
                    <p><textarea class="option_input" name="address" id="address" style="width: 90%;; height: 120px; padding: 0px;" placeholder="" rows="3" cols="10"><?php if (!empty($address)) {
                                                                                                                                                                            echo esc_textarea($address);
                                                                                                                                                                        } ?></textarea>
                    </p>
                    <p>
                        <h4 class="title"><?php esc_html_e('Manual input map', 'wp_property_manager'); ?></h4>
                        <div class="custom_checkbox">
                            <input type="checkbox" class="chkPassport" name="manul_map" id="manul_map" <?php if (!empty($manul_map)) {
                                                                                                            echo 'checked';
                                                                                                        } ?> /><label for="manul_map">Toggle</label>
                            <span style="font-style: italic;color: #878585;"><?php _e('Manually input map location', 'wp_property_manager'); ?></span>
                        </div>
                    </p>




                    <div class="manul_map_google1" <?php if (!empty($manul_map)) {
                                                        echo 'style="display: block;"';
                                                    } else {
                                                        echo 'style="display: none;"';
                                                    } ?>>
                        <p>
                            <h4 class="title"><?php esc_html_e('Enter property location', 'wp_property_manager'); ?></h4>
                        </p>
                        <p>
                            <input id="pac-input" class="controls option_input" type="text" placeholder="Search Box" style="width: 75%;height: 36px;">
                            <input type="hidden" name="map_id_admin" id="map_id_admin">
                            <div id="map_admin" style="height: 300px;margin-bottom:20px;margin-top:20px; "></div>
                        </p>
                        <?php if ($wpm_settings['google_map_api_wpm'] != '') { ?>
                            <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $wpm_settings['google_map_api_wpm']; ?>&libraries=places&callback=initAutocomplete" async defer></script>
                        <?php } else {
                            echo '<span class="api_not_put" >First put Google API key in "Settings"..!!</span>';
                        } ?>
                    </div>

                    <?php $map_lati_long = str_replace(array('(', ')'), '', $map_id_admin);
                    $map_lati_long = explode(',', $map_lati_long); ?>

                    <div class="manul_map_google2" <?php if (!empty($manul_map)) {
                                                        echo 'style="display: none;"';
                                                    } else {
                                                        echo 'style="display: block;"';
                                                    } ?>>
                        <p>
                            <h4 class="title"><?php esc_html_e('Longitude', 'wp_property_manager'); ?></h4>
                        </p>
                        <p><input class="option_input" name="longi_wpm" id="longi_wpm" style="width: 90%;" placeholder="" type="text" value="<?php if (empty($longi_wpm) && isset($map_lati_long)) {
                                                                                                                                                    echo $map_lati_long[0];
                                                                                                                                                } else {
                                                                                                                                                    echo esc_attr($longi_wpm);
                                                                                                                                                } ?>"> </input></p>
                        <p>
                            <h4 class="title"><?php esc_html_e('Latitute', 'wp_property_manager'); ?></h4>
                        </p>
                        <p><input class="option_input" name="lati_wpm" id="lati_wpm" style="width: 90%;" placeholder="" type="text" value="<?php if (empty($lati_wpm) && isset($map_lati_long[1])) {
                                                                                                                                                echo $map_lati_long[1];
                                                                                                                                            } else {
                                                                                                                                                echo esc_attr($lati_wpm);
                                                                                                                                            } ?>"> </input></p>
                    </div>
                </div>
            </div>
        </div>
<?php
    }


    public static function wpm_property_meta_save($post_id)
    {
        if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || (defined('DOING_AJAX') && DOING_AJAX) || isset($_REQUEST['bulk_edit'])) {
            return;
        }
        if (!current_user_can('edit_page', $post_id)) {
            return;
        }
        if (isset($_POST['post_ID'])) {
            $post_ID = sanitize_text_field($_POST['post_ID']);
            $post_type = get_post_type($post_ID);

            $wpm_label_text = sanitize_meta('wpm_label_text', $_POST['wpm_label_text'], 'user');
            $wpm_label_text = self::sanitize_wpm_label_text_meta($wpm_label_text);
            $wpm_features_text = sanitize_meta('wpm_features_text', $_POST['wpm_features_text'], 'user');
            $wpm_features_text = self::sanitize_wpm_features_text_meta($wpm_features_text);

            $wpm_label_text = serialize($wpm_label_text);
            $wpm_features_text = serialize($wpm_features_text);

            if ($post_type == 'wpm_properties') {
                update_post_meta($post_ID, 'address', sanitize_text_field($_POST['address']));
                update_post_meta($post_ID, 'area', sanitize_text_field($_POST['area']));
                update_post_meta($post_ID, 'price', sanitize_text_field($_POST['price']));
                update_post_meta($post_ID, 'deposit', sanitize_text_field($_POST['deposit']));
                update_post_meta($post_ID, 'phone_no', sanitize_text_field($_POST['phone_no']));
                update_post_meta($post_ID, 'featured_wpm', sanitize_text_field($_POST['featured_wpm']));
                update_post_meta($post_ID, 'star_rate', sanitize_text_field($_POST['star_rate']));
                update_post_meta($post_ID, 'video_ulr', sanitize_text_field($_POST['video_ulr']));
                update_post_meta($post_ID, 'manul_map', sanitize_text_field($_POST['manul_map']));
                update_post_meta($post_ID, 'longi_wpm', sanitize_text_field($_POST['longi_wpm']));
                update_post_meta($post_ID, 'lati_wpm', sanitize_text_field($_POST['lati_wpm']));
                update_post_meta($post_ID, 'map_id_admin', sanitize_text_field($_POST['map_id_admin']));
                update_post_meta($post_ID, 'wpm_city', sanitize_text_field($_POST['wpm_city']));
                update_post_meta($post_ID, 'wpm_state', sanitize_text_field($_POST['wpm_state']));
                update_post_meta($post_ID, 'wpm_country', sanitize_text_field($_POST['wpm_country']));
                update_post_meta($post_ID, 'property_type', sanitize_text_field($_POST['property_type']));
                update_post_meta($post_ID, 'wpm_label_text', sanitize_text_field($wpm_label_text));
                update_post_meta($post_ID, 'wpm_features_text', sanitize_text_field($wpm_features_text));
            }
        }
    }


    public static function sanitize_wpm_label_text_meta($wpm_label_text)
    {
        if (is_array($wpm_label_text)) {
            return $wpm_label_text;
        } else {
            wp_die('Invalid entry, go back and try again.');
        }
    }


    public static function sanitize_wpm_features_text_meta($wpm_features_text)
    {
        if (is_array($wpm_features_text)) {
            return $wpm_features_text;
        } else {
            wp_die('Invalid entry, go back and try again.');
        }
    }
}

?>