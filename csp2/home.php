<?php
require "connection.php";
require "template.php";

function display_title()
{
    echo "Pinoyware";
}

function display_css()
{?>
    <link rel="stylesheet" href="assets/css/home.css">
    <?php }

function display_bottom_nav()
{}

function display_content()
{ ?>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item text-center active">
                <img class="carouImg img-fluid" src="assets/img/1.jpg" alt="image1">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="carouTxt">Desktops</h5>
                    <p class="carouTxt">The best rig money can buy!</p>
                </div>
            </div>
            <div class="carousel-item text-center">
                <img class="carouImg img-fluid" src="assets/img/2.jpg" alt="image2">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="carouTxt">Monitors</h5>
                    <p class="carouTxt">Curved for maximum viewing angle!</p>
                </div>
            </div>
            <div class="carousel-item text-center">
                <img class="carouImg img-fluid" src="assets/img/3.jpg" alt="image3">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="carouTxt">Laptops</h5>
                    <p class="carouTxt">Portable with the same power of a desktop!</p>
                </div>
            </div>
            <div class="carousel-item text-center">
                <img class="carouImg img-fluid" src="assets/img/4.jpg" alt="image4">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="carouTxt">Headphones</h5>
                    <p class="carouTxt">Immerse yourself in your media!</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>



    <?php }

function display_js()
{}