// for searching property

jQuery(document).ready(function() {
	//alert(search_array.input_get)
	
	if (search_array.input_get > 0) {
		jQuery(".pro-search").css("display", "none");
		jQuery(".pro-search" + search_array.js_class).css("display", "block");
	} else {
		jQuery(".pro-search").css("display", "block");
	}
});
