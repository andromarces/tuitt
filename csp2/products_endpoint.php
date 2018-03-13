<?php
session_start();
require "connection.php";

// add to cart
if (isset($_POST["addtocart"])) {
    $index = mysqli_real_escape_string($conn, $_POST["index"]);
    $cart_id = $_SESSION["cart_id"];
    unset($_POST);

    $sql = "SELECT item_id, quantity FROM cart_items WHERE item_id = '$index' AND cart_id = '$cart_id'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            extract($row);
        }
        $qty = ($quantity + 1);

        $sql = "UPDATE cart_items SET quantity = '$qty' WHERE cart_items.item_id = '$index' AND cart_items.cart_id = '$cart_id'";

        $result = mysqli_query($conn, $sql);

    } else {
        $sql = "INSERT INTO cart_items (item_id, quantity, cart_id) VALUES ('$index', 1, '$cart_id')";

        $result = mysqli_query($conn, $sql);
    }
}

// cart qty update
if (isset($_POST["updatecart"])) {
    $index = mysqli_real_escape_string($conn, $_POST["index"]);
    $cart_id = $_SESSION["cart_id"];
    $qty = mysqli_real_escape_string($conn, $_POST["qty"]);

    unset($_POST);

    $sql = "UPDATE cart_items SET quantity = '$qty' WHERE cart_items.item_id = '$index' AND cart_items.cart_id = '$cart_id'";

    $result = mysqli_query($conn, $sql);
}

// cart delete
if (isset($_POST["cartdel"])) {
    $index = mysqli_real_escape_string($conn, $_POST["index"]);
    $cart_id = $_SESSION["cart_id"];
    
    unset($_POST);
    
    $sql = "DELETE FROM cart_items WHERE cart_items.item_id = '$index' AND cart_items.cart_id = '$cart_id'";
    
    $result = mysqli_query($conn, $sql);
}

// checkout
if (isset($_POST["checkout"])) {
    $cart_id = $_SESSION["cart_id"];
    $user_id = $_SESSION["user_id"];

    unset($_POST);
    
    $sql = "SELECT MAX(order_id) 'order_id' FROM orders";
    
    $result = mysqli_query($conn, $sql);
    
    $row = mysqli_fetch_assoc($result);
    
    $order_id = ($row["order_id"] + 1);


    $sql = "SELECT u.username 'username', g.sex 'sex', u.first_name 'first_name', u.last_name 'last_name', u.address 'address', pc.city_name 'city', pp.province_name 'province', pr.region_name 'philregion', ir.name 'intlregion', co.name 'country', p.name 'name', ci.quantity 'qty', p.price 'price' FROM cart ca, cart_items ci, status_cart_order sco, products p, users u, countries co, phil_city pc, phil_region pr, phil_province pp, intl_regions ir, gender g WHERE '$cart_id' = ci.cart_id AND ci.item_id = p.product_id AND '$user_id' = u.user_id AND g.id = u.sex AND u.city_id = pc.city_id AND u.province_id = pp.province_id AND u.phil_region_id = pr.region_id AND u.intl_region_state_id = ir.id AND u.country_id = co.id AND ca.cart_status_id = 3 GROUP BY p.name";
    
    $result = mysqli_query($conn, $sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
        extract($row);
        $place = ($city == "N/A" ? $address . ", " . ($intlregion == "N/A" ? "" : $intlregion . ", ") . $country : $address . ", " . $city . ", " . $province . ", " . $philregion . ", " . $country);
        $fullname = (($sex == "male") ? "Mr. " . $first_name . " " . $last_name : "Ms. " . $first_name . " " . $last_name);
        $sql = "INSERT INTO orders (order_id, username, name, address, item, quantity, price, order_status) VALUES ('$order_id', '$username', '$fullname', '$place', '$name', '$qty', '$price', 3)";
        $temp = mysqli_query($conn, $sql);
    }
    
    $sql = "UPDATE cart SET order_id = '$order_id', cart_status_id = 5 WHERE cart_id = '$cart_id' AND user_id = '$user_id'";
    
    $result = mysqli_query($conn, $sql);
    
    $sql = "INSERT INTO cart (user_id, cart_status_id) VALUES ('$user_id', 3)";
    
    $result = mysqli_query($conn, $sql);

    $sql = "SELECT cart_id FROM cart WHERE user_id = '$user_id' AND cart_status_id = 3";
    
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);

    unset($_SESSION["cart_id"]);

    $_SESSION["cart_id"] = $row["cart_id"];

    echo $_SESSION["cart_id"];
}