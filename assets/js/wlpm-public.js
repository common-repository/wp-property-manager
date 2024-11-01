var swiper = new Swiper(".wpm_single_swiper-thumbnail", {
	autoHeight: true,
	slidesPerView: 3,
	spaceBetween: 20,
	// init: false,
	pagination: {
		el: ".swiper-pagination",
		clickable: true
	},
	navigation: {
		nextEl: ".swiper-button-next",
		prevEl: ".swiper-button-prev"
	},
	breakpoints: {
		1024: {
			slidesPerView: 3,
			spaceBetween: 20
		},
		768: {
			slidesPerView: 3,
			spaceBetween: 20
		},
		640: {
			slidesPerView: 2,
			spaceBetween: 20
		},
		320: {
			slidesPerView: 1,
			spaceBetween: 10
		}
	}
});

var swiper = new Swiper(".swiper-container", {
	navigation: {
		nextEl: ".swiper-button-next",
		prevEl: ".swiper-button-prev"
	}
});

// console.log(object_name);
// function myMap() {
// 	var mapProp = {
// 		center: new google.maps.LatLng(object_name.lat, object_name.log),
// 		zoom: 13
// 	};
// 	var map = new google.maps.Map(
// 		document.getElementById("googleMap"),
// 		mapProp
// 	);
// }
