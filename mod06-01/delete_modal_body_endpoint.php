Are you sure you want to delete this item:
<br>
<?php
$index = $_POST['index'];
// $string = file_get_contents("assets/items.json");
// $items = json_decode($string, true);
require 'connection.php';

$sql = "SELECT * FROM items WHERE id = '$index'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
extract($row);

// $img = $items[$index]['img'];
// $name = $items[$index]['name'];
// $description = $items[$index]['description'];
// $price = $items[$index]['price'];
echo "<div class='row'>";
echo "<div class='col-xs-4 item_display'>";
echo "<img src='$image'>";
echo "<h5>$name</h5>";
echo "Price: Php$price<br>";
echo "</div></div>";

?>
<a href='delete.php?index=<?php echo $index; ?>'><button class="btn btn-danger">Yes</button></a> <button class="btn btn-primary" data-dismiss='modal'>No</button>