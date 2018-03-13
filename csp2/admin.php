<?php session_start();
if (isset($_SESSION["username"])) {
    if ($_SESSION["role"] == "staff") {

function display_title()
{
    echo "Pinoyware - Admin";
}

function display_css()
{?>
<link rel="stylesheet" href="assets/css/admin.css">
<?php }

function display_bottom_nav()
{?>

<button type="button" id="sectionBtn" class="nav-item btn btn-outline-dark px-3 mr-auto d-md-none">
    <span class="text-center sectionTitle">
        <i class="fas fa-columns"></i> Sections</span>
</button>

<!-- nav group -->
<div class="section p-0 mr-md-auto">
    <div class="px-1 mx-0" id="sectionParent">
        <div class="nav flex-column flex-md-row nav-pills my-1 my-md-0" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link" id="v-pills-users-tab" data-toggle="pill" href="?users" role="tab" aria-controls="v-pills-users" aria-selected="false">
                <i class="fas fa-users"></i> Users</a>
            <a class="nav-link" id="v-pills-staff-tab" data-toggle="pill" href="?staff" role="tab" aria-controls="v-pills-staff" aria-selected="false">
                <i class="fas fa-users"></i> Staff</a>
            <a class="nav-link" id="v-pills-products-tab" data-toggle="pill" href="?products" role="tab" aria-controls="v-pills-products"
                aria-selected="false">
                <i class="fab fa-dropbox"></i> Products</a>
            <a class="nav-link" id="v-pills-orders-tab" data-toggle="pill" href="?orders" role="tab" aria-controls="v-pills-orders" aria-selected="false">
                <i class="fas fa-plane"></i> Orders</a>
        </div>
    </div>
</div>

<?php }

function display_content()
{
require "connection.php";?>
<div class="row">

    <!-- content section -->
    <div class="col px-0 mx-0" id="contentParent">
        <div class="table-responsive" id="tableParent">
            <table class="table table-striped table-bordered table-sm" id="table">
                <?php if (isset($_GET["staff"])) { ?>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Sex</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sql = "SELECT s.staff_id 'staff_id', s.username 'username', s.email 'email', s.first_name 'first_name', s.last_name 'last_name', g.sex 'sex' FROM staff s, gender g WHERE g.id = s.sex ORDER BY staff_id";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    extract($row); ?>

                    <tr>
                        <td class="align-middle">
                            <?php echo $staff_id; ?>
                        </td>
                        <td class="align-middle">
                            <?php echo $username; ?>
                        </td>
                        <td class="align-middle">
                            <?php echo $email; ?>
                        </td>
                        <td class="align-middle">
                            <?php echo $first_name; ?>
                        </td>
                        <td class="align-middle">
                            <?php echo $last_name; ?>
                        </td>
                        <td class="align-middle">
                            <?php echo ucfirst($sex); ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
                <?php } else if (isset($_GET["products"])) { ?>
                <thead>
                    <tr>
                        <th scope="col">
                            <input type="checkbox" disabled>
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Image</th>
                        <th scope="col">Processor</th>
                        <th scope="col">Screen Size</th>
                        <th scope="col">RAM</th>
                        <th scope="col">HDD</th>
                        <th scope="col">GPU</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Category</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sql = "SELECT p.product_id 'product_id', p.name 'name', p.price 'price', p.image 'image', p.processor 'processor', p.screen_size 'screen_size', p.ram 'ram', p.hdd 'hdd', p.gpu 'gpu', b.brand_name 'brand', c.category 'category' FROM products p, brands b, categories c WHERE p.brand_id = b.brand_id AND p.category_id = c.category_id ORDER BY name";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    extract($row); ?>

                    <tr>
                        <th class="align-middle" scope="row">
                            <input type="checkbox" data-index="<?php echo $product_id; ?>" data-name="<?php echo $name; ?>" data-price="<?php echo $price; ?>"
                                data-image="<?php echo $image; ?>" data-processor="<?php echo (is_null($processor) ? 'NULL' : $processor); ?>"
                                data-screensize="<?php echo (is_null($screen_size) ? 'NULL' : $screen_size); ?>" data-ram="<?php echo (is_null($ram) ? 'NULL' : $ram); ?>"
                                data-hdd="<?php echo (is_null($hdd) ? 'NULL' : str_replace('00', '', $hdd)); ?>" data-gpu="<?php echo (is_null($gpu) ? 'NULL' : $gpu); ?>"
                                data-brand="<?php echo $brand; ?>" data-category="<?php echo $category; ?>" class="rowcheck">
                        </th>
                        <td class="align-middle">
                            <?php echo $product_id; ?>
                        </td>
                        <td class="align-middle">
                            <?php echo $name; ?>
                        </td>
                        <td class="align-middle">
                            <?php echo number_format($price, 2, ".", ","); ?>
                        </td>
                        <td class="align-middle">
                            <?php echo $image; ?>
                        </td>
                        <td class="align-middle">
                            <?php echo (is_null($processor) ? "NULL" : $processor); ?>
                        </td>
                        <td class="align-middle">
                            <?php echo (is_null($screen_size) ? "NULL" : $screen_size); ?>
                        </td>
                        <td class="align-middle">
                            <?php echo (is_null($ram) ? "NULL" : $ram); ?>
                        </td>
                        <td class="align-middle">
                            <?php echo (is_null($hdd) ? "NULL" : str_replace("00", "", $hdd)); ?>
                        </td>
                        <td class="align-middle">
                            <?php echo (is_null($gpu) ? "NULL" : $gpu); ?>
                        </td>
                        <td class="align-middle">
                            <?php echo $brand; ?>
                        </td>
                        <td class="align-middle">
                            <?php echo $category; ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
                <?php } else if (isset($_GET["orders"])) { ?>
                <thead>
                    <tr>
                        <th scope="col">
                            <input type="checkbox" disabled>
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Item</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col">Grandtotal</th>
                        <th scope="col">Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sql = "SELECT order_id, quantity 'qty', price FROM orders ORDER BY order_id";
        $result = mysqli_query($conn, $sql);
        $count = 0;
        $grandtotal = 0;
        $order = 0;
        $rowspan = array();
        $grandt = array();
        while ($row = mysqli_fetch_assoc($result)) {
            extract($row);
            if ($order == $order_id) {
                $rowspan[$order_id] += 1;
                $grandt[$order_id] += ($qty * $price);
            } else {
                $count = 1;
                $grandtotal = ($qty * $price);
                $order = $order_id;
                $rowspan[$order_id] = $count;
                $grandt[$order_id] = $grandtotal;
            }
        } 
        
        $sql = "SELECT o.order_id 'order_id', o.username 'username', o.name 'name', o.address 'address', o.item 'item', o.quantity 'qty', o.price 'price', c.update_date 'timestamp' FROM orders o, cart c WHERE o.order_id = c.order_id ORDER BY o.order_id";
        $result = mysqli_query($conn, $sql);
        $colname = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            extract($row);
            if ($colname == $order_id) { ?>
                    <tr>
                        <td class="align-middle">
                            <?php echo $item; ?>
                        </td>
                        <td class="align-middle">
                            <?php echo $qty; ?>
                        </td>
                        <td class="align-middle">
                            <?php echo number_format($price, 2, ".", ","); ?>
                        </td>
                        <td class="align-middle">
                            <?php echo number_format(($price * $qty), 2, ".", ","); ?>
                        </td>
                    </tr>
                    <?php } else { 
            $colname = $order_id;?>

                    <tr>
                        <th rowspan="<?php echo $rowspan[$order_id]; ?>" class="align-middle" scope="row">
                            <input type="checkbox" data-index="<?php echo $order_id; ?>" class="rowcheck">
                        </th>
                        <td rowspan="<?php echo $rowspan[$order_id]; ?>" class="align-middle">
                            <?php echo $order_id; ?>
                        </td>
                        <td rowspan="<?php echo $rowspan[$order_id]; ?>" class="align-middle">
                            <?php echo $username; ?>
                        </td>
                        <td rowspan="<?php echo $rowspan[$order_id]; ?>" class="align-middle">
                            <?php echo $name; ?>
                        </td>
                        <td rowspan="<?php echo $rowspan[$order_id]; ?>" class="align-middle">
                            <?php echo $address; ?>
                        </td>
                        <td class="align-middle">
                            <?php echo $item; ?>
                        </td>
                        <td class="align-middle">
                            <?php echo $qty; ?>
                        </td>
                        <td class="align-middle">
                            <?php echo number_format($price, 2, ".", ","); ?>
                        </td>
                        <td class="align-middle">
                            <?php echo number_format(($price * $qty), 2, ".", ","); ?>
                        </td>
                        <td rowspan="<?php echo $rowspan[$order_id]; ?>" class="align-middle">
                            <?php echo number_format($grandt[$order_id], 2, ".", ","); ?>
                        </td>
                        <td rowspan="<?php echo $rowspan[$order_id]; ?>" class="align-middle">
                            <?php echo date('F/j/Y',strtotime($timestamp)); ?>
                        </td>
                    </tr>
                    <?php }} ?>
                </tbody>
                <?php } else { ?>
                <thead>
                    <tr>
                        <th scope="col">
                            <input type="checkbox" disabled>
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Sex</th>
                        <th scope="col">Birthday</th>
                        <th scope="col">Address</th>
                        <th scope="col">City</th>
                        <th scope="col">Province</th>
                        <th scope="col">Phil. Region</th>
                        <th scope="col">Intl. Region</th>
                        <th scope="col">Country</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sql = "SELECT u.user_id 'user_id', u.username 'username', u.email 'email', u.first_name 'first_name', u.last_name 'last_name', g.sex 'sex', u.birthday 'birthday', u.address 'address', pc.city_name 'city', pp.province_name 'province', pr.region_name 'philregion', ir.name 'intlregion', c.name 'country' FROM users u, phil_city pc, phil_province pp, phil_region pr, intl_regions ir, countries c, gender g WHERE u.city_id = pc.city_id AND u.province_id = pp.province_id AND u.phil_region_id = pr.region_id AND u.intl_region_state_id = ir.id AND u.country_id = c.id AND g.id = u.sex ORDER BY user_id";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                extract($row); ?>

                    <tr>
                        <th class="align-middle" scope="row">
                            <input type="checkbox" data-index="<?php echo $user_id; ?>" data-email="<?php echo $email; ?>" data-username="<?php echo $username; ?>"
                                class="rowcheck">
                        </th>
                        <td class="align-middle">
                            <?php echo $user_id; ?>
                        </td>
                        <td class="align-middle">
                            <?php echo $username; ?>
                        </td>
                        <td class="align-middle">
                            <?php echo $email; ?>
                        </td>
                        <td class="align-middle">
                            <?php echo $first_name; ?>
                        </td>
                        <td class="align-middle">
                            <?php echo $last_name; ?>
                        </td>
                        <td class="align-middle">
                            <?php echo ucfirst($sex); ?>
                        </td>
                        <td class="align-middle">
                            <?php echo $birthday; ?>
                        </td>
                        <td class="align-middle">
                            <?php echo $address; ?>
                        </td>
                        <td class="align-middle">
                            <?php echo $city; ?>
                        </td>
                        <td class="align-middle">
                            <?php echo $province; ?>
                        </td>
                        <td class="align-middle">
                            <?php echo $philregion; ?>
                        </td>
                        <td class="align-middle">
                            <?php echo $intlregion; ?>
                        </td>
                        <td class="align-middle">
                            <?php echo $country; ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
                <?php } ?>
            </table>
        </div>
        <button type="button" id="addBtn" class="btn btn-success ml-1 ml-sm-0">
            <i class="fas fa-plus-circle"></i> Add</button>
        <button type="button" id="editBtn" class="btn btn-warning" disabled>
            <i class="fas fa-edit"></i> Edit</button>
        <button type="button" id="delBtn" data-index="<?php echo $_SESSION['staff_id']; ?>" data-username="<?php echo $_SESSION['username']; ?>"
            class="btn btn-danger" disabled>
            <i class="fas fa-trash-alt"></i> Delete</button>
    </div>
    <div class="d-none" id="hiddenTable"></div>
    <?php }

function display_js()
{?>
    <script src="assets/js/admin.js"></script>
    <?php }
        require "template.php";
        } else {
            header("location: index.php");
        }}   else {
            header("location: index.php");
        }