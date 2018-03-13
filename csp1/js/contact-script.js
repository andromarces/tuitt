'use strict'

function initMap() {
	var purrfect = {
		lat: 14.632946,
		lng: 121.043719
	};
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 17,
		center: purrfect
	});
	var marker = new google.maps.Marker({
		position: purrfect,
		map: map
	});
	google.maps.event.addDomListener(window, 'resize', function () {
		map.setCenter(purrfect);
	});
}

$(function () {
	/* offcanvas script */

	$('[data-toggle="offcanvas"]').on('click', function () {
		$('.sidebar-offcanvas').toggleClass('active');
	});


	$(document).on('click', function (event) {
		if (!$(event.target).closest('#sidebar').length) {
			if ($('.sidebar-offcanvas').hasClass('active')) {
				$('.sidebar-offcanvas').toggleClass('active');
			}
		}
	});
	/* back to top script */
	window.onscroll = function () {
		scrollFunction();
	};

	function scrollFunction() {
		if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
			document.getElementById("topBtn").style.display = "inline-block";
		} else {
			document.getElementById("topBtn").style.display = "none";
		}
	}

	$('[data-toggle="top"]').on('click', function () {
		document.body.scrollTop = 0; // For Safari
		document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
	});

	// fake form submission
	$(".fakeForm").submit(function (e) {
		e.preventDefault();
		$(".fakeForm")[0].reset();
		$(".alert").fadeIn(350, function () {
			setTimeout(() => {
				$(".alert").fadeOut(350);
			}, 2000);
		});
	});
});