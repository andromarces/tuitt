<?php
session_start();
require "connection.php";

// login
if (isset($_POST["login"])) {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    unset($_POST);
    
    $sql = "SELECT user_id, username, password, email FROM users WHERE BINARY username = '$username'";
    
    $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            $user_id = $row["user_id"];
            $_SESSION["username"] = $username;
            $_SESSION["role"] = "user";
            $_SESSION["email"] = $row["email"];
            $sql = "SELECT cart_id FROM cart WHERE user_id = '$user_id' AND cart_status_id = 3";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $_SESSION["cart_id"] = $row["cart_id"];
            $_SESSION["user_id"] = $user_id;
            echo 1;
        } else {
            echo false;
        }
    } else {
        $sql = "SELECT staff_id, username, password FROM staff WHERE BINARY username = '$username'";
        
        $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row["password"])) {
                $_SESSION["username"] = $username;
                $_SESSION["role"] = "staff";
                $_SESSION["staff_id"] = $row["staff_id"];
                echo 2;
            } else {
                echo false;
            }
        } else {
            echo false;
        }
    }
}

// logout
if (isset($_GET["logout"])) {
    unset($_GET);
    unset($_POST);
    unset($_SESSION);
    session_destroy();
    echo true;
}

// error catching
if (isset($_POST["error"])) {
    $data = mysqli_real_escape_string($conn, $_POST["data"]);
    unset($_POST);
    $sql = "INSERT INTO sql_errors (id, error, status_id, creation_date, update_date) VALUES (NULL, '$data', 3, CURRENT_TIMESTAMP, NULL)";

    $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
}
