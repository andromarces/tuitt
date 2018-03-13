<!-- .nav / bottom nav -->
<nav class="nav mt-1 mb-2 mb-md-1 justify-content-end px-1 px-md-3">
    <!-- bottom nav content -->
    <?php display_bottom_nav();
    if (isset($_SESSION["username"]) && isset($_SESSION["role"])) {
    if ($_SESSION["role"] == "user" && strpos($_SERVER["PHP_SELF"], "checkout.php") == false) {?>
    <!-- cart button -->
    <div class="cartParent d-flex col col-md-6 col-lg-5 col-xl-3 justify-content-end px-0">
        <button type="button" class="nav-item btn btn-outline-dark px-3 px-md-auto mr-0" id="cartBtn">
            <span class="fa-layers fa-fw">
                <i class="fas fa-shopping-cart fa-lg" data-fa-transform="grow-4 left-2"></i>
                <div class="counterWrapper">
                    <div id="counterContent">
                        <?php $cart_id = $_SESSION["cart_id"];
                    $sql = "SELECT p.product_id 'product_id', p.name 'name', p.price 'price', p.image 'image', p.processor 'processor', p.screen_size 'screen_size', p.ram 'ram', p.hdd 'hdd', p.gpu 'gpu', p.item_description 'item_description', ci.quantity 'quantity', ci.creation_date 'creation_date' FROM products p, cart_items ci, cart c WHERE p.product_id = ci.item_id AND ci.cart_id = '$cart_id' AND c.cart_status_id = 3 GROUP BY product_id ORDER BY creation_date";
                    $result = mysqli_query($conn, $sql);
                    $totalq = 0;
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            extract($row);
                            $totalq += $quantity;
                        }?>
                        <span class="fa-layers-counter">
                            <?php echo $totalq; ?>
                        </span>
                        <?php }?>
                    </div>
                </div>
            </span>
            <span class="pl-2 d-none d-md-inline-block"> Cart</span>
        </button>
        <div class="cartMenu p-0 col-11 col-md-12 mr-1 mr-md-0 border border-dark rounded text-center">
            <div id="cartContent">
                <?php mysqli_data_seek($result, 0);
            $grandtotal = 0;
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    extract($row);
                    $str = nl2br($item_description);
                    $hdd = str_replace("00", "", $hdd);
                    $grandtotal += ($price * $quantity)?>
                <div class="media rounded border-dark m-1 media-cart">
                    <img class="align-self-center mr-2 scale-img-cart" src="<?php echo $image; ?>" alt="<?php echo $name; ?>">
                    <div class="media-body text-left">
                        <h6 class="mt-0 font-weight-bold pb-0 mb-0 cartTitle">
                            <?php echo $name; ?>
                        </h6>
                        <span class="pb-0 mb-0 d-inline-block mr-auto">
                            <small class="font-weight-bold itemPriceCart">
                                ₱
                                <?php echo number_format($price, 2, ".", ","); ?>
                            </small>
                        </span>
                        <button class="cart-item-info" data-index="<?php echo $product_id; ?>" data-name="<?php echo $name; ?>" data-price="<?php echo number_format($price, 2, '.', ','); ?>"
                            data-img="<?php echo $image; ?>" data-proc="<?php echo $processor; ?>" data-screen="<?php if ($screen_size == '') {} else {echo $screen_size . ' in. ';}?>"
                            data-ram="<?php if ($ram == '') {} else {echo $ram . 'GB ';}?>" data-hdd="<?php echo $hdd; ?>" data-gpu="<?php echo $gpu; ?>">
                            <i class="fas fa-info-circle"></i>
                        </button>
                        <p class="d-none prodDescript" id="descript<?php echo $product_id; ?>">
                            <?php echo $str; ?>
                        </p>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text px-1 font-weight-bold">Qty</span>
                                <button class="btn btn-danger cartMinus" data-index="<?php echo $product_id; ?>" type="button" <?php if ($quantity==1 ) {echo
                                    "disabled";}?>>
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <form class="p-0 m-0 border-0 cartQtyForm">
                                <a tabindex="0" class="m-0 p-0 border-0" role="button" data-trigger="focus" data-animation="true" data-html="true" data-placement="top"
                                    data-content="<span class='font-weight-bold text-dark'><i class='fas fa-exclamation-triangle'></i>Update?</span><br><button data-index='<?php echo $product_id; ?>' class='btn-success confUp'>Yes</button><button class='btn-warning'>No</button>">
                                    <input type="number" class="cartQty" data-index="<?php echo $product_id; ?>" min=0 aria-label="Quantity" value=<?php echo
                                        $quantity; ?> data-qty=
                                    <?php echo $quantity; ?> max=100 id="cartQtyInput<?php echo $product_id; ?>">
                                </a>
                            </form>
                            <div class="input-group-append">
                                <button class="btn btn-success cartAdd" data-index="<?php echo $product_id; ?>" type="button" <?php if ($quantity > 99) {echo
                                    "disabled";}?>>
                                    <i class="fas fa-plus"></i>
                                </button>
                                <a tabindex="0" class="btn btn-danger rounded-right cartDel" role="button" data-toggle="popover" data-animation="true" data-html="true"
                                    data-trigger="focus" data-placement="top" data-content="<span class='font-weight-bold text-danger pl-2'><i class='fas fa-exclamation-triangle'></i>Delete?</span><br><button data-index='<?php echo $product_id; ?>' class='btn-danger confDel'>Yes</button><button class='btn-success'>No</button>">
                                    <i class="far fa-times-circle" data-fa-transform="grow-4"></i>
                                </a>
                            </div>
                            <div class="ml-auto row pr-4">
                                <p class="font-weight-bold mr-1 mb-0">Subtotal:</p>
                                <p class="font-weight-bold subtotalTxt ml-auto mb-0">₱
                                    <?php echo number_format(($price * $quantity), 2, ".", ","); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
                <div class="font-weight-bold text-right cartGrandTotal rounded mx-1 mb-1 pr-2">Grandtotal: ₱
                    <?php echo number_format(($grandtotal), 2, ".", ","); ?> </div>
                <button type="button" class="btn btn-success mb-1" id="chkOut">
                    <i class="far fa-credit-card"></i> Checkout</button>
                <?php } else {?>
                <span class="font-weight-bold">
                    <i class='far fa-frown'></i> Your cart is empty.</span>
                <?php }?>
            </div>
        </div>
    </div>
    <?php }
}?>

    <!-- search form -->
    <div class="nav-item col-auto px-0 searchWrapper">
        <button type="button" class="btn btn-outline-dark d-md-none px-3" id="searchtgl">
            <i class="fas fa-search"></i>
        </button>
        <form class="form-inline justify-content-end searchForm rounded">
            <input class="form-control col-8 col-sm-9 col-md-7 col-lg-7" name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-dark col-3 col-sm-2 col-md-4 col-lg-4 searchBtn" type="submit">
                <i class="fas fa-search d-inline-block d-md-none"></i>
                <span class="d-none d-md-inline-block">Search
                    <span>
            </button>
        </form>
    </div>
</nav>
<!-- /.nav // bottom nav -->