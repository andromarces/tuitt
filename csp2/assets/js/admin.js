"use strict" /* strict mode enabled */

var adminPg = 1; /* admin page indicator */
var passwords = 0; /* 0 = passwords invalid, 1 = passwords OK */
var username = 0; /* 0 = username invalid, 1 = username valid */
var email = 0; /* 0 = email invalid, 1 email valid */
var edit = 0; /* 1 = editing */
var userId = ""; /* user id for editing */
var userEmail = ""; /* user email for editing */
var editName = ""; /* username for editing */

// reload page on popstate event
window.addEventListener("popstate", function (e) {
    window.location.reload();
});

$(function () { /* document ready function */
    
    // initialize datedropper on modal show
    $(".modal").on("shown.bs.modal", function () {
        $("#birthDay").dateDropper();
        $("#birthDayEdit").dateDropper();
        $("#birthDay").val(null);
        $("#birthDay").prop("readonly", false);
        $("#birthDayEdit").prop("readonly", false);
        $("#birthDay").on('keydown paste', function(e){
            e.preventDefault();
        });
        $("#birthDayEdit").on('keydown paste', function(e){
            e.preventDefault();
        });
    });

    // change url on page load
    if (window.location.href.indexOf("?products") > -1) {
        $("#v-pills-products-tab").addClass("active");
        $("#v-pills-products-tab").attr("aria-selected", true);
        adminPg = 3;
        window.history.replaceState("", "Pinoyware - Admin", "admin.php?products");
    } else if (window.location.href.indexOf("?staff") > -1) {
        $("#v-pills-staff-tab").addClass("active");
        $("#v-pills-staff-tab").attr("aria-selected", true);
        adminPg = 2;
        window.history.replaceState("", "Pinoyware - Admin", "admin.php?staff");
    } else if (window.location.href.indexOf("?orders") > -1) {
        $("#v-pills-orders-tab").addClass("active");
        $("#v-pills-orders-tab").attr("aria-selected", true);
        $("#addBtn").hide();
        $("#delBtn").hide();
        adminPg = 4;
        window.history.replaceState("", "Pinoyware - Admin", "admin.php?orders");
    } else {
        $("#v-pills-users-tab").addClass("active");
        $("#v-pills-users-tab").attr("aria-selected", true);
        adminPg = 1;
        window.history.replaceState("", "Pinoyware - Admin", "admin.php?users");
    }

    // get min height for content container to stick footer on bottom of viewport if content is too short
    var sectionHeight = $(".section").outerHeight(true);
    var contentHeight = (window.innerHeight - ($("#navBar").outerHeight(true) + $(".nav").outerHeight(true) + $("footer").outerHeight(true)));
    if (sectionHeight > contentHeight) {
        $(".container").css("min-height", sectionHeight + "px");
    } else {
        $(".container").css("min-height", contentHeight + "px");
    }

    // toggle to fade in or out .section
    $("#sectionBtn").click(function () {
        $(".section").fadeToggle(350);
    });

    // fade out .section when clicking outside .section and #sectionBtn
    $(document).click(function () {
        if (!$(event.target).closest($(".section")).length && !$(event.target).closest("#sectionBtn").length && $("#sectionBtn").css("display") !== "none") {
            if ($(".section").css("display") == "block") {
                $(".section").fadeOut(350);
            }
        }
    });

    // show .section on breakpoint 768px and up
    $(window).resize(function () {
        if ($(".breakpointDiv").css("display") !== "none") {
            $(".section").show();
        } else {
            $(".section").hide();
        }
    });

    // staff tab
    $("#v-pills-staff-tab").click(function () {
        window.history.pushState("", "Pinoyware - Admin", "admin.php?staff");
        adminPg = 2;
        $("#addBtn").fadeOut(350);
        $("#editBtn").fadeOut(350);
        $("#delBtn").fadeOut(350);
        $("#tableParent").fadeOut(350, function () {
            $("#tableParent").addClass("text-center");
            $("#tableParent").html("<i class='fas fa-cog fa-spin fa-10x m-5'></i>");
            $("#tableParent").fadeIn(350);
        });
        $("#editBtn").prop("disabled", false);
        $("#delBtn").prop("disabled", false);
        $("#hiddenTable").load(" #table", function (data) {
            $("#tableParent").fadeOut(350, function () {
                $("#tableParent").removeClass("text-center");
                $("#tableParent").html($("#hiddenTable").html());
                $("#hiddenTable").empty();
                $("#tableParent").fadeIn(350, function () {
                    $("#addBtn").fadeIn(350);
                    $("#editBtn").fadeIn(350);
                    $("#delBtn").fadeIn(350);
                });
            });
        });
    });

    // products tab
    $("#v-pills-products-tab").click(function () {
        window.history.pushState("", "Pinoyware - Admin", "admin.php?products");
        adminPg = 3;
        $("#addBtn").fadeOut(350);
        $("#editBtn").fadeOut(350);
        $("#delBtn").fadeOut(350);
        $("#tableParent").fadeOut(350, function () {
            $("#tableParent").addClass("text-center");
            $("#tableParent").html("<i class='fas fa-cog fa-spin fa-10x m-5'></i>");
            $("#tableParent").fadeIn(350);
        });
        $("#editBtn").prop("disabled", true);
        $("#delBtn").prop("disabled", true);
        $("#hiddenTable").load(" #table", function (data) {
            $("#tableParent").fadeOut(350, function () {
                $("#tableParent").removeClass("text-center");
                $("#tableParent").html($("#hiddenTable").html());
                $("#hiddenTable").empty();
                $("#tableParent").fadeIn(350, function () {
                    $("#addBtn").fadeIn(350);
                    $("#editBtn").fadeIn(350);
                    $("#delBtn").fadeIn(350);
                });
            });
        });
    });

    // orders tab
    $("#v-pills-orders-tab").click(function () {
        window.history.pushState("", "Pinoyware - Admin", "admin.php?orders");
        adminPg = 4;
        $("#addBtn").fadeOut(350);
        $("#editBtn").fadeOut(350);
        $("#delBtn").fadeOut(350);
        $("#tableParent").fadeOut(350, function () {
            $("#tableParent").addClass("text-center");
            $("#tableParent").html("<i class='fas fa-cog fa-spin fa-10x m-5'></i>");
            $("#tableParent").fadeIn(350);
        });
        $("#editBtn").prop("disabled", true);
        $("#delBtn").prop("disabled", true);
        $("#hiddenTable").load(" #table", function (data) {
            $("#tableParent").fadeOut(350, function () {
                $("#tableParent").removeClass("text-center");
                $("#tableParent").html($("#hiddenTable").html());
                $("#hiddenTable").empty();
                $("#tableParent").fadeIn(350, function () {
                    $("#editBtn").fadeIn(350);
                });
            });
        });
    });

    // users tab
    $("#v-pills-users-tab").click(function () {
        window.history.pushState("", "Pinoyware - Admin", "admin.php?users");
        adminPg = 1;
        $("#addBtn").fadeOut(350);
        $("#editBtn").fadeOut(350);
        $("#delBtn").fadeOut(350);
        $("#tableParent").fadeOut(350, function () {
            $("#tableParent").addClass("text-center");
            $("#tableParent").html("<i class='fas fa-cog fa-spin fa-10x m-5'></i>");
            $("#tableParent").fadeIn(350);
        });
        $("#editBtn").prop("disabled", true);
        $("#delBtn").prop("disabled", true);
        $("#hiddenTable").load(" #table", function (data) {
            $("#tableParent").fadeOut(350, function () {
                $("#tableParent").removeClass("text-center");
                $("#tableParent").html($("#hiddenTable").html());
                $("#hiddenTable").empty();
                $("#tableParent").fadeIn(350, function () {
                    $("#addBtn").fadeIn(350);
                    $("#editBtn").fadeIn(350);
                    $("#delBtn").fadeIn(350);
                });
            });
        });
    });

    // add new user / item
    $("#addBtn").click(function () {
        if (adminPg == 1) {
            $.ajax({
                method: "get",
                url: "admin_endpoint.php",
                data: {
                    adduser: 1
                },
                success: function (data) {
                    $(".modal-content").html(data);
                    $(".modal").modal("show");
                }
            });
        } else if (adminPg == 2) {
            $.ajax({
                method: "get",
                url: "admin_endpoint.php",
                data: {
                    adduser: 2
                },
                success: function (data) {
                    $(".modal-content").html(data);
                    $(".modal").modal("show");
                }
            });
        } else {
            $.ajax({
                method: "get",
                url: "admin_endpoint.php",
                data: {
                    additem: true
                },
                success: function (data) {
                    $(".modal-content").html(data);
                    $(".modal").modal("show");
                }
            });
        }
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
        if (formFunction == 2) {
            userId = $(".modal-content .regBtn").data("index")
            var birthday = $(".modal-content #birthDayEdit").val();
        } else if (formFunction == 4) {
            userId = "";
            var birthday = $(".modal-content #birthDay").val();
        } else {
            userId = "";
            var birthday = $(".modal-content #birthDay").val();
        }
        $(".modal-content .regBtn").prop("disabled", true);
        var firstname = $(".modal-content #firstName").val();
        var lastname = $(".modal-content #lastName").val();
        var email = $(".modal-content #registerEmail").val();
        var username = $(".modal-content #registerUsername").val();
        var password = $(".modal-content #registerPassword1").val();
        var sex = $(".modal-content #inputSex").val();
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
                    $("#addBtn").fadeOut(350);
                    $("#editBtn").fadeOut(350);
                    $("#delBtn").fadeOut(350);
                    $(".table").fadeOut(350, function () {
                        $(".table").addClass("text-center");
                        $(".table").html("<i class='fas fa-cog fa-spin fa-10x m-5'></i>");
                    });
                    $(".table").fadeIn(350);
                    if (adminPg == 1) {
                        $.ajax({
                            method: "get",
                            url: "admin_endpoint.php",
                            data: {
                                users: true
                            },
                            success: function (data) {
                                $("#editBtn").prop("disabled", true);
                                $("#delBtn").prop("disabled", true);
                                $(".table").fadeOut(350, function () {
                                    $(".table").removeClass("text-center");
                                    $(".table").html(data);
                                });
                                $(".table").fadeIn(350, function () {
                                    $("#addBtn").fadeIn(350);
                                    $("#editBtn").fadeIn(350);
                                    $("#delBtn").fadeIn(350);
                                });
                            }
                        });
                    } else {
                        $.ajax({
                            method: "get",
                            url: "admin_endpoint.php",
                            data: {
                                staff: true
                            },
                            success: function (data) {
                                if (formFunction == 4) {
                                    $.ajax({
                                        method: "get",
                                        url: "login_logout_endpoint.php",
                                        data: {
                                            logout: true
                                        },
                                        success: function (data) {
                                            if (window.location.pathname.toLowerCase().indexOf("/products.php") >= 0) {
                                                window.location.reload();
                                            } else {
                                                window.location.href = "products.php?sort=0&cat=0&brand=&minp=0&maxp=&search=&page=1";
                                            }
                                        }
                                    });
                                } else {
                                    $("#editBtn").prop("disabled", false);
                                    $("#delBtn").prop("disabled", false);
                                    $(".table").fadeOut(350, function () {
                                        $(".table").removeClass("text-center");
                                        $(".table").html(data);
                                    });
                                    $(".table").fadeIn(350, function () {
                                        $("#addBtn").fadeIn(350);
                                        $("#editBtn").fadeIn(350);
                                        $("#delBtn").fadeIn(350);
                                    });
                                }
                            }
                        });
                    }
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

    // on checking a checkbox
    $("#tableParent").on("change", ".rowcheck", function () {
        if ($(this).prop("checked") == true) {
            $(".table .rowcheck").not(this).prop("checked", false);
            $("#editBtn").prop("disabled", false);
            $("#delBtn").prop("disabled", false);
        } else {
            $("#editBtn").prop("disabled", true);
            $("#delBtn").prop("disabled", true);
        }
    });

    // edit user / staff / item
    $("#editBtn").click(function () {
        if (adminPg == 1) {
            edit = 1;
            passwords = 1;
            username = 1;
            email = 1;
            userId = $(".table .rowcheck:checked").data("index");
            userEmail = $(".table .rowcheck:checked").data("email");
            editName = $(".table .rowcheck:checked").data("username");
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
                }
            });
        } else if (adminPg == 2) {
            edit = 1;
            passwords = 1;
            username = 1;
            email = 1;
            $.ajax({
                method: "get",
                url: "admin_endpoint.php",
                data: {
                    edituser: 2
                },
                success: function (data) {
                    $(".modal-content").html(data);
                    $(".modal").modal("show");
                }
            });
        } else if (adminPg == 3) {
            var index = $(".table .rowcheck:checked").data("index");
            var name = $(".table .rowcheck:checked").data("name");
            var price = $(".table .rowcheck:checked").data("price");
            var image = $(".table .rowcheck:checked").data("image");
            var processor = $(".table .rowcheck:checked").data("processor");
            var screensize = $(".table .rowcheck:checked").data("screensize");
            var ram = $(".table .rowcheck:checked").data("ram");
            var hdd = $(".table .rowcheck:checked").data("hdd");
            var gpu = $(".table .rowcheck:checked").data("gpu");
            var brand = $(".table .rowcheck:checked").data("brand");
            var category = $(".table .rowcheck:checked").data("category");
            $.ajax({
                method: "get",
                url: "admin_endpoint.php",
                data: {
                    index: index,
                    name: name,
                    price: price,
                    image: image,
                    processor: processor,
                    screensize: screensize,
                    ram: ram,
                    hdd: hdd,
                    gpu: gpu,
                    brand: brand,
                    category: category,
                    edititem: true
                },
                success: function (data) {
                    $(".modal-content").html(data);
                    $(".modal").modal("show");
                }
            });
        }
    });

    // reset variables on modal close
    $(".modal").on("hide.bs.modal", function () {
        edit = 0;
        passwords = 0;
        username = 0;
        email = 0;
        userId = "";
        userEmail = "";
        editName = "";
    });

    // delete user / staff / item
    $("#delBtn").click(function () {
        if (adminPg == 1) {
            var delName = $(".table .rowcheck:checked").data("username");
            var index = $(".table .rowcheck:checked").data("index");
        } else if (adminPg == 2) {
            var delName = $(this).data("username");
            var index = $(this).data("index");
        } else if (adminPg == 3) {
            var index = $(".table .rowcheck:checked").data("index");
            var delName = $(".table .rowcheck:checked").data("name");
        }
        $(".modal-content").html("<div class='bg-white border border-dark rounded text center col-12 col-md-6 mx-auto p-2'><i class='fas fa-trash-alt fa-3x text-danger mb-2'></i><br><span class='font-weight-bold'>Delete \"<span class='text-danger font-weight-bold'>" + delName + "</span>\". Confirm?</span><br><button type='button' id='delConBtn' data-index='" + index + "' class='btn btn-danger mr-1 mt-2'>Delete</button><button type='button' class='btn btn-warning ml-1 mt-2' data-dismiss='modal'>Cancel</button></div>");
        $(".modal").modal("show");
    });

    // confirm delete user / staff
    $(".modal-content").on("click", "#delConBtn", function () {
        userId = $(this).data("index");
        $(this).prop("disabled", true);
        if (adminPg == 1) {
            var deluser = 1;
        } else if (adminPg == 2) {
            var deluser = 2;
        } else if (adminPg == 3) {
            deluser = 3;
        }
        $.ajax({
            method: "post",
            url: "admin_endpoint.php",
            data: {
                userId: userId,
                deluser: deluser
            },
            success: function (data) {
                $(".modal").modal("hide");
                if (adminPg == 1) {
                    $("#addBtn").fadeOut(350);
                    $("#editBtn").fadeOut(350);
                    $("#delBtn").fadeOut(350);
                    $(".table").fadeOut(350, function () {
                        $(".table").addClass("text-center");
                        $(".table").html("<i class='fas fa-cog fa-spin fa-10x m-5'></i>");
                    });
                    $(".table").fadeIn(350);
                    $("#editBtn").prop("disabled", true);
                    $("#delBtn").prop("disabled", true);
                    $.ajax({
                        method: "get",
                        url: "admin_endpoint.php",
                        data: {
                            users: true
                        },
                        success: function (data) {
                            $(".table").fadeOut(350, function () {
                                $(".table").removeClass("text-center");
                                $(".table").html(data);
                            });
                            $(".table").fadeIn(350, function () {
                                $("#addBtn").fadeIn(350);
                                $("#editBtn").fadeIn(350);
                                $("#delBtn").fadeIn(350);
                            });
                        }
                    });
                    $(".register-modal-lg").modal("hide");
                    $(".modal").modal("hide");
                } else if (adminPg == 2) {
                    $.ajax({
                        method: "get",
                        url: "login_logout_endpoint.php",
                        data: {
                            logout: true
                        },
                        success: function (data) {
                            if (window.location.pathname.toLowerCase().indexOf("/products.php") >= 0) {
                                window.location.reload();
                            } else {
                                window.location.href = "products.php?sort=0&cat=0&brand=&minp=0&maxp=&search=&page=1";
                            }
                        }
                    });
                } else if (adminPg == 3) {
                    $("#addBtn").fadeOut(350);
                    $("#editBtn").fadeOut(350);
                    $("#delBtn").fadeOut(350);
                    $(".table").fadeOut(350, function () {
                        $(".table").addClass("text-center");
                        $(".table").html("<i class='fas fa-cog fa-spin fa-10x m-5'></i>");
                    });
                    $(".table").fadeIn(350);
                    $("#editBtn").prop("disabled", true);
                    $("#delBtn").prop("disabled", true);
                    $.ajax({
                        method: "get",
                        url: "admin_endpoint.php",
                        data: {
                            products: true
                        },
                        success: function (data) {
                            $(".table").fadeOut(350, function () {
                                $(".table").removeClass("text-center");
                                $(".table").html(data);
                            });
                            $(".table").fadeIn(350, function () {
                                $("#addBtn").fadeIn(350);
                                $("#editBtn").fadeIn(350);
                                $("#delBtn").fadeIn(350);
                            });
                        }
                    });
                }
            }
        });
    });
});