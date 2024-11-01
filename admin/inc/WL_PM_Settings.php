<?php if (! defined('ABSPATH')) {
    exit;
}
$date_format = get_option('date_format');
$time_format = get_option('time_format');
$wpm_settings = get_option('wpm_general_settings');
?>
<section class="wpm_setting_heading wow fadeIn">
    <div class="card-body text-white text-center py-5 px-5 my-5">
        <h1 class="mb-4 text-uppercase">
            <b><?php esc_html_e('Wp Property Manager','wp_property_manager'); ?></b>
        </h1>
        <h2 class="text-uppercase general_settings_h2">
            <strong><?php esc_html_e('General Settings','wp_property_manager'); ?></strong>
        </h2>
    </div>
</section>
<!-- Generated shotcode -->
<section class="wpm_settings_main">
  <form id="wpm-save-setting" name="wpm-save-setting" method="post">
    <div class="table-responsive col-md-10 col-sm-12">
      <table class="table">
      <tbody>
        	<tr>
            	<td> <strong> <label  for="Shortcode"><?php esc_html_e('Copy This Shortcode Into Your Page: ','wp_property_manager'); ?></label> </strong> <span> [wpm_featured name="test" id="0" ]</span> </td>
            </tr>
            <tr>
              <td><label  for="title"><?php esc_html_e('Enable/Disable for display ','wp_property_manager'); ?></label></td>
              <td><div class="custom_checkbox">
                  <input type="checkbox" name="p_comments" id="p_comments" <?php if(isset($wpm_settings['p_comments'])) { checked( $wpm_settings['p_comments'], 1 ); } ?> value="1" />
                  <span class="font-italic"><?php esc_html_e('Enable comments','wp_property_manager'); ?></span>
              </div></td>
            </tr>
            <tr>
              <td><label  for="title"><?php esc_html_e('Enable/Disable for display Revisions','wp_property_manager'); ?> </label></td>
              <td><div class="custom_checkbox">
                  <input type="checkbox" name="p_revisions" id="p_revisions" <?php if(isset($wpm_settings['p_revisions'])) { checked( $wpm_settings['p_revisions'], 1 ); } ?> value="1" />
                  <span class="font-italic"><?php esc_html_e('Enable revisions','wp_property_manager'); ?></span>
              </div></td>
            </tr>
            <tr>
              <td><label  for="title"><?php esc_html_e('Enable/Disable for display','wp_property_manager'); ?> </label></td>
              <td><div class="custom_checkbox">
                  <input type="checkbox" name="p_exclude" id="p_exclude" <?php if(isset($wpm_settings['p_exclude'])) { checked( $wpm_settings['p_exclude'], 1 ); } ?> value="1" /><label for="p_exclude">
                  <span class="font-italic"> <?php esc_html_e(' Exclude Properties from regular search results.','wp_property_manager'); ?></span>
              </div></td>
            </tr>
            
            <tr>
              <td><label  for="symbol"><?php esc_html_e('Currency Symbol','wp_property_manager'); ?></label></td>
              <td><input type="text" placeholder="<?php esc_attr_e('Symbol Like','wp_property_manager');?> '$'" name="pro_symbol" id="pro_symbol" value="<?php
               if(isset($wpm_settings['pro_symbol'])){
                  echo esc_attr($wpm_settings['pro_symbol']);
                   }else {
                     $wpm_settings= '$';
                   }  ?>">
              </td>
            </tr>
            
            <tr>
                <td><label  for="password"><?php esc_html_e('Google Map API Key','wp_property_manager'); ?></label></td>
                <td><input type="text" name="google_map_api_wpm" id="google_map_api_wpm"  value="<?php if(isset($wpm_settings['google_map_api_wpm'])){ echo esc_attr($wpm_settings['google_map_api_wpm']); }  ?>"></td>
            </tr>
            
            <tr>
              <td><input type="hidden" id="save-setting" name="save-setting" value="wpm-save-setting">
              <?php wp_nonce_field( 'wpm_setting_nonce', 'wpm_setting_nonce' ); ?>
              <input type="button" id="save" name="save" class="btn btn-info btn-mg" onclick="return SaveSetting();" value="<?php _e('Save Settings','wp_property_manager'); ?>">
            </tr>
        </tbody>
      </table>
  </form>
</section>

<?php // save settings
if (isset($_POST['save-setting'])) {
    if (! wp_verify_nonce($_POST['wpm_setting_nonce'], 'wpm_setting_nonce')) {
        return;
    } else {
        $saved_short = get_option("wpm_general_settings");
        $p_comments = sanitize_key($_POST['p_comments']);
        $p_revisions = sanitize_key($_POST['p_revisions']);
        $p_exclude = sanitize_key($_POST['p_exclude']);
        
        $pro_symbol = sanitize_text_field($_POST['pro_symbol']);

        $p_marker = sanitize_text_field($_POST['p_marker']);
        $google_map_api_wpm = sanitize_text_field($_POST['google_map_api_wpm']);
   
        $new_holiday = array(
        'p_comments' => $p_comments,
        'p_revisions' => $p_revisions,
        'p_exclude' => $p_exclude,
        'pro_symbol' => $pro_symbol,
        'p_marker' => $p_marker,
        'google_map_api_wpm' => $google_map_api_wpm,
    );

        if ( update_option('wpm_general_settings', $new_holiday) ) {
           echo "<script>jQuery(document).ready( function () {
            alert('data saved.!');
           });</script>";
          ;
        }
    }

}
?>