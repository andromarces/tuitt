<?php

// $host = "localhost";
// $username = "root";
// $password = "";
// $dbname = "movies";

require "connection.php"
// $conn = mysqli_connect($host, $username, $password, $dbname); //procedural

// $conn = new mysqli($host, $username, $password, $dbname); //object oriented

if (!$conn) {
    die("Connection failed: " . mysqli_error($conn));
} else {
    echo "Connected successfully<br>";
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM songs WHERE id = $id";
    mysqli_query($conn, $sql);
}

if (isset($_POST['add_song'])) {
    $new_title = $_POST['title'];
    $new_length = $_POST['length'];
    $new_genre = $_POST['genre'];

    $sql = "INSERT INTO songs (title,length,genre,album_id) VALUES ('$new_title',$new_length,'$new_genre',1)";
    mysqli_query($conn, $sql);
}

$sql = "SELECT * FROM songs"; //query deifinition / creation
$result = mysqli_query($conn, $sql); //we run the query

// echo "<br>";
// print_r($result);
?>
    <h2>SONGS</h2>
    <table>
        <tr>
            <th>Title</th>
            <th>Length</th>
            <th>Genre</th>
            <th>Delete?</th>
        </tr>
        <?php
    while ($row = mysqli_fetch_assoc($result)) {
    $title = $row['title'];
    $length = $row['length'];
    $genre = $row['genre'];
    $id = $row['id'];
    // echo "<br>";
    // print_r($row);
    // echo "<hr>"; ?>
            <tr>
                <td>
                    <?php echo $title; ?>
                </td>
                <td>
                    <?php echo $length; ?>
                </td>
                <td>
                    <?php echo $genre; ?>
                </td>
                <td><a href="songs.php?id=<?php echo $id; ?>"><button>Delete!</button></a></td>
            </tr>
            <?php }?>
    </table>
    <h3>Add Song:</h3>
    <form method="POST" action="">
        Title:
        <input type="text" name="title">
        <br> Length:
        <input type="text" name="length">
        <br> Genre:
        <input type="text" name="genre">
        <br>
        <input type="submit" name="add_song" value="Add Song">
    </form>
    <?php

// echo "<br>";
// print_r($result);

// $result = mysqli_query($conn,"SELECT * FROM users") or die("Error");
// mysqli_close($conn);