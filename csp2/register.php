<?php session_start();
if (isset($_SESSION["username"])) {
    header("location: index.php");
} else {

function display_title()
{
    echo "Pinoyware - Register";
}

function display_css()
{?>
<link rel="stylesheet" href="assets/css/register.css">
<?php }

function display_bottom_nav()
{}

function display_content()
{
    require "connection.php";?>

<h1 class="text-center">Registration</h1>

<form class="col-12 col-md-10 col-lg-9 col-xl-8 mx-auto px-0 px-md-3" id="regForm">
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
            <div class="row col-12 mx-0 px-0 birthDay">
                <select name="month" class="form-control custom-select col-4" id="birthMonth" required>
                    <option value="">Month</option>
                    <option value=1>January</option>
                    <option value=2>February</option>
                    <option value=3>March</option>
                    <option value=4>April</option>
                    <option value=5>May</option>
                    <option value=6>June</option>
                    <option value=7>July</option>
                    <option value=8>August</option>
                    <option value=9>September</option>
                    <option value=10>October</option>
                    <option value=11>November</option>
                    <option value=12>December</option>
                </select>
                <input type="number" id="birthDate" name="day" class="form-control col-4" min=1 max=31 placeholder="Day" required>
                <input type="number" id="birthYear" name="year" class="form-control col-4" min="<?php echo date('Y', strtotime('- 115 years')); ?>" max="<?php echo date('Y', strtotime('- 18 years')); ?>" placeholder="Year" required>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm-6 col-lg-4 mb-3">
            <label for="country">Country</label>
            <select name="country" class="form-control custom-select" id="country" autocomplete="country-name" required>
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
            <textarea class="form-control" name="address" id="address" pattern="^$|^[^\s]+(\s+[^\s]+)*$" autocomplete="street-address"
                placeholder="Address" row=3 required></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
            <label class="form-check-label" for="invalidCheck">
                Agree to terms and conditions.
            </label>
        </div>
    </div>
    <button class="btn btn-success regBtn d-block mx-auto" type="submit" disabled>Register</button>
</form>

<?php }

function display_js()
{?>
<script>
    <?php require "connection.php";
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

<script src="assets/js/register.js"></script>
<?php }
require "template.php";    
}