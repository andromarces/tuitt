<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><?php
if (isset($_SESSION['username'])) {
    echo "Hello " . $_SESSION['username'];
} else {
    echo "Pinoyware";
}?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="items.php">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact Us</a>
            </li>
            <?php if (isset($_SESSION['username'])) {?>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Log Out</a>
            </li>
            <?php } else {?>
            <li class="nav-item">
                <a class="nav-link" href="register.php">Register</a>
            </li>
            <?php }?>
        </ul>
    </div>
</nav>