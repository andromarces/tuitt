<?php
require 'connection.php';

// echo $_POST['index'];
if (isset($_POST['add'])) { ?>
    <form action="additem.php" method="post" enctype="multipart/form-data">
        <div class="card mx-auto" style="width: 18rem;">
            <div class="card-body">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Name</span>
                    </div>
                    <input type="text" class="form-control" aria-label="name" name="name" aria-describedby="basic-addon1" value="...">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2">Description</span>
                    </div>
                    <textarea name="description">...</textarea>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">Price</span>
                    </div>
                    <input type="number" min=0 class="form-control" name="price" aria-label="price" aria-describedby="basic-addon3" value=0>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2">Category</span>
                    </div>
                    <select name='category'>
                        <option>Select Category</option>
                        <?php $sql = "SELECT * FROM categories";
		                $result = mysqli_query($conn,$sql);
		                while($row = mysqli_fetch_assoc($result)){
			            extract($row);
			            echo "<option value='$id'>$name</option>"; } ?>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">Image</span>
                    </div>
                    <input type='file' name='image'>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Add Item</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>
    <?php } else {

$index = $_POST['index'];
// $string = file_get_contents("items.json");
// $items = json_decode($string, true);

$sql = "SELECT * FROM items WHERE id=$index";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
extract($row);

// $img = $items[$index]['img'];
// $name = $items[$index]['name'];
// $description = $items[$index]['description'];
// $price = $items[$index]['price'];?>

    <!-- <div class="row">
        <div class="col-xs-4 item_display">
            <form>
                <img src="<?php //echo $img; ?>">
                <br> Name:
                <input type="text" name="name" value="<?php //echo $name; ?>">
                <br> Description:
                <textarea>
                    <?php //echo $description; ?>
                </textarea>
                <br> Price: Php
                <input type="number" min=0 value="<?php //echo $price; ?>">
            </form>
        </div>
    </div> -->
    <form action="edit.php?index=<?php echo $index; ?>" method="post">
        <div class="card mx-auto" style="width: 18rem;">
            <img class="card-img-top" src="<?php echo $img; ?>" alt="Card image cap">
            <div class="card-body">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Name</span>
                    </div>
                    <input type="text" class="form-control" aria-label="name" name="name" aria-describedby="basic-addon1" value="<?php echo $name; ?>">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2">Description</span>
                    </div>
                    <textarea name="description"><?php echo $description; ?></textarea>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">Price</span>
                    </div>
                    <input type="number" min=0 class="form-control" name="price" aria-label="price" aria-describedby="basic-addon3" value="<?php echo $price; ?>">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>

    <?php } ?>