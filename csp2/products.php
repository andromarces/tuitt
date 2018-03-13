<?php session_start();
require "template.php";

function display_title()
{
    echo "Pinoyware - Products";
}

function display_css()
{?>

<link rel="stylesheet" href="assets/css/products.css">

<?php }

function display_bottom_nav()
{?>

<button type="button" id="filterBtn" class="nav-item btn btn-outline-dark px-3 d-md-none mr-auto">
    <i class="fas fa-filter"></i>
</button>

<?php }

function display_content()
{
    require "connection.php";?>
<div class="row">

    <!-- filter group -->
    <div class="col-7 col-md-3 filter p-0">
        <div class="px-1 mx-0 border border-dark rounded" id="filterParent">
            <span class="text-center d-none d-md-block filterTitle">
                <i class="fas fa-filter"></i> Filter</span>
            <span class="text-center d-block filterLabel">Sort</span>

            <!-- sort filters -->
            <form id="sortForm">
                <select name="sort" class="form-control form-control-sm" id="sortSelect">
                    <?php
if (isset($_GET["sort"])) {
        if ($_GET["sort"] == "" || $_GET["sort"] == "0") {
            $sort = 0;
        } else {
            $sort = intval(mysqli_real_escape_string($conn, $_GET["sort"]));
        }} else {
        $sort = 0;
    }?>
                        <option value=0 <?php if ($sort==0 ) {echo "selected";}?>>Alphabetical (A-Z)</option>
                        <option value=1 <?php if ($sort==1 ) {echo "selected";}?>>Alphabetical (Z-A)</option>
                        <option value=2 <?php if ($sort==2 ) {echo "selected";}?>>Price (Low - High)</option>
                        <option value=3 <?php if ($sort==3 ) {echo "selected";}?>>Price (High - Low)</option>
                </select>
            </form>
            <div class="dropdown-divider mb-0"></div>

            <!-- category filters -->
            <span class="text-center d-block filterLabel">Categories</span>
            <form id="catForm">
                <?php $sql = "SELECT category_id,category FROM categories";
    $result = mysqli_query($conn, $sql);
    if (isset($_GET["cat"])) {
        if ($_GET["cat"] == "" || $_GET["cat"] == "0") {
            $cat = 0;
        } else {
            $cat = mysqli_real_escape_string($conn, $_GET["cat"]);
        }
    } else {
        $cat = 0;
    }
    function in_haystack($needle, $haystack, $strict = false)
    {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_cart($needle, $item, $strict))) {
                return true;
            }
        }
        return false;
    }
    $catstack = explode(",", $cat);
    while ($row = mysqli_fetch_assoc($result)) {
        extract($row);

        if (in_haystack($category_id, $catstack)) {?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="<?php echo $category_id; ?>" id="catCheck<?php echo $category_id; ?>"
                        checked>
                    <label class="form-check-label" for="catCheck<?php echo $category_id; ?>">
                        <?php echo $category; ?>
                    </label>
                </div>
                <?php } else {?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="<?php echo $category_id; ?>" id="catCheck<?php echo $category_id; ?>">
                    <label class="form-check-label" for="catCheck<?php echo $category_id; ?>">
                        <?php echo $category; ?>
                    </label>
                </div>
                <?php }}?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value=0 id="catCheck0" <?php if ($cat==0 ) {echo "checked";}?>>
                    <label class="form-check-label" for="catCheck0">
                        All Products
                    </label>
                </div>
            </form>
            <div class="dropdown-divider mb-0"></div>

            <!-- brand filters -->
            <div id="brandForm">
                <div id="brandContent">
                    <?php
if (isset($_GET["search"])) {
        if ($_GET["search"] == "") {
            $isearch = "";
        } else {
            $isearch = mysqli_real_escape_string($conn, $_GET["search"]);
        }} else {
        $isearch = "";
    }
    if (isset($_GET["minp"])) {
        if ($_GET["minp"] == "" || $_GET["minp"] == "0") {
            $iminp = 0;
        } else {
            $iminp = intval(mysqli_real_escape_string($conn, $_GET["minp"]));
        }} else {
        $iminp = 0;
    }
    if (isset($_GET["maxp"])) {
        if ($_GET["maxp"] == "" || $_GET["maxp"] == "0") {
            $imaxp = 0;
        } else {
            $imaxp = intval(mysqli_real_escape_string($conn, $_GET["maxp"]));
        }} else {
        $imaxp = 0;
    }
    if ($iminp == 0) {
        $minp = "WHERE price > 0";
    } else {
        $minp = "WHERE price > $iminp";
    }
    if ($imaxp == 0 || $imaxp <= $iminp) {
        $maxp = "";
    } else {
        $maxp = "AND price < $imaxp";
    }
    if ($isearch !== "") {
        $search = "AND (name LIKE '%$isearch%' OR processor LIKE '%$isearch%' OR screen_size LIKE '%$isearch%' OR ram LIKE '%$isearch%' OR hdd LIKE '%$isearch%' OR gpu LIKE '%$isearch%' OR item_description LIKE '%$isearch%')";
    } else {
        $search = "";
    }
    if ($cat == 0) {
        $cat = "";
    } else {
        $cat = "AND category_id IN ($cat)";
    }
    $sql = "SELECT brand_id,brand_name FROM brands WHERE brand_id IN (SELECT brand_id FROM products $minp $cat $maxp $search) GROUP BY brand_id";
    $result = mysqli_query($conn, $sql);
    if (isset($_GET["brand"])) {
        if ($_GET["brand"] == "" || $_GET["brand"] == "0") {
            $brand = 0;
        } else {
            $brand = mysqli_real_escape_string($conn, $_GET["brand"]);
        }} else {
        $brand = 0;
    }
    $brandstack = explode(",", $brand);
    if (mysqli_num_rows($result) > 1) {?>
                        <span class="text-center d-block filterLabel">Brands</span>
                        <form>
                            <?php while ($row = mysqli_fetch_assoc($result)) {
                        extract($row);
                        if (in_haystack($brand_id, $brandstack)) {?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="<?php echo $brand_id; ?>" id="brandCheck<?php echo $brand_id; ?>"
                                    checked>
                                <label class="form-check-label" for="brandCheck<?php echo $brand_id; ?>">
                                    <?php echo $brand_name; ?>
                                </label>
                            </div>
                            <?php } else {?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="<?php echo $brand_id; ?>" id="brandCheck<?php echo $brand_id; ?>">
                                <label class="form-check-label" for="brandCheck<?php echo $brand_id; ?>">
                                    <?php echo $brand_name; ?>
                                </label>
                            </div>
                            <?php }}?>
                        </form>
                        <div class="dropdown-divider mb-0"></div>
                        <?php } ?>
                </div>
            </div>

            <!-- price filters -->
            <span class="text-center d-block filterLabel">Price</span>
            <form id="priceForm">
                <div class="form-row">
                    <div class="col">
                        <div class="input-group input-group-sm mb-3">
                            <input type="number" name="minp" class="form-control px-0" min=0 <?php if ($imaxp==0 || $imaxp=="" || $imaxp <=$iminp) {}
                                else {echo "max=" . ($imaxp - 1);}?> placeholder="₱ Min" pattern="[0-9]*" aria-label="Amount (to the nearest peso)"
                            <?php if ($iminp == 0 || $iminp == "") {} else {echo "value=$iminp";}?> id="minpinput">
                            <input type="number" name="maxp" class="form-control px-0" min=<?php echo $iminp + 1; ?> placeholder="₱ Max" pattern="[0-9]*" aria-label="Amount (to the nearest peso)"
                            <?php if ($imaxp == 0 || $imaxp == "") {} else {echo "value=$imaxp";}?> id="maxpinput">
                            <div class="input-group-append">
                                <button class="btn btn-outline-success" type="submit">Go!</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- products section -->
    <div class="col-12 col-md ml-md-2 mr-md-0 pl-1 pr-0" id="productParent">
        <div id="productContent">
            <?php
if ($sort == 1) {
        $sort = ",name DESC";
    } else if ($sort == 2) {
        $sort = ",price";
    } else if ($sort == 3) {
        $sort = ",price DESC";
    } else {
        $sort = ",name";
    }
    if ($brand == 0) {
        $brand = "";
    } else {
        $brand = "AND brand_id IN ($brand)";
    }
    if (isset($_GET["page"])) {
        if ($_GET["page"] == "" || $_GET["page"] == "0") {
            $page = 1;
        } else {
            $page = intval(mysqli_real_escape_string($conn, $_GET["page"]));
        }} else {
        $page = 1;
    }
    $offset = (($page * 10) - 10);
    $sql = "SELECT product_id, name, price, image, processor, screen_size, ram, hdd, gpu, item_description, priority_id, category_id FROM products $minp $cat $maxp $search $brand ORDER BY priority_id DESC$sort LIMIT $offset, 18446744073709551615";
    $result = mysqli_query($conn, $sql);
    $rowcount = mysqli_num_rows($result);
    $pages = ceil(($rowcount + (($page - 1) * 10)) / 10);?>
                <?php $pagenos = 1;?>

                <!-- products nav -->
                <nav>
                    <ul class="pagination mb-1 d-inline-flex">
                        <li class="page-item">
                            <a class="page-link pagitext border-dark" href="#">
                                <span class="d-block d-md-none" aria-hidden="true">&laquo;</span>
                                <span class="d-none d-md-block">Previous</span>
                            </a>
                        </li>
                        <?php while ($pagenos <= $pages) {
        if ($pagenos == $page) {?>
                        <li class="page-item active page<?php echo $pagenos; ?>">
                            <a class="page-link pagitext border-dark" href="#">
                                <?php echo $pagenos; ?>
                            </a>
                        </li>
                        <?php } else {?>
                        <li class="page-item page<?php echo $pagenos; ?>">
                            <a class="page-link pagitext border-dark" href="#">
                                <?php echo $pagenos; ?>
                            </a>
                        </li>
                        <?php }
        $pagenos++;}?>
                        <li class="page-item">
                            <a class="page-link pagitext border-dark" href="#">
                                <span class="d-none d-md-block">Next</span>
                                <span class="d-block d-md-none" aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                    <span class="ml-3 font-weight-bold d-inline-block">(
                        <?php echo ($rowcount + (($page - 1) * 10)); ?>
                        <?php if (($rowcount + (($page - 1) * 10)) > 1) {echo "results";} else { echo "result";}?>.)</span>
                    <?php if ($isearch !== "") {?>
                    <button type="button" class="ml-1 btn btn-outline-danger searchTerm">
                        <i class="fas fa-times-circle"></i>
                        <?php echo $isearch; ?>
                    </button>
                    <?php }
    if ($iminp == "" || $iminp == 0) {} else {?>
                    <button type="button" class="ml-1 btn btn-outline-danger clearMinp">
                        <i class="fas fa-times-circle"></i>
                        <?php echo $iminp; ?>
                    </button>
                    <?php }
    if ($imaxp == "" || $imaxp == 0) {} else {?>
                    <button type="button" class="ml-1 btn btn-outline-danger clearMaxp">
                        <i class="fas fa-times-circle"></i>
                        <?php echo $imaxp; ?>
                    </button>
                    <?php }?>
                </nav>
                <div class="row no-gutters">
                    <?php if ((($rowcount + (($page - 1) * 10)) - (($page - 1) * 10)) < 10) {
        $remitems = (($rowcount + (($page - 1) * 10)) - (($page - 1) * 10));
    } else {
        $remitems = 10;
    }
    $itemnos = 0;
    while ($itemnos < $remitems) {
        $row = mysqli_fetch_assoc($result);
        extract($row);
        $str = nl2br($item_description);
        $hdd = str_replace("00", "", $hdd);?>

                    <!-- product cards -->
                    <a href="#" class="col-12 col-lg-6 productCard mb-1" id="product<?php echo $product_id; ?>" data-index="<?php echo $product_id; ?>"
                        data-name="<?php echo $name; ?>" data-price="<?php echo number_format($price, 2, '.', ','); ?>" data-img="<?php echo $image; ?>"
                        data-proc="<?php echo $processor; ?>" data-screen="<?php if ($screen_size == '') {} else {echo $screen_size . ' in.';}?>"
                        data-ram="<?php if ($ram == '') {} else {echo $ram . 'GB';}?>" data-hdd="<?php echo $hdd; ?>" data-gpu="<?php echo $gpu; ?>">
                        <div class="media rounded mr-1">
                            <img class="align-self-center mr-2 scale-img" src="<?php echo $image; ?>" alt="<?php echo $name; ?>">
                            <div class="media-body">
                                <h6 class="mt-0 font-weight-bold pb-0 mb-0">
                                    <?php echo $name; ?>
                                </h6>
                                <p class="pb-0 mb-0">
                                    <small class="font-weight-bold itemPrice">
                                        ₱
                                        <?php echo number_format($price, 2, ".", ","); ?>
                                    </small>
                                </p>
                                <?php if ($processor == "") {} else {?>
                                <small class="d-none d-md-inline-block">
                                    <span class="font-weight-bold">Processor:</span>
                                    <?php echo ($screen_size == "" && $ram == "" && $hdd == "" && $gpu == "" ? substr($processor, 0, stripos($processor, "-")) : substr($processor, 0, stripos($processor, "-")) . ","); ?>
                                </small>
                                <?php }
                                if ($screen_size == "") {} else {?>
                                <small class="d-none d-md-inline-block">
                                    <span class="font-weight-bold">Screen Size:</span>
                                    <?php echo ($ram == "" && $hdd == "" && $gpu == "" ? "$screen_size\"" : "$screen_size\","); ?>
                                </small>
                                <?php }
                                if ($ram == "") {} else {?>
                                <small class="d-none d-md-inline-block">
                                    <span class="font-weight-bold">RAM:</span>
                                    <?php echo ($hdd == "" && $gpu == "" ? $ram."GB" : $ram."GB,"); ?>
                                </small>
                                <?php }
                                if ($hdd == "") {} else {?>
                                <small class="d-none d-md-inline-block">
                                    <span class="font-weight-bold">Storage:</span>
                                    <?php echo ($gpu == "" ? $hdd : "$hdd,"); ?>
                                </small>
                                <?php }
                                if ($gpu == "") {} else {?>
                                <small class="d-none d-md-inline-block">
                                    <span class="font-weight-bold">GPU:</span>
                                    <?php echo $gpu; ?>
                                </small>
                                <?php }?>
                                <p class="d-none prodDescript" id="descript<?php echo $product_id; ?>">
                                    <?php echo $str; ?>
                                </p>
                            </div>
                        </div>
                    </a>
                    <?php $itemnos++;}?>
                </div>
        </div>
    </div>
</div>
<div id="hiddenProduct" class="d-none"></div>
<div id="hiddenBrand" class="d-none"></div>
<?php }

function display_js()
{
    if (isset($_GET["cat"])) {
        if ($_GET["cat"] == "" || $_GET["cat"] == "0") {
            $cat = "\"\"";
        } else {
            $cat = "\"" . htmlspecialchars($_GET["cat"]) . "\"";
        }
    } else {
        $cat = "\"\"";
    }
    if (isset($_GET["brand"])) {
        if ($_GET["brand"] == "" || $_GET["brand"] == "0") {
            $brand = "\"\"";
        } else {
            $brand = "\"" . htmlspecialchars($_GET["brand"]) . "\"";
        }} else {
        $brand = "\"\"";
    }
    if (isset($_GET["sort"])) {
        if ($_GET["sort"] == "" || $_GET["sort"] == "0") {
            $sort = 0;
        } else {
            $sort = intval(htmlspecialchars($_GET["sort"]));
        }} else {
        $sort = 0;
    }
    if (isset($_GET["minp"])) {
        if ($_GET["minp"] == "" || $_GET["minp"] == "0") {
            $minp = 0;
        } else {
            $minp = intval(htmlspecialchars($_GET["minp"]));
        }} else {
        $minp = 0;
    }
    if (isset($_GET["maxp"])) {
        if ($_GET["maxp"] == "" || $_GET["maxp"] == "0") {
            $maxp = "\"\"";
        } else {
            $maxp = intval(htmlspecialchars($_GET["maxp"]));
        }} else {
        $maxp = "\"\"";
    }
    if (isset($_GET["page"])) {
        if ($_GET["page"] == "" || $_GET["page"] == "0") {
            $page = 1;
        } else {
            $page = intval(htmlspecialchars($_GET["page"]));
        }} else {
        $page = 1;
    }?>
<script>
    var sort = <?php echo $sort; ?>;
    var cat = <?php echo $cat; ?>;
    var brand = <?php echo $brand; ?>;
    var minp = <?php echo $minp; ?>;
    var maxp = <?php echo $maxp; ?>;
    var page = parseInt(<?php echo $page; ?>);
    var maxpage = ($("#productParent .page-item").length - 2);
</script>
<script src="assets/js/products.js"></script>
<?php }