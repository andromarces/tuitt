"use strict" /* strict mode enabled */

$(function () { /* document ready function */
    var passwords = 0; /* 0 = passwords invalid, 1 = passwords OK */
    var username = 0; /* 0 = username invalid, 1 = username valid */
    var email = 0; /* 0 = email invalid, 1 email valid */

    // initialize datedropper
    $("#birthDay").dateDropper();
    $("#birthDay").val(null);
    $("#birthDay").prop("readonly", false);
    $("#birthDay").on('keydown paste', function (e) {
        e.preventDefault();
    });

    // check if email already exists in database
    $("#registerEmail").on("input", function () {
        var mail = $("#registerEmail").val();
        if ($("#registerEmail").val().length > 0) {
            email = 0;
            $(".regBtn").prop("disabled", true);
            if ($(".mailCheck").has("svg.fa-cog").length == 0) {
                $(".mailCheck").fadeOut(350, function () {
                    $(".mailCheck").addClass("font-weight-bold");
                    $(".mailCheck").html("<i class='fas fa-cog fa-spin'></i>");
                    $(".mailCheck").css("color", "#663");
                    $(".mailCheck").fadeIn(350);
                });
            }
            $.ajax({
                method: "get",
                url: "register_endpoint.php",
                data: {
                    mail: mail,
                    mailcheck: true
                },
                success: function (data) {
                    if (data == 1) {
                        email = 0;
                        $(".regBtn").prop("disabled", true);
                        $(".mailCheck").fadeOut(350, function () {
                            $(".mailCheck").addClass("font-weight-bold");
                            $(".mailCheck").html("Email already registered.");
                            $(".mailCheck").css("color", "red");
                            $(".mailCheck").fadeIn(350);
                        });
                    } else {
                        email = 1;
                        $(".mailCheck").fadeOut(350, function () {
                            $(".mailCheck").addClass("font-weight-bold");
                            $(".mailCheck").html("Email available.");
                            $(".mailCheck").css("color", "green");
                            $(".mailCheck").fadeIn(350);
                        });
                        if (passwords == 1 && username == 1 && email == 1) {
                            $(".regBtn").prop("disabled", false);
                        } else {
                            $(".regBtn").prop("disabled", true);
                        }
                    }
                }
            });
        } else {
            email = 0;
            $(".regBtn").prop("disabled", true);
            $(".mailCheck").fadeOut(350, function () {
                $(".mailCheck").removeClass("font-weight-bold");
                $(".mailCheck").css("color", "#6c757d");
                $(".mailCheck").empty();
                $(".mailCheck").fadeIn(350);
            });
        }
    });

    // check if username already exists in database
    $("#registerUsername").on("input", function () {
        var name = $("#registerUsername").val();
        if ($("#registerUsername").val().length > 32) {
            username = 0;
            $(".regBtn").prop("disabled", true);
            if ($(".userCheck").text() !== " Username is more than 32 characters.") {
                $(".userCheck").fadeOut(350, function () {
                    $(".userCheck").addClass("font-weight-bold");
                    $(".userCheck").text(" Username is more than 32 characters.");
                    $(".userCheck").css("color", "red");
                    $(".userCheck").fadeIn(350);
                });
            }
        } else if ($("#registerUsername").val().length > 0) {
            username = 0;
            $(".regBtn").prop("disabled", true);
            if ($(".userCheck").has("svg.fa-cog").length == 0) {
                $(".userCheck").fadeOut(350, function () {
                    $(".userCheck").addClass("font-weight-bold");
                    $(".userCheck").html("<i class='fas fa-cog fa-spin'></i>");
                    $(".userCheck").css("color", "#663");
                    $(".userCheck").fadeIn(350);
                });
            }
            $.ajax({
                method: "get",
                url: "register_endpoint.php",
                data: {
                    name: name,
                    namecheck: true
                },
                success: function (data) {
                    if (data == 1) {
                        username = 0;
                        $(".regBtn").prop("disabled", true);
                        $(".userCheck").fadeOut(350, function () {
                            $(".userCheck").addClass("font-weight-bold");
                            $(".userCheck").html("Username not available.")
                            $(".userCheck").css("color", "red");
                            $(".userCheck").fadeIn(350);
                        });
                    } else {
                        username = 1;
                        $(".userCheck").fadeOut(350, function () {
                            $(".userCheck").addClass("font-weight-bold");
                            $(".userCheck").html("Username available.");
                            $(".userCheck").css("color", "green");
                            $(".userCheck").fadeIn(350);
                        });
                        if (passwords == 1 && username == 1 && email == 1) {
                            $(".regBtn").prop("disabled", false);
                        } else {
                            $(".regBtn").prop("disabled", true);
                        }
                    }
                }
            });
        } else {
            username = 0;
            $(".regBtn").prop("disabled", true);
            $(".userCheck").fadeOut(350, function () {
                $(".userCheck").removeClass("font-weight-bold");
                $(".userCheck").css("color", "#6c757d");
                $(".userCheck").html("Maximum 32 characters long. No spaces at start and end.");
                $(".userCheck").fadeIn(350);
            });
        }
    });

    // check if passwords match and are more than 6 characters
    $(".newPass").on("input", function () {
        var length = 0;
        var match = 0;
        if ($("#registerPassword2").val().length < 6 && $("#registerPassword2").val().length > 0 && $("#registerPassword1").val().length < 6 && $("#registerPassword1").val().length > 0) {
            length = 0;
            if ($(".lengthCheck").text() !== " Password less than 6 characters.") {
                $(".lengthCheck").fadeOut(350, function () {
                    $(".lengthCheck").text(" Password less than 6 characters.");
                    $(".lengthCheck").css("color", "red");
                    $(".lengthCheck").fadeIn(350);
                });
            }
        } else {
            length = 1;
            $(".lengthCheck").fadeOut(350, function () {
                $(".lengthCheck").empty();
            });
        }
        if ($("#registerPassword2").val() == "" || $("#registerPassword1").val() == "") {
            match = 0;
            $(".matchCheck").fadeOut(350, function () {
                $(".matchCheck").empty();
            });
            $(".lengthCheck").fadeOut(350, function () {
                $(".lengthCheck").empty();
            });
        } else if ($("#registerPassword2").val() != $("#registerPassword1").val()) {
            match = 0;
            if ($(".matchCheck").html() !== "Passwords not matching.") {
                $(".matchCheck").fadeOut(350, function () {
                    $(".matchCheck").css("color", "red");
                    $(".matchCheck").html("Passwords not matching.");
                    $(".matchCheck").fadeIn(350);
                });
            }
        } else {
            match = 1;
            $(".matchCheck").fadeOut(350, function () {
                $(".matchCheck").css("color", "green");
                $(".matchCheck").html("Passwords matching.");
                $(".matchCheck").fadeIn(350);
            });
        }
        if (match == 1 && length == 1) {
            passwords = 1;
        } else {
            passwords = 0;
        }
        if (passwords == 1 && username == 1 && email == 1) {
            $(".regBtn").prop("disabled", false);
        } else {
            $(".regBtn").prop("disabled", true);
        }
    });

    // display list of regions when user picks a country
    $("#country").change(function () {
        var country = $("#country option:selected").text();
        var id = $("#country option:selected").val();
        if (country == "Philippines" && id == 164) {
            if ($(".region").html() == "") {
                $(".region").addClass("text-center");
                $(".region").html("<i class='far fa-compass fa-spin fa-3x'></i>");
            } else {
                $(".region").fadeOut(350, function () {
                    $(".region").addClass("text-center");
                    $(".region").html("<i class='far fa-compass fa-spin fa-3x'></i>");
                });
            }
            $(".region").fadeIn(350);
            $.ajax({
                method: "get",
                url: "register_endpoint.php",
                data: {
                    index: id,
                    hasregion: "phil"
                },
                success: function (data) {
                    $(".region").fadeOut(350, function () {
                        $(".region").removeClass("text-center");
                        $(".region").html(data);
                        $(".region").fadeIn(350);
                    });
                }
            });
        } else if ($.inArray(country, noRegion) < 0 && id !== "") {
            $(".city").slideUp(350, function () {
                $(".city").empty();
                $(".city").removeClass("text-center");
            });
            $(".province").fadeOut(350, function () {
                $(".province").empty();
                $(".province").removeClass("text-center");
            });
            if ($(".region").html() == "") {
                $(".region").addClass("text-center");
                $(".region").html("<i class='far fa-compass fa-spin fa-3x'></i>");
            } else {
                $(".region").fadeOut(350, function () {
                    $(".region").addClass("text-center");
                    $(".region").html("<i class='far fa-compass fa-spin fa-3x'></i>");
                });
            }
            $(".region").fadeIn(350);
            $.ajax({
                method: "get",
                url: "register_endpoint.php",
                data: {
                    index: id,
                    hasregion: "intl"
                },
                success: function (data) {
                    $(".region").fadeOut(350, function () {
                        $(".region").removeClass("text-center");
                        $(".region").html(data);
                        $(".region").fadeIn(350);
                    });
                }
            });
        } else {
            $(".region").fadeOut(350, function () {
                $(".region").empty();
                $(".region").removeClass("text-center");
            });
            $(".city").slideUp(350, function () {
                $(".city").empty();
                $(".city").removeClass("text-center");
            });
            $(".province").fadeOut(350, function () {
                $(".province").empty();
                $(".province").removeClass("text-center");
            });
        }
    });

    // change first option of intl region to "Not in List / Other" when user clicks on select
    $(".region").on("click", "#intlregion", function () {
        if ($("#notInList").text() == "Select Region / State") {
            $("#notInList").attr("value", 0);
            $("#notInList").text("Not in List / Other");
        }
    });

    // display list of provinces when user picks a Philippine region
    $(".region").on("change", "#philregion", function () {
        var id = $("#philregion option:selected").val();
        if (id !== "") {
            $(".city").slideUp(350, function () {
                $(".city").empty();
                $(".city").removeClass("text-center");
            });
            if ($(".province").html() == "") {
                $(".province").addClass("text-center");
                $(".province").html("<i class='far fa-compass fa-spin fa-3x'></i>");
            } else {
                $(".province").fadeOut(350, function () {
                    $(".province").addClass("text-center");
                    $(".province").html("<i class='far fa-compass fa-spin fa-3x'></i>");
                });
            }
            $(".province").fadeIn(350);
            $.ajax({
                method: "get",
                url: "register_endpoint.php",
                data: {
                    index: id,
                    province: true
                },
                success: function (data) {
                    $(".province").fadeOut(350, function () {
                        $(".province").removeClass("text-center");
                        $(".province").html(data);
                        $(".province").fadeIn(350);
                    });
                }
            });
        } else {
            $(".city").slideUp(350, function () {
                $(".city").empty();
                $(".city").removeClass("text-center");
            });
            $(".province").fadeOut(350, function () {
                $(".province").empty();
                $(".province").removeClass("text-center");
            });
        }
    });

    // display list of cities / municipalities when user picks a Philippine province
    $(".province").on("change", "#province", function () {
        var id = $("#province option:selected").val();
        if (id !== "") {
            if ($(".city").html() == "") {
                $(".city").addClass("text-center");
                $(".city").html("<i class='far fa-compass fa-spin fa-3x'></i>");
            } else {
                $(".city").fadeOut(350, function () {
                    $(".city").addClass("text-center");
                    $(".city").html("<i class='far fa-compass fa-spin fa-3x'></i>");
                });
            }
            $(".city").fadeIn(350);
            $.ajax({
                method: "get",
                url: "register_endpoint.php",
                data: {
                    index: id,
                    city: true
                },
                success: function (data) {
                    $(".city").fadeOut(350, function () {
                        $(".city").removeClass("text-center");
                        $(".city").html(data);
                        $(".city").fadeIn(350);
                    });
                }
            });
        } else {
            $(".city").slideUp(350, function () {
                $(".city").empty();
                $(".city").removeClass("text-center");
            });
        }
    });

    // set max days in date field depending on month and year
    $("#birthMonth").on("change", function () {
        var month = $("#birthMonth").val();
        if (month == 1 || month == 3 || month == 5 || month == 7 || month == 8 || month == 10 || month == 12) {
            $("#birthDate").attr("max", 31);
        } else if (month == 2) {
            if ($("#birthYear").val() % 4 || $("#birthYear").val() == 2000) {
                $("#birthDate").attr("max", 29);
            } else {
                $("#birthDate").attr("max", 28);
            }
        } else {
            $("#birthDate").attr("max", 30);
        }
    });

    $("#birthYear").on("input", function () {
        if (($("#birthYear").val() % 4) === 0 || $("#birthYear").val() == 2000) {
            if ($("#birthMonth").val() == 2) {
                $("#birthDate").attr("max", 29);
            }
        } else {
            if ($("#birthMonth").val() == 2) {
                $("#birthDate").attr("max", 28);
            }
        }
    });

    // submit form and register user
    $("#regForm").on("submit", function (e) {
        e.preventDefault();
        $(".modal-content").html("<i class='fas fa-cog fa-spin align-self-center fa-5x'></i><span class='modal-text font-weight-bold'>Please wait while you are registered and signed-in.</span>");
        $(".register-modal-lg").modal({
            backdrop: 'static'
        });
        var firstname = $("#firstName").val();
        var lastname = $("#lastName").val();
        var email = $("#registerEmail").val();
        var username = $("#registerUsername").val();
        var password = $("#registerPassword1").val();
        var sex = $("#inputSex").val();
        var birthday = ($("#birthYear").val() + "-" + $("#birthMonth").val() + "-" + $("#birthDate").val());
        var country = $("#country").val();
        var philregion = $("#philregion").val();
        var intlregion = $("#intlregion").val();
        var province = $("#province").val();
        var city = $("#city").val();
        var address = $("#address").val();
        $.ajax({
            method: "post",
            url: "register_endpoint.php",
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
                register: true
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
                    window.location.href = "products.php?"
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