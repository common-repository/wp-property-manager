<?php if ( ! defined( 'ABSPATH' ) ) exit;
$date_format = get_option('date_format');  
?>
<!-- Generated shotcode -->
<section class="generated_shortcodes">
    <div class="form_only">
      <h1><?php esc_html_e('ShortCodes','wp_property_manager'); ?></h1>
        <div class="inset">
          <div class="card-body">
              <!--Table-->
              <table class="table table-hover table-responsive-md ">
                  <!--Table head-->
                  <thead>
                      <tr>
                          <th><?php esc_html_e('#','wp_property_manager'); ?></th>
                          <th><?php esc_html_e('Name','wp_property_manager'); ?></th>
                          <th><?php esc_html_e('Shortcode','wp_property_manager'); ?></th>
                          <th><?php esc_html_e('Date Created','wp_property_manager'); ?></th>
                          <th><?php esc_html_e('Action','wp_property_manager'); ?></th>
                      </tr>
                  </thead>
                  <!--Table head-->
                  <!--Table body-->
                  <?php if($shortcodes = get_option("wpm_generate_shortcode")) { ?>
                  <tbody>
                  <?php $n = 1; 
                  foreach($shortcodes as $key => $shortcode) { 
                  $title = $shortcode['s_title'];
                  $p_featured = $shortcode['p_featured'];
                      ?>
                      <tr>
                          <td scope="row"><?php echo esc_html($n); ?></td>
                          <td><?php echo esc_html($shortcode['s_title']); ?></td>
                          <td><?php
                                if($p_featured)
                                {
                                    echo esc_html('[wpm_featured name="'.$shortcode['s_title'].'" id="'.$key.'" ]');
                                } else {
                                    echo esc_html('[wpm_shortcode name="'.$shortcode['s_title'].'" id="'.$key.'" ]');
                                }
                               ?>
                          </td>
                          <td><?php echo esc_html(date($date_format , strtotime($shortcode['current_date']))); ?></td>
                          <td>
                              <form id="wpm-delete-shortcode" name="wpm-delete-shortcode" method="post">
                                  <input type="hidden" name="p_id" id="p_id" value="<?php echo esc_attr($key); ?>">
                                  <?php wp_nonce_field( 'wpm_shortcode_delete_nonce', 'wpm_shortcode_delete_nonce' ); ?>
                                  <input type="hidden" id="delete-shortcode" name="delete-shortcode" value="wpm-delete-shortcode">
                                  <button type="button" class="btn btn-danger" onclick="return DeleteShortcode();">DELETE</button>
                              </form>
                          </td>
                      </tr>
                      <?php $n++; } ?>
                  </tbody>
              <?php } else {
                  echo '<tbody><tr><th>No Shortcode Created Yet!</th></tr></tbody>';
              } ?>
                  <tfooter>
                      <tr>
                          <th><?php esc_html_e('#','wp_property_manager'); ?>/th>
                          <th><?php esc_html_e('Name','wp_property_manager'); ?></th>
                          <th><?php esc_html_e('Shortcode','wp_property_manager'); ?></th>
                          <th><?php esc_html_e('Date Created','wp_property_manager'); ?></th>
                          <th><?php esc_html_e('Action','wp_property_manager'); ?></th>
                      </tr>
                  </tfooter>
                  <!--Table body-->
              </table>
              <!--Table-->
               <button type="button" class="btn btn-info " data-toggle="modal" data-target="#wpm_new_short_model"><?php esc_html_e('Add New','wp_property_manager'); ?></button>
          </div>
      </div>
  </div>
</section>

<!-- Model for create new shortcode -->
<div class="modal fade" id="wpm_new_short_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-notify modal-info" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><?php esc_html_e('Create New Shortcode','wp_property_manager'); ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </div>
          <div class="modal-body">
            <form id="wpm-save-shortcode" name="wpm-save-shortcode" method="post" action="">
                   <div class="form-group col-md-8">
                      
                        <label for="title"><?php esc_html_e('Name','wp_property_manager'); ?></label>
                        <p>
                        <input type="text" class="form-control" name="s_title" id="s_title">
                      </p>
                      <p>
                        <label for="title"><?php esc_html_e('Display Title','wp_property_manager'); ?></label>
                        <div class="custom_checkbox">
                            <input type="checkbox" class="form-control" name="dis_title" id="dis_title" value="0" />
                            <span class="span_notice"><?php esc_html_e('Show Title on Property Shortcode section','wp_property_manager'); ?> </span>
                        </div>
                      </p>
                      <p class="s_stitle_p" style="display:none;">
                        <label for="title"><?php esc_html_e('Section Title','wp_property_manager'); ?></label>
                        <input type="text" class="form-control" name="s_stitle" id="s_stitle">
                      </p>
                      <p>
                        <label for="title"><?php esc_html_e('Display Description','wp_property_manager'); ?></label>
                        <div class="custom_checkbox">
                            <input type="checkbox" class="form-control" name="dis_desc" id="dis_desc" /><label for="dis_desc">
                            <span class="span_notice"><?php esc_html_e('Show Description on Property Shortcode section','wp_property_manager'); ?></span> 
                        </div>
                      </p>
                      <p class="s_description_p" style="display:none;">
                        <label for="password"><?php esc_html_e('Section Description','wp_property_manager'); ?></label>
                        <textarea name="s_description" class="form-control" id="s_description" placeholder="" ></textarea>
                      </p>
                      <p>
                        <label for="title"><?php esc_html_e('Display Featured ','wp_property_manager'); ?></label>
                        <div class="custom_checkbox">
                            <input type="checkbox" class="form-control" name="p_featured" id="p_featured" /><label for="p_featured">
                            <span class="span_notice"><?php esc_html_e('Show only Featured Properties','wp_property_manager'); ?> </span>
                        </div>
                      </p>
                      <p>
                        <label for="password"><?php esc_html_e('Select Property Type','wp_property_manager'); ?></label>
                        <select name="s_pcat" id="s_pcat" class="form-control">
                            <option  value="all"><?php esc_html_e('Select Type','wp_property_manager'); ?></option>
                            <option value="p_11" ><?php esc_html_e('Bungalow','wp_property_manager'); ?></option>
                            <option value="p_12" >- <?php esc_html_e('Detached Bungalow','wp_property_manager'); ?></option>
                            <option value="p_13" >- <?php esc_html_e('Semi-Detached Bungalow','wp_property_manager'); ?></option>
                            <option value="p_14" >- <?php esc_html_e('Terraced Bungalow','wp_property_manager'); ?></option>
                            <option value="p_15" ><?php esc_html_e('Flat / Apartment','wp_property_manager'); ?></option>
                            <option value="p_16" >- <?php esc_html_e('Apartment','wp_property_manager'); ?></option>
                            <option value="p_17" >- <?php esc_html_e('Duplex','wp_property_manager'); ?></option>
                            <option value="p_18" >- <?php esc_html_e('Flat','wp_property_manager'); ?></option>
                            <option value="p_19" >- <?php esc_html_e('Maisonette','wp_property_manager'); ?></option>
                            <option value="p_20" >- <?php esc_html_e('Penthouse','wp_property_manager'); ?></option>
                            <option value="p_21" >- <?php esc_html_e('Studio','wp_property_manager'); ?></option>
                            <option value="p_22" >- <?php esc_html_e('Triplex','wp_property_manager'); ?></option>
                            <option value="p_23" ><?php esc_html_e('House','wp_property_manager'); ?></option>
                            <option value="p_24" >- <?php esc_html_e('Cottage','wp_property_manager'); ?></option>
                            <option value="p_25" >- <?php esc_html_e('Detached House','wp_property_manager'); ?></option>
                            <option value="p_26" >- <?php esc_html_e('End of Terrace House','wp_property_manager'); ?></option>
                            <option value="p_27" >- <?php esc_html_e('Link Detached House','wp_property_manager'); ?></option>
                            <option value="p_28" >- <?php esc_html_e('Mews','wp_property_manager'); ?></option>
                            <option value="p_29" >- <?php esc_html_e('Semi-Detached House','wp_property_manager'); ?></option>
                            <option value="p_30" >- <?php esc_html_e('Terraced House','wp_property_manager'); ?></option>
                            <option value="p_31" >- <?php esc_html_e('Town House','wp_property_manager'); ?></option>
                            <option value="p_32" ><?php esc_html_e('Other','wp_property_manager'); ?></option>
                            <option value="p_33" >- <?php esc_html_e('Commercial','wp_property_manager'); ?></option>
                            <option value="p_34" >- <?php esc_html_e('Garage','wp_property_manager'); ?></option>
                            <option value="p_35" >- <?php esc_html_e('Land','wp_property_manager'); ?></option>
                        </select>
                      </p>
                      <p>
                        <label for="password"><?php esc_html_e('No. of columns shown in page.','wp_property_manager'); ?></label>
                        <select name="s_col" id="s_col" class="form-control">
                            <option value="2" ><?php esc_html_e('Two','wp_property_manager'); ?></option>
                            <option value="3" ><?php esc_html_e('Three','wp_property_manager'); ?></option>
                            <option value="4" ><?php esc_html_e('Four','wp_property_manager'); ?></option>
                        </select>
                      </p>
                      <p>
                        <label for="password"><?php esc_html_e('No. of Properties shown at once.','wp_property_manager'); ?></label>
                        <input type="number" class="form-control" name="s_nop" id="s_nop">
                      </p>
                  </div>
                 
                    <input type="hidden" class="form-control" id="save-shortcode" name="save-shortcode" value="wpm-save-shortcode">
                    <input type="hidden" class="form-control" name="current_date" value="<?php echo date("Y-m-d"); ?>">
                    <?php $nounce = wp_create_nonce( 'wpm_shortcode_nonce' ); ?>
                    <input type="hidden" class="form-control" name="wpm_shortcode_nonce" value="<?php echo esc_attr( $nounce );; ?>">
                  <div class="modal-footer ">
                    <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                    <button type="submit"  name="submit_shortcode" class="btn btn-info">Submit </button>
                   </div>
                </form>
          </div>
      </div>
  </div>
</div>
<?php 
// save Shortcodes

if(isset($_POST['submit_shortcode'])) {
  if( ! wp_verify_nonce( $_REQUEST['wpm_shortcode_nonce'], 'wpm_shortcode_nonce' ) )
    { return; } else  {
    $saved_short = get_option("wpm_generate_shortcode");
    $s_title = sanitize_text_field($_POST['s_title']);
    $s_stitle = sanitize_text_field($_POST['s_stitle']);
    $s_description = sanitize_text_field($_POST['s_description']);
    // $s_categories = sanitize_text_field($_POST['s_categories']);
    $wpm_cat = sanitize_text_field($_POST['s_pcat']);
    $s_nop = sanitize_text_field($_POST['s_nop']);
    $current_date = sanitize_text_field($_POST['current_date']);
    $p_featured = sanitize_text_field($_POST['p_featured']);
    $s_col = sanitize_text_field($_POST['s_col']);

    if ( empty ( $saved_short ) ) {
      $saved_short = array();
    }
    
    $new_holiday = array ( 
        's_title' => $s_title,
        's_stitle' => $s_stitle,
        's_description' => $s_description,
        's_pcat' => $wpm_cat,
        // 's_categories' => $s_categories,
        's_nop' => $s_nop,
        'current_date' => $current_date,
        'p_featured' => $p_featured,
        's_col' => $s_col,
    );
    
    // $saved_short[] = $new_holiday;
    array_push( $saved_short, $new_holiday );
    if(update_option("wpm_generate_shortcode" , $saved_short)) {
        ?><div id="add-holiday-result"><?php esc_html_e('Shortcodes Saved successfully.', 'wp_property_manager' );?></div><?php
    }
  }
} 

//delete shortcode
if(isset($_POST['delete-shortcode'])) {
  if( ! wp_verify_nonce( $_POST['wpm_shortcode_delete_nonce'], 'wpm_shortcode_delete_nonce' ) )
    { return; } else  {
    $key = sanitize_text_field($_POST['p_id']);
    $shortcodes_d = get_option("wpm_generate_shortcode");
    unset($shortcodes_d[$key]);
    $shortcodes_d = update_option("wpm_generate_shortcode", $shortcodes_d);
  }
}
?>
