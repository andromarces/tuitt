"use strict"

$(function () {
    // document ready variables
    var passwords = 0; /* 0 = passwords invalid, 1 = passwords OK */
    var username = 0; /* 0 = username invalid, 1 = username valid */
    var email = 0; /* 0 = email invalid, 1 email valid */

    // check username & email for edit account on load
    // check username
    if ($("#orangeForm-name2").val() !== "") {
        var token = $("#token").data("token");
        var usernameCheck = $("#orangeForm-name2").val();
        $.ajax({
            method: "post",
            url: "checkUsername",
            data: {
                _token: token,
                username: usernameCheck
            },
            success: function (data) {
                if (usernameCheck == "") {
                    $("#usernameValidation2").empty();
                    $("#updateBtn").prop("disabled", true);
                    username = 0;
                } else if (data == 1) {
                    $("#usernameValidation2").css("color", "red");
                    $("#usernameValidation2").html("Username not available.");
                    $("#updateBtn").prop("disabled", true);
                    username = 0;
                } else {
                    $("#usernameValidation2").css("color", "green");
                    $("#usernameValidation2").html("Username available.");
                    username = 1;
                }
            },
            error: function (data) {
                console.log(data.responseText);
            }
        });
        // check email
        var emailreg = $("#orangeForm-email2").val();
        $.ajax({
            method: "post",
            url: "checkEmail",
            data: {
                _token: token,
                email: emailreg
            },
            success: function (data) {
                if (emailreg == "") {
                    $("#emailValidation2").empty();
                    $("#updateBtn").prop("disabled", true);
                    email = 0;
                } else if (data == 1) {
                    $("#emailValidation2").css("color", "red");
                    $("#emailValidation2").html("Email not available.");
                    $("#updateBtn").prop("disabled", true);
                    email = 0;
                } else {
                    $("#emailValidation2").css("color", "green");
                    $("#emailValidation2").html("Email available.");
                    email = 1;
                }
            },
            error: function (data) {
                console.log(data.responseText);
            }
        });
    }


    // register user
    $("#modalRegisterForm").submit(function (e) {
        e.preventDefault();
        var token = $("#token").data("token");
        var name = $("#orangeForm-name").val();
        var emailreg = $("#orangeForm-email").val();
        var password = $("#orangeForm-pass").val();
        var password2 = $("#orangeForm-pass2").val();
        $("#modalRegisterForm input").prop("disabled", true);
        $("#registerBtn").prop("disabled", true);
        $("#ganapNavbar button").prop("disabled", true);
        $.ajax({
            method: "post",
            url: "register",
            data: {
                _token: token,
                username: name,
                email: emailreg,
                password: password,
                password_confirmation: password2
            },
            success: function (data) {
                $("#modalRegisterForm input").prop("disabled", false);
                $("#modalRegisterForm input").val("");
                $("#modalRegisterForm form")[0].reset();
                $("#passwordValidation").empty();
                $("#emailValidation").empty();
                $("#usernameValidation").empty();
                $("#modalRegisterForm").modal("hide");
                passwords = 0;
                username = 0;
                email = 0;
                $("#editAcctParent").load(" #editAcctForm");
                $("#csrf").load(" #token");
                $("#hiddenDiv1").load(" .navbar-nav", function () {
                    $("#ganapNavbar").fadeOut(function () {
                        $("#ganapNavbar").empty();
                        $("#ganapNavbar").html($("#hiddenDiv1").html());
                        $("#ganapNavbar").fadeIn();
                        $("#hiddenDiv1").empty();
                    });
                });
                $("#hiddenDiv2").load(" #eventsContent", function () {
                    $("#eventsParent").fadeOut(function () {
                        $("#eventsParent").empty();
                        $("#eventsParent").html($("#hiddenDiv2").html());
                        $("#eventsParent").fadeIn();
                        $("#hiddenDiv2").empty();
                    });
                });
                $("#hiddenDiv3").load(" #addEvent", function () {
                    $("#addEventParent").fadeOut(function () {
                        $("#addEventParent").empty();
                        $("#addEventParent").html($("#hiddenDiv3").html());
                        $("#addEventParent").fadeIn();
                        $("#hiddenDiv3").empty();
                    });
                });
            },
            error: function (data) {
                console.log(data.responseText);
                $("#modalRegisterForm input").prop("disabled", false);
                $("#registerBtn").prop("disabled", false);
                $("#ganapNavbar button").prop("disabled", false);
            }
        });
    });

    // logout user
    $("#ganapNavbar").on("click", ".logOut", function (e) {
        e.preventDefault();
        var token = $("#token").data("token");
        $("#ganapNavbar a").addClass("disabledLink");
        $("#mainContent button").prop("disabled", true);
        $("#mainContent a").addClass("disabledLink");
        $.ajax({
            method: "post",
            url: "logout",
            data: {
                _token: token
            },
            success: function (data) {
                $("#csrf").load(" #token");
                $("#hiddenDiv1").load(" .navbar-nav", function () {
                    $("#ganapNavbar").fadeOut(function () {
                        $("#ganapNavbar").empty();
                        $("#ganapNavbar").html($("#hiddenDiv1").html());
                        $("#ganapNavbar").fadeIn();
                        $("#hiddenDiv1").empty();
                    });
                });
                $("#hiddenDiv2").load(" #eventsContent", function () {
                    $("#eventsParent").fadeOut(function () {
                        $("#eventsParent").empty();
                        $("#eventsParent").html($("#hiddenDiv2").html());
                        $("#eventsParent").fadeIn();
                        $("#hiddenDiv2").empty();
                    });
                });
                $("#hiddenDiv3").load(" #addEvent", function () {
                    $("#addEventParent").fadeOut(function () {
                        $("#addEventParent").empty();
                        $("#addEventParent").html($("#hiddenDiv3").html());
                        $("#addEventParent").fadeIn();
                        $("#hiddenDiv3").empty();
                    });
                });
            },
            error: function (data) {
                console.log(data.responseText);
                $("#ganapNavbar a").removeClass("disabledLink");
                $("#mainContent button").prop("disabled", false);
                $("#mainContent a").removeClass("disabledLink");
            }
        });
    });

    // login user
    $("#ganapNavbar").on("submit", "#loginForm", function (e) {
        e.preventDefault();
        var token = $("#token").data("token");
        var name = $("#DropdownFormUsername").val();
        var password = $("#DropdownFormPassword").val();
        $("#modalRegisterForm input").prop("disabled", true);
        $("#ganapNavbar button").prop("disabled", true);
        $("#ganapNavbar input").prop("disabled", true);
        $("#ganapNavbar a").addClass("disabledLink");
        if ($("#registerBtn").prop("disabled") == false) {
            var disabled = 0;
            $("#registerBtn").prop("disabled", true);
        } else {
            var disabled = 1;
        }
        $.ajax({
            method: "post",
            url: "login",
            data: {
                _token: token,
                username: name,
                password: password
            },
            success: function (data) {
                $("#modalRegisterForm input").prop("disabled", false);
                $("#modalRegisterForm input").prop("disabled", false);
                $("#modalRegisterForm input").val("");
                $("#modalRegisterForm form")[0].reset();
                $("#passwordValidation").empty();
                $("#emailValidation").empty();
                $("#usernameValidation").empty();
                $("#registerBtn").prop("disabled", true);
                passwords = 0;
                username = 0;
                email = 0;
                $("#editAcctParent").load(" #editAcctForm", function () {
                    // check username if available for edit account
                    var token = $("#token").data("token");
                    var usernameCheck = $("#orangeForm-name2").val();
                    $.ajax({
                        method: "post",
                        url: "checkUsername",
                        data: {
                            _token: token,
                            username: usernameCheck
                        },
                        success: function (data) {
                            if (usernameCheck == "") {
                                $("#usernameValidation2").empty();
                                $("#updateBtn").prop("disabled", true);
                                username = 0;
                            } else if (data == 1) {
                                $("#usernameValidation2").css("color", "red");
                                $("#usernameValidation2").html("Username not available.");
                                $("#updateBtn").prop("disabled", true);
                                username = 0;
                            } else {
                                $("#usernameValidation2").css("color", "green");
                                $("#usernameValidation2").html("Username available.");
                                username = 1;
                            }
                        },
                        error: function (data) {
                            console.log(data.responseText);
                        }
                    });
                    // check email if available for edit account
                    var emailreg = $("#orangeForm-email2").val();
                    $.ajax({
                        method: "post",
                        url: "checkEmail",
                        data: {
                            _token: token,
                            email: emailreg
                        },
                        success: function (data) {
                            if (emailreg == "") {
                                $("#emailValidation2").empty();
                                $("#updateBtn").prop("disabled", true);
                                email = 0;
                            } else if (data == 1) {
                                $("#emailValidation2").css("color", "red");
                                $("#emailValidation2").html("Email not available.");
                                $("#updateBtn").prop("disabled", true);
                                email = 0;
                            } else {
                                $("#emailValidation2").css("color", "green");
                                $("#emailValidation2").html("Email available.");
                                email = 1;
                            }
                        },
                        error: function (data) {
                            console.log(data.responseText);
                        }
                    });
                });
                $("#hiddenDiv1").load(" .navbar-nav", function () {
                    $("#ganapNavbar").fadeOut(function () {
                        $("#ganapNavbar").empty();
                        $("#ganapNavbar").html($("#hiddenDiv1").html());
                        $("#ganapNavbar").fadeIn();
                        $("#hiddenDiv1").empty();
                    });
                });
                $("#hiddenDiv2").load(" #eventsContent", function () {
                    $("#eventsParent").fadeOut(function () {
                        $("#eventsParent").empty();
                        $("#eventsParent").html($("#hiddenDiv2").html());
                        $("#eventsParent").fadeIn();
                        $("#hiddenDiv2").empty();
                    });
                });
                $("#hiddenDiv3").load(" #addEvent", function () {
                    $("#addEventParent").fadeOut(function () {
                        $("#addEventParent").empty();
                        $("#addEventParent").html($("#hiddenDiv3").html());
                        $("#addEventParent").fadeIn();
                        $("#hiddenDiv3").empty();
                    });
                });
                $("#hiddenDiv4").load(" #delUserSelect", function () {
                    $("#delUserForm").fadeOut(function () {
                        $("#delUserForm").empty();
                        $("#delUserForm").html($("#hiddenDiv4").html());
                        $("#delUserForm").fadeIn();
                        $("#hiddenDiv4").empty();
                    });
                });
                $("#csrf").load(" #token");
            },
            error: function (data) {
                $("#ganapNavbar input").prop("disabled", false);
                $("#ganapNavbar button").prop("disabled", false);
                $("#ganapNavbar a").removeClass("disabledLink");
                $("#modalRegisterForm input").prop("disabled", false);
                if (disabled == 0) {
                    $("#registerBtn").prop("disabled", false);
                } else {
                    $("#registerBtn").prop("disabled", true);
                }
                console.log(data.responseText);
            }
        });
    });

    // check email if available
    $("#orangeForm-email").on("input", function () {
        var token = $("#token").data("token");
        var emailreg = $(this).val();
        $.ajax({
            method: "post",
            url: "checkEmail",
            data: {
                _token: token,
                email: emailreg
            },
            success: function (data) {
                if (emailreg == "") {
                    $("#emailValidation").empty();
                    $("#registerBtn").prop("disabled", true);
                    email = 0;
                } else if (data == 1) {
                    $("#emailValidation").css("color", "red");
                    $("#emailValidation").html("Email not available.");
                    $("#registerBtn").prop("disabled", true);
                    email = 0;
                } else {
                    $("#emailValidation").css("color", "green");
                    $("#emailValidation").html("Email available.");
                    email = 1;
                    if (passwords == 1 && username == 1 && email == 1) {
                        $("#registerBtn").prop("disabled", false);
                    }
                }
            },
            error: function (data) {
                console.log(data.responseText);
            }
        });
    });

    // check username if available
    $("#orangeForm-name").on("input", function () {
        var token = $("#token").data("token");
        var usernameCheck = $(this).val();
        $.ajax({
            method: "post",
            url: "checkUsername",
            data: {
                _token: token,
                username: usernameCheck
            },
            success: function (data) {
                if (usernameCheck == "") {
                    $("#usernameValidation").empty();
                    $("#registerBtn").prop("disabled", true);
                    username = 0;
                } else if (data == 1) {
                    $("#usernameValidation").css("color", "red");
                    $("#usernameValidation").html("Username not available.");
                    $("#registerBtn").prop("disabled", true);
                    username = 0;
                } else {
                    $("#usernameValidation").css("color", "green");
                    $("#usernameValidation").html("Username available.");
                    username = 1;
                    if (passwords == 1 && username == 1 && email == 1) {
                        $("#registerBtn").prop("disabled", false);
                    }
                }
            },
            error: function (data) {
                console.log(data.responseText);
            }
        });
    });

    // check passwords if matching
    $("#orangeForm-pass").on("input", function () {
        if ($("#orangeForm-pass").val() == "" || $("#orangeForm-pass2").val() == "") {
            $("#passwordValidation").empty();
            $("#registerBtn").prop("disabled", true);
            passwords = 0;
        } else if ($("#orangeForm-pass").val().length < 6 || $("#orangeForm-pass2").val().length < 6) {
            $("#registerBtn").prop("disabled", true);
            passwords = 0;
            $("#passwordValidation").css("color", "red");
            $("#passwordValidation").html("Both passwords must be more than 6 characters.");
        } else if ($("#orangeForm-pass").val() == $("#orangeForm-pass2").val()) {
            passwords = 1;
            $("#passwordValidation").css("color", "green");
            $("#passwordValidation").html("Passwords matching.");
            if (passwords == 1 && username == 1 && email == 1) {
                $("#registerBtn").prop("disabled", false);
            }
        } else if ($("#orangeForm-pass").val().length > 6 && $("#orangeForm-pass2").val().length > 6) {
            $("#registerBtn").prop("disabled", true);
            passwords = 0;
            $("#passwordValidation").css("color", "red");
            $("#passwordValidation").html("Both passwords must match.");
        }
    });

    $("#orangeForm-pass2").on("input", function () {
        if ($("#orangeForm-pass").val() == "" || $("#orangeForm-pass2").val() == "") {
            $("#passwordValidation").empty();
            $("#registerBtn").prop("disabled", true);
            passwords = 0;
        } else if ($("#orangeForm-pass").val().length < 6 || $("#orangeForm-pass2").val().length < 6) {
            $("#registerBtn").prop("disabled", true);
            passwords = 0;
            $("#passwordValidation").css("color", "red");
            $("#passwordValidation").html("Both passwords must be more than 6 characters.");
        } else if ($("#orangeForm-pass").val() == $("#orangeForm-pass2").val()) {
            passwords = 1;
            $("#passwordValidation").css("color", "green");
            $("#passwordValidation").html("Passwords matching.");
            if (passwords == 1 && username == 1 && email == 1) {
                $("#registerBtn").prop("disabled", false);
            }
        } else if ($("#orangeForm-pass").val().length > 6 && $("#orangeForm-pass2").val().length > 6) {
            $("#registerBtn").prop("disabled", true);
            passwords = 0;
            $("#passwordValidation").css("color", "red");
            $("#passwordValidation").html("Both passwords must match.");
        }
    });

    $("#orangeForm-pass3").on("input", function () {
        if ($("#orangeForm-pass3").val() == "" || $("#orangeForm-pass4").val() == "") {
            $("#passwordValidation2").empty();
            $("#changeBtn").prop("disabled", true);
        } else if ($("#orangeForm-pass3").val().length < 6 || $("#orangeForm-pass4").val().length < 6) {
            $("#passwordValidation2").css("color", "red");
            $("#passwordValidation2").html("Both passwords must be more than 6 characters.");
            $("#changeBtn").prop("disabled", true);
        } else if ($("#orangeForm-pass3").val() == $("#orangeForm-pass4").val()) {
            $("#passwordValidation2").css("color", "green");
            $("#passwordValidation2").html("Passwords matching.");
            $("#changeBtn").prop("disabled", false);
        } else if ($("#orangeForm-pass3").val().length > 6 && $("#orangeForm-pass4").val().length > 6) {
            $("#passwordValidation2").css("color", "red");
            $("#passwordValidation2").html("Both passwords must match.");
            $("#changeBtn").prop("disabled", true);
        }
    });

    $("#orangeForm-pass4").on("input", function () {
        if ($("#orangeForm-pass3").val() == "" || $("#orangeForm-pass4").val() == "") {
            $("#passwordValidation2").empty();
            $("#changeBtn").prop("disabled", true);
        } else if ($("#orangeForm-pass3").val().length < 6 || $("#orangeForm-pass4").val().length < 6) {
            $("#passwordValidation2").css("color", "red");
            $("#passwordValidation2").html("Both passwords must be more than 6 characters.");
            $("#changeBtn").prop("disabled", true);
        } else if ($("#orangeForm-pass3").val() == $("#orangeForm-pass4").val()) {
            $("#passwordValidation2").css("color", "green");
            $("#passwordValidation2").html("Passwords matching.");
            $("#changeBtn").prop("disabled", false);
        } else if ($("#orangeForm-pass3").val().length > 6 && $("#orangeForm-pass4").val().length > 6) {
            $("#passwordValidation2").css("color", "red");
            $("#passwordValidation2").html("Both passwords must match.");
            $("#changeBtn").prop("disabled", true);
        }
    });

    $("#orangeForm-pass5").on("input", function () {
        if ($("#orangeForm-pass5").val() == "" || $("#orangeForm-pass6").val() == "") {
            $("#passwordValidation3").empty();
            $("#adminBtn").prop("disabled", true);
        } else if ($("#orangeForm-pass5").val().length < 6 || $("#orangeForm-pass6").val().length < 6) {
            $("#passwordValidation3").css("color", "red");
            $("#passwordValidation3").html("Both passwords must be more than 6 characters.");
            $("#adminBtn").prop("disabled", true);
        } else if ($("#orangeForm-pass5").val() == $("#orangeForm-pass6").val()) {
            $("#passwordValidation3").css("color", "green");
            $("#passwordValidation3").html("Passwords matching.");
            $("#adminBtn").prop("disabled", false);
        } else if ($("#orangeForm-pass5").val().length > 6 && $("#orangeForm-pass6").val().length > 6) {
            $("#passwordValidation3").css("color", "red");
            $("#passwordValidation3").html("Both passwords must match.");
            $("#adminBtn").prop("disabled", true);
        }
    });

    $("#orangeForm-pass6").on("input", function () {
        if ($("#orangeForm-pass5").val() == "" || $("#orangeForm-pass6").val() == "") {
            $("#passwordValidation3").empty();
            $("#adminBtn").prop("disabled", true);
        } else if ($("#orangeForm-pass5").val().length < 6 || $("#orangeForm-pass6").val().length < 6) {
            $("#passwordValidation3").css("color", "red");
            $("#passwordValidation3").html("Both passwords must be more than 6 characters.");
            $("#adminBtn").prop("disabled", true);
        } else if ($("#orangeForm-pass5").val() == $("#orangeForm-pass6").val()) {
            $("#passwordValidation3").css("color", "green");
            $("#passwordValidation3").html("Passwords matching.");
            $("#adminBtn").prop("disabled", false);
        } else if ($("#orangeForm-pass5").val().length > 6 && $("#orangeForm-pass6").val().length > 6) {
            $("#passwordValidation3").css("color", "red");
            $("#passwordValidation3").html("Both passwords must match.");
            $("#adminBtn").prop("disabled", true);
        }
    });

    // edit password
    $("#modalChangeForm").submit(function (e) {
        e.preventDefault();
        var token = $("#token").data("token");
        var password = $("#orangeForm-pass3").val();
        var password2 = $("#orangeForm-pass4").val();
        $("#modalChangeForm").find("input, button").prop("disabled", true);
        $.ajax({
            method: "post",
            url: "editPassword",
            data: {
                _token: token,
                password: password,
                password_confirmation: password2
            },
            success: function (data) {
                $("#modalChangeForm").find("input").prop("disabled", false);
                $("#modalChangeForm input").val("");
                $("#modalChangeForm form")[0].reset();
                $("#passwordValidation2").empty();
                $("#modalChangeForm").modal("hide");
            },
            error: function (data) {
                $("#modalChangeForm").find("input, button").prop("disabled", false);
                console.log(data.responseText);
            }
        });
    });

    // check username if available for edit account
    $("#editAcctParent").on("input", "#orangeForm-name2", function () {
        var token = $("#token").data("token");
        var usernameCheck = $(this).val();
        $.ajax({
            method: "post",
            url: "checkUsername",
            data: {
                _token: token,
                username: usernameCheck
            },
            success: function (data) {
                if (usernameCheck == "") {
                    $("#usernameValidation2").empty();
                    $("#updateBtn").prop("disabled", true);
                    username = 0;
                } else if (data == 1) {
                    $("#usernameValidation2").css("color", "red");
                    $("#usernameValidation2").html("Username not available.");
                    $("#updateBtn").prop("disabled", true);
                    username = 0;
                } else {
                    $("#usernameValidation2").css("color", "green");
                    $("#usernameValidation2").html("Username available.");
                    username = 1;
                    if (username == 1 && email == 1) {
                        $("#updateBtn").prop("disabled", false);
                    }
                }
            },
            error: function (data) {
                console.log(data.responseText);
            }
        });
    });

    // check email if available for edit account
    $("#editAcctParent").on("input", "#orangeForm-email2", function () {
        var token = $("#token").data("token");
        var emailreg = $(this).val();
        $.ajax({
            method: "post",
            url: "checkEmail",
            data: {
                _token: token,
                email: emailreg
            },
            success: function (data) {
                if (emailreg == "") {
                    $("#emailValidation2").empty();
                    $("#updateBtn").prop("disabled", true);
                    email = 0;
                } else if (data == 1) {
                    $("#emailValidation2").css("color", "red");
                    $("#emailValidation2").html("Email not available.");
                    $("#updateBtn").prop("disabled", true);
                    email = 0;
                } else {
                    $("#emailValidation2").css("color", "green");
                    $("#emailValidation2").html("Email available.");
                    email = 1;
                    if (username == 1 && email == 1) {
                        $("#updateBtn").prop("disabled", false);
                    }
                }
            },
            error: function (data) {
                console.log(data.responseText);
            }
        });
    });

    // update user
    $("#modalEditForm").submit(function (e) {
        e.preventDefault();
        var token = $("#token").data("token");
        var name = $("#orangeForm-name2").val();
        var emailreg = $("#orangeForm-email2").val();
        $("#editAcctParent").find("input, button").prop("disabled", true);
        $.ajax({
            method: "post",
            url: "updateUser",
            data: {
                _token: token,
                username: name,
                email: emailreg,
            },
            success: function (data) {
                $("#modalEditForm").modal("hide");
                $("#editAcctParent").find("input, button").prop("disabled", false);
                username = 0;
                email = 0;
                $("#csrf").load(" #token");
                $("#hiddenDiv1").load(" .navbar-nav", function () {
                    $("#ganapNavbar").fadeOut(function () {
                        $("#ganapNavbar").empty();
                        $("#ganapNavbar").html($("#hiddenDiv1").html());
                        $("#ganapNavbar").fadeIn();
                        $("#hiddenDiv1").empty();
                    });
                });
            },
            error: function (data) {
                $("#editAcctParent").find("input, button").prop("disabled", false);
                console.log(data.responseText);
            }
        });
    });

    // reset variables on modal hide
    $(".modal").on("hidden.bs.modal", function () {
        passwords = 0;
        username = 0;
        email = 0;
    });

    // set variables on clicking edit account
    $("#ganapNavbar").on("click", ".editAcct", function () {
        username = 1;
        email = 1;
    });

    // check email if available
    $("#orangeForm-email3").on("input", function () {
        var token = $("#token").data("token");
        var emailreg = $(this).val();
        $.ajax({
            method: "post",
            url: "checkEmail",
            data: {
                _token: token,
                email: emailreg
            },
            success: function (data) {
                if (emailreg == "") {
                    $("#emailValidation3").empty();
                    $("#adminBtn").prop("disabled", true);
                    email = 0;
                } else if (data == 1) {
                    $("#emailValidation3").css("color", "red");
                    $("#emailValidation3").html("Email not available.");
                    $("#adminBtn").prop("disabled", true);
                    email = 0;
                } else {
                    $("#emailValidation3").css("color", "green");
                    $("#emailValidation3").html("Email available.");
                    email = 1;
                    if (passwords == 1 && username == 1 && email == 1) {
                        $("#adminBtn").prop("disabled", false);
                    }
                }
            },
            error: function (data) {
                console.log(data.responseText);
            }
        });
    });

    // check username if available
    $("#orangeForm-name3").on("input", function () {
        var token = $("#token").data("token");
        var usernameCheck = $(this).val();
        $.ajax({
            method: "post",
            url: "checkUsername",
            data: {
                _token: token,
                username: usernameCheck
            },
            success: function (data) {
                if (usernameCheck == "") {
                    $("#usernameValidation3").empty();
                    $("#adminBtn").prop("disabled", true);
                    username = 0;
                } else if (data == 1) {
                    $("#usernameValidation3").css("color", "red");
                    $("#usernameValidation3").html("Username not available.");
                    $("#adminBtn").prop("disabled", true);
                    username = 0;
                } else {
                    $("#usernameValidation3").css("color", "green");
                    $("#usernameValidation3").html("Username available.");
                    username = 1;
                    if (passwords == 1 && username == 1 && email == 1) {
                        $("#adminBtn").prop("disabled", false);
                    }
                }
            },
            error: function (data) {
                console.log(data.responseText);
            }
        });
    });

    // create admin
    $("#modalAdminForm").submit(function (e) {
        e.preventDefault();
        var token = $("#token").data("token");
        var name = $("#orangeForm-name3").val();
        var emailreg = $("#orangeForm-email3").val();
        var password = $("#orangeForm-pass5").val();
        var password2 = $("#orangeForm-pass6").val();
        $("#modalAdminForm").find("input, button").prop("disabled", true);
        $.ajax({
            method: "post",
            url: "createAdmin",
            data: {
                _token: token,
                username: name,
                email: emailreg,
                password: password,
                password_confirmation: password2
            },
            success: function (data) {
                $("#modalAdminForm").find("input").prop("disabled", false);
                $("#modalAdminForm input").val("");
                $("#modalAdminForm form")[0].reset();
                $("#passwordValidation3").empty();
                $("#emailValidation3").empty();
                $("#usernameValidation3").empty();
                $("#modalAdminForm").modal("hide");
                passwords = 0;
                username = 0;
                email = 0;
                $("#csrf").load(" #token");
            },
            error: function (data) {
                $("#modalAdminForm").find("input, button").prop("disabled", false);
                console.log(data.responseText);
            }
        });
    });

    // set max days in date field depending on month and year
    $("#eventMonth").on("change", function () {
        var month = $("#eventMonth").val();
        if (month == 1 || month == 3 || month == 5 || month == 7 || month == 8 || month == 10 || month == 12) {
            $("#eventDate").attr("max", 31);
        } else if (month == 2) {
            if ($("#eventYear").val() % 4) {
                $("#eventDate").attr("max", 29);
            } else {
                $("#eventDate").attr("max", 28);
            }
        } else {
            $("#eventDate").attr("max", 30);
        }
    });

    $("#eventYear").on("input", function () {
        if (($("#eventYear").val() % 4) === 0) {
            if ($("#eventMonth").val() == 2) {
                $("#eventDate").attr("max", 29);
            }
        } else {
            if ($("#eventMonth").val() == 2) {
                $("#eventDate").attr("max", 28);
            }
        }
    });

    // create event
    $("#createEventForm").on("submit", function (e) {
        e.preventDefault();
        var eventName = $("#eventName").val();
        var eventVenue = $("#eventVenue").val();
        var eventImg = $("#eventImg").val();
        var eventDate = ($("#eventYear").val() + "-" + $("#eventMonth").val() + "-" + $("#eventDate").val());
        var eventTime = $("#eventTime").val();
        var eventDescription = $("#eventDescription").val();
        var token = $("#token").data("token");
        $("#createEventForm").find("input, button, textarea, select").prop("disabled", true);
        $("#mainContent button").prop("disabled", true);
        $("#mainContent a").addClass("disabledLink");
        $.ajax({
            method: "post",
            url: "createEvent",
            data: {
                _token: token,
                name: eventName,
                place: eventVenue,
                image: eventImg,
                date: eventDate,
                time: eventTime,
                description: eventDescription
            },
            success: function (data) {
                $("#addEventParent button").prop("disabled", false);
                $("#createEventForm").find("input, button, textarea, select").prop("disabled", false);
                $("#createEventForm input").val("");
                $("#createEventForm form")[0].reset();
                $("#createEventForm").modal("hide");
                $("#csrf").load(" #token");
                $("#hiddenDiv1").load(" #eventsContent", function () {
                    $("#eventsParent").fadeOut(function () {
                        $("#eventsParent").empty();
                        $("#eventsParent").html($("#hiddenDiv1").html());
                        $("#eventsParent").fadeIn();
                        $("#hiddenDiv1").empty();
                    });
                });
            },
            error: function (data) {
                $("#createEventForm").find("input, button, textarea, select").prop("disabled", false);
                $("#mainContent button").prop("disabled", false);
                $("#mainContent a").removeClass("disabledLink");
                console.log(data.responseText);
            }
        });
    });

    // fill edit event modal on click
    $("#eventsParent").on("click", ".editEvent", function (e) {
        $("#eventName2").val($(this).data("name"));
        $("#eventVenue2").val($(this).data("place"));
        $("#eventImg2").val($(this).data("image"));
        $("#eventTime2").val($(this).data("time"));
        $("#eventDescription2").val($(this).data("description"));
        var date = $(this).data("date").split("-");
        $("#eventYear2").val(date[0]);
        $("#eventMonth2").val(date[1].replace(0, ""));
        $("#eventDate2").val(date[2]);
        $("#eventID").val($(this).data("id"));
    });

    // clear edit event modal form on modal hide
    $("#editEventForm").on("hidden.bs.modal", function () {
        $("#editEventForm input").val("");
        $("#editEventForm form")[0].reset();
    });

    // edit event
    $("#editEventForm").on("submit", function (e) {
        e.preventDefault();
        var eventName = $("#eventName2").val();
        var eventVenue = $("#eventVenue2").val();
        var eventImg = $("#eventImg2").val();
        var eventDate = ($("#eventYear2").val() + "-" + $("#eventMonth2").val() + "-" + $("#eventDate2").val());
        var eventTime = $("#eventTime2").val();
        var eventDescription = $("#eventDescription2").val();
        var eventID = $("#eventID").val();
        var token = $("#token").data("token");
        $("#editEventForm").find("input, button, textarea, select").prop("disabled", true);
        $("#mainContent button").prop("disabled", true);
        $("#mainContent a").addClass("disabledLink");
        $.ajax({
            method: "post",
            url: "editEvent",
            data: {
                _token: token,
                name: eventName,
                place: eventVenue,
                image: eventImg,
                date: eventDate,
                time: eventTime,
                description: eventDescription,
                id: eventID
            },
            success: function (data) {
                $("#addEventParent button").prop("disabled", false);
                $("#editEventForm").find("input, button, textarea, select").prop("disabled", false);
                $("#editEventForm input").val("");
                $("#editEventForm form")[0].reset();
                $("#editEventForm").modal("hide");
                $("#csrf").load(" #token");
                $("#hiddenDiv1").load(" #eventsContent", function () {
                    $("#eventsParent").fadeOut(function () {
                        $("#eventsParent").empty();
                        $("#eventsParent").html($("#hiddenDiv1").html());
                        $("#eventsParent").fadeIn();
                        $("#hiddenDiv1").empty();
                    });
                });
            },
            error: function (data) {
                $("#editEventForm").find("input, button, textarea, select").prop("disabled", false);
                $("#mainContent button").prop("disabled", false);
                $("#mainContent a").removeClass("disabledLink");
                console.log(data.responseText);
            }
        });
    });

    // on click delete event
    $("#eventsParent").on("click", ".deleteEvent", function (e) {
        e.preventDefault();
        var target = $(this);
        if ($(target).html().toLowerCase().indexOf("cancel") >= 0) {
            $(target).closest(".eventButtons").fadeOut(function () {
                $(target).html("<i class='fa fa-trash' aria-hidden='true'></i> Delete");
                $(target).siblings(".editEvent").attr("data-toggle", "modal");
                $(target).siblings(".editEvent").attr("data-target", "#editEventForm");
                $(target).siblings(".editEvent").html("<i class='fa fa-edit' aria-hidden='true'></i> Edit");
                $(target).closest(".eventButtons").fadeIn();
            });
        } else {
            $(target).closest(".eventButtons").fadeOut(function () {
                $(target).html("<i class='fa fa-trash' aria-hidden='true'></i> Cancel");
                $(target).siblings(".editEvent").attr("data-toggle", "");
                $(target).siblings(".editEvent").attr("data-target", "");
                $(target).siblings(".editEvent").html("<i class='fa fa-edit' aria-hidden='true'></i> Confirm Delete");
                $(target).closest(".eventButtons").fadeIn();
            });
        }
    });

    // delete event
    $("#eventsParent").on("click", ".editEvent", function (e) {
        e.preventDefault();
        var target = $(this);
        if ($(target).html().toLowerCase().indexOf("confirm delete") >= 0) {
            var eventID = $(target).data("id");
            var token = $("#token").data("token");
            $("#mainContent button").prop("disabled", true);
            $("#mainContent a").addClass("disabledLink");
            $.ajax({
                method: "post",
                url: "deleteEvent",
                data: {
                    _token: token,
                    id: eventID
                },
                success: function (data) {
                    $("#addEventParent button").prop("disabled", false);
                    $("#csrf").load(" #token");
                    $("#hiddenDiv1").load(" #eventsContent", function () {
                        $("#eventsParent").fadeOut(function () {
                            $("#eventsParent").empty();
                            $("#eventsParent").html($("#hiddenDiv1").html());
                            $("#eventsParent").fadeIn();
                            $("#hiddenDiv1").empty();
                        });
                    });
                },
                error: function (data) {
                    $("#mainContent button").prop("disabled", false);
                    $("#mainContent a").removeClass("disabledLink");
                    console.log(data.responseText);
                }
            });
        }
    });

    // add comment
    $("#eventsParent").on("submit", ".addCommentForm", function (e) {
        e.preventDefault();
        var comment = $(this).find(".commentContent").val();
        var eventID = $(this).find(".commentEventID").val();
        var token = $("#token").data("token");
        $("#mainContent button").prop("disabled", true);
        $("#mainContent a").addClass("disabledLink");
        $.ajax({
            method: "post",
            url: "addComment",
            data: {
                _token: token,
                comment: comment,
                event_id: eventID
            },
            success: function (data) {
                $("#addEventParent button").prop("disabled", false);
                $("#hiddenDiv1").load(" #eventsContent", function () {
                    $("#eventsParent").fadeOut(function () {
                        $("#eventsParent").empty();
                        $("#eventsParent").html($("#hiddenDiv1").html());
                        $("#eventsParent").fadeIn();
                        $("#hiddenDiv1").empty();
                        $("#csrf").load(" #token");
                    });
                });
            },
            error: function (data) {
                $("#mainContent button").prop("disabled", false);
                $("#mainContent a").removeClass("disabledLink");
                console.log(data.responseText);
            }
        });
    });

    // edit / delete comment
    $("#eventsParent").on("click", ".editComment", function (e) {
        e.preventDefault();
        var target = $(this);
        var newComment = $(target).closest(".commentButtons").siblings("textarea").val();
        var token = $("#token").data("token");
        var eventID = $(target).data("event");
        var commentID = $(target).data("id");
        if ($(target).html().toLowerCase().indexOf("save edit") >= 0) {
            $("#mainContent button").prop("disabled", true);
            $("#mainContent a").addClass("disabledLink");
            $.ajax({
                method: "post",
                url: "editComment",
                data: {
                    description: newComment,
                    _token: token,
                    event_id: eventID,
                    id: commentID
                },
                success: function (data) {
                    $("#addEventParent button").prop("disabled", false);
                    $("#hiddenDiv1").load(" #eventsContent", function () {
                        $("#eventsParent").fadeOut(function () {
                            $("#eventsParent").empty();
                            $("#eventsParent").html($("#hiddenDiv1").html());
                            $("#eventsParent").fadeIn();
                            $("#hiddenDiv1").empty();
                            $("#csrf").load(" #token");
                        });
                    });
                },
                error: function (data) {
                    $("#mainContent button").prop("disabled", false);
                    $("#mainContent a").removeClass("disabledLink");
                    console.log(data.responseText);
                }
            });
        } else if ($(target).html().toLowerCase().indexOf("confirm delete") >= 0) {
            $("#mainContent button").prop("disabled", true);
            $("#mainContent a").addClass("disabledLink");
            $.ajax({
                method: "post",
                url: "deleteComment",
                data: {
                    _token: token,
                    id: commentID
                },
                success: function (data) {
                    $("#addEventParent button").prop("disabled", false);
                    $("#hiddenDiv1").load(" #eventsContent", function () {
                        $("#eventsParent").fadeOut(function () {
                            $("#eventsParent").empty();
                            $("#eventsParent").html($("#hiddenDiv1").html());
                            $("#eventsParent").fadeIn();
                            $("#hiddenDiv1").empty();
                            $("#csrf").load(" #token");
                        });
                    });
                },
                error: function (data) {
                    $("#mainContent button").prop("disabled", false);
                    $("#mainContent a").removeClass("disabledLink");
                    console.log(data.responseText);
                }
            });
        } else {
            $(target).closest("form").siblings(".commentTxt").fadeOut(function () {
                $(target).closest(".commentButtons").siblings("textarea").fadeIn();
            });
            $(target).closest(".commentButtons").fadeOut(function () {
                $(target).html("<i class='fa fa-edit' aria-hidden='true'></i> Save Edit");
                $(target).siblings("a").html("<i class='fa fa-stop-circle' aria-hidden='true'></i> Cancel Edit");
                $(target).closest(".commentButtons").fadeIn();
            });
        }
    });

    // cancel edit / delete comment
    $("#eventsParent").on("click", ".deleteComment", function (e) {
        e.preventDefault();
        var target = $(this);
        var orig = $(target).closest("form").siblings(".commentTxt").html();
        if ($(target).html().toLowerCase().indexOf("cancel") >= 0) {
            if ($(target).siblings("button").html().toLowerCase().indexOf("save edit") >= 0) {
                $(target).closest(".commentButtons").siblings("textarea").fadeOut(function () {
                    $(target).closest("form").siblings(".commentTxt").fadeIn();
                    $(target).closest(".commentButtons").siblings("textarea").val(orig);
                });
            }
            $(target).closest(".commentButtons").fadeOut(function () {
                $(target).html("<i class='fa fa-trash' aria-hidden='true'></i> Delete");
                $(target).siblings("button").html("<i class='fa fa-edit' aria-hidden='true'></i> Edit");
                $(target).closest(".commentButtons").fadeIn();
            });
        } else if ($(target).html().toLowerCase().indexOf("delete") >= 0) {
            $(target).closest(".commentButtons").fadeOut(function () {
                $(target).html("<i class='fa fa-trash' aria-hidden='true'></i> Cancel");
                $(target).siblings("button").html("<i class='fa fa-edit' aria-hidden='true'></i> Confirm Delete");
                $(target).closest(".commentButtons").fadeIn();
            });
        }
    });

    // delete account
    $("#ganapNavbar").on("click", "#delAcct", function (e) {
        e.preventDefault();
        var token = $("#token").data("token");
        $("#ganapNavbar a").addClass("disabledLink");
        $("#mainContent button").prop("disabled", true);
        $("#mainContent a").addClass("disabledLink");
        $.ajax({
            method: "get",
            url: "deleteAccount",
            data: {
                _token: token
            },
            success: function (data) {
                $("#csrf").load(" #token");
                $("#hiddenDiv1").load(" .navbar-nav", function () {
                    $("#ganapNavbar").fadeOut(function () {
                        $("#ganapNavbar").empty();
                        $("#ganapNavbar").html($("#hiddenDiv1").html());
                        $("#ganapNavbar").fadeIn();
                        $("#hiddenDiv1").empty();
                    });
                });
                $("#hiddenDiv2").load(" #eventsContent", function () {
                    $("#eventsParent").fadeOut(function () {
                        $("#eventsParent").empty();
                        $("#eventsParent").html($("#hiddenDiv2").html());
                        $("#eventsParent").fadeIn();
                        $("#hiddenDiv2").empty();
                    });
                });
                $("#hiddenDiv3").load(" #addEvent", function () {
                    $("#addEventParent").fadeOut(function () {
                        $("#addEventParent").empty();
                        $("#addEventParent").html($("#hiddenDiv3").html());
                        $("#addEventParent").fadeIn();
                        $("#hiddenDiv3").empty();
                    });
                });
            },
            error: function (data) {
                $("#ganapNavbar a").removeClass("disabledLink");
                $("#mainContent button").prop("disabled", false);
                $("#mainContent a").removeClass("disabledLink");
                console.log(data.responseText);
            }
        });
    });

    // delete user
    $("#delUserForm").on("submit", function (e) {
        e.preventDefault();
        var token = $("#token").data("token");
        var id = $("#delUserForm select").val();
        $("#mainContent button").prop("disabled", true);
        $("#mainContent a").addClass("disabledLink");
        $.ajax({
            method: "post",
            url: "deleteUser",
            data: {
                _token: token,
                id: id
            },
            success: function (data) {
                $("#addEventParent button").prop("disabled", false);
                $("#csrf").load(" #token");
                $("#hiddenDiv1").load(" #delUserSelect", function () {
                    $("#delUserForm").fadeOut(function () {
                        $("#delUserForm").empty();
                        $("#delUserForm").html($("#hiddenDiv1").html());
                        $("#delUserForm").fadeIn();
                        $("#hiddenDiv1").empty();
                    });
                });
                $("#hiddenDiv2").load(" #eventsContent", function () {
                    $("#eventsParent").fadeOut(function () {
                        $("#eventsParent").empty();
                        $("#eventsParent").html($("#hiddenDiv2").html());
                        $("#eventsParent").fadeIn();
                        $("#hiddenDiv2").empty();
                    });
                });
            },
            error: function (data) {
                $("#mainContent button").prop("disabled", false);
                $("#mainContent a").removeClass("disabledLink");
                console.log(data.responseText);
            }
        });
    });
});