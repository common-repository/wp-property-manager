<?php // Search Property Page
if (! defined('ABSPATH')) {
	exit;
}
get_header();
$country_arr = array();
$state_arr   = array();
$city_arr    = array();
$property_data= array('post_type'=>'wpm_properties', 'posts_per_page'=>-1);
$pro_list= new WP_Query($property_data);
if ($pro_list->have_posts()) {
    while ($pro_list->have_posts()) {
        $pro_list->the_post();
        if (get_post_meta(get_the_ID(), 'wpm_country', true)!='') {
			$country= get_post_meta(get_the_ID(), 'wpm_country', true);
			$country =explode(', ', $country);
			array_push( $country_arr , $country );
        }
        if (get_post_meta(get_the_ID(), 'wpm_state', true)!='') {
			$state = get_post_meta(get_the_ID(), 'wpm_state', true);
			$state =explode(', ', $state);
			array_push( $state_arr , $state );
        }
        if (get_post_meta(get_the_ID(), 'wpm_city', true)!='') {
			$city= get_post_meta(get_the_ID(), 'wpm_city', true);
			$city=explode(" ", $city);
			array_push( $city_arr , $city );
        }
    }
}
foreach($country_arr as $k=>$v) {
if( ($kt=array_search($v,$country_arr))!==false and $k!=$kt )
 { unset($country_arr[$kt]);  $duplicated[]=$v; }
}
foreach($state_arr as $k=>$v) {
if( ($kt=array_search($v,$state_arr))!==false and $k!=$kt )
 { unset($state_arr[$kt]);  $duplicated[]=$v; }
}
foreach($city_arr as $k=>$v) {
if( ($kt=array_search($v,$city_arr))!==false and $k!=$kt )
 { unset($city_arr[$kt]);  $duplicated[]=$v; } }
?>

<section >
  <div class="container mt-5">
		<div class="col-md-12 select-product-drowp">
		<form role="search" id="wpm-save-search" name="wpm-save-search"  method="post" action="">
			 <div class="col-md-12 col-sm-6 ">
				<h1><?php esc_html_e('Find Here','wp_property_manager'); ?></h1>
			</div>
			
			<div class="col-md-4 col-sm-6 item__content select-product-drowp">
				<label> <?php esc_html_e('City','wp_property_manager'); ?>	</label>
				<select class="mdb-select colorful-select dropdown-primary" name="wpm_city_search">
					<option value=""> <?php esc_html_e('All','wp_property_manager'); ?></option>
					<?php 

					foreach($city_arr as $arr){?>
						<?php foreach($arr as $item){?>
					<option value="<?php echo esc_attr($item); ?>"><?php echo esc_html($item); ?></option>
					<?php  }} ?>
				</select>
				<!--/Blue select-->	
			</div>
			<div class="col-md-4 col-sm-6 item__content select-product-drowp">
				<label> <?php esc_html_e('State','wp_property_manager'); ?>	 </label>
				<select class="mdb-select colorful-select dropdown-primary" name="wpm_state_search">
					<option value=""> <?php esc_html_e('All','wp_property_manager'); ?></option>

					<?php if(is_array($state_arr)){
					foreach($state_arr as $arr){?>
						<?php foreach($arr as $item){?>
					<option value="<?php echo esc_attr($item); ?>"><?php echo esc_html($item); ?></option>
					<?php } }} ?>
				</select>
				<!--/Blue select-->
			</div>
			<div class="col-md-4 col-sm-6  item__content select-product-drowp">
				<label> <?php esc_html_e('Country','wp_property_manager'); ?>	 </label>
				<select class="mdb-select colorful-select dropdown-primary" name="wpm_country_search">
					<option value=""> <?php esc_html_e('All','wp_property_manager'); ?></option>
					<?php foreach($country_arr as $arr){?>
						<?php foreach($arr as $item){?>
					<option value="<?php echo esc_attr($item); ?>"><?php echo esc_html($item); ?></option>
					<?php } } ?>
				</select>	
				<!--/Blue select-->
			</div>
			<div class="col-md-4 col-sm-6 item__content select-product-drowp">
				<label> <?php esc_html_e('Type','wp_property_manager'); ?> </label>
				<select class="mdb-select colorful-select dropdown-primary" name="wpm_cat_search">
					<option value="all"><?php esc_html_e('All','wp_property_manager'); ?></option>
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
			</div>
			<input type="hidden" name="post_type" value="realestate_property" />
			<div class="col-md-2 col-sm-12 item__content col-xs-12 select-product-drowp ">
				<button type="submit" id="search-btn" class="btn btn-dark px-3 form-inline" value="<?php esc_html_e('Search','wp_property_manager'); ?>" name="submit_btn">Search</button>
			</div>
		</form>
		</div>
	
  </div>
</section>
<?php if(isset($_REQUEST['submit_btn']))
    { 
       $wpm_country_search = $_POST['wpm_country_search'];
       $wpm_state_search = $_POST['wpm_state_search'];
       $wpm_city_search = $_POST['wpm_city_search'];
       $wpm_type = $_POST['wpm_cat_search'];
    } 
?>

<?php $input_get = 0;
		if(isset($wpm_city_search) || isset($wpm_state_search) || isset($wpm_country_search) || isset($wpm_type) )
		{
		$input_get = 1;
	    $type= str_replace(' ', '-', $wpm_type);
		$city= str_replace(' ', '-', $wpm_city_search);
		$state= str_replace(' ', '-', $wpm_state_search);
		$country= str_replace(' ', '-', $wpm_country_search);
			
			if($type || $city || $state || $country){
				$js_class='';
				if($city){ $js_class.= '.'.$city; }
				if($state){ $js_class.= '.'.$state; }
				if($country){ $js_class.= '.'.$country; }
				if($type){ $js_class.= '.'.$type; }
			}
		    // Localize the script with new data
			$search_array = array(
			    'js_class' => $js_class,
			    'input_get' => $input_get,
			);

			wp_localize_script( 'frontend-ajax', 'search_array', $search_array );
		}

			$service_data= array('post_type' => 'wpm_properties','posts_per_page'=> -1 );
		
			  $service = new WP_Query( $service_data );
			  if( $service->have_posts() ){ $i=1;?>
<div class="container">
<div class="row my-5">

	<?php
		while($service->have_posts()): $service->the_post(); 
			$project_home_port = unserialize(base64_decode(get_post_meta( get_the_ID(), 'bs_all_photos_details', true)));
			$fliter_class= '';
				if(get_post_meta( get_the_ID(), 'wpm_city', true )!=''){
				    $fliter_class .= str_replace(' ', '-', get_post_meta( get_the_ID(), 'wpm_city', true )).' ';
				} 
				if(get_post_meta( get_the_ID(), 'wpm_state', true )!=''){
				    $fliter_class .= str_replace(' ', '-', get_post_meta( get_the_ID(), 'wpm_state', true )).' ';
				} 
				if(get_post_meta( get_the_ID(), 'wpm_country', true )!=''){
				    $fliter_class .= str_replace(' ', '-', get_post_meta( get_the_ID(), 'wpm_country', true )).' ';
				} 
				if(get_post_meta( get_the_ID(), 'property_type', true )!=''){
				    $fliter_class .= str_replace(' ', '-', get_post_meta( get_the_ID(), 'property_type', true )).' ';
				}
	?>
		
		<div class="col-lg-4 col-md-6 mb-4 pro-search <?php echo esc_attr( $fliter_class ); ?> all" >
		<div class="card h-100 ">
			<a href="<?php the_permalink(); ?>"><img class="card-img-top" src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt=""></a>
			<div class="card-body">
			<h4 class="card-title">
				<a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
			</h4>
			<h5><strong>Price: </strong> 
				<?php $price = get_post_meta( get_the_ID(), 'price', true );
				if($price!='')
				{
					$wpm_settings = get_option('wpm_general_settings');
					echo '<b>'.$wpm_settings['pro_symbol'].'</b>'.$price;
				} ?>
			</h5>
			<h5><strong>City: </strong><?php echo(get_post_meta(get_the_ID(), 'wpm_city', true)); ?></h5>
			
			<h5><strong>State: </strong><?php echo(get_post_meta(get_the_ID(), 'wpm_state', true)); ?></h5>
			
			<p class="card-text"><strong><?php esc_html_e('Description: ','wp_property_manager'); ?></strong><?php the_excerpt(); ?></p>
			</div>
			<div class="card-footer">
			<small class="text-muted"><?php 
			$i = get_post_meta(get_the_ID(), 'star_rate', true);
			for ($x=0; $x <=$i ; $x++) { 
				echo '<i class="fas fa-star"></i>';
			}
				?>
				</small><a class="btn btn-dark float-right" href="<?php the_permalink(); ?>" ><?php esc_html_e('View More','wp_property_manager'); ?></a>
			</div>
		</div>
		</div>
		
        <!-- /.row -->
<?php  endwhile; } ?>
</div>
</div>
<?php get_footer(); ?>
