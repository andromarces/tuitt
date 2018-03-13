"use strict" /* strict mode enabled */

// function to close menus when user clicks outside of their container element
function ddbtnclose(event, element, menu, btn) {
    if (!$(event.target).closest(element).length) {
        if ($(menu).css("display") !== "none" && $(menu).has("svg.fa-cog").length == 0) {
            $(menu).fadeOut(350, function () {
                $(btn).attr("aria-expanded", "false");
                $(menu).removeClass("show");
                $(element).removeClass("show");
            });
        }
    }
}

// toggleFade function
function toggleFade(element, menu, btn) {
    if ($(menu).css("display") !== "none" && $(menu).has("svg.fa-cog").length == 0) {
        $(menu).fadeOut(350, function () {
            $(btn).attr("aria-expanded", "false");
            $(menu).removeClass("show");
            $(element).removeClass("show");
        });
    } else {
        $(menu).fadeIn(350, function () {
            $(btn).attr("aria-expanded", "true");
            $(menu).addClass("show");
            $(element).addClass("show");
        });
    }
}

$(function () { /* document ready function */

    // enable popovers
    $('[data-toggle="popover"]').popover();

    // enable tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // stick footer to the bottom of viewport when content is too short
    var contentHeight = (window.innerHeight - ($("#navBar").outerHeight(true) + $(".nav").outerHeight(true) + $("footer").outerHeight(true)) - ($(".container").innerHeight() - $(".container").outerHeight(true)));
    if ($(".breakpointDiv").css("display") == "none") {
        $(".container").css("min-height", (contentHeight - 14) + "px");
    } else {
        $(".container").css("min-height", contentHeight + "px");
    }

    // on resize, stick footer to the bottom of viewport when content is too short
    $(window).resize(function () {
        contentHeight = (window.innerHeight - ($("#navBar").outerHeight(true) + $(".nav").outerHeight(true) + $("footer").outerHeight(true)) - ($(".container").innerHeight() - $(".container").outerHeight(true)));
        $(".container").css("min-height", (contentHeight - 14) + "px");
    });

    // show or hide .searchForm after page load depending on visibility of #searchtgl
    if ($("#searchtgl").css("display") == "inline-block") {
        $(".searchForm").css("display", "none");
    } else {
        $(".searchForm").css("display", "flex");
    }

    // show or hide .searchForm on browser resize depending on visibility of #searchtgl
    $(window).resize(function () {
        if ($("#searchtgl").css("display") == "inline-block") {
            $(".searchForm").css("display", "none");
        } else {
            $(".searchForm").css("display", "flex");
        }
    });

    // open .ddmenu when mouse hovers on #navbarDropdownMenuLink
    $("#navbarDropdownMenuLink").mouseenter(function () {
        if ($(".ddmenu").css("display") !== "block" && $(".breakpointDiv").css("display") !== "none") {
            $(".ddmenu").fadeIn(350, function () {
                $("#navbarDropdownMenuLink").attr("aria-expanded", "true");
                $(".ddmenu").addClass("show");
                $("#ddp").addClass("show");
            });
        }
    });

    // close .ddmenu when mouse leaves #navBar
    $("#navBar").mouseleave(function () {
        if ($(".ddmenu").css("display") == "block" && $(".breakpointDiv").css("display") !== "none") {
            $(".ddmenu").fadeOut(350, function () {
                $("#navbarDropdownMenuLink").attr("aria-expanded", "false");
                $(".ddmenu").removeClass("show");
                $("#ddp").removeClass("show");
            });
        }
    });

    // toggle to close or open .ddmenu
    $("#navbarDropdownMenuLink").click(function () {
        toggleFade(document.getElementById("ddp"), document.getElementsByClassName("ddmenu"), document.getElementById("navbarDropdownMenuLink"));
    });

    // toggle to close or open .ddsu2
    $("#dropdownMenuButton2").click(function () {
        toggleFade(document.getElementById("ddsu2"), document.getElementsByClassName("ddsu2"), document.getElementById("dropdownMenuButton2"));
    });

    // toggle to close or open .ddsu1 and close other menus if they are open
    $("#dropdownMenuButton1").click(function () {
        toggleFade(document.getElementById("ddsu1"), document.getElementsByClassName("ddsu1"), document.getElementById("dropdownMenuButton1"));
        if ($("div.navbar-collapse").css("left") == "1px") {
            $("div.navbar-collapse").animate({
                left: -210
            }, 350, function () {
                $("button.navbar-toggler").attr("aria-expanded", "false");
            });
        }
        if ($(".searchForm").css("display") == "flex" && $("#searchtgl").css("display") == "inline-block") {
            $(".searchForm").fadeOut(350);
        }
        if ($(".ddmenu").css("display") == "block") {
            $(".ddmenu").fadeOut(350, function () {
                $("#navbarDropdownMenuLink").attr("aria-expanded", "false");
                $(".ddmenu").removeClass("show");
                $("#ddp").removeClass("show");
            });
        }
        if ($(".ddsu2").css("display") == "block") {
            $(".ddsu2").fadeOut(350, function () {
                $("#dropdownMenuButton2").attr("aria-expanded", "false");
                $(".ddsu2").removeClass("show");
                $("#ddsu2").removeClass("show");
            });
        }
    });

    // toggle to close or open .searchForm
    $("#searchtgl").click(function () {
        $(".searchForm").fadeToggle(350);
    });

    // toggle to close or open div.navbar-collapse
    $("button.navbar-toggler").click(function () {
        if ($("div.navbar-collapse").css("left") == "-210px") {
            $("div.navbar-collapse").animate({
                left: 1
            }, 350, function () {
                $("button.navbar-toggler").attr("aria-expanded", "true");
            });
        } else {
            $("div.navbar-collapse").animate({
                left: -210
            }, 350, function () {
                $("button.navbar-toggler").attr("aria-expanded", "false");
            });
        }
    });

    // close .searchForm when user clicks outside of .searchWrapper
    $(document).click(function () {
        if (!$(event.target).closest(".searchWrapper").length) {
            if ($(".searchForm").css("display") !== "none" && $("#searchtgl").css("display") == "inline-block") {
                $(".searchForm").fadeOut(350);
            }
        }
    });

    // close div.navbar-collapse when clicking outside #navbarNavDropdown
    $(document).click(function () {
        if (!$(event.target).closest($("#navbarNavDropdown")).length) {
            if ($("div.navbar-collapse").css("left") == "1px") {
                $("div.navbar-collapse").animate({
                    left: -210
                }, 350, function () {
                    $("button.navbar-toggler").attr("aria-expanded", "false");
                });
            }
        }
    });

    // call ddbtnclose to close menus when user clicks outside of their container element
    $(document).click(function () {
        ddbtnclose(event, document.getElementById("ddp"), document.getElementsByClassName("ddmenu"), document.getElementById("navbarDropdownMenuLink"));
        ddbtnclose(event, document.getElementById("ddsu1"), document.getElementsByClassName("ddsu1"), document.getElementById("dropdownMenuButton1"));
        ddbtnclose(event, document.getElementById("ddsu2"), document.getElementsByClassName("ddsu2"), document.getElementById("dropdownMenuButton2"));
    });

    // login form 2
    $(".ddsu2").on("submit", ".login2", function (e) {
        e.preventDefault();
        var username = $("#DropdownFormUsername2").val();
        var password = $("#DropdownFormPassword2").val();
        $(".ddsu2").fadeOut(350, function () {
            $(".ddsu2").addClass("text-center");
            $(".ddsu2").html("<i class='fas fa-cog fa-spin fa-5x'></i><br><span class='font-weight-bold'>Please wait while you are signed-in.</span>");
            $(".ddsu2").fadeIn(350);
        });
        $.ajax({
            method: "post",
            url: "login_logout_endpoint.php",
            data: {
                username: username,
                password: password,
                login: true
            },
            success: function (data) {
                if (data == 1) {
                    if (window.location.pathname.toLowerCase().indexOf("/products.php") >= 0) {
                        window.location.reload();
                    } else {
                        window.location.href = "products.php?";
                    }
                } else if (data == 2) {
                    window.location.href = "admin.php";
                } else {
                    $(".modal-content").html("<i class='far fa-frown align-self-center fa-5x'></i><span class='modal-text font-weight-bold'>Oh no! Login failed.</span><br><button type='button' class='btn btn-warning align-self-center col-4' data-dismiss='modal'>Dismiss</button>");
                    $(".register-modal-lg").modal("show");
                    $(".ddsu1").fadeOut(350, function () {
                        $(".ddsu1").removeClass("text-center");
                        $(".ddsu1").html("<form class='px-4 py-3 login1'><div class='form-group'><label for='DropdownFormUsername1'>Username</label><input type='text' class='form-control' id='DropdownFormUsername1' placeholder='Username' autocomplete='username'></div><div class='form-group'><label for='DropdownFormPassword1'>Password</label><input type='password' class='form-control' id='DropdownFormPassword1' placeholder='Password' autocomplete='current-password'></div><button type='submit' class='btn btn-success'>Login</button></form><div class='dropdown-divider'></div><a class='dropdown-item loginfooter' href='register.php'>New around here? Sign up</a><a class='dropdown-item loginfooter' href='#'>Forgot password?</a>");
                        $(".ddsu1").fadeIn(350);
                    });
                    if (data.length > 1) {
                        $(".modal-content").fadeOut(350, function () {
                            $(".modal-content").html("<i class='far fa-frown align-self-center fa-5x'></i><span class='modal-text font-weight-bold'>Oh no! An error occurred! Please send us a message or try again.</span><br><button type='button' class='btn btn-warning align-self-center col-4' data-dismiss='modal'>Dismiss</button>");
                            $(".modal-content").fadeIn(350);
                        });
                        $.ajax({
                            method: "post",
                            url: "login_logout_endpoint.php",
                            data: {
                                error: true,
                                data: ".login1, submit:" + data
                            }
                        });
                    }
                }
            },
            error: function (XHR, textStatus, errorThrown) {
                $.ajax({
                    method: "post",
                    url: "login_logout_endpoint.php",
                    data: {
                        error: true,
                        data: ".login2, submit:\r\n" + XHR + "\r\n" + textStatus + "\r\n" + errorThrown
                    }
                });
                $(".modal-content").html("<i class='far fa-frown align-self-center fa-5x'></i><span class='modal-text font-weight-bold'>Oh no! An error occurred! Please send us a message or try again.</span><br><button type='button' class='btn btn-warning align-self-center col-4' data-dismiss='modal'>Dismiss</button>");
                $(".register-modal-lg").modal("show");
            }
        });
    });

    // login form 1
    $(".ddsu1").on("submit", ".login1", function (e) {
        e.preventDefault();
        var username = $("#DropdownFormUsername1").val();
        var password = $("#DropdownFormPassword1").val();
        $(".ddsu1").fadeOut(350, function () {
            $(".ddsu1").addClass("text-center");
            $(".ddsu1").html("<i class='fas fa-cog fa-spin fa-5x'></i><br><span class='font-weight-bold'>Please wait while you are signed-in.</span>");
            $(".ddsu1").fadeIn(350);
        });
        $.ajax({
            method: "post",
            url: "login_logout_endpoint.php",
            data: {
                username: username,
                password: password,
                login: true
            },
            success: function (data) {
                if (data == 1) {
                    if (window.location.pathname.toLowerCase().indexOf("/products.php") >= 0) {
                        window.location.reload();
                    } else {
                        window.location.href = "products.php?";
                    }
                } else if (data == 2) {
                    window.location.href = "admin.php";
                } else {
                    $(".modal-content").html("<i class='far fa-frown align-self-center fa-5x'></i><span class='modal-text font-weight-bold'>Oh no! Login failed.</span><br><button type='button' class='btn btn-warning align-self-center col-4' data-dismiss='modal'>Dismiss</button>");
                    $(".register-modal-lg").modal("show");
                    $(".ddsu1").fadeOut(350, function () {
                        $(".ddsu1").removeClass("text-center");
                        $(".ddsu1").html("<form class='px-4 py-3 login1'><div class='form-group'><label for='DropdownFormUsername1'>Username</label><input type='text' class='form-control' id='DropdownFormUsername1' placeholder='Username' autocomplete='username'></div><div class='form-group'><label for='DropdownFormPassword1'>Password</label><input type='password' class='form-control' id='DropdownFormPassword1' placeholder='Password' autocomplete='current-password'></div><button type='submit' class='btn btn-success'>Login</button></form><div class='dropdown-divider'></div><a class='dropdown-item loginfooter' href='register.php'>New around here? Sign up</a><a class='dropdown-item loginfooter' href='#'>Forgot password?</a>");
                        $(".ddsu1").fadeIn(350);
                    });
                    if (data.length > 1) {
                        $(".modal-content").fadeOut(350, function () {
                            $(".modal-content").html("<i class='far fa-frown align-self-center fa-5x'></i><span class='modal-text font-weight-bold'>Oh no! An error occurred! Please send us a message or try again.</span><br><button type='button' class='btn btn-warning align-self-center col-4' data-dismiss='modal'>Dismiss</button>");
                            $(".modal-content").fadeIn(350);
                        });
                        $.ajax({
                            method: "post",
                            url: "login_logout_endpoint.php",
                            data: {
                                error: true,
                                data: ".login1, submit:" + data
                            }
                        });
                    }
                }
            },
            error: function (XHR, textStatus, errorThrown) {
                $.ajax({
                    method: "post",
                    url: "login_logout_endpoint.php",
                    data: {
                        error: true,
                        data: ".login1, submit:\r\n" + XHR + "\r\n" + textStatus + "\r\n" + errorThrown
                    }
                });
                $(".modal-content").html("<i class='far fa-frown align-self-center fa-5x'></i><span class='modal-text font-weight-bold'>Oh no! An error occurred! Please send us a message or try again.</span><br><button type='button' class='btn btn-warning align-self-center col-4' data-dismiss='modal'>Dismiss</button>");
                $(".register-modal-lg").modal("show");
            }
        });
    });

    // logout
    $(".logOut").click(function () {
        $.ajax({
            method: "get",
            url: "login_logout_endpoint.php",
            data: {
                logout: true
            },
            success: function (data) {
                if (window.location.pathname.toLowerCase().indexOf("index.php") >= 0) {
                    window.location.reload();
                } else {
                    window.location.href = "index.php";
                }
            }
        });
    });

    // enter key dismisses small modals
    $(document).keypress(function (e) {
        if (e.which == 13 && $("button[data-dismiss=modal]").text() == "Dismiss") {
            $(".register-modal-lg").modal("hide");
            $(".modal").modal("hide");
        }
    });

    // search function
    $(".searchForm").on("submit", function (e) {
        e.preventDefault();
        search = $(".searchForm input").val();
        if (window.location.pathname.toLowerCase().indexOf("/products.php") >= 0) {
            $("#productParent").fadeOut(350, function () {
                $("#productParent").addClass("text-center");
                $("#productParent").html("<i class='fas fa-cog fa-spin fa-10x m-5'></i>");
                $("#productParent").fadeIn(350);
            });
            $("#brandForm").fadeOut(350, function () {
                $("#brandForm").addClass("text-center");
                $("#brandForm").html("<i class='fas fa-cog fa-spin fa-10x'></i>");
                $("#brandForm").fadeIn(350);
            });
            $("#maxpinput").val("");
            $("#minpinput").attr("max", "");
            $("#minpinput").val("");
            $("#maxpinput").attr("min", 1);
            sort = 0;
            cat = "";
            minp = "";
            maxp = "";
            page = 1;
            brand = "";
            window.history.pushState("", "Pinoyware - Products", "products.php?sort=0&cat=0&brand=&minp=0&maxp=&search=" + search + "&page=1");
            $("#filterParent").find("*").prop("disabled", true);
            $("#hiddenProduct").load(" #productContent", function (data) {
                $("#productParent").fadeOut(350, function () {
                    $("#productParent").removeClass("text-center");
                    $("#productParent").html($("#hiddenProduct").html());
                    $("#hiddenProduct").empty();
                    $("#productParent").fadeIn(350);
                });
            });
            $("#hiddenBrand").load(" #brandContent", function (data) {
                $("#brandForm").fadeOut(350, function () {
                    $("#brandForm").removeClass("text-center");
                    $("#brandForm").html($("#hiddenBrand").html());
                    $("#hiddenBrand").empty();
                    $("#brandForm").fadeIn(350, function () {
                        var filterHeight = $("#filterParent").outerHeight(true);
                        $(".filter").parent().css("min-height", filterHeight + "px");
                        $("#filterParent").find("*").prop("disabled", false);
                        $("#catForm input").prop("checked", false);
                        $("#catCheck0").prop("checked", true);
                        maxpage = ($("#productParent .page-item").length - 2);
                    });
                });
            });
        } else {
            window.location.href = "products.php?sort=0&cat=0&brand=&minp=0&maxp=&search=" + search + "&page=1";
        }
    });

    // show or hide .cartMenu
    $("#cartBtn").click(function () {
        $(".cartMenu").slideToggle(350);
    });

    // hide .cartMenu on clicking outside of it
    $(document).click(function () {
        if (!$(event.target).closest(".cartMenu").length && !$(event.target).closest("#cartBtn").length && !$(event.target).closest(".modal").length && !$(event.target).closest(".popover").length) {
            if ($(".cartMenu").css("display") == "block") {
                $(".cartMenu").slideUp(350);
            }
        }
    });

    // display cart item info
    $(".cartMenu").on("click", ".cart-item-info", function () {
        var index = $(this).data("index");
        var name = $(this).data("name");
        var price = $(this).data("price");
        var img = $(this).data("img");
        var proc = $(this).data("proc");
        if (proc == "") {} else {
            proc = "<span class='d-inline-block mr-3'><span class='font-weight-bold'>Processor:</span> " + proc + ",</span>";
        }
        var screen = $(this).data("screen");
        if (screen == "") {} else {
            screen = "<span class='d-inline-block mr-3'><span class='font-weight-bold'>Screen:</span> " + screen + ",</span>";
        }
        var ram = $(this).data("ram");
        if (ram == "") {} else {
            ram = "<span class='d-inline-block mr-3'><span class='font-weight-bold'>RAM:</span> " + ram + ",</span>";
        }
        var hdd = $(this).data("hdd");
        if (hdd == "") {} else {
            hdd = "<br><span class='d-inline-block mr-3'><span class='font-weight-bold'>Storage:</span> " + hdd + ",</span>";
        }
        var gpu = $(this).data("gpu");
        if (gpu == "") {} else {
            gpu = "<span class='d-inline-block mr-3'><span class='font-weight-bold'>GPU:</span> " + gpu + ",</span>";
        }
        var descript = $(this).siblings(".prodDescript").html();
        descript = "<br><br><span class='d-inline-block mr-3'><span class='font-weight-bold'>Description:</span><br>" + descript + "</span>";
        $(".modal-content").html("<div class='card'><img class='card-img-top align-self-center' src='" + img + "' alt='Card image cap'><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button><div class='card-body'><h5 class='card-title prodTitle'>" + name + "</h5><h5 class='card-title prodPrice'>₱ " + price + "</h5><div class='card-text'>" + proc + screen + ram + hdd + gpu + descript + "</div><br><button type='button' class='btn btn-warning' data-dismiss='modal'>Dismiss</button></div></div>");
        $(".modal").modal("show");
    });

    // cart plus button
    $(".cartMenu").on("click", ".cartAdd", function () {
        var qty = ($(this).parent().siblings(".cartQtyForm").find(".cartQty").data("qty") + 1);
        var index = $(this).data("index");
        $(".cartMenu").find("*").prop("disabled", true);
        $.ajax({
            method: "post",
            url: "products_endpoint.php",
            data: {
                index: index,
                qty: qty,
                updatecart: true
            },
            success: function (data) {
                $(".counterWrapper").load(" #counterContent");
                $(".cartMenu").load(" #cartContent");
            }
        });
    });

    // cart minus button
    $(".cartMenu").on("click", ".cartMinus", function () {
        var qty = ($(this).parent().siblings(".cartQtyForm").find(".cartQty").data("qty") - 1);
        var index = $(this).data("index");
        $(".cartMenu").find("*").prop("disabled", true);
        $.ajax({
            method: "post",
            url: "products_endpoint.php",
            data: {
                index: index,
                qty: qty,
                updatecart: true
            },
            success: function (data) {
                $(".counterWrapper").load(" #counterContent");
                $(".cartMenu").load(" #cartContent");
            }
        });
    });

    // cart delete button
    $(".cartMenu").on("click", ".cartDel", function () {
        $(this).popover("show");
    });

    // confirm delete from cart
    $("body").on("click", ".confDel", function () {
        var index = $(this).data("index");
        $(".cartMenu").find("*").prop("disabled", true);
        $.ajax({
            method: "post",
            url: "products_endpoint.php",
            data: {
                index: index,
                cartdel: true
            },
            success: function (data) {
                $(".counterWrapper").load(" #counterContent");
                $(".cartMenu").load(" #cartContent");
            }
        });
    });

    // cart input update form
    $(".cartMenu").on("submit", ".cartQtyForm", function (e) {
        e.preventDefault();
    });

    // cart popover status
    var popover = 0; /* not shown */

    // when popover is hidden
    $("body").on("hidden.bs.popover", function () {
        popover = 0;
    });

    // cart input update
    $(".cartMenu").on("input", ".cartQty", function () {
        var index = $(this).data("index");
        if (popover == 0) {
            popover = 1;
            $(this).parent().popover("show");
        }
        if ($(this).val() > 100 || $(this).val() < 0) {
            $("body").find(".popover-body").html("<span class='font-weight-bold text-danger'><i class='fas fa-exclamation-triangle'></i>Number must be between 0 - 100.</span>");
        } else if ($(this).val() == 0 || $(this).val() == "") {
            $("body").find(".popover-body").html("<span class='font-weight-bold text-danger pl-2'><i class='fas fa-exclamation-triangle'></i>Delete?</span><br><button data-index='" + index + "' class='btn-danger confDel'>Yes</button><button class='btn-success'>No</button>");
        } else {
            $("body").find(".popover-body").html("<span class='font-weight-bold text-dark'><i class='fas fa-exclamation-triangle'></i>Update?</span><br><button data-index='" + index + "' class='btn-success confUp'>Yes</button><button class='btn-warning'>No</button>");
        }
    });

    // cart input focusout
    $(".cartMenu").on("focusout", ".cartQty", function () {
        setTimeout(() => {
            $(this).val($(this).data("qty"));
        }, 500);
    });

    // cart qty update
    $("body").on("click", ".confUp", function () {
        var index = $(this).data("index");
        var qty = $("#cartQtyInput" + index).val();
        $("*").popover('hide');
        popover = 0;
        $(".cartMenu").find("*").prop("disabled", true);
        $.ajax({
            method: "post",
            url: "products_endpoint.php",
            data: {
                index: index,
                qty: qty,
                updatecart: true
            },
            success: function (data) {
                $(".counterWrapper").load(" #counterContent");
                $(".cartMenu").load(" #cartContent");
            },
            error: function (data) {
                $(".cartMenu").find("*").prop("disabled", false);
            }
        });
    });

    // checkout button
    $(".cartMenu").on("click", "#chkOut", function () {
        window.location.href = "checkout.php";
    });

    var passwords = 0; /* 0 = passwords invalid, 1 = passwords OK */
    var username = 0; /* 0 = username invalid, 1 = username valid */
    var email = 0; /* 0 = email invalid, 1 email valid */
    var edit = 0; /* 1 = editing */
    var userId = ""; /* user id for editing */
    var userEmail = ""; /* user email for editing */
    var editName = ""; /* username for editing */

    // edit profile
    $(".editProfile").click(function (e) {
        e.preventDefault();
        edit = 1;
        passwords = 1;
        username = 1;
        email = 1;
        userId = $(".editProfile").data("index");
        userEmail = $(".editProfile").data("email");
        editName = $(".editProfile").data("name");
        $.ajax({
            method: "get",
            url: "admin_endpoint.php",
            data: {
                user: userId,
                edituser: 1
            },
            success: function (data) {
                $(".modal-content").html(data);
                if ($(".modal-content .region").children().length > 0) {
                    $(".modal-content .region").css("display", "block");
                }
                if ($(".modal-content .province").children().length > 0) {
                    $(".modal-content .province").css("display", "block");
                    $(".modal-content .city").css("display", "block");
                }
                $(".modal").modal("show");
            },
            error: function (XHR, textStatus, errorThrown) {
                $.ajax({
                    method: "post",
                    url: "login_logout_endpoint.php",
                    data: {
                        error: true,
                        data: "#regForm, submit:\r\n" + XHR + "\r\n" + textStatus + "\r\n" + errorThrown
                    }
                });
                $(".modal-content").fadeOut(350, function () {
                    $(".modal-content").html("<i class='far fa-frown align-self-center fa-5x'></i><span class='modal-text font-weight-bold'>Oh no! An error occurred! Please send us a message or try again.</span><br><button type='button' class='btn btn-warning align-self-center col-4' data-dismiss='modal'>Dismiss</button>");
                    $(".modal-content").fadeIn(350);
                });
            }
        });
    });

    // initialize datedropper on modal show
    $(".modal").on("shown.bs.modal", function () {
        $("#birthDayEdit").dateDropper();
        $("#birthDayEdit").prop("readonly", false);
        $("#birthDayEdit").on('keydown paste', function (e) {
            e.preventDefault();
        });
    });

    // check if email already exists in database
    $(".modal-content").on("input", "#registerEmail", function () {
        userEmail = $(this).data("email");
        var mail = $(".modal-content #registerEmail").val();
        if ($(".modal-content #registerEmail").val().length > 0) {
            email = 0;
            $(".modal-content .regBtn").prop("disabled", true);
            if ($(".modal-content .mailCheck").has("svg.fa-cog").length == 0) {
                $(".modal-content .mailCheck").fadeOut(350, function () {
                    $(".modal-content .mailCheck").addClass("font-weight-bold");
                    $(".modal-content .mailCheck").html("<i class='fas fa-cog fa-spin'></i>");
                    $(".modal-content .mailCheck").css("color", "#663");
                    $(".modal-content .mailCheck").fadeIn(350);
                });
            }
            $.ajax({
                method: "get",
                url: "register_endpoint.php",
                data: {
                    userEmail: userEmail,
                    mail: mail,
                    mailcheck: true
                },
                success: function (data) {
                    if (data == 1) {
                        email = 0;
                        $(".modal-content .regBtn").prop("disabled", true);
                        $(".modal-content .mailCheck").fadeOut(350, function () {
                            $(".modal-content .mailCheck").addClass("font-weight-bold");
                            $(".modal-content .mailCheck").html("Email already registered.");
                            $(".modal-content .mailCheck").css("color", "red");
                            $(".modal-content .mailCheck").fadeIn(350);
                        });
                    } else {
                        email = 1;
                        $(".modal-content .mailCheck").fadeOut(350, function () {
                            $(".modal-content .mailCheck").addClass("font-weight-bold");
                            $(".modal-content .mailCheck").html("Email available.");
                            $(".modal-content .mailCheck").css("color", "green");
                            $(".modal-content .mailCheck").fadeIn(350);
                        });
                        if (passwords == 1 && username == 1 && email == 1) {
                            $(".modal-content .regBtn").prop("disabled", false);
                        } else {
                            $(".modal-content .regBtn").prop("disabled", true);
                        }
                    }
                }
            });
        } else {
            email = 0;
            $(".modal-content .regBtn").prop("disabled", true);
            $(".modal-content .mailCheck").fadeOut(350, function () {
                $(".modal-content .mailCheck").removeClass("font-weight-bold");
                $(".modal-content .mailCheck").css("color", "#6c757d");
                $(".modal-content .mailCheck").empty();
                $(".modal-content .mailCheck").fadeIn(350);
            });
        }
    });

    // check if username already exists in database
    $(".modal-content").on("input", "#registerUsername", function () {
        editName = $(this).data("username");
        var name = $(".modal-content #registerUsername").val();
        if ($(".modal-content #registerUsername").val().length > 32) {
            username = 0;
            $(".modal-content .regBtn").prop("disabled", true);
            if ($(".modal-content .userCheck").text() !== " Username is more than 32 characters.") {
                $(".modal-content .userCheck").fadeOut(350, function () {
                    $(".modal-content .userCheck").addClass("font-weight-bold");
                    $(".modal-content .userCheck").text(" Username is more than 32 characters.");
                    $(".modal-content .userCheck").css("color", "red");
                    $(".modal-content .userCheck").fadeIn(350);
                });
            }
        } else if ($(".modal-content #registerUsername").val().length > 0) {
            username = 0;
            $(".modal-content .regBtn").prop("disabled", true);
            if ($(".modal-content .userCheck").has("svg.fa-cog").length == 0) {
                $(".modal-content .userCheck").fadeOut(350, function () {
                    $(".modal-content .userCheck").addClass("font-weight-bold");
                    $(".modal-content .userCheck").html("<i class='fas fa-cog fa-spin'></i>");
                    $(".modal-content .userCheck").css("color", "#663");
                    $(".modal-content .userCheck").fadeIn(350);
                });
            }
            $.ajax({
                method: "get",
                url: "register_endpoint.php",
                data: {
                    editName: editName,
                    name: name,
                    namecheck: true
                },
                success: function (data) {
                    if (data == 1) {
                        username = 0;
                        $(".modal-content .regBtn").prop("disabled", true);
                        $(".modal-content .userCheck").fadeOut(350, function () {
                            $(".modal-content .userCheck").addClass("font-weight-bold");
                            $(".modal-content .userCheck").html("Username not available.")
                            $(".modal-content .userCheck").css("color", "red");
                            $(".modal-content .userCheck").fadeIn(350);
                        });
                    } else {
                        username = 1;
                        $(".modal-content .userCheck").fadeOut(350, function () {
                            $(".modal-content .userCheck").addClass("font-weight-bold");
                            $(".modal-content .userCheck").html("Username available.");
                            $(".modal-content .userCheck").css("color", "green");
                            $(".modal-content .userCheck").fadeIn(350);
                        });
                        if (passwords == 1 && username == 1 && email == 1) {
                            $(".modal-content .regBtn").prop("disabled", false);
                        } else {
                            $(".modal-content .regBtn").prop("disabled", true);
                        }
                    }
                }
            });
        } else {
            username = 0;
            $(".modal-content .regBtn").prop("disabled", true);
            $(".modal-content .userCheck").fadeOut(350, function () {
                $(".modal-content .userCheck").removeClass("font-weight-bold");
                $(".modal-content .userCheck").css("color", "#6c757d");
                $(".modal-content .userCheck").html("Maximum 32 characters long. No spaces at start and end.");
                $(".modal-content .userCheck").fadeIn(350);
            });
        }
    });

    // check if passwords match and are more than 6 characters
    $(".modal-content").on("input", ".newPass", function () {
        var length = 0;
        var match = 0;
        if ($(".modal-content #registerPassword2").val().length < 6 && $(".modal-content #registerPassword2").val().length > 0 && $(".modal-content #registerPassword1").val().length < 6 && $(".modal-content #registerPassword1").val().length > 0 && $(".modal-content #registerPassword2").val() !== "" && $(".modal-content #registerPassword1").val() !== "") {
            length = 0;
            if ($(".modal-content .lengthCheck").text() !== " Password less than 6 characters.") {
                $(".modal-content .lengthCheck").fadeOut(350, function () {
                    $(".modal-content .lengthCheck").text(" Password less than 6 characters.");
                    $(".modal-content .lengthCheck").css("color", "red");
                    $(".modal-content .lengthCheck").fadeIn(350);
                });
            }
        } else {
            length = 1;
            $(".modal-content .lengthCheck").fadeOut(350, function () {
                $(".modal-content .lengthCheck").empty();
            });
        }
        if ($(".modal-content #registerPassword2").val() == "" || $(".modal-content #registerPassword1").val() == "") {
            if ($(".modal-content #registerPassword2").val() == "" && $(".modal-content #registerPassword1").val() == "" && edit == 1) {
                length = 1;
                match = 1;
            } else {
                match = 0;
                $(".modal-content .matchCheck").fadeOut(350, function () {
                    $(".modal-content .matchCheck").empty();
                });
                $(".modal-content .lengthCheck").fadeOut(350, function () {
                    $(".modal-content .lengthCheck").empty();
                });
            }
        } else if ($(".modal-content #registerPassword2").val() != $(".modal-content #registerPassword1").val()) {
            match = 0;
            if ($(".modal-content .matchCheck").html() !== "Passwords not matching.") {
                $(".modal-content .matchCheck").fadeOut(350, function () {
                    $(".modal-content .matchCheck").css("color", "red");
                    $(".modal-content .matchCheck").html("Passwords not matching.");
                    $(".modal-content .matchCheck").fadeIn(350);
                });
            }
        } else {
            match = 1;
            $(".modal-content .matchCheck").fadeOut(350, function () {
                $(".modal-content .matchCheck").css("color", "green");
                $(".modal-content .matchCheck").html("Passwords matching.");
                $(".modal-content .matchCheck").fadeIn(350);
            });
        }
        if (match == 1 && length == 1) {
            passwords = 1;
        } else {
            passwords = 0;
        }
        if (passwords == 1 && username == 1 && email == 1) {
            $(".modal-content .regBtn").prop("disabled", false);
        } else {
            $(".modal-content .regBtn").prop("disabled", true);
        }
    });

    // display list of regions when user picks a country
    $(".modal-content").on("change", "#country", function () {
        var country = $(".modal-content #country option:selected").text();
        var id = $(".modal-content #country option:selected").val();
        if (country == "Philippines" && id == 164) {
            if ($(".modal-content .region").html() == "") {
                $(".modal-content .region").addClass("text-center");
                $(".modal-content .region").html("<i class='far fa-compass fa-spin fa-3x'></i>");
            } else {
                $(".modal-content .region").fadeOut(350, function () {
                    $(".modal-content .region").addClass("text-center");
                    $(".modal-content .region").html("<i class='far fa-compass fa-spin fa-3x'></i>");
                });
            }
            $(".modal-content .region").fadeIn(350);
            $.ajax({
                method: "get",
                url: "register_endpoint.php",
                data: {
                    index: id,
                    hasregion: "phil"
                },
                success: function (data) {
                    $(".modal-content .region").fadeOut(350, function () {
                        $(".modal-content .region").removeClass("text-center");
                        $(".modal-content .region").html(data);
                        $(".modal-content .region").fadeIn(350);
                    });
                }
            });
        } else if ($.inArray(country, noRegion) < 0 && id !== "") {
            $(".modal-content .city").slideUp(350, function () {
                $(".modal-content .city").empty();
                $(".modal-content .city").removeClass("text-center");
            });
            $(".modal-content .province").fadeOut(350, function () {
                $(".modal-content .province").empty();
                $(".modal-content .province").removeClass("text-center");
            });
            if ($(".modal-content .region").html() == "") {
                $(".modal-content .region").addClass("text-center");
                $(".modal-content .region").html("<i class='far fa-compass fa-spin fa-3x'></i>");
            } else {
                $(".modal-content .region").fadeOut(350, function () {
                    $(".modal-content .region").addClass("text-center");
                    $(".modal-content .region").html("<i class='far fa-compass fa-spin fa-3x'></i>");
                });
            }
            $(".modal-content .region").fadeIn(350);
            $.ajax({
                method: "get",
                url: "register_endpoint.php",
                data: {
                    index: id,
                    hasregion: "intl"
                },
                success: function (data) {
                    $(".modal-content .region").fadeOut(350, function () {
                        $(".modal-content .region").removeClass("text-center");
                        $(".modal-content .region").html(data);
                        $(".modal-content .region").fadeIn(350);
                    });
                }
            });
        } else {
            $(".modal-content .region").fadeOut(350, function () {
                $(".modal-content .region").empty();
                $(".modal-content .region").removeClass("text-center");
            });
            $(".modal-content .city").slideUp(350, function () {
                $(".modal-content .city").empty();
                $(".modal-content .city").removeClass("text-center");
            });
            $(".modal-content .province").fadeOut(350, function () {
                $(".modal-content .province").empty();
                $(".modal-content .province").removeClass("text-center");
            });
        }
    });

    // change first option of intl region to "Not in List / Other" when user clicks on select
    $(".modal-content").on("click", "#intlregion", function () {
        if ($(".modal-content #notInList").text() == "Select Region / State") {
            $(".modal-content #notInList").attr("value", 0);
            $(".modal-content #notInList").text("Not in List / Other");
        }
    });

    // display list of provinces when user picks a Philippine region
    $(".modal-content").on("change", "#philregion", function () {
        var id = $(".modal-content #philregion option:selected").val();
        if (id !== "") {
            $(".modal-content .city").slideUp(350, function () {
                $(".modal-content .city").empty();
                $(".modal-content .city").removeClass("text-center");
            });
            if ($(".modal-content .province").html() == "") {
                $(".modal-content .province").addClass("text-center");
                $(".modal-content .province").html("<i class='far fa-compass fa-spin fa-3x'></i>");
            } else {
                $(".modal-content .province").fadeOut(350, function () {
                    $(".modal-content .province").addClass("text-center");
                    $(".modal-content .province").html("<i class='far fa-compass fa-spin fa-3x'></i>");
                });
            }
            $(".modal-content .province").fadeIn(350);
            $.ajax({
                method: "get",
                url: "register_endpoint.php",
                data: {
                    index: id,
                    province: true
                },
                success: function (data) {
                    $(".modal-content .province").fadeOut(350, function () {
                        $(".modal-content .province").removeClass("text-center");
                        $(".modal-content .province").html(data);
                        $(".modal-content .province").fadeIn(350);
                    });
                }
            });
        } else {
            $(".modal-content .city").slideUp(350, function () {
                $(".modal-content .city").empty();
                $(".modal-content .city").removeClass("text-center");
            });
            $(".modal-content .province").fadeOut(350, function () {
                $(".modal-content .province").empty();
                $(".modal-content .province").removeClass("text-center");
            });
        }
    });

    // display list of cities / municipalities when user picks a Philippine province
    $(".modal-content").on("change", "#province", function () {
        var id = $("#province option:selected").val();
        if (id !== "") {
            if ($(".modal-content .city").html() == "") {
                $(".modal-content .city").addClass("text-center");
                $(".modal-content .city").html("<i class='far fa-compass fa-spin fa-3x'></i>");
            } else {
                $(".modal-content .city").fadeOut(350, function () {
                    $(".modal-content .city").addClass("text-center");
                    $(".modal-content .city").html("<i class='far fa-compass fa-spin fa-3x'></i>");
                });
            }
            $(".modal-content .city").fadeIn(350);
            $.ajax({
                method: "get",
                url: "register_endpoint.php",
                data: {
                    index: id,
                    city: true
                },
                success: function (data) {
                    $(".modal-content .city").fadeOut(350, function () {
                        $(".modal-content .city").removeClass("text-center");
                        $(".modal-content .city").html(data);
                        $(".modal-content .city").fadeIn(350);
                    });
                }
            });
        } else {
            $(".modal-content .city").slideUp(350, function () {
                $(".modal-content .city").empty();
                $(".modal-content .city").removeClass("text-center");
            });
        }
    });

    // submit form and update / register user
    $(".modal-content").on("submit", "#regForm", function (e) {
        e.preventDefault();
        var formFunction = $(".modal-content .regBtn").data("function");
        userId = $(".modal-content .regBtn").data("index");
        $(".modal-content .regBtn").prop("disabled", true);
        var firstname = $(".modal-content #firstName").val();
        var lastname = $(".modal-content #lastName").val();
        var email = $(".modal-content #registerEmail").val();
        var username = $(".modal-content #registerUsername").val();
        var password = $(".modal-content #registerPassword1").val();
        var sex = $(".modal-content #inputSex").val();
        var birthday = $(".modal-content #birthDayEdit").val();
        var country = $(".modal-content #country").val();
        var philregion = $(".modal-content #philregion").val();
        var intlregion = $(".modal-content #intlregion").val();
        var province = $(".modal-content #province").val();
        var city = $(".modal-content #city").val();
        var address = $(".modal-content #address").val();
        $.ajax({
            method: "post",
            url: "admin_endpoint.php",
            data: {
                firstname: firstname,
                lastname: lastname,
                email: email,
                username: username,
                password: password,
                sex: sex,
                birthday: birthday,
                country: country,
                philregion: philregion,
                intlregion: intlregion,
                province: province,
                city: city,
                address: address,
                userid: userId,
                user: formFunction
            },
            success: function (data) {
                if (data.length > 0) {
                    $(".modal-content").fadeOut(350, function () {
                        $(".modal-content").html("<i class='far fa-frown align-self-center fa-5x'></i><span class='modal-text font-weight-bold'>Oh no! An error occurred! Please send us a message or try again.</span><br><button type='button' class='btn btn-warning align-self-center col-4' data-dismiss='modal'>Dismiss</button>");
                        $(".modal-content").fadeIn(350);
                    });
                    $.ajax({
                        method: "post",
                        url: "login_logout_endpoint.php",
                        data: {
                            error: true,
                            data: "#regForm, submit:" + data
                        }
                    });
                } else {
                    $(".register-modal-lg").modal("hide");
                    $(".modal").modal("hide");
                }
            },
            error: function (XHR, textStatus, errorThrown) {
                $.ajax({
                    method: "post",
                    url: "login_logout_endpoint.php",
                    data: {
                        error: true,
                        data: "#regForm, submit:\r\n" + XHR + "\r\n" + textStatus + "\r\n" + errorThrown
                    }
                });
                $(".modal-content").fadeOut(350, function () {
                    $(".modal-content").html("<i class='far fa-frown align-self-center fa-5x'></i><span class='modal-text font-weight-bold'>Oh no! An error occurred! Please send us a message or try again.</span><br><button type='button' class='btn btn-warning align-self-center col-4' data-dismiss='modal'>Dismiss</button>");
                    $(".modal-content").fadeIn(350);
                });
            }
        });
    });
});