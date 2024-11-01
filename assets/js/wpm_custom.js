function SaveSetting() {
	jQuery("#setting-save-loading-icon").show();
	var data_values = jQuery("#wpm-save-setting").serialize();
	//post data
	jQuery.ajax({
		type: "post",
		url: location.href,
		data: data_values,
		contentType: "application/x-www-form-urlencoded",
		success: function(responseData, _textStatus, _jqXHR) {
			var result = jQuery(responseData).find("div#action-result");
			jQuery("#setting-save-loading-icon").hide();
			location.reload();
		},
		error: function(_jqXHR, _textStatus, errorThrown) {
			console.log(errorThrown);
		}
	});
}

function SaveShortcode() {
	jQuery("#shortcode-save-loading-icon").show();
	var data_values = jQuery("#wpm-save-shortcode").serialize();
	console.log(data_values);
	//post data
	jQuery.ajax({
		type: "post",
		url: location.href,
		data: data_values,
		contentType: "application/x-www-form-urlencoded",
		success: function(responseData, _textStatus, _jqXHR) {
			var result = jQuery(responseData).find("div#action-result");
			jQuery("#shortcode-save-loading-icon").hide();
			location.reload();
		},
		error: function(_jqXHR, _textStatus, errorThrown) {
			console.log(errorThrown);
		}
	});
}
function DeleteShortcode() {
	var answer = confirm("Are you sure?");
	if (answer == true) {
		var data_values = jQuery("#wpm-delete-shortcode").serialize();
		
		//post data
		jQuery.ajax({
			type: "post",
			url: location.href,
			data: data_values,
			contentType: "application/x-www-form-urlencoded",
			success: function(responseData, _textStatus, _jqXHR) {
				var result = jQuery(responseData).find("div#action-result");
				location.reload();
			},
			error: function(_jqXHR, _textStatus, errorThrown) {
				console.log(errorThrown);
			}
		});
	}
	return false;
}

//------Default image for properties ----///
jQuery(document).ready(function($) {
	jQuery("#upload-btn-p").click(function(e) {
		e.preventDefault();
		var image = wp
			.media({
				title: "Upload Image",
				// mutiple: true if you want to upload multiple files at once
				multiple: false
			})
			.open()
			.on("select", function(_e) {
				// This will return the selected image from the Media Uploader, the result is an object
				var uploaded_image = image
					.state()
					.get("selection")
					.first();
				// We convert uploaded_image to a JSON object to make accessing it easier
				// Output to the console uploaded_image
				console.log(uploaded_image);
				var p_image = uploaded_image.toJSON().url;
				// Let's assign the url value to the input field
				jQuery("#p_image").val(p_image);
				var img_tag = $("#p_image").val(p_image);
			});
	});
});
jQuery(document).ready(function() {
	jQuery(".remove_image_button_p").click(function() {
		var answer = confirm("Are you sure?");
		if (answer == true) {
			jQuery("#p_image").val("");
		}
		return false;
	});
});

//---------default marker for maps ----------//
jQuery(document).ready(function($) {
	jQuery("#upload-btn-p_marker").click(function(e) {
		e.preventDefault();
		var image = wp
			.media({
				title: "Upload Image",
				// mutiple: true if you want to upload multiple files at once
				multiple: false
			})
			.open()
			.on("select", function(_e) {
				// This will return the selected image from the Media Uploader, the result is an object
				var uploaded_image = image
					.state()
					.get("selection")
					.first();
				// We convert uploaded_image to a JSON object to make accessing it easier
				// Output to the console uploaded_image
				console.log(uploaded_image);
				var p_marker = uploaded_image.toJSON().url;
				// Let's assign the url value to the input field
				jQuery("#p_marker").val(p_marker);
				var img_tag = $("#p_marker").val(p_marker);
			});
	});
});
jQuery(document).ready(function() {
	jQuery(".remove_image_button_p_marker").click(function() {
		var answer = confirm("Are you sure?");
		if (answer == true) {
			jQuery("#p_marker").val("");
		}
		return false;
	});
});

//--------for create new shortcode settings---------//
jQuery(document).ready(function() {
	jQuery("#dis_title").on("click", function() {
		if (this.checked == true) {
			jQuery(".s_stitle_p").fadeToggle(2500);
		} else {
			jQuery(".s_stitle_p").css("display", "none");
		}
	});
});

jQuery(document).ready(function() {
	jQuery("#dis_desc").on("click", function() {
		if (this.checked == true) {
			jQuery(".s_description_p").fadeToggle(2500);
		} else {
			jQuery(".s_description_p").css("display", "none");
		}
	});
});
