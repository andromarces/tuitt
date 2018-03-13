<?php
session_start();
require "connection.php";

// add user
if (isset($_GET["adduser"])) {
    if ($_GET["adduser"] == 1) {
    unset($_GET); ?>

    <form class="px-1 border border-dark rounded bg-white" id="regForm">
        <div class="form-row">
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" name="firstname" pattern="^$|^[^\s]+(\s+[^\s]+)*$" autocomplete="given-name" id="firstName"
                    placeholder="First name" required>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control" pattern="^$|^[^\s]+(\s+[^\s]+)*$" name="lastname" autocomplete="family-name" id="lastName"
                    placeholder="Last name" required>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="registerEmail">Email</label>
                <input type="email" class="form-control" name="email" autocomplete="email" id="registerEmail" placeholder="Email" required>
                <small class="form-text text-muted">
                    <span class="mailCheck"></span>
                </small>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="registerUsername">Username</label>
                <input type="text" class="form-control" name="username" autocomplete="username" id="registerUsername" pattern="^[A-Za-z0-9_]{1,32}$"
                    placeholder="Username" required>
                <small class="form-text text-muted">
                    <span class="userCheck">Maximum 32 characters long. No spaces at start and end.</span>
                </small>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="registerPassword1">Password</label>
                <input type="password" id="registerPassword1" name="password1" class="form-control newPass" autocomplete="new-password" pattern="^(?:\S.{4,}\S)?$"
                    placeholder="Password" required>
                <small class="form-text text-muted">
                    Minimum of 6 characters. No spaces at start and end.
                </small>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="registerPassword2">Confirm Password</label>
                <input type="password" id="registerPassword2" name="password2" class="form-control newPass" autocomplete="new-password" pattern="^(?:\S.{4,}\S)?$"
                    placeholder="Confirm Password" required>
                <small class="form-text font-weight-bold passCheck">
                    <span class="matchCheck"></span>
                    <span class="lengthCheck"></span>
                </small>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="inputSex">Gender</label>
                <select class="form-control custom-select" name="sex" id="inputSex" required>
                    <option value="">Select Gender</option>
                    <option value=1>Female</option>
                    <option value=2>Male</option>
                </select>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="birthDay">Birthday</label>
                <input type="text" id="birthDay" name="birthday" class="form-control" data-large-default="true" data-large-mode="true" data-default-date="<?php echo date('m-d-Y', strtotime('- 18 years')); ?>" data-modal="true" data-min-year="<?php echo date('Y', strtotime('- 115 years')); ?>" data-max-year="<?php echo date('Y', strtotime('- 18 years')); ?>" data-format="Y-m-d" placeholder="yyyy-mm-dd" data-theme="pinoyware" required>
            </div>
        </div>
        <div class="form-row">
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="country">Country</label>
                <select name="country" class="form-control custom-select" id="country" required>
                    <option value="" class="countryOption">Select Country</option>
                    <?php $sql = "SELECT * FROM countries ORDER BY countries.name ASC";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            extract($row);
            echo "<option value=$id>$name</option>";
        }?>
                </select>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3 region"></div>
            <div class="col-sm-6 col-lg-4 mb-3 province"></div>
            <div class="col-sm-6 col-lg-4 mb-3 city"></div>
            <div class="col-sm-6 col-lg-8 mb-3">
                <label for="address">Address</label>
                <textarea class="form-control" name="address" id="address" pattern="^$|^[^\s]+(\s+[^\s]+)*$" auto-complete="street-address"
                    placeholder="Address" row=3 required></textarea>
            </div>
        </div>
        <div class="d-block mb-1 mx-auto">
            <button class="btn btn-success regBtn" data-function="1" type="submit" disabled>Register</button>
            <button type='button' class='btn btn-warning' data-dismiss='modal'>Close</button>
        </div>
    </form>
    <script>
        <?php 
    // create list of countries with no regions
    $sql = "SELECT countries.name FROM countries WHERE NOT EXISTS (SELECT * FROM intl_regions WHERE intl_regions.country_id = countries.id)";
    $result = mysqli_query($conn, $sql);
    $noregion = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $noregion[] = $row["name"];
    }?>
        // list of countries with no regions in database (auto-generated)
        var noRegion = <?php echo json_encode($noregion); ?>;
    </script>

    <!-- add staff -->
    <?php } else if ($_GET["adduser"] == 2) {
        unset($_GET); ?>
    <form class="px-1 border border-dark rounded bg-white" id="regForm">
        <div class="form-row">
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" name="firstname" pattern="^$|^[^\s]+(\s+[^\s]+)*$" autocomplete="given-name" id="firstName"
                    placeholder="First name" required>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control" pattern="^$|^[^\s]+(\s+[^\s]+)*$" name="lastname" autocomplete="family-name" id="lastName"
                    placeholder="Last name" required>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="registerEmail">Email</label>
                <input type="email" class="form-control" name="email" autocomplete="email" id="registerEmail" placeholder="Email" required>
                <small class="form-text text-muted">
                    <span class="mailCheck"></span>
                </small>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="registerUsername">Username</label>
                <input type="text" class="form-control" name="username" autocomplete="username" id="registerUsername" pattern="^[A-Za-z0-9_]{1,32}$"
                    placeholder="Username" required>
                <small class="form-text text-muted">
                    <span class="userCheck">Maximum 32 characters long. No spaces at start and end.</span>
                </small>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="registerPassword1">Password</label>
                <input type="password" id="registerPassword1" name="password1" class="form-control newPass" autocomplete="new-password" pattern="^(?:\S.{4,}\S)?$"
                    placeholder="Password" required>
                <small class="form-text text-muted">
                    Minimum of 6 characters. No spaces at start and end.
                </small>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="registerPassword2">Confirm Password</label>
                <input type="password" id="registerPassword2" name="password2" class="form-control newPass" autocomplete="new-password" pattern="^(?:\S.{4,}\S)?$"
                    placeholder="Confirm Password" required>
                <small class="form-text font-weight-bold passCheck">
                    <span class="matchCheck"></span>
                    <span class="lengthCheck"></span>
                </small>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="inputSex">Gender</label>
                <select class="form-control custom-select" name="sex" id="inputSex" required>
                    <option value="">Select Gender</option>
                    <option value=1>Female</option>
                    <option value=2>Male</option>
                </select>
            </div>
        </div>
        <div class="d-block mb-1 mx-auto">
            <button class="btn btn-success regBtn" data-function="3" type="submit" disabled>Register</button>
            <button type='button' class='btn btn-warning' data-dismiss='modal'>Close</button>
        </div>
    </form>
    <?php }}

// edit user
if (isset($_GET["edituser"])) {
    if ($_GET["edituser"] == 1) {
    $user_id = mysqli_real_escape_string($conn, $_GET["user"]);
    unset($_GET);
    
    $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);
    $row = mysqli_fetch_assoc($result);
    extract($row);
    $philprovid = $province_id;
    unset($province_id);
    $cityid = $city_id;
    unset($city_id); ?>

    <form class="px-1 border border-dark rounded bg-white" id="regForm">
        <div class="form-row">
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" name="firstname" pattern="^$|^[^\s]+(\s+[^\s]+)*$" autocomplete="given-name" id="firstName"
                    placeholder="First name" value="<?php echo $first_name; ?>" required>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control" pattern="^$|^[^\s]+(\s+[^\s]+)*$" data-email="<?php echo $last_name; ?>" name="lastname"
                    autocomplete="family-name" id="lastName" placeholder="Last name" value="<?php echo $last_name; ?>" required>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="registerEmail">Email</label>
                <input type="email" class="form-control" name="email" autocomplete="email" id="registerEmail" placeholder="Email" value="<?php echo $email; ?>"
                    required>
                <small class="form-text text-muted">
                    <span class="mailCheck"></span>
                </small>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="registerUsername">Username</label>
                <input type="text" class="form-control" name="username" autocomplete="username" id="registerUsername" pattern="^[A-Za-z0-9_]{1,32}$"
                    placeholder="Username" data-username="<?php echo $username; ?>" value="<?php echo $username; ?>" required>
                <small class="form-text text-muted">
                    <span class="userCheck">Maximum 32 characters long. No spaces at start and end.</span>
                </small>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="registerPassword1">Password</label>
                <input type="password" id="registerPassword1" name="password1" class="form-control newPass" autocomplete="new-password" pattern="^(?:\S.{4,}\S)?$"
                    placeholder="Password">
                <small class="form-text text-muted">
                    Minimum of 6 characters. No spaces at start and end.
                </small>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="registerPassword2">Confirm Password</label>
                <input type="password" id="registerPassword2" name="password2" class="form-control newPass" autocomplete="new-password" pattern="^(?:\S.{4,}\S)?$"
                    placeholder="Confirm Password">
                <small class="form-text font-weight-bold passCheck">
                    <span class="matchCheck"></span>
                    <span class="lengthCheck"></span>
                </small>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="inputSex">Gender</label>
                <select class="form-control custom-select" name="sex" id="inputSex" required>
                    <option value="">Select Gender</option>
                    <option value=1<?php echo ($sex==1 ? " selected" : ""); ?>>Female</option>
                    <option value=2<?php echo ($sex==2 ? " selected" : ""); ?>>Male</option>
                </select>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="birthDay">Birthday</label>
                <input type="text" id="birthDayEdit" name="birthday" class="form-control" data-large-default="true" data-large-mode="true" data-default-date="<?php echo date('m-d-Y', strtotime($birthday)); ?>" data-modal="true" data-min-year="<?php echo date('Y', strtotime('- 115 years')); ?>" data-max-year="<?php echo date('Y', strtotime('- 18 years')); ?>" data-format="Y-m-d" placeholder="yyyy-mm-dd" data-theme="pinoyware" value="<?php echo $birthday; ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="country">Country</label>
                <select name="country" class="form-control custom-select" id="country" required>
                    <option value="" class="countryOption">Select Country</option>
                    <?php $sql = "SELECT * FROM countries ORDER BY countries.name ASC";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            extract($row);
            echo ($country_id == $id ? "<option value=$id selected>$name</option>" : "<option value=$id>$name</option>");
        }?>
                </select>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3 region">
                <?php if ($country_id == 164) { ?>
                <label for="philregion">Region</label>
                <select name="philregion" class="form-control custom-select" id="philregion" required>
                    <option value="">Select Region</option>
                    <?php $sql = "SELECT phil_region.region_id,phil_region.region_name FROM phil_region WHERE NOT region_id = 18 ORDER BY phil_region.region_name ASC";
                    $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
                    while ($row = mysqli_fetch_assoc($result)) {
                        extract($row);
                        echo ($phil_region_id == $region_id ? "<option value=$region_id selected>$region_name</option>" : "<option value=$region_id>$region_name</option>");
                    }?>
                </select>
                <?php } else { 
                    $sql = "SELECT intl_regions.id,intl_regions.name FROM intl_regions WHERE intl_regions.country_id = '$country_id' ORDER BY intl_regions.name ASC";
                    $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
                    if (mysqli_num_rows($result) > 0) { ?>
                <label for="intlregion">Region / State</label>
                <select name="intlregion" class="form-control custom-select" id="intlregion">
                    <option value="<?php echo ($intl_region_state_id == 3890 ? 0 : " "); ?>"id="notInList" <?php echo ($intl_region_state_id==3890
                        ? " selected" : ""); ?>>
                        <?php echo ($intl_region_state_id == 3890 ? "Not in List / Other" : "Select Region / State"); ?>
                    </option>
                    <?php while ($row = mysqli_fetch_assoc($result)) {
                        extract($row);
                        echo ($intl_region_state_id == $id ? "<option value=$id selected>$name</option>" : "<option value=$id>$name</option>"); 
                        } ?>
                </select>
                <?php }} ?>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3 province">
                <?php if ($country_id == 164) { ?>
                <label for="province">Province</label>
                <select name="province" class="form-control custom-select" id="province" required>
                    <option value="">Select Province</option>
                    <?php $sql = "SELECT phil_province.province_id,phil_province.province_name FROM phil_province WHERE phil_province.region_id = '$phil_region_id' ORDER BY phil_province.province_name ASC";
                    $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
                    while ($row = mysqli_fetch_assoc($result)) {
                        extract($row);
                        echo ($philprovid == $province_id ? "<option value=$province_id selected>$province_name</option>" : "<option value=$province_id>$province_name</option>");
                    }?>
                </select>
                <?php } ?>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3 city">
                <?php if ($country_id == 164) { ?>
                <label for="city">City / Municipality</label>
                <select name="city" class="form-control custom-select" id="city" required>
                    <option value="">Select City / Municipality</option>
                    <?php $sql = "SELECT phil_city.city_id,phil_city.city_name FROM phil_city WHERE phil_city.province_id = '$philprovid' ORDER BY phil_city.city_name ASC";
                    $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
                    while ($row = mysqli_fetch_assoc($result)) {
                        extract($row);
                        echo ($cityid == $city_id ? "<option value=$city_id selected>$city_name</option>" : "<option value=$city_id>$city_name</option>");
                    }?>
                </select>
                <?php } ?>
            </div>
            <div class="col-sm-6 col-lg-8 mb-3">
                <label for="address">Address</label>
                <textarea class="form-control" name="address" id="address" pattern="^$|^[^\s]+(\s+[^\s]+)*$" auto-complete="street-address"
                    placeholder="Address" row=3 required><?php echo $address; ?></textarea>
            </div>
        </div>
        <div class="d-block mb-1 mx-auto">
            <button class="btn btn-success regBtn" data-function="2" data-index="<?php echo $user_id; ?>" type="submit">Update</button>
            <button type='button' class='btn btn-warning' data-dismiss='modal'>Close</button>
        </div>
    </form>
    <script>
        <?php 
    // create list of countries with no regions
    $sql = "SELECT countries.name FROM countries WHERE NOT EXISTS (SELECT * FROM intl_regions WHERE intl_regions.country_id = countries.id)";
    $result = mysqli_query($conn, $sql);
    $noregion = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $noregion[] = $row["name"];
    }?>
        // list of countries with no regions in database (auto-generated)
        var noRegion = <?php echo json_encode($noregion); ?>;
    </script>
    <?php } else {
        unset($_GET);
        $staff_id = $_SESSION['staff_id'];
        $sql = "SELECT * FROM staff WHERE staff_id = '$staff_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        extract($row); ?>
    <form class="px-1 border border-dark rounded bg-white" id="regForm">
        <div class="form-row">
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" name="firstname" pattern="^$|^[^\s]+(\s+[^\s]+)*$" autocomplete="given-name" id="firstName"
                    placeholder="First name" value="<?php echo $first_name; ?>" required>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control" pattern="^$|^[^\s]+(\s+[^\s]+)*$" name="lastname" autocomplete="family-name" id="lastName"
                    placeholder="Last name" value="<?php echo $last_name; ?>" required>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="registerEmail">Email</label>
                <input type="email" class="form-control" name="email" autocomplete="email" id="registerEmail" data-email="<?php echo $email; ?>"
                    placeholder="Email" value="<?php echo $email; ?>" required>
                <small class="form-text text-muted">
                    <span class="mailCheck"></span>
                </small>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="registerUsername">Username</label>
                <input type="text" class="form-control" name="username" autocomplete="username" data-username="<?php echo $username; ?>"
                    id="registerUsername" pattern="^[A-Za-z0-9_]{1,32}$" placeholder="Username" value="<?php echo $username; ?>"
                    required>
                <small class="form-text text-muted">
                    <span class="userCheck">Maximum 32 characters long. No spaces at start and end.</span>
                </small>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="registerPassword1">Password</label>
                <input type="password" id="registerPassword1" name="password1" class="form-control newPass" autocomplete="new-password" pattern="^(?:\S.{4,}\S)?$"
                    placeholder="Password">
                <small class="form-text text-muted">
                    Minimum of 6 characters. No spaces at start and end.
                </small>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="registerPassword2">Confirm Password</label>
                <input type="password" id="registerPassword2" name="password2" class="form-control newPass" autocomplete="new-password" pattern="^(?:\S.{4,}\S)?$"
                    placeholder="Confirm Password">
                <small class="form-text font-weight-bold passCheck">
                    <span class="matchCheck"></span>
                    <span class="lengthCheck"></span>
                </small>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="inputSex">Gender</label>
                <select class="form-control custom-select" name="sex" id="inputSex" required>
                    <option value="">Select Gender</option>
                    <option value=1<?php echo ($sex==1 ? " selected" : "" ); ?>>Female</option>
                    <option value=2<?php echo ($sex==2 ? " selected" : "" ); ?>>Male</option>
                </select>
            </div>
        </div>
        <div class="d-block mb-1 mx-auto">
            <button class="btn btn-success regBtn" data-function="4" data-index="<?php echo $staff_id; ?>" type="submit">Update</button>
            <button type='button' class='btn btn-warning' data-dismiss='modal'>Close</button>
        </div>
    </form>
    <?php }}

// register new user in database and assign a cart id or update existing user // update or add staff
if (isset($_POST["user"])) {
    $firstname = mysqli_real_escape_string($conn, $_POST["firstname"]);
    $lastname = mysqli_real_escape_string($conn, $_POST["lastname"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $sex = mysqli_real_escape_string($conn, $_POST["sex"]);
    if (isset($_POST["birthday"])) {
        $birthday = date("Y-m-d", strtotime(mysqli_real_escape_string($conn, $_POST["birthday"])));
    }
    if (isset($_POST["country"])) {
        $country = mysqli_real_escape_string($conn, $_POST["country"]);
    }
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
    if (isset($_POST["address"])) {
        $address = mysqli_real_escape_string($conn, $_POST["address"]);
    }

    // register user
    if ($_POST["user"] == 1) {
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        unset($_POST);
    
        $sql = "INSERT INTO users (user_id, username, password, email, first_name, last_name, sex, birthday, address, city_id, province_id, phil_region_id, intl_region_state_id, country_id, creation_date, update_date) SELECT * FROM (SELECT NULL as id, '$username' as user, '$password' as pass, '$email' as mail, '$firstname' as firstname, '$lastname' as lastname, '$sex' as sex, '$birthday' as bday, '$address' as streetaddress, $city as city, $province as province, $philregion as philregion, $intlregion as intlregion, '$country' as country, CURRENT_TIMESTAMP as creationtime, NULL as updatetime) AS tmp WHERE NOT EXISTS (SELECT staff.username FROM staff WHERE staff.username = '$username');";
    
        $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
        
        $sql = "INSERT INTO cart (user_id, cart_status_id) VALUES ((SELECT user_id FROM users WHERE username = '$username'),3)";
        
        $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
        
        // update user
    } else if ($_POST["user"] == 2) {
        if ($_POST["password"] == "") {
            $user_id = mysqli_real_escape_string($conn, $_POST["userid"]);
            unset($_POST);
            $sql = "UPDATE users SET username = '$username', email = '$email', first_name = '$firstname', last_name = '$lastname', sex = '$sex', birthday = '$birthday', address = '$address', city_id = '$city', province_id = '$province', phil_region_id = '$philregion', intl_region_state_id = '$intlregion', country_id = '$country' WHERE user_id = '$user_id'";
            $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
        } else {
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $user_id = mysqli_real_escape_string($conn, $_POST["userid"]);
            unset($_POST);
            $sql = "UPDATE users SET username = '$username', password = '$password', email = '$email', first_name = '$firstname', last_name = '$lastname', sex = '$sex', birthday = '$birthday', address = '$address', city_id = '$city', province_id = '$province', phil_region_id = '$philregion', intl_region_state_id = '$intlregion', country_id = '$country' WHERE user_id = '$user_id'";
            $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
        }
        
        // register staff
    } else if ($_POST["user"] == 3) {
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        unset($_POST);
        $sql = "INSERT INTO staff (username, password, email, first_name, last_name, sex) VALUES ('$username', '$password', '$email', '$firstname', '$lastname', '$sex')";
        $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
        
        // update staff
    } else if ($_POST["user"] == 4) {
        if ($_POST["password"] == "") {
            unset($_POST);
            $staff_id = $_SESSION['staff_id'];
            $sql = "UPDATE staff SET username = '$username', email = '$email', first_name = '$firstname', last_name = '$lastname', sex = '$sex' WHERE staff_id = '$staff_id'";
            $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
        } else {
            $staff_id = $_SESSION['staff_id'];
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            unset($_POST);
            $sql = "UPDATE staff SET username = '$username', password = '$password', email = '$email', first_name = '$firstname', last_name = '$lastname', sex = '$sex' WHERE staff_id = '$staff_id'";
            $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
        }}
    }
    
    // delete user
    if (isset($_POST["deluser"])) {
        if ($_POST["deluser"] == 1) {
            $user_id = mysqli_real_escape_string($conn, $_POST["userId"]);
            unset($_POST);
            
            $sql = "DELETE FROM cart_items WHERE cart_id IN (SELECT cart_id FROM cart WHERE user_id = '$user_id')";
            $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
            
            $sql = "DELETE FROM cart WHERE user_id = '$user_id'";
            $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
            
            $sql = "DELETE FROM users WHERE user_id = '$user_id'";
            $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);

            // delete staff
        } else if ($_POST["deluser"] == 2) {
            unset($_POST);
            $staff_id = $_SESSION['staff_id'];
            $sql = "DELETE FROM staff WHERE staff_id = '$staff_id'";
            $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
            
            // delete item
        } else if ($_POST["deluser"] == 3) {
            $item_id = mysqli_real_escape_string($conn, $_POST["userId"]);
            unset($_POST);
            $sql = "DELETE FROM cart_items WHERE item_id = '$item_id'";
            $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
            $sql = "DELETE FROM products WHERE product_id = '$item_id'";
            $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
    }
}

// add item
if (isset($_GET["additem"])) {
    unset($_GET); ?>
    <form class="px-1 border border-dark rounded bg-white col-12 col-md-10 col-lg-6 mx-auto" action="additem.php" method="post" enctype="multipart/form-data" id="regItemForm">
        <h2 class="font-weight-bold mb-3">Register Product</h2>
        <div class="form-group">
            <label>Product Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Product Name" required>
        </div>
        <div class="form-group">
            <label>Price</label>
            <input type="number" class="form-control" id="price" name="price" placeholder="Price" required>
        </div>
        <div class="form-group">
            <label>Image Upload</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="image" name="image" required>
                <label class="custom-file-label">Choose Image...</label>
            </div>
        </div>
        <div class="form-group">
            <label>Processor</label>
            <input type="text" class="form-control" id="processor" name="processor" placeholder="Processor">
        </div>
        <div class="form-group">
            <label>Screen Size</label>
            <input type="number" class="form-control" id="screensize" name="screensize" placeholder="Screen Size">
        </div>
        <div class="form-group">
            <label>RAM</label>
            <input type="number" class="form-control" id="ram" name="ram" placeholder="RAM">
        </div>
        <div class="form-group">
            <label>HDD</label>
            <input type="text" class="form-control" id="hdd" name="hdd" placeholder="HDD">
        </div>
        <div class="form-group">
            <label>GPU</label>
            <input type="text" class="form-control" id="gpu" name="gpu" placeholder="GPU">
        </div>
        <div class="form-group">
            <label>Product Description</label>
            <textarea class="form-control" id="description" rows="3" name="description" placeholder="Product Description" required></textarea>
        </div>
        <div class="form-group">
            <label>Brand</label>
            <select class="form-control" name="brand" required>
                <option value="">Select Brand</option>
                <?php $sql = "SELECT brand_id,brand_name FROM brands";
            $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
            while ($row = mysqli_fetch_assoc($result)) {
                extract($row);
                echo "<option value=$brand_id>$brand_name</option>";
            } ?>
            </select>
        </div>
        <div class="form-group">
            <label>Category</label>
            <select class="form-control" name="category" required>
                <option>Select Category</option>
                <?php $sql = "SELECT category_id,category FROM categories";
            $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
            while ($row = mysqli_fetch_assoc($result)) {
                extract($row);
                echo "<option value=$category_id>$category</option>";
            } ?>
            </select>
        </div>
        <div class="d-block mb-1 mx-auto">
            <button class="btn btn-success regItemBtn" type="submit">Register Item</button>
            <button type='button' class='btn btn-warning' data-dismiss='modal'>Close</button>
        </div>
    </form>
    <?php }

// edit item
if (isset($_GET["edititem"])) {
    $index = mysqli_real_escape_string($conn, $_GET["index"]);
    $name = mysqli_real_escape_string($conn, $_GET["name"]);
    $price = mysqli_real_escape_string($conn, $_GET["price"]);
    $image = mysqli_real_escape_string($conn, $_GET["image"]);
    if (isset($_GET["processor"])) {
        $processor = mysqli_real_escape_string($conn, $_GET["processor"]);
    } else {
        $processor = "";
    }
    if (isset($_GET["screensize"])) {
        $screensize = mysqli_real_escape_string($conn, $_GET["screensize"]);
    } else {
        $screensize = "";
    }
    if (isset($_GET["ram"])) {
        $ram = mysqli_real_escape_string($conn, $_GET["ram"]);
    } else {
        $ram = "";
    }
    if (isset($_GET["hdd"])) {
        $hdd = mysqli_real_escape_string($conn, $_GET["hdd"]);
    } else {
        $hdd = "";
    }
    if (isset($_GET["gpu"])) {
        $gpu = mysqli_real_escape_string($conn, $_GET["gpu"]);
    } else {
        $gpu = "";
    }
    $brand = mysqli_real_escape_string($conn, $_GET["brand"]);
    $category_name = mysqli_real_escape_string($conn, $_GET["category"]);
    unset($_GET); ?>
    <form class="px-1 border border-dark rounded bg-white col-12 col-md-10 col-lg-6 mx-auto" action="edititem.php" method="post" enctype="multipart/form-data" id="regItemForm">
        <h2 class="font-weight-bold mb-3">Update Product</h2>
        <input type="text" class="form-control d-none" value="<?php echo $index; ?>" id="name" name="index" placeholder="Product Name" required>
        <div class="form-group">
            <label>Product Name</label>
            <input type="text" class="form-control" value="<?php echo $name; ?>" id="name" name="name" placeholder="Product Name" required>
        </div>
        <div class="form-group">
            <label>Price</label>
            <input type="number" class="form-control" value="<?php echo $price; ?>" id="price" name="price" placeholder="Price" required>
        </div>
        <div class="form-group">
            <label>Image Upload</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" value="<?php echo $image; ?>" id="image" name="image" required>
                <label class="custom-file-label">Choose Image...</label>
            </div>
        </div>
        <div class="form-group">
            <label>Processor</label>
            <input type="text" class="form-control" value="<?php echo $processor; ?>" id="processor" name="processor" placeholder="Processor">
        </div>
        <div class="form-group">
            <label>Screen Size</label>
            <input type="number" class="form-control" value="<?php echo $screensize; ?>" id="screensize" name="screensize" placeholder="Screen Size">
        </div>
        <div class="form-group">
            <label>RAM</label>
            <input type="number" class="form-control" value="<?php echo $ram; ?>" id="ram" name="ram" placeholder="RAM">
        </div>
        <div class="form-group">
            <label>HDD</label>
            <input type="text" class="form-control" value="<?php echo $hdd; ?>" id="hdd" name="hdd" placeholder="HDD">
        </div>
        <div class="form-group">
            <label>GPU</label>
            <input type="text" class="form-control" value="<?php echo $gpu; ?>" id="gpu" name="gpu" placeholder="GPU">
        </div>
        <div class="form-group">
            <label>Product Description</label>
            <?php $sql = "SELECT item_description FROM products WHERE product_id = $index";
            $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
            $row = mysqli_fetch_assoc($result);
                extract($row); ?>
            <textarea class="form-control" id="description" rows="3" name="description" placeholder="Product Description" required><?php echo $item_description; ?></textarea>
        </div>
        <div class="form-group">
            <label>Brand</label>
            <select class="form-control" name="brand" required>
                <option value="">Select Brand</option>
                <?php $sql = "SELECT brand_id,brand_name FROM brands";
            $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
            while ($row = mysqli_fetch_assoc($result)) {
                extract($row);
                echo ($brand == $brand_name ? "<option value=$brand_id selected>$brand_name</option>" : "<option value=$brand_id>$brand_name</option>");
            } ?>
            </select>
        </div>
        <div class="form-group">
            <label>Category</label>
            <select class="form-control" name="category" required>
                <option>Select Category</option>
                <?php $sql = "SELECT category_id,category FROM categories";
            $result = mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
            while ($row = mysqli_fetch_assoc($result)) {
                extract($row);
                echo ($category_name == $category ? "<option value=$category_id selected>$category</option>" : "<option value=$category_id>$category</option>");
            } ?>
            </select>
        </div>
        <div class="d-block mb-1 mx-auto">
            <button class="btn btn-success regItemBtn" type="submit">Update Item</button>
            <button type='button' class='btn btn-warning' data-dismiss='modal'>Close</button>
        </div>
    </form>
    <?php } ?>