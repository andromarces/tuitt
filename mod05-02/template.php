<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php display_title();?>
    </title>

    <link rel="stylesheet" href="assets/cdn/bootstrap.css">
    <script defer src="assets/cdn/fontawesome-5.0.3.js"></script>

    <style>
        form.loginside {
            max-height: 300px;
        }

        footer {
            position: relative;
            bottom: 0;
            width: 100%;
            padding: 20px 0;
            background: #bfd700;
            text-align: center;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            opacity: 1;
        }
    </style>
    <?php display_style();?>
</head>

<body>
    <?php require "nav.php";?>
    <main class="container my-2">
        <div class="row">
            <?php display_content();?>
            <?php require "sidebar.php";?>
        </div>
    </main>

    <div class="modal fade lif" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">LOGIN FAILED</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php require "footer.php";?>

    <script src="assets/cdn/jquery-3.2.1.min.js"></script>
    <script src="assets/cdn/popper.min.js"></script>
    <script src="assets/cdn/bootstrap.js"></script>
    <script>
        if (window.location.href.indexOf("#lif") != -1) {
            $('.lif').modal('show');
        }
    </script>
    <?php display_script();?>
</body>

</html>