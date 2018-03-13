<?php

session_start();
//ternary

if(isset($_SESSION['username'])) :
	$username = $_SESSION['username'];
else : 
	$username = "";
endif;


?>