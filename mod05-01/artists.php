<?php

// $host = "localhost";
// $username = "root";
// $password = "";
// $dbname = "movies";
require "connection.php";
// $conn = mysqli_connect($host, $username, $password, $dbname); //procedural

// $conn = new mysqli($host, $username, $password, $dbname); //object oriented

if (!$conn) {
    die("Connection failed: " . mysqli_error($conn));
} else {
    echo "Connected successfully<br>";
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM artists WHERE id = $id";
    mysqli_query($conn, $sql);
}

if (isset($_POST['add_artist'])) {
    $new_artist = $_POST['name'];

    $sql = "INSERT INTO artists (name) VALUES ('$new_artist')";
    mysqli_query($conn, $sql);
}

$sql = "SELECT * FROM artists ORDER BY id"; //query deifinition / creation
$result = mysqli_query($conn, $sql); //we run the query

// echo "<br>";
// print_r($result);
?>
    <h2>SONGS</h2>
    <ul>
        <?php
    while ($row = mysqli_fetch_assoc($result)) {
    $name = $row['name'];
    $id = $row['id'];
    // echo "<br>";
    // print_r($row);
    // echo "<hr>"; ?>
            <li>
                <?php echo $name; ?>
                <a href="artists.php?id=<?php echo $id; ?>">
                    <button> Delete!</button>
                </a>
            </li>
            <?php }?>

            <h3>Add Artist:</h3>
            <form method="POST">
                Artist:
                <input type="text" name="name">
                <br>
                <input type="submit" name="add_artist" value="Add Artist">
            </form>
            <?php

// echo "<br>";
// print_r($result);

// $result = mysqli_query($conn,"SELECT * FROM users") or die("Error");
// mysqli_close($conn);