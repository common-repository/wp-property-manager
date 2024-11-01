//Map toggle switch
jQuery(function() {
	jQuery(".chkPassport").click(function() {
		if (jQuery(this).is(":checked")) {
			jQuery(".manul_map_google1").show();
			jQuery(".manul_map_google2").hide();
		} else {
			jQuery(".manul_map_google1").hide();
			jQuery(".manul_map_google2").show();
		}
	});
});
//admin end google map box
function initAutocomplete() {
	var map = new google.maps.Map(document.getElementById("map_admin"), {
		center: { lat: -33.8688, lng: 151.2195 },
		zoom: 14,
		mapTypeId: "roadmap"
	});

	// Create the search box and link it to the UI element.
	var input = document.getElementById("pac-input");
	var searchBox = new google.maps.places.SearchBox(input);
	map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

	// Bias the SearchBox results towards current map's viewport.
	map.addListener("bounds_changed", function() {
		searchBox.setBounds(map.getBounds());
	});

	var markers = [];
	// Listen for the event fired when the user selects a prediction and retrieve
	// more details for that place.
	searchBox.addListener("places_changed", function() {
		var places = searchBox.getPlaces();

		if (places.length == 0) {
			return;
		}

		// Clear out the old markers.
		markers.forEach(function(marker) {
			marker.setMap(null);
		});
		markers = [];

		// For each place, get the icon, name and location.
		var bounds = new google.maps.LatLngBounds();
		places.forEach(function(place) {
			if (!place.geometry) {
				console.log("Returned place contains no geometry");
				return;
			}
			var icon = {
				url: place.icon,
				size: new google.maps.Size(71, 71),
				origin: new google.maps.Point(0, 0),
				anchor: new google.maps.Point(17, 34),
				scaledSize: new google.maps.Size(25, 25)
			};

			// Create a marker for each place.
			markers.push(
				new google.maps.Marker({
					map: map,
					icon: icon,
					title: place.name,
					position: place.geometry.location
				})
			);

			if (place.geometry.viewport) {
				// Only geocodes have viewport.
				var map_id = bounds.union(place.geometry.viewport);
				jQuery("#map_id_admin").val(place.geometry.location);
			} else {
				bounds.extend(place.geometry.location);
			}
		});
		var map_id1 = map.fitBounds(bounds);
	});
}

//Property features fields
jQuery(document).ready(function() {
	var max_fields = 15; //maximum input boxes allowed
	var wrapper = jQuery(".input_fields_wrap_wpm"); //Fields wrapper
	var add_button = jQuery(".wpm_add_field_button"); //Add button ID

	var x = 1; //initlal text box count
	jQuery(add_button).click(function(e) {
		//on add input button click
		e.preventDefault();
		if (x < max_fields) {
			//max input box allowed
			x++; //text box increment
			jQuery(wrapper).append(
				'<div class="col-md-6 "><div id="wpm_label_text_service" class="form-group"> <div class="controls "> <input type="text" placeholder="Property Feature" name="wpm_label_text[]" id="wpm_label_text" class="textinput form-control option_input" /> </div> </div> </div> <div class="col-md-6"> <div id="wpm_features_text_service" class="form-group"> <div class="controls "> <input type="text" placeholder="value" name="wpm_features_text[]" id="wpm_features_text" class="textinput form-control option_input" /></div></div></div> '
			);
		} else {
			alert("Field limit exceeds...!");
		}
	});

	jQuery(wrapper).on("click", ".remove_field", function(e) {
		//user click on remove text
		e.preventDefault();
		$(this)
			.parent("div")
			.remove();
		x--;
	});
});



