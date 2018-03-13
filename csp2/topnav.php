<!-- #navBar / top navbar -->
<nav class="navbar navbar-expand-md navbar-light bg-white pt-1 pb-0 px-1 px-md-3" id="navBar">
    <!-- .navbar-toggler dropdown button when top navbar collapses -->
    <button class="navbar-toggler" id="navbarTgl" type="button" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- .navbar-brand -->
    <a class="navbar-brand font-weight-bold mr-0" href="#">
        <img src="assets/img/1.png" width="30" height="30" class="d-inline-block imgbrand align-top" alt="">
        <span>Pinoyware</span>
    </a>

    <!-- #ddsu1 / dropdown for login/sign-up 1 (ddsu1) -->
    <div class="dropdown d-md-none" id="ddsu1">
        <?php if (isset($_SESSION["username"]) && isset($_SESSION["role"])) {
        if ($_SESSION["role"] == "staff") {?>
        <!-- #logOut1 -->
        <button class="btn btn-outline-dark logOut" type="button" id="logOut1">
            <i class="fas fa-sign-out-alt"></i> Logout
        </button>
        <?php } else {?>
        <!-- #dropdownMenuButton1 / user menu .ddsu1 -->
        <button class="btn btn-outline-dark p-0 border-0" type="button" id="dropdownMenuButton1">
            <i class="far fa-user-circle fa-2x"></i>
        </button>
        <!-- .ddsu1 / dropdown user menu 1 -->
        <div class="dropdown-menu dropdown-menu-right text-center ddsu1">
            <span class="d-block d-md-none">Hello
                <?php echo $_SESSION["username"]; ?>!</span>
            <div class="d-block d-md-none dropdown-divider"></div>
            <a class="dropdown-item editProfile" data-index="<?php echo $_SESSION['user_id']; ?>" data-email="<?php echo $_SESSION['email']; ?>" data-name="<?php echo $_SESSION['username']; ?>" href="#">
                <i class="fas fa-wrench"></i> Edit Profile</a>
            <div class="dropdown-divider"></div>
            <button class="btn btn-outline-dark logOut" type="button" id="logOut1">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </div>
        <!-- /.ddsu1 -->
        <?php }} else {?>
        <!-- #dropdownMenuButton1 / dropdown button for login1 .ddsu1 -->
        <button class="btn btn-outline-dark px-1" type="button" id="dropdownMenuButton1" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-sign-in-alt"></i> Login
        </button>
        <!-- .ddsu1 / dropdown menu login/sign-up 1 -->
        <div class="dropdown-menu dropdown-menu-right ddsu1">
            <form class="px-4 py-3 login1">
                <div class="form-group">
                    <label for="DropdownFormUsername1">Username</label>
                    <input type="text" class="form-control" id="DropdownFormUsername1" placeholder="Username" autocomplete="username">
                </div>
                <div class="form-group">
                    <label for="DropdownFormPassword1">Password</label>
                    <input type="password" class="form-control" id="DropdownFormPassword1" placeholder="Password" autocomplete="current-password">
                </div>
                <button type="submit" class="btn btn-success">Login</button>
            </form>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item loginfooter" href="register.php">New around here? Sign up</a>
        </div>
        <!-- /.ddsu1 -->
        <?php }?>
    </div>
    <!-- /#ddsu1 -->

    <!-- #navbarNavDropdown / dropdown menu when top navbar collapses -->
    <div class="collapse navbar-collapse px-2 px-md-0" id="navbarNavDropdown">
        <!-- .navbar-nav / contains links for Home, Products, About, Contact Us -->
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home
                </a>
            </li>
            <!-- #ddp / dropdown for Products -->
            <li class="nav-item active dropdown" id="ddp">
                <!-- #navbarDropdownMenuLink / dropdown button for .ddmenu -->
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" aria-haspopup="true" aria-expanded="false">
                    Products
                </a>
                <!-- .ddmenu / dropdown menu for Products -->
                <div class="dropdown-menu ddmenu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="products.php?cat=2">Desktops</a>
                    <a class="dropdown-item" href="products.php?cat=1">Laptops</a>
                    <a class="dropdown-item" href="products.php?cat=4">Monitors</a>
                    <a class="dropdown-item" href="products.php?cat=3">Headphones</a>
                    <a class="dropdown-item" href="products.php?">All Products</a>
                </div>
                <!-- /.ddmenu -->
            </li>
            <?php if (!isset($_SESSION["username"])) {?>
            <li class="nav-item active">
                <a class="nav-link" href="register.php">Register</a>
            </li>
            <?php }
            if (isset($_SESSION["username"])) {
            if ($_SESSION["role"] == "staff") {?>
            <li class="nav-item active">
                <a class="nav-link" href="admin.php">Admin</a>
            </li>
            <?php }}?>
        </ul>
        <!-- /.navbar-nav -->

        <div class="dropdown-divider"></div>

        <!-- #ddsu2 / dropdown login/sign-up 2 (ddsu2) -->
        <div class="dropdown ml-md-auto mb-1 mb-md-0" id="ddsu2">
            <?php if (isset($_SESSION["username"]) && isset($_SESSION["role"])) {
            if ($_SESSION["role"] == "staff") {?>
            <!-- #logOut2 -->
            <button class="btn btn-outline-dark logOut" type="button" id="logOut2">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
            <?php } else {?>
            <!-- #.dropdownMenuButton2 / dropdown button for user menu 2 .ddsu2 -->
            <button class="btn btn-outline-dark border-0 px-1 px-md-1 mr-2 d-none d-md-inline-flex align-items-center" type="button"
                id="dropdownMenuButton2" aria-haspopup="true" aria-expanded="false">
                <span class="">Hello
                    <?php echo $_SESSION["username"]; ?>! </span>
                <i class="ml-1 far fa-user-circle"></i>
            </button>
            <!-- .ddsu2 / dropdown user menu 2 -->
            <div class="dropdown-menu dropdown-menu-left ddsu2">
                <a class="dropdown-item editProfile" data-index="<?php echo $_SESSION['user_id']; ?>" data-email="<?php echo $_SESSION['email']; ?>" data-name="<?php echo $_SESSION['username']; ?>" href="#">
                    <i class="fas fa-wrench"></i> Edit Profile</a>
            </div>
            <!-- /.ddsu2 -->
            <!-- #logOut2 -->
            <button class="btn btn-outline-dark logOut" type="button" id="logOut2">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
            <?php }} else {?>
            <!-- #.dropdownMenuButton2 / dropdown button for login2 .ddsu2 -->
            <button class="btn btn-outline-dark px-1 px-md-3" type="button" id="dropdownMenuButton2" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
            <!-- .ddsu2 / dropdown menu login/sign-up 2 -->
            <div class="dropdown-menu dropdown-menu-right ddsu2">
                <form class="px-4 py-3 login2">
                    <div class="form-group">
                        <label for="DropdownFormUsername2">Username</label>
                        <input type="text" class="form-control" id="DropdownFormUsername2" placeholder="Username" autocomplete="username">
                    </div>
                    <div class="form-group">
                        <label for="DropdownFormPassword2">Password</label>
                        <input type="password" class="form-control" id="DropdownFormPassword2" placeholder="Password" autocomplete="current-password">
                    </div>
                    <button type="submit" class="btn btn-success">Login</button>
                </form>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item loginfooter" href="register.php">New around here? Sign up</a>
            </div>
            <!-- /.ddsu2 -->
            <?php }?>
        </div>
        <!-- /#ddsu2 -->
    </div>
    <!-- /#navbarNavDropdown -->
</nav>
<!-- /#navBar // top navbar -->