"use strict" /* strict mode enabled */

// reload page on popstate event
window.addEventListener("popstate", function (e) {
    window.location.reload();
});

$(function () { /* document ready function */


    // check the categories checkboxes
    var catNos = $("#catForm input").length - 1;
    var catChk = $("#catForm input[checked]").length;
    if (document.getElementById("catCheck0").checked || catNos == catChk || catChk == 0) {
        $("#catForm input").prop("checked", false);
        $("#catCheck0").prop("checked", true);
    }
    allCheck = [];
    $("#catForm :checked").each(function () {
        allCheck.push($(this).val());
    });
    cat = allCheck.join(",");
    if (cat == "") {
        cat = 0;
    }

    // check the brands checkboxes
    var allCheck = [];
    $("#brandForm :checked").each(function () {
        allCheck.push($(this).val());
    });
    brand = allCheck.join(",");
    window.history.replaceState("", "Pinoyware - Products", "products.php?sort=" + sort + "&cat=" + cat + "&brand=" + brand + "&minp=" + minp + "&maxp=" + maxp + "&search=" + search + "&page=" + page);

    // check min and max price input boxes
    if (isNaN(maxp) || maxp == 0) {
        maxp = "";
        $("#maxpinput").val("");
        $("#minpinput").attr("max", "");
    } else {
        $("#minpinput").attr("max", maxp - 1);
    }
    if (isNaN(minp) || minp == 0) {
        minp = 0;
        $("#minpinput").val("");
        $("#maxpinput").attr("min", 1);
    } else {
        $("#maxpinput").attr("min", minp + 1);
    }


    // get min height for content container to stick footer on bottom of viewport if content is too short
    var filterHeight = $("#filterParent").outerHeight(true);
    $(".filter").parent().css("min-height", filterHeight + "px");

    // show or hide .filter after page load depending on visibility of #filterBtn
    if ($("#filterBtn").css("display") !== "none") {
        $(".filter").css("display", "none");
    } else {
        $(".filter").css("display", "block");
    }

    // show or hide .filter on browser resize depending on visibility of #filterBtn
    $(window).resize(function () {
        if ($("#filterBtn").css("display") !== "none") {
            $(".filter").css("display", "none");
        } else {
            $(".filter").css("display", "block");
        }
    });

    // toggle to fade in or out .filter
    $("#filterBtn").click(function () {
        $(".filter").fadeToggle(350);
    });

    // fade out .filter when clicking outside .filter and #filterBtn
    $(document).click(function () {
        if (!$(event.target).closest($(".filter")).length && !$(event.target).closest("#filterBtn").length && $("#filterBtn").css("display") !== "none") {
            if ($(".filter").css("display") == "block") {
                $(".filter").fadeOut(350);
            }
        }
    });

    // sort items
    $("#filterParent").on("change", "#sortSelect", function () {
        $("#productParent").fadeOut(350, function () {
            $("#productParent").addClass("text-center");
            $("#productParent").html("<i class='fas fa-cog fa-spin fa-10x m-5'></i>");
            $("#productParent").fadeIn(350);
        });
        sort = $("#sortSelect").val();
        $("#filterParent").find("*").prop("disabled", true);
        page = 1;
        window.history.pushState("", "Pinoyware - Products", "products.php?sort=" + sort + "&cat=" + cat + "&brand=" + brand + "&minp=" + minp + "&maxp=" + maxp + "&search=" + search + "&page=1");
        $("#hiddenProduct").load(" #productContent", function (data) {
            $("#productParent").fadeOut(350, function () {
                $("#productParent").removeClass("text-center");
                $("#productParent").html($("#hiddenProduct").html());
                $("#hiddenProduct").empty();
                $("#productParent").fadeIn(350, function () {
                    $("#filterParent").find("*").prop("disabled", false);
                });
            });
        });
    });

    // display by category function
    $("#catForm").on("change", "input", function () {
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
        catNos = $("#catForm input").length - 1;
        catChk = $("#catForm :checked").length;
        page = 1;
        if (document.getElementById("catCheck0").checked || catNos == catChk || catChk == 0) {
            if (cat == 0) {
                $("#catCheck0").prop("checked", false);
            } else {
                $("#catForm input").prop("checked", false);
                $("#catCheck0").prop("checked", true);
                cat = 0;
            }
            allCheck = [];
            $("#catForm :checked").each(function () {
                allCheck.push($(this).val());
            });
            cat = allCheck.join(",");
            if (cat == "") {
                cat = 0;
                $("#catCheck0").prop("checked", true);
            }
            window.history.pushState("", "Pinoyware - Products", "products.php?sort=" + sort + "&cat=" + cat + "&brand=" + brand + "&minp=" + minp + "&maxp=" + maxp + "&search=" + search + "&page=1");
        } else {
            allCheck = [];
            $("#catForm :checked").each(function () {
                allCheck.push($(this).val());
            });
            cat = allCheck.join(",");
            window.history.pushState("", "Pinoyware - Products", "products.php?sort=" + sort + "&cat=" + cat + "&brand=" + brand + "&minp=" + minp + "&maxp=" + maxp + "&search=" + search + "&page=1");
        }
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
                    filterHeight = $("#filterParent").outerHeight(true);
                    $(".filter").parent().css("min-height", filterHeight + "px");
                    allCheck = [];
                    $("#brandForm :checked").each(function () {
                        allCheck.push($(this).val());
                    });
                    brand = allCheck.join(",");
                    window.history.replaceState("", "Pinoyware - Products", "products.php?sort=" + sort + "&cat=" + cat + "&brand=" + brand + "&minp=" + minp + "&maxp=" + maxp + "&search=" + search + "&page=1");
                    $("#filterParent").find("*").prop("disabled", false);
                    maxpage = ($("#productParent .page-item").length - 2);
                });
            });
        });
    });

    // display by brand function
    $("#brandForm").on("change", "input", function () {
        $("#productParent").fadeOut(350, function () {
            $("#productParent").addClass("text-center");
            $("#productParent").html("<i class='fas fa-cog fa-spin fa-10x m-5'></i>");
            $("#productParent").fadeIn(350);
        });
        allCheck = [];
        $("#brandForm :checked").each(function () {
            allCheck.push($(this).val());
        });
        brand = allCheck.join(",");
        page = 1;
        window.history.pushState("", "Pinoyware - Products", "products.php?sort=" + sort + "&cat=" + cat + "&brand=" + brand + "&minp=" + minp + "&maxp=" + maxp + "&search=" + search + "&page=1");
        $("#filterParent").find("*").prop("disabled", true);
        $("#hiddenProduct").load(" #productContent", function (data) {
            $("#productParent").fadeOut(350, function () {
                $("#productParent").removeClass("text-center");
                $("#productParent").html($("#hiddenProduct").html());
                $("#hiddenProduct").empty();
                $("#productParent").fadeIn(350, function () {
                    $("#filterParent").find("*").prop("disabled", false);
                    maxpage = ($("#productParent .page-item").length - 2);
                });
            });
        });
    });

    // min price input
    $("#minpinput").on("input", function () {
        minp = parseInt($("#minpinput").val());
        if (isNaN(minp) || minp == 0) {
            minp = "";
            $("#minpinput").val("");
            $("#maxpinput").attr("min", 1);
        } else {
            $("#maxpinput").attr("min", minp + 1);
        }
    });

    // max price input
    $("#maxpinput").on("input", function () {
        maxp = parseInt($("#maxpinput").val());
        if (isNaN(maxp) || maxp == 0) {
            maxp = "";
            $("#maxpinput").val("");
            $("#minpinput").attr("max", "");
        } else {
            $("#minpinput").attr("max", maxp - 1);
        }
    });

    // limit by price
    $("#priceForm").on("submit", function (e) {
        e.preventDefault();
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
        minp = parseInt($("#minpinput").val());
        maxp = parseInt($("#maxpinput").val());
        if (isNaN(maxp) || maxp == 0) {
            maxp = "";
            $("#maxpinput").val("");
            $("#minpinput").attr("max", "");
        } else {
            $("#minpinput").attr("max", maxp - 1);
        }
        if (isNaN(minp) || minp == 0) {
            minp = 0;
            $("#minpinput").val("");
            $("#maxpinput").attr("min", 1);
        } else {
            $("#maxpinput").attr("min", minp + 1);
        }
        page = 1;
        window.history.pushState("", "Pinoyware - Products", "products.php?sort=" + sort + "&cat=" + cat + "&brand=" + brand + "&minp=" + minp + "&maxp=" + maxp + "&search=" + search + "&page=1");
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
                    filterHeight = $("#filterParent").outerHeight(true);
                    $(".filter").parent().css("min-height", filterHeight + "px");
                    allCheck = [];
                    $("#brandForm :checked").each(function () {
                        allCheck.push($(this).val());
                    });
                    brand = allCheck.join(",");
                    window.history.replaceState("", "Pinoyware - Products", "products.php?sort=" + sort + "&cat=" + cat + "&brand=" + brand + "&minp=" + minp + "&maxp=" + maxp + "&search=" + search + "&page=1");
                    $("#filterParent").find("*").prop("disabled", false);
                    maxpage = ($("#productParent .page-item").length - 2);
                });
            });
        });
    });

    // clear search term
    $("#productParent").on("click", ".searchTerm", function () {
        $(".searchForm input").val("");
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
        search = "";
        page = 1;
        brand = "";
        window.history.pushState("", "Pinoyware - Products", "products.php?sort=" + sort + "&cat=" + cat + "&brand=&minp=" + minp + "&maxp=" + maxp + "&search=" + search + "&page=1");
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
                    filterHeight = $("#filterParent").outerHeight(true);
                    $(".filter").parent().css("min-height", filterHeight + "px");
                    $("#filterParent").find("*").prop("disabled", false);
                    maxpage = ($("#productParent .page-item").length - 2);
                });
            });
        });
    });

    // clear max price
    $("#productParent").on("click", ".clearMaxp", function () {
        $("#maxpinput").val("");
        $("#minpinput").attr("max", "");
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
        maxp = "";
        page = 1;
        brand = "";
        window.history.pushState("", "Pinoyware - Products", "products.php?sort=" + sort + "&cat=" + cat + "&brand=&minp=" + minp + "&maxp=" + maxp + "&search=" + search + "&page=1");
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
                    filterHeight = $("#filterParent").outerHeight(true);
                    $(".filter").parent().css("min-height", filterHeight + "px");
                    $("#filterParent").find("*").prop("disabled", false);
                    maxpage = ($("#productParent .page-item").length - 2);
                });
            });
        });
    });

    // clear min price
    $("#productParent").on("click", ".clearMinp", function () {
        $("#minpinput").val("");
        $("#maxpinput").attr("min", 1);
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
        minp = 0;
        page = 1;
        brand = "";
        window.history.pushState("", "Pinoyware - Products", "products.php?sort=" + sort + "&cat=" + cat + "&brand=&minp=" + minp + "&maxp=" + maxp + "&search=" + search + "&page=1");
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
                    filterHeight = $("#filterParent").outerHeight(true);
                    $(".filter").parent().css("min-height", filterHeight + "px");
                    $("#filterParent").find("*").prop("disabled", false);
                    maxpage = ($("#productParent .page-item").length - 2);
                });
            });
        });
    });

    // page number function
    $("#productParent").on("click", ".page-item", function (e) {
        e.preventDefault();
        if ($(this).text().indexOf("Previous") >= 0 && page !== 1) {
            page = page - 1;
            window.history.pushState("", "Pinoyware - Products", "products.php?sort=" + sort + "&cat=" + cat + "&brand=" + brand + "&minp=" + minp + "&maxp=" + maxp + "&search=" + search + "&page=" + page);
            $("#productParent").fadeOut(350, function () {
                $("#productParent").addClass("text-center");
                $("#productParent").html("<i class='fas fa-cog fa-spin fa-10x m-5'></i>");
                $("#productParent").fadeIn(350);
            });
            $("#filterParent").find("*").prop("disabled", true);
            $("#hiddenProduct").load(" #productContent", function (data) {
                $("#productParent").fadeOut(350, function () {
                    $("#productParent").removeClass("text-center");
                    $("#productParent").html($("#hiddenProduct").html());
                    $("#hiddenProduct").empty();
                    $("#productParent").fadeIn(350, function () {
                        $("#filterParent").find("*").prop("disabled", false);
                    });
                });
            });
        } else if ($(this).text().indexOf("Next") >= 0 && page !== maxpage) {
            page = page + 1;
            window.history.pushState("", "Pinoyware - Products", "products.php?sort=" + sort + "&cat=" + cat + "&brand=" + brand + "&minp=" + minp + "&maxp=" + maxp + "&search=" + search + "&page=" + page);
            $("#productParent").fadeOut(350, function () {
                $("#productParent").addClass("text-center");
                $("#productParent").html("<i class='fas fa-cog fa-spin fa-10x m-5'></i>");
                $("#productParent").fadeIn(350);
            });
            $("#filterParent").find("*").prop("disabled", true);
            $("#hiddenProduct").load(" #productContent", function (data) {
                $("#productParent").fadeOut(350, function () {
                    $("#productParent").removeClass("text-center");
                    $("#productParent").html($("#hiddenProduct").html());
                    $("#hiddenProduct").empty();
                    $("#productParent").fadeIn(350, function () {
                        $("#filterParent").find("*").prop("disabled", false);
                    });
                });
            });
        } else if ($(this).text().indexOf("Next") < 0 && $(this).text().indexOf("Previous") < 0) {
            page = parseInt($(this).text());
            window.history.pushState("", "Pinoyware - Products", "products.php?sort=" + sort + "&cat=" + cat + "&brand=" + brand + "&minp=" + minp + "&maxp=" + maxp + "&search=" + search + "&page=" + page);
            $("#productParent").fadeOut(350, function () {
                $("#productParent").addClass("text-center");
                $("#productParent").html("<i class='fas fa-cog fa-spin fa-10x m-5'></i>");
            });
            $("#productParent").fadeIn(350);
            $("#filterParent").find("*").prop("disabled", true);
            $("#hiddenProduct").load(" #productContent", function (data) {
                $("#productParent").fadeOut(350, function () {
                    $("#productParent").removeClass("text-center");
                    $("#productParent").html($("#hiddenProduct").html());
                    $("#hiddenProduct").empty();
                    $("#productParent").fadeIn(350, function () {
                        $("#filterParent").find("*").prop("disabled", false);
                    });
                });
            });
        }
    });

    // product modal
    $("#productParent").on("click", ".productCard", function (e) {
        e.preventDefault();
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
        var descript = $(this).find(".prodDescript").html();
        descript = "<br><br><span class='d-inline-block mr-3'><span class='font-weight-bold'>Description:</span><br>" + descript + "</span>";
        if (user == 1) {
            var addCart = "<button type='button' class='btn btn-success mr-3 addToCart' data-index=" + index + ">Add to Cart <i class='fas fa-cart-plus'></i></button>";
        } else {
            addCart = "";
        }
        $(".modal-content").html("<div class='card'><img class='card-img-top align-self-center' src='" + img + "' alt='Card image cap'><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button><div class='card-body'><h5 class='card-title prodTitle'>" + name + "</h5><h5 class='card-title prodPrice'>₱ " + price + "</h5><div class='card-text'>" + proc + screen + ram + hdd + gpu + descript + "</div><br><a tabindex='0' class='btn p-0 m-0 border-0 popover-dismiss addCartPopover' role='button' data-toggle='popover' data-trigger='focus' data-placement='top' title='" + name + " added to cart!'>" + addCart + "</a><button type='button' class='btn btn-warning' data-dismiss='modal'>Close</button></div></div>");
        $(".modal").modal("show");
    });

    // add to cart btn
    $(".modal-content").on("click", ".addToCart", function () {
        $(this).prop("disabled", true);
        var index = $(this).data("index");
        $(".cartMenu").find("*").prop("disabled", true);
        $.ajax({
            method: "post",
            url: "products_endpoint.php",
            data: {
                index: index,
                addtocart: true
            },
            success: function (data) {
                $(".modal-content").find(".addCartPopover").popover("show");
                setTimeout(() => {
                    $(".modal-content").find(".addCartPopover").popover("hide");
                    $(".register-modal-lg").modal("hide");
                    $(".modal").modal("hide");
                }, 2000);
                $(".counterWrapper").load(" #counterContent");
                $(".cartMenu").load(" #cartContent");
            }
        });
    });

    // dismiss popovers
    $('.popover-dismiss').popover({
        trigger: 'focus'
    });
});