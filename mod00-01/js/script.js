'use strict'

// typewriter effect
var i = 0;
var txt1 = "I am a freelance full-stack web developer from the Philippines, based in Davao City. Passionate about expanding my knowledge of web development and creating amazing websites. Feel free to take a look at my ";
var speed = 50;
var txt2 = "portfolio! "

// elements for typewriter
var element1 = document.getElementById("landingTxt");
var element2 = document.getElementById("landingTxtPort");

function typeWriter(txt, element, callback) {
    if (i < txt.length) {
        element.innerHTML += txt.charAt(i);
        i++;
        if (i == txt.length) {
            if (callback) callback();
            return;
        }
        setTimeout(function () {
            typeWriter(txt, element, callback)
        }, speed);
    }
}

// start page
var page = 0;

// contentHeight to fill viewport
var contentHeight = 0;

var bottom = 0;
var pageTop = 0;

var scrollDetect = 0;

function pageDown() {
    if (page > 1 && pageTop == 1) {
        scrollDetect = 1;
        $(".sr-only").remove();
        $(".nav-item").removeClass("active");
        if (page == 3) {
            $("footer").fadeOut();
        }
        if (page == 1 || page == 2) {
            $(".page" + page).find(".leadingLine").hide();
        }
        $(".page" + page).css("min-height", "0px");
        $(".page" + page).slideUp(400, "linear");
        page--;
        if (page == 1) {
            window.history.pushState("", "Web Developer Portfolio - Andro Marces", "index.html#landing");
            $(".landingLink").append("<span class='sr-only'>(current)</span>");
            $(".landingLink").parent().addClass("active");
        } else if (page == 2) {
            window.history.pushState("", "Web Developer Portfolio - Andro Marces", "index.html#portfolio");
            $(".portfolioLink").append("<span class='sr-only'>(current)</span>");
            $(".portfolioLink").parent().addClass("active");
        }
        $(".page" + page).css({
            height: 0,
            minHeight: 0,
            position: "absolute",
            bottom: 0,
            overflow: "hidden",
            display: "block"
        });
        contentHeight = (window.innerHeight - ($(".landing").outerHeight(true) - $(".landing").innerHeight()));
        $(".page" + page).animate({
            height: contentHeight + "px"
        }, 400, "linear", function () {
            if (page == 1) {
                i = 0;
                typeWriter(txt1, element1, function () {
                    i = 0;
                    typeWriter(txt2, element2);
                });
                $(".landingCard > .pages").css("min-height", contentHeight + "px");
            }
            if ($(".breakpointDivLg").css("display") == "block") {
                if (page == 1 || page == 2) {
                    $(".page" + page).find(".leadingLine").show();
                }
            }
            $(this).css({
                height: "",
                minHeight: contentHeight + "px",
                position: "",
                bottom: "",
                marginTop: "",
                overflow: "",
            });
            scrollDetect = 0;
            bottom = 0;
            pageTop = 0;
            if ($(window).scrollTop() == 0) {
                pageTop = 1;
            }
            setTimeout(() => {
                if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                    bottom = 1;
                }
            }, 500);
        });
    }
}

function pageUp() {
    if (page < 3 && bottom == 1) {
        scrollDetect = 1;
        $(".sr-only").remove();
        $(".nav-item").removeClass("active");
        if (page == 1 || page == 2) {
            $(".page" + page).find(".leadingLine").hide();
        }
        $(".page" + page).css("min-height", "0px");
        $(".page" + page).slideUp(400, "linear", function () {
            if (page == 2) {
                i = 9999;
                $("#landingTxt").empty();
                $("#landingTxtPort").empty();
            }
        });
        page++;
        if (page == 2) {
            window.history.pushState("", "Web Developer Portfolio - Andro Marces", "index.html#portfolio");
            $(".portfolioLink").append("<span class='sr-only'>(current)</span>");
            $(".portfolioLink").parent().addClass("active");
        } else if (page == 3) {
            window.history.pushState("", "Web Developer Portfolio - Andro Marces", "index.html#contact");
            $(".contactLink").append("<span class='sr-only'>(current)</span>");
            $(".contactLink").parent().addClass("active");
        }
        $(".page" + page).css({
            height: 0,
            minHeight: 0,
            position: "absolute",
            bottom: 0,
            overflow: "hidden",
            display: "block"
        });
        if (page == 3) {
            contentHeight = (window.innerHeight - ($("footer").outerHeight(true) + ($(".contact").outerHeight(true) - $(".contact").innerHeight())));
        }
        $(".page" + page).animate({
            marginTop: 0,
            height: contentHeight + "px"
        }, 400, "linear", function () {
            if (page == 3) {
                $("footer").fadeIn();
            }
            if ($(".breakpointDivLg").css("display") == "block") {
                if (page == 1 || page == 2) {
                    $(".page" + page).find(".leadingLine").show();
                }
            }
            $(this).css({
                height: "",
                minHeight: contentHeight + "px",
                position: "",
                bottom: "",
                marginTop: "",
                overflow: ""
            });
            scrollDetect = 0;
            bottom = 0;
            pageTop = 0;
            if ($(window).scrollTop() == 0) {
                pageTop = 1;
            }
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                bottom = 1;
            }
        });
    }
}

// fadeout page loader and load page depending on hash
$(window).on("load", function () {
    $(".loader").fadeOut(function () {
        // fadein page
        $(".navbar").fadeIn(400);
        $(".sr-only").remove();
        $(".nav-item").removeClass("active");
        if (window.location.href.toLowerCase().indexOf("#portfolio") >= 0) {
            page = 2;
            window.history.replaceState("", "Web Developer Portfolio - Andro Marces", "index.html#portfolio");
            $(".portfolioLink").append("<span class='sr-only'>(current)</span>");
            $(".portfolioLink").parent().addClass("active");
        } else if (window.location.href.toLowerCase().indexOf("#contact") >= 0) {
            page = 3;
            window.history.replaceState("", "Web Developer Portfolio - Andro Marces", "index.html#contact");
            $(".contactLink").append("<span class='sr-only'>(current)</span>");
            $(".contactLink").parent().addClass("active");
        } else {
            page = 1;
            window.history.replaceState("", "Web Developer Portfolio - Andro Marces", "index.html#landing");
            $(".landingLink").append("<span class='sr-only'>(current)</span>");
            $(".landingLink").parent().addClass("active");
        }
        if (page == 3) {
            contentHeight = (window.innerHeight - ($("footer").outerHeight(true) + ($(".contact").outerHeight(true) - $(".contact").innerHeight())));
        }
        $(".page" + page).css("min-height", contentHeight + "px");
        $(".page" + page).fadeIn(400, function () {
            if (page == 1) {
                setTimeout(() => {
                    typeWriter(txt1, element1, function () {
                        i = 0;
                        typeWriter(txt2, element2);
                    });
                }, 300);
                $(".landingCard > .pages").css("min-height", contentHeight + "px");
            }
            if (page == 3) {
                $("footer").fadeIn();
            }
            if ($(".breakpointDivLg").css("display") == "block") {
                if (page == 1 || page == 2) {
                    $(".page" + page).find(".leadingLine").show();
                }
            }
            scrollDetect = 0;
            bottom = 0;
            pageTop = 0;
            if ($(window).scrollTop() == 0) {
                pageTop = 1;
            }
            setTimeout(() => {
                if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                    bottom = 1;
                }
            }, 500);
        });
    });
});

$(function () {

    // contentHeight to fill viewport
    contentHeight = (window.innerHeight - ($(".landing").outerHeight(true) - $(".landing").innerHeight()));

    // on resize, fill whole viewport height
    $(window).resize(function () {
        if (page == 3) {
            contentHeight = (window.innerHeight - ($("footer").outerHeight(true) + ($(".contact").outerHeight(true) - $(".contact").innerHeight())));
        } else {
            contentHeight = (window.innerHeight - ($(".landing").outerHeight(true) - $(".landing").innerHeight()));
        }
        $(".pages").css("min-height", contentHeight + "px");
    });

    // animated hamburger icon
    var hamburgerBusy = 0;
    $(".animated-icon1").click(function () {
        hamburgerBusy = 1;
        $(".navbar").css("pointer-events", "none");
        $(this).toggleClass("open");
        if ($(".navbar").css("width") !== "45px") {
            $(this).css("left", "-1px");
            $(".navbar-toggler").css("margin-left", "-8px");
            $(".navbar").animate({
                "width": "45px",
                "border-radius": "50%"
            }, 400, function () {
                hamburgerBusy = 0;
                $(".navbar").css("pointer-events", "");
            });
        } else {
            $(this).css("left", "5px");
            $(".navbar-toggler").css("margin-left", "40px");
            $(".navbar").animate({
                "width": "105px",
                "border-radius": "0.25rem"
            }, 400, function () {
                hamburgerBusy = 0;
                $(".navbar").css("pointer-events", "");
            });
        }
    });

    // close hamburger menu when clicking outside of it
    $(document).click(function () {
        if (hamburgerBusy == 0) {
            if (!$(event.target).closest($(".navbar")).length) {
                if ($(".navbar").css("width") !== "45px") {
                    $(".animated-icon1").toggleClass("open");
                    $(".animated-icon1").css("left", "-1px");
                    $(".navbar-toggler").css("margin-left", "-8px");
                    $(".navbar-toggler").addClass("collapsed");
                    $(".navbar-toggler").attr("aria-expanded", false);
                    $(".navbar-collapse").removeClass("show");
                    $(".navbar").animate({
                        "width": "45px",
                        "border-radius": "50%"
                    }, 400);
                }
            }
        }
    });

    // close hamburger menu after clicking on nav-link
    $(".nav-link").click(function () {
        $(".animated-icon1").toggleClass("open");
        $(".animated-icon1").css("left", "-1px");
        $(".navbar-toggler").css("margin-left", "-8px");
        $(".navbar-toggler").addClass("collapsed");
        $(".navbar-toggler").attr("aria-expanded", false);
        $(".navbar-collapse").removeClass("show");
        $(".navbar").animate({
            "width": "45px",
            "border-radius": "50%"
        }, 400);
    });

    // detect if user has scrolled to the bottom or top
    $(window).bind("mousewheel DOMMouseScroll", function (event) {
        var origY = $(window).scrollTop();
        if (event.originalEvent.wheelDelta > 0 || event.originalEvent.detail < 0) {
            bottom = 0;
            setTimeout(() => {
                var newY = $(window).scrollTop();
                if (newY == origY) {
                    pageTop = 1;
                } else {
                    pageTop = 0;
                }
            }, 50);
        } else {
            pageTop = 0;
            setTimeout(() => {
                var newY = $(window).scrollTop();
                if (newY == origY) {
                    bottom = 1;
                } else {
                    bottom = 0;
                }
            }, 50);
        }
    });

    // detect mousescroll and change page
    $(window).bind("mousewheel DOMMouseScroll", function (event) {
        if (scrollDetect == 0 && page > 0 && page < 4) {
            if (event.originalEvent.wheelDelta > 0 || event.originalEvent.detail < 0) {
                pageDown();
            } else {
                pageUp();
            }
        }
    });

    // change page on hash change
    window.onhashchange = function () {
        $(".sr-only").remove();
        $(".nav-item").removeClass("active");
        if (page == 3) {
            $("footer").fadeOut();
        }
        if (page == 1 || 2) {
            $(".page" + page).find(".leadingLine").hide();
        }
        $(".page" + page).css("min-height", "0px");
        $(".page" + page).slideUp(400, "linear", function () {
            if (page == 2) {
                i = 9999;
                $("#landingTxt").empty();
                $("#landingTxtPort").empty();
            }
        });
        if (window.location.href.toLowerCase().indexOf("#portfolio") >= 0) {
            page = 2;
            $(".portfolioLink").append("<span class='sr-only'>(current)</span>");
            $(".portfolioLink").parent().addClass("active");
            if (window.location.href.toLowerCase().indexOf("#portfolio-purrfectcafe") >= 0) {
                page = 4;
                $(".sr-only").remove();
                $(".nav-item").removeClass("active");
                $(".portfolio1").slideDown();
                return;
            } else if (window.location.href.toLowerCase().indexOf("#portfolio-pinoyware") >= 0) {
                page = 5;
                $(".sr-only").remove();
                $(".nav-item").removeClass("active");
                $(".portfolio2").slideDown();
                return;
            } else if (window.location.href.toLowerCase().indexOf("#portfolio-eventbook") >= 0) {
                page = 6;
                $(".sr-only").remove();
                $(".nav-item").removeClass("active");
                $(".portfolio3").slideDown();
                return;
            }
        } else if (window.location.href.toLowerCase().indexOf("#contact") >= 0) {
            page = 3;
            $(".contactLink").append("<span class='sr-only'>(current)</span>");
            $(".contactLink").parent().addClass("active");
            window.history.replaceState("", "Web Developer Portfolio - Andro Marces", "index.html#contact");
        } else {
            page = 1;
            $(".landingLink").append("<span class='sr-only'>(current)</span>");
            $(".landingLink").parent().addClass("active");
            window.history.replaceState("", "Web Developer Portfolio - Andro Marces", "index.html#landing");
        }
        $(".page" + page).css({
            height: 0,
            minHeight: 0,
            position: "absolute",
            bottom: 0,
            overflow: "hidden",
            display: "block"
        });
        if (page == 3) {
            contentHeight = (window.innerHeight - ($("footer").outerHeight(true) + ($(".contact").outerHeight(true) - $(".contact").innerHeight())));
        } else {
            contentHeight = (window.innerHeight - ($(".landing").outerHeight(true) - $(".landing").innerHeight()));
        }
        $(".page" + page).animate({
            height: contentHeight + "px"
        }, 400, "linear", function () {
            if (page == 1) {
                i = 0;
                typeWriter(txt1, element1, function () {
                    i = 0;
                    typeWriter(txt2, element2);
                });
                $(".landingCard > .pages").css("min-height", contentHeight + "px");
            }
            if (page == 3) {
                $("footer").fadeIn();
            }
            if ($(".breakpointDivLg").css("display") == "block") {
                if (page == 1 || page == 2) {
                    $(".page" + page).find(".leadingLine").show();
                }
            }
            $(this).css({
                height: "",
                minHeight: contentHeight + "px",
                position: "",
                bottom: "",
                marginTop: "",
                overflow: "",
            });
            scrollDetect = 0;
            bottom = 0;
            pageTop = 0;
            if ($(window).scrollTop() == 0) {
                pageTop = 1;
            }
            setTimeout(() => {
                if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                    bottom = 1;
                }
            }, 500);
        });
    }

    // scroll to top on clicking any link inside the portfolio page
    $(".portfolio").on("click", "a", function () {
        $("html").animate({
            scrollTop: 0
        }, 1000);
    });

});