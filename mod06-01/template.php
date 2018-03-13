<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php display_title(); ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 <link rel="stylesheet" href="assets/style.css">

 <style type="text/css">
 	img{
 		width: 100%;
 	}
 	div[class="item_display"] {
 		height: 500px;
		margin-bottom: 30px;
	}
	h5{
		font-weight: bold;
	}
 </style>
</head>
<body>

<?php require "partials/nav.php"; ?>

<div class='container'>
	<div id="content_area">
		<?php display_content(); ?>
	</div>
	
	<?php require "partials/sidebar.php"; ?>
</div>

<?php require "partials/footer.php"; ?>

</body>
</html>
