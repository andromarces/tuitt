<?php if (isset($_SESSION['username']) && $_SESSION['username'] == 'admin') {} else if (isset($_SESSION['username'])) {

    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];

        if (count($cart) == 0) {} else {
            $total = 0;?>
<div class="col-12 col-md-4 col-lg-3 border rounded border-dark px-0">
    <?php foreach ($cart as $index => $item) {?>
    <form class="media cart border border-success" action="" method="post">
        <img class="align-self-center" src="<?php echo $item['img']; ?>" alt="Generic placeholder image">
        <div class="media-body border border-dark">
            <h6 class="mt-0">
                <?php echo $item['name']." (Php ".$item['price'].".00)" ?>
            </h6>
            <span>Quantity: </span>
            <input type="number" min=0 class="cartqty" name="qty" value=<?php echo $item['quantity']; ?>>
            <strong class="cartprice"><?php echo "= Php ".$item['quantity'] * $item['price'].".00" ?></strong>
            <button type="submit" class="btn btn-info updateqty" data-index="<?php echo $index; ?>">Update Qty</button>
            <button type="submit" class="btn btn-danger removecart" data-index="<?php echo $index; ?>">Delete Order</button>
        </div>
    </form>
    <?php $total += ($item['quantity'] * $item['price']); }?>
    <div class="col-12">
    <strong>Total Cost: Php <?php echo $total ?>.00</strong>
    </div>
</div>


<?php }} else {}?>









<?php } else {?>

<form class="col-12 col-md-4 col-lg-3 border rounded border-dark loginside" action="authenticate.php" method="POST">
    <div class="form-group">
        <label for="exampleInputUsername1">Username</label>
        <input type="text" class="form-control" id="exampleInputUsername1" autocomplete="username" aria-describedby="usernameHelp" placeholder="Enter Username"
            name="username">
        <small id="usernameHelp" class="form-text text-muted">We'll never share your info with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" autocomplete="current-password" placeholder="Password" name="password">
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>

<?php }?>