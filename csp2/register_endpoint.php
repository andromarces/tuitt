<?php
session_start();
require "connection.php";

if (isset($_GET["hasregion"])) {
    // send list of intl regions
    if ($_GET["hasregion"] == "intl") {
        $id = mysqli_real_escape_string($conn, $_GET["index"]);
        unset($_GET);?>
    <label for="intlregion">Region / State</label>
    <select name="intlregion" class="form-control custom-select" id="intlregion">
        <option value="" id="notInList">Select Region / State</option>
        <?php $sql = "SELECT intl_regions.id,intl_regions.name FROM intl_regions WHERE intl_regions.country_id = '$id' ORDER BY intl_regions.name ASC";
        $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);
        while ($row = mysqli_fetch_assoc($result)) {
            extract($row);
            echo "<option value=$id>$name</option>";
        }?>
    </select>
    <?php

        // send list of regions for the Philippines
    } else if ($_GET["hasregion"] == "phil") {
        unset($_GET);?>
        <label for="philregion">Region</label>
        <select name="philregion" class="form-control custom-select" id="philregion" required>
            <option value="">Select Region</option>
            <?php $sql = "SELECT phil_region.region_id,phil_region.region_name FROM phil_region WHERE NOT region_id = 18 ORDER BY phil_region.region_name ASC";
        $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);
        while ($row = mysqli_fetch_assoc($result)) {
            extract($row);
            echo "<option value=$region_id>$region_name</option>";
        }?>
        </select>
        <?php }}

// send list of Phil. provinces
if (isset($_GET["province"])) {
    $id = mysqli_real_escape_string($conn, $_GET["index"]);
    unset($_GET);?>
        <label for="province">Province</label>
        <select name="province" class="form-control custom-select" id="province" required>
            <option value="">Select Province</option>
            <?php $sql = "SELECT phil_province.province_id,phil_province.province_name FROM phil_province WHERE phil_province.region_id = '$id' ORDER BY phil_province.province_name ASC";
    $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);
    while ($row = mysqli_fetch_assoc($result)) {
        extract($row);
        echo "<option value=$province_id>$province_name</option>";
    }?>
        </select>
        <?php }

// send list of Phil. cities / municipalities
if (isset($_GET["city"])) {
    $id = mysqli_real_escape_string($conn, $_GET["index"]);
    unset($_GET);?>
        <label for="city">City / Municipality</label>
        <select name="city" class="form-control custom-select" id="city" required>
            <option value="">Select City / Municipality</option>
            <?php $sql = "SELECT phil_city.city_id,phil_city.city_name FROM phil_city WHERE phil_city.province_id = '$id' ORDER BY phil_city.city_name ASC";
    $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);
    while ($row = mysqli_fetch_assoc($result)) {
        extract($row);
        echo "<option value=$city_id>$city_name</option>";
    }?>
        </select>
        <?php }

// check if username exists in user and staff database
if (isset($_GET["namecheck"])) {
    $name = mysqli_real_escape_string($conn, $_GET["name"]);
    if (isset($_GET["editName"])) {
        if ($_GET["editName"] == "") {
            unset($_GET);
            $sql = "SELECT username FROM (SELECT users.username FROM users UNION ALL SELECT staff.username FROM staff) a WHERE username = '$name'";
            $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);
            if (mysqli_num_rows($result) > 0) {
                echo true;
            } else {
                echo false;
            }
        } else {
            $username = mysqli_real_escape_string($conn, $_GET["editName"]);
            unset($_GET);
            $sql = "SELECT username FROM (SELECT users.username FROM users UNION ALL SELECT staff.username FROM staff) a WHERE username = '$name' AND NOT username = '$username'";
            $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);
            if (mysqli_num_rows($result) > 0) {
                echo true;
            } else {
                echo false;
            }
        }} else {
        unset($_GET);
        $sql = "SELECT username FROM (SELECT users.username FROM users UNION ALL SELECT staff.username FROM staff) a WHERE username = '$name'";
        $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);
        if (mysqli_num_rows($result) > 0) {
            echo true;
        } else {
            echo false;
        }
    }}

// check if email exists in user and staff database
if (isset($_GET["mailcheck"])) {
    $email = mysqli_real_escape_string($conn, $_GET["mail"]);
    if (isset($_GET["userEmail"])) {
        if ($_GET["userEmail"] == "") {
            unset($_GET);
            $sql = "SELECT email FROM (SELECT users.email FROM users UNION ALL SELECT staff.email FROM staff) a WHERE email = '$email'";
            $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);
            if (mysqli_num_rows($result) > 0) {
                echo true;
            } else {
                echo false;
            }
        } else {
            $user_email = mysqli_real_escape_string($conn, $_GET["userEmail"]);
            unset($_GET);
            $sql = "SELECT email FROM (SELECT users.email FROM users UNION ALL SELECT staff.email FROM staff) a WHERE email = '$email' AND NOT email = '$user_email'";
            $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);
            if (mysqli_num_rows($result) > 0) {
                echo true;
            } else {
                echo false;
            }
        }
    } else {
        unset($_GET);
        $sql = "SELECT email FROM (SELECT users.email FROM users UNION ALL SELECT staff.email FROM staff) a WHERE email = '$email'";
        $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);
        if (mysqli_num_rows($result) > 0) {
            echo true;
        } else {
            echo false;
        }
    }
}

// register new user in database and assign a cart id
if (isset($_POST["register"])) {
    $firstname = mysqli_real_escape_string($conn, $_POST["firstname"]);
    $lastname = mysqli_real_escape_string($conn, $_POST["lastname"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $sex = mysqli_real_escape_string($conn, $_POST["sex"]);
    $birthday = date("Y-m-d", strtotime(mysqli_real_escape_string($conn, $_POST["birthday"])));
    $country = mysqli_real_escape_string($conn, $_POST["country"]);
    if (isset($_POST["philregion"])) {
        $philregion = mysqli_real_escape_string($conn, $_POST["philregion"]);
    } else {
        $philregion = '18';
    }
    if (isset($_POST["intlregion"])) {
        if ($_POST["intlregion"] == 0) {
            $intlregion = '3890';
        } else {
            $intlregion = mysqli_real_escape_string($conn, $_POST["intlregion"]);
        }
    } else {
        $intlregion = '3890';
    }
    if (isset($_POST["province"])) {
        $province = mysqli_real_escape_string($conn, $_POST["province"]);
    } else {
        $province = '84';
    }
    if (isset($_POST["city"])) {
        $city = mysqli_real_escape_string($conn, $_POST["city"]);
    } else {
        $city = '1434';
    }
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    unset($_POST);

    $sql = "INSERT INTO users (user_id, username, password, email, first_name, last_name, sex, birthday, address, city_id, province_id, phil_region_id, intl_region_state_id, country_id, creation_date, update_date) SELECT * FROM (SELECT NULL as id, '$username' as user, '$password' as pass, '$email' as mail, '$firstname' as firstname, '$lastname' as lastname, '$sex' as sex, '$birthday' as bday, '$address' as streetaddress, $city as city, $province as province, $philregion as philregion, $intlregion as intlregion, '$country' as country, CURRENT_TIMESTAMP as creationtime, NULL as updatetime) AS tmp WHERE NOT EXISTS (SELECT staff.username FROM staff WHERE staff.username = '$username');";

    $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);

    $sql = "SELECT user_id FROM users WHERE username = '$username'";
    
    $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);

    $row = mysqli_fetch_assoc($result);
    $user_id = $row["user_id"];
    $_SESSION["user_id"] = $user_id;
    
    $sql = "INSERT INTO cart (user_id, cart_status_id) VALUES ('$user_id',3)";

    $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);

    $sql = "SELECT cart_id FROM cart WHERE user_id = (SELECT user_id FROM users WHERE username = '$username') AND cart_status_id = 3";

    $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);

    $row = mysqli_fetch_assoc($result);

    $_SESSION["cart_id"] = $row["cart_id"];
    $_SESSION["username"] = $username;
    $_SESSION["email"] = $email;
    $_SESSION["role"] = "user";
}