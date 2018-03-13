<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="home.php">TUITT Cafe</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="home.php">Home</a></li>
      <li><a href="menu.php">Menu</a></li>
      <li><a href="cart.php">Cart</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="contact.php">Contact</a></li>
      <?php
      echo isset($_SESSION['username']) ? '<li><a href="logout.php">Logout</a></li>' : '' ;
      ?>
    </ul>
  </div>
</nav>
