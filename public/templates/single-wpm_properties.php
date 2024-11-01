<?php
if (! defined('ABSPATH')) {
    exit;
}
get_header();
?>
<?php if (have_posts()) {
    while (have_posts()) :
        the_post();
        $current_pid = get_the_ID();
        
        $project_home_port = unserialize(base64_decode(get_post_meta( get_the_ID(), 'bs_all_photos_details', true)));
        if (get_the_post_thumbnail() || $project_home_port) { 
?>
<div class="container">
     <h3 class="mt-3">Property Name: <?php echo get_the_title(); ?></h3>
    
<div class="wrapper boxed-main index-1 mt-4" id="gallery" >
           <div class="swiper-container">
    <div class="swiper-wrapper">
                    <div class="swiper-slide">
                             <img class="img-responsive" src="<?php  echo esc_attr(esc_url(get_the_post_thumbnail_url())); ?>" alt="property images">
                    </div>
                    <?php 
                    if (!empty($project_home_port)) {
                        foreach($project_home_port as $port_images) { ?>
                        
                         <div class="swiper-slide">
                             <img class="img-responsive" src="<?php echo esc_attr(esc_url($port_images['bsp_image_url'])); ?>" alt="property images">
                        </div>
                        
                  <?php  } ?> 
                      
                            <!-- Add Arrows -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    <?php }  ?>
                </div>
                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                <?php } ?>
            </div>
            </div>
    <div class="row">
      <div class="col-lg-12">
        <hr>


        <h3><?php esc_html_e('House Details','wp_property_manager'); ?></h3>
	</div>
	<div class="col-lg-6">
    <?php 
        $deposit =  get_post_meta(get_the_ID(), 'deposit', true);
        $city =  get_post_meta(get_the_ID(), 'wpm_city', true);
        $state =  get_post_meta(get_the_ID(), 'wpm_state', true);
        $country =  get_post_meta(get_the_ID(), 'wpm_country', true);
        $zipcode =  get_post_meta(get_the_ID(), 'area', true);
        $phone =  get_post_meta(get_the_ID(), 'phone_no', true);
        $address = get_post_meta(get_the_ID(), 'address', true);
        
    ?>

		<?php if(isset($deposit) || isset($area) || isset($phone_no) || isset($address) || isset($city) ){ ?>
		<h5><strong><?php esc_html_e('Price: ','wp_property_manager'); ?></strong> 
					<?php $price = get_post_meta( get_the_ID(), 'price', true );
					if($price!='')
			        {
			        	$wpm_settings = get_option('wpm_general_settings');
			        	echo '<b>'.$wpm_settings['pro_symbol'].'</b>'.$price;
			        } ?>
				</h5>
        <h5><strong><?php esc_html_e('City: ','wp_property_manager'); ?></strong><?php echo esc_html($city); ?></h5>
        <h5><strong><?php esc_html_e('State: ','wp_property_manager'); ?></strong><?php echo esc_html( $state); ?></h5>
        <h5><strong><?php esc_html_e('Country: ','wp_property_manager'); ?></strong><?php echo esc_html( $country); ?></h5>
		
	</div>
		
    <div class="col-lg-6">
		<h5><strong><?php esc_html_e('Zipcode: ','wp_property_manager'); ?></strong><?php echo esc_html($zipcode); ?></h5>
		<h5><strong><?php esc_html_e('Phone Number: ','wp_property_manager'); ?></strong><?php echo esc_html($phone); ?></h5>
        <h5><strong><?php esc_html_e('Address: ','wp_property_manager'); ?></strong><?php echo esc_html($address); ?></h5>
        <h5><strong><?php esc_html_e('Security Deposit: ','wp_property_manager'); ?></strong><?php echo esc_html($deposit); ?></h5>
	</div>
        <hr>
                <?php } ?>
    <div class="col-lg-12">
        <hr>
        <?php $wpm_label_text = get_post_meta( get_the_ID(), 'wpm_label_text', true ); 
                        $wpm_features_text = get_post_meta( get_the_ID(), 'wpm_features_text', true ); 
                        $all_labels = unserialize($wpm_label_text);
                        $all_features = unserialize($wpm_features_text);
                        if(isset($all_labels) && isset($all_features)) { 
                        $arra_size = sizeof($all_labels); ?>
                    
                                <h4 ><?php esc_html_e('Property Features','wp_property_manager'); ?></h4>
                                <ul>
                                    <?php 
                                    if (empty($all_features) ) {
                                        echo "<p>No Addistional Feature! <p>";
                                    }else{
                                    for($i=0; $i < $arra_size ; $i++){ ?>
                                        <li><strong>Feature: </strong> <?php echo esc_html($all_labels[$i]); ?>  <strong><?php esc_html_e('Value: ','wp_property_manager'); ?></strong>
                                         <?php echo esc_html($all_features[$i]); ?></li>
                                    <?php }} ?>
                                </ul>
            
            <h5><?php esc_html_e('House Description: ','wp_property_manager'); ?></h5>
            <p><?php the_excerpt(); ?></p>
            <h5>Video Link: <?php echo(get_post_meta(get_the_ID(), 'video_ulr', true)); ?></h5>
        </div><?php } ?>
        
        <!-- Google map  -->
        <div class="col-lg-12 mb-5">
        <hr>
        <h3>Map Location</h3>
        <div id="googleMap" style="width:100%;height:250px;"></div>
        
        <?php
        $map_id_admin = get_post_meta( get_the_ID(), 'map_id_admin', true);
        $lati_wpm = get_post_meta( get_the_ID(), 'lati_wpm', true);
        $longi_wpm = get_post_meta( get_the_ID(), 'longi_wpm', true); 
        $wpm_settings = get_option('wpm_general_settings');
        $manul_map = get_post_meta( get_the_ID(), 'manul_map', true);
        

        if($wpm_settings['google_map_api_wpm']!=''){
        $wpm_settings = get_option('wpm_general_settings');

        if ( ! empty ( $wpm_settings['google_map_api_wpm'] ) ) {

        if($map_id_admin!=''){

        $map_lati_long = str_replace(array( '(', ')' ), '', $map_id_admin); $map_lati_long = explode(',', $map_lati_long); 
            
            
        echo "<script> function myMap() {
                    var mapProp = {
                        center: new google.maps.LatLng(".$map_lati_long[0].", ".$map_lati_long[1]."),
                        zoom: 13
                    };
                    var map = new google.maps.Map(
                        document.getElementById('googleMap'),
                        mapProp
                    );
                } </script>";
        ?>
      
        <?php } } } ?>
    </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
    <?php endwhile;
}?>
<?php get_footer(); ?>
