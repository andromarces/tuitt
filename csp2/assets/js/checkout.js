"use strict" /* strict mode enabled */

$(function () { /* document ready function */
    // back button
    $(".checkoutList").on("click", "#goBack", function () {
        window.location.href = "products.php?";
    });

    // confirm order
    $("#chkOut").click(function () {
        $(this).prop("disabled", true);
        $(".checkoutList").fadeOut(350, function () {
            $(".checkoutList").addClass("text-center");
            $(".checkoutList").html("<i class='fas fa-cog fa-spin fa-10x m-5'></i>");
        });
        $(".checkoutList").fadeIn(350);
        $.ajax({
            method: "post",
            url: "products_endpoint.php",
            data: {
                checkout: true
            },
            success: function (data, textStatus, jqXHR) {
                $(".checkoutList").fadeOut(350, function () {
                    $(".checkoutList").html("<i class='fas fa-plane fa-10x'></i><h2>Thank you for purchasing!</h2><h4>Your items are now being delivered. We only do COD transactions as of this time. Thank you for bearing with us!</h4><i class='fas fa-smile fa-10x'></i><br><button type='button' class='mt-2 btn btn-danger mb-1' id='goBack'>Go Back</button>");
                });
                $(".checkoutList").fadeIn(350);
            }
        });
    });
});