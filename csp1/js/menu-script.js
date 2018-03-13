'use strict'

// reload page on popstate event
window.addEventListener("popstate", function (e) {
	window.location.reload();
});

$(function () {

	// check if window width is < 768px, then read the url and assign .active to the correct nav-link
	if ($("#menuTabContent").css("display") == "block") {
		if (window.location.href.toLowerCase().indexOf("#coffee") >= 0) {
			window.history.replaceState("", "Purrfect Coffee - Menu", "menu.html#coffee");
			$("#coffee-tab").addClass("active");
			$("#coffee-tab").attr("aria-selected", true);
			$("#coffee").addClass("active show");
		} else if (window.location.href.toLowerCase().indexOf("#desserts") >= 0) {
			window.history.replaceState("", "Purrfect Coffee - Menu", "menu.html#desserts");
			$("#desserts-tab").addClass("active");
			$("#desserts-tab").attr("aria-selected", true);
			$("#desserts").addClass("active show");
		} else {
			window.history.replaceState("", "Purrfect Coffee - Menu", "menu.html#pastries");
			$("#pastries-tab").addClass("active");
			$("#pastries-tab").attr("aria-selected", true);
			$("#pastries").addClass("active show");
		}
	}

	// on window resize, check if window width is < 768px, then read the url and assign .active to the correct nav-link
	$(window).resize(function () {
		if ($("#menuTabContent").css("display") == "block") {
			if (window.location.href.toLowerCase().indexOf("#coffee") >= 0) {
				window.history.replaceState("", "Purrfect Coffee - Menu", "menu.html#coffee");
				$("#coffee-tab").addClass("active");
				$("#coffee").addClass("active show");
			} else if (window.location.href.toLowerCase().indexOf("#desserts") >= 0) {
				window.history.replaceState("", "Purrfect Coffee - Menu", "menu.html#desserts");
				$("#desserts-tab").addClass("active");
				$("#desserts").addClass("active show");
			} else {
				window.history.replaceState("", "Purrfect Coffee - Menu", "menu.html#pastries");
				$("#pastries-tab").addClass("active");
				$("#pastries").addClass("active show");
			}
		}
	});

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

	// change url on changing tabs
	$("#pastries-tab").click(function () {
		window.history.pushState("", "Purrfect Coffee - Menu", "menu.html#pastries");
	});

	$("#coffee-tab").click(function () {
		window.history.pushState("", "Purrfect Coffee - Menu", "menu.html#coffee");
	});

	$("#desserts-tab").click(function () {
		window.history.pushState("", "Purrfect Coffee - Menu", "menu.html#desserts");
	});

});