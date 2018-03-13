<?php require "connection.php";?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php display_title();?>
    </title>

    <!-- imports Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Audiowide|Open+Sans" rel="stylesheet">

    <!-- ****** faviconit.com favicons ****** -->
    <link rel="shortcut icon" href="assets/img/favicon/Pinoyware.ico">
    <link rel="icon" sizes="16x16 32x32 64x64" href="assets/img/favicon/Pinoyware.ico">
    <link rel="icon" type="image/png" sizes="196x196" href="assets/img/favicon/Pinoyware-192.png">
    <link rel="icon" type="image/png" sizes="160x160" href="assets/img/favicon/Pinoyware-160.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon/Pinoyware-96.png">
    <link rel="icon" type="image/png" sizes="64x64" href="assets/img/favicon/Pinoyware-64.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon/Pinoyware-32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon/Pinoyware-16.png">
    <link rel="apple-touch-icon" href="assets/img/favicon/Pinoyware-57.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/img/favicon/Pinoyware-114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/img/favicon/Pinoyware-72.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/img/favicon/Pinoyware-144.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/img/favicon/Pinoyware-60.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/img/favicon/Pinoyware-120.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicon/Pinoyware-76.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/img/favicon/Pinoyware-152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicon/Pinoyware-180.png">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="msapplication-TileImage" content="assets/img/favicon/Pinoyware-144.png">
    <meta name="msapplication-config" content="assets/img/favicon/browserconfig.xml">
    <!-- ****** faviconit.com favicons ****** -->

    <!-- imports Bootstrap 4.0.0 css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <!-- imports FontAwesome 5.0.6 js -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

    <!-- imports date dropper css -->
    <link rel="stylesheet" href="assets/css/datedropper.min.css">
    <link rel="stylesheet" href="assets/css/pinoyware.css">

    <!-- imports template.css -->
    <link rel="stylesheet" href="assets/css/template.css">

    <!-- imports page css -->
    <?php display_css();?>
</head>

<body>
    <?php require "topnav.php";
    require "bottomnav.php" ?>



    <!-- .container -->
    <div class="container mx-auto">
        <!-- main content -->
        <?php display_content();?>
    </div>
    <!-- /.container -->

    <!-- footer -->
    <footer class="text-dark position-relative text-center">
        <a class="footerlink" href="#">&copy; 2018 Andro O. Marces</a>
    </footer>

    <!-- modal -->
    <div class="modal fade register-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 text-center"></div>
        </div>
    </div>

    <!-- div that is referred by JS/JQuery for breakpoints -->
    <div class="d-none d-md-inline-block position-absolute breakpointDiv"></div>

    <!-- imports JQuery 3.3.1 js -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <!-- imports Popper 1.12.9 js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <!-- imports Bootstrap 4.0.0 js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- imports date dropper js -->
    <script src="assets/js/datedropper.min.js"></script>

    <!-- imports template.js -->
    <script src="assets/js/template.js"></script>

    <!-- php to js variables -->
    <script>
        var user =
            <?php if (isset($_SESSION["role"])) {
            if ($_SESSION["role"] == "user") {
                echo 1;
            } else {
                echo 2;
            }
        } else {
            echo 0;
        };
        if (isset($_GET["search"])) {
        if ($_GET["search"] == "") {
            $search = "\"\"";
        } else {
            $search = "\"" . htmlspecialchars($_GET["search"]) . "\"";
        }} else {
        $search = "\"\"";
    } ?>

        var search = <?php echo $search; ?>;
    </script>

    <!-- imports page js -->
    <?php display_js();?>
</body>

</html>