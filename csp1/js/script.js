'use strict'

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
		scrollFunction()
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

	// swipe left or right to change carousel
	$(".carousel").on("touchstart", function (event) {
		var xClick = event.originalEvent.touches[0].pageX;
		$(this).one("touchmove", function (event) {
			var xMove = event.originalEvent.touches[0].pageX;
			if (Math.floor(xClick - xMove) > 5) {
				$(this).carousel('next');
			} else if (Math.floor(xClick - xMove) < -5) {
				$(this).carousel('prev');
			}
		});
		$(".carousel").on("touchend", function () {
			$(this).off("touchmove");
		});
	});
});