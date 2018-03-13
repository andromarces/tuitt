<?php

function display_title()
{
    echo "Items";
}

function display_style()
{?>
    <style>
        strong {
            font-size: 1.5rem;
        }

        strong.cartprice {
            font-size: 1.1rem;
        }

        .qty {
            width: 70px;
            height: 30px;
        }

        .cartqty {
            width: 40px;
        }

        img.align-self-center {
            width: 50px;
        }
    </style>
    <?php }
// $ages = [
//     'Peter' => 35,
//     'Ben' => 37,
//     'Joe' => 43,
// ];

// echo $ages['Peter']."<br>";
// echo $ages['Ben']."<br>";
// echo $ages['Joe']."<br>";

// foreach ($ages as $name => $age) {
//     echo "$name $age <br>";
// }

// $item1 = [
//     'name' => 'Coffee',
//     'description' => 'Powerful coffee drink.',
//     'price' => 3,
//     'img' => 'assets/img/coffee.jpeg',
//     'category' => 'Drinks',
// ];

// $item2 = [
//     'name' => 'Juice',
//     'description' => 'Natural fruit juice.',
//     'price' => 2,
//     'img' => 'assets/img/juice.jpeg',
//     'category' => 'Drinks',
// ];

// $item3 = [
//     'name' => 'Donut',
//     'description' => 'A ring of goodness.',
//     'price' => 4,
//     'img' => 'assets/img/donut.jpeg',
//     'category' => 'Food',
// ];

// $item4 = [
//     'name' => 'Cake',
//     'description' => 'A slice of heaven.',
//     'price' => 5,
//     'img' => 'assets/img/cake.jpeg',
//     'category' => 'Food',
// ];

// $item5 = [
//     'name' => 'Water',
//     'description' => "Good ol' H2O.",
//     'price' => 1,
//     'img' => 'assets/img/water.jpeg',
//     'category' => 'Drinks',
// ];

// $item6 = [
//     'name' => 'Ice Cream',
//     'description' => 'Great for those hot days.',
//     'price' => 6,
//     'img' => 'assets/img/icecream.jpeg',
//     'category' => 'Food',
// ];

// $items = [
//     $item1,
//     $item2,
//     $item3,
//     $item4,
//     $item5,
//     $item6,
// ];

// $file = fopen('items.json', 'w');
// fwrite($file, json_encode($items, JSON_PRETTY_PRINT)); /* rewrite the json file */
// fclose($file); /* close the json file */

// exit();

// foreach ($items as $item) {
//     // print_r($item);
//     foreach ($item as $key => $value) {
//         echo "$key: $value <br>";
//     }
//     echo "<hr>";
// }

// $string = file_get_contents("items.json");
// $items = json_decode($string, true);


function display_content()
{
    require 'connection.php';
    // global $items;
    // $categories = array_unique(array_column($items, 'category'));
    $sql = "SELECT * FROM categories";
    $result = mysqli_query($conn,$sql);
    $filter = isset($_GET['category']) ? $_GET['category'] : 'All';?>
    <div class='col-12 col-md-8 col-lg-9'>
        <div class='row mb-1'>
            <form class='col row'>
                <strong class="pr-2">Filter:</strong>
                <select class='custom-select col-2' name='category'>
                    <option value="All">All</option>
                    <?php //foreach ($categories as $category) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $category = $row['name']; ?>

                    <?php
                    echo $filter == $row['id'] ? "<option value='".$row['id']."' selected>$category</option>" : "<option value='".$row['id']."'>$category</option>";} ?>
                </select>
            </form>
            <?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin') { ?>
            <button type="button" class="btn btn-success" id="additem" data-toggle="modal" data-target="#myModal">Add Item</button>
            <?php } ?>
        </div>

        <div class='row'>
            <?php 
            $sql = "SELECT * FROM items";
            $result = mysqli_query($conn,$sql);
            while($item = mysqli_fetch_assoc($result)) {
                $index = $item['id'];
            //foreach ($items as $index => $item) {
            if ($filter == 'All' || $item['category_id'] == $filter) {?>
            <div class='col-12 col-md-6 col-lg-4 card' style='width: 18rem;'>
                <img class='card-img-top' src='<?php echo $item["img"]; ?>' alt='img' style='max-height: 165px;'>
                <div class='card-body'>
                    <p>
                        Name:
                        <?php echo $item['name']; ?>
                        <br> Description:
                        <?php echo $item['description']; ?>
                        <br> Price: Php
                        <?php echo $item['price']; ?>
                        <?php
                        if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin') { ?>
                        <br>
                        <button type="button" class="btn btn-primary render_modal_body" data-toggle="modal" data-target="#myModal" data-index="<?php echo $index; ?>">Edit</button>
                        <button type="button" class="btn btn-danger delbtn" data-toggle="modal" data-target=".bd-modal-sm" data-index="<?php echo $index; ?>"
                            data-name="<?php echo $item['name']; ?>" data-image="<?php echo $item['img']; ?>">Delete</button>
                        <?php } else if (isset($_SESSION['username'])) {?>
                        <br>
                        <form action="cartadd.php?index=<?php echo $index; ?>" method="post">
                            <input type="number" name="qty" class="qty" value=1>
                            <button type="submit" class="btn btn-success addcart">Add to Cart</button>
                        </form>
                        <?php }?>
                    </p>
                </div>
            </div>
            <?php }}?>
        </div>
    </div>

    <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal-body" class="modal-body">

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-modal-sm" tabindex="-1" role="dialog" aria-labelledby="delete modal" aria-hidden="true">
        <div class="modal-dialog modal-sm text-center">
            <form action="" method="post" class="modal-content">
                <img id="delmodimg" src="" class="img-fluid rounded" alt="img">
                <strong id="spanName"></strong>
                <button type="submit" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </form>
        </div>
    </div>
    <?php }

function display_script()
{?>
    <script>
        $('select[name=category]').change(function () {
            // alert("Y");
            $('form[class="col row"]').submit();
        });
        $(".render_modal_body").click(function () {
            var index = $(this).data('index');
            // $.post('render_modal_body_endpoint.php', {
            //     //variables (key-value pairs to be passed)
            //     index: index
            // }, function (data) {
            //     $("#modal-body").html(data);
            // });
            $.ajax({
                method: 'post',
                url: 'render_modal_body_endpoint.php',
                data: {
                    index: index
                },
                success: function (data) {
                    $("#modal-body").html(data);
                }
            });
        });
        $('#additem').click(function () {
            $.ajax({
                method: 'post',
                url: 'render_modal_body_endpoint.php',
                data: {
                    add : true
                },
                success: function (data) {
                    console.log(data);
                    $("#modal-body").html(data);
                }
            });
        });
        $(".delbtn").click(function () {
            var index = $(this).data('index');
            var name = $(this).data('name');
            var img = $(this).data('image');
            $('#spanName').html("Confirm deletion of \"" + name + "\"?");
            $('form.modal-content').attr("action", "del.php?index=" + index);
            $('#delmodimg').attr("src", img);
        });
        $(".updateqty").click(function () {
            var index = $(this).data('index');
            $('form.cart').attr("action", "cartedit.php?index=" + index);
        })
        $(".removecart").click(function () {
            var index = $(this).data('index');
            $(this).siblings('input.cartqty').attr("value", 0);
            $('form.cart').attr("action", "cartedit.php?index=" + index);
        });
    </script>

    <?php }

require "template.php";

?>