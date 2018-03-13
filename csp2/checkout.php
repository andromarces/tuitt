<?php session_start();
if (isset($_SESSION["username"])) {
    if ($_SESSION["role"] == "staff") {
        header("location: index.php");
    } else {
    require "connection.php";

    $cart_id = mysqli_real_escape_string($conn, $_SESSION["cart_id"]);
    
    $sql = "SELECT p.product_id 'product_id', p.name 'name', p.price 'price', p.image 'image', ci.quantity 'quantity', ci.creation_date 'creation_date' FROM products p, cart_items ci, cart c WHERE p.product_id = ci.item_id AND ci.cart_id = '$cart_id' AND c.cart_status_id = 3 GROUP BY product_id ORDER BY creation_date";
    
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {

function display_title()
{
    echo "Pinoyware - Checkout";
}

function display_css()
{ ?>
    <link rel="stylesheet" href="assets/css/checkout.css">
    <?php }

function display_bottom_nav()
{}

function display_content()
{ ?>

    <h1 class="text-center">Checkout</h1>
    
    <ul class="list-unstyled mx-auto checkoutList border border-dark rounded col-12 col-md-8 col-lg-6 col-xl-5 p-1">
    <?php 
    require "connection.php";

    $cart_id = mysqli_real_escape_string($conn, $_SESSION["cart_id"]);
    
    $sql = "SELECT p.product_id 'product_id', p.name 'name', p.price 'price', p.image 'image', ci.quantity 'quantity', ci.creation_date 'creation_date' FROM products p, cart_items ci, cart c WHERE p.product_id = ci.item_id AND ci.cart_id = '$cart_id' AND c.cart_status_id = 3 GROUP BY product_id ORDER BY creation_date";
    
    $result = mysqli_query($conn, $sql);
    $grandtotal = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        extract($row);
        $grandtotal += ($price * $quantity) ?>
      <li class="media border border-dark rounded text-center mb-1">
        <img class="chkOutImg ml-1 my-1" src="<?php echo $image; ?>" alt="image">
        <div class="media-body">
          <h5 class="mt-0 mb-1"><?php echo $name; ?></h5>
          <p class="mb-1 text-right pr-1"><span class="font-weight-bold">Quantity: <?php echo $quantity; ?></span> <i class="fas fa-times"></i> <span class="font-weight-bold">₱ <?php echo number_format($price, 2, ".", ","); ?></span></p>
          <p class="font-weight-bold text-right pr-1 mb-1">Subtotal: <span class="subTotal">₱ <?php echo number_format(($price*$quantity), 2, ".", ","); ?></span></p>
        </div>
        </li>
        <?php } ?>
        <li class="font-weight-bold text-right rounded pr-1 mb-1 grandTotal">Grandtotal: ₱ <?php echo number_format(($grandtotal), 2, ".", ","); ?> </li>
        <li class="text-center">
            <button type="button" class="btn btn-success mb-1" id="chkOut">Confirm Order</button>
            <button type="button" class="btn btn-danger mb-1" id="goBack">Cancel</button>
        </li>
    </ul>




    <?php } 

function display_js()
{ ?>
<script src="assets/js/checkout.js"></script>
<?php }
require "template.php";
} else {
    header("location: products.php");
}}} else {
    header("location: index.php");
}