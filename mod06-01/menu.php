<?php
// require_once "items.php"; //replace with code to get items from the json file

// $string = file_get_contents("assets/items.json");
// $items = json_decode($string, true);

function display_title(){
	echo "Menu Page";
}

function display_content(){
	// global $items;
	// $categories = array_unique(array_column($items, 'category'));
	
	// $filter = 'All';
	$filter = isset($_GET['category']) ? $_GET['category'] : 'All';
	// if(isset($_GET['category']))
	// 	$filter = $_GET['category'];
	require 'connection.php';

	if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){
		echo "<button class='btn btn-success' id='add_item'>Add Item</button>";
	}

	echo "<form><select name='category'><option>All</option>";
	$sql = "SELECT * FROM categories";
	$result = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_assoc($result)){
		$id = $row['id'];
		$category = $row['name'];
	// foreach ($categories as $category) {
		// if($filter == $category)
		// 	echo "<option selected>$category</option>";
		// else
			// echo "<option value='$id'>$category</option>";
		echo $filter == $id ? "<option selected value='$id'>$category</option>" : "<option value='$id'>$category</option>";
	}
	echo "</select>";
	echo "<button>Search</button></form>";

	$sql = "SELECT * FROM items";
	$result = mysqli_query($conn,$sql);
	echo "<div class='row'>";
	while($item = mysqli_fetch_assoc($result)) {
		$index = $item['id'];
	// foreach ($items as $index => $item) {
		if($filter == 'All' || $item['category_id'] == $filter){

			echo "<div class='col-xs-4 item_display'><img src='".$item['image']."'>";
			echo "<h5>".$item['name']."</h5>";
			echo "Price: Php".$item['price']."<br>";
			if(isset($_SESSION['username']) && $_SESSION['role'] == 'admin'){
				echo "<button class='btn btn-primary render_modal_body' data-toggle='modal' data-target='#myModal' data-index='$index'>Edit</button>";
				echo "<button class='btn btn-danger delete_modal_body' data-toggle='modal' data-target='#myModal' data-index='$index'>Delete</button>";
			}
			else if(isset($_SESSION['username'])){
				echo "<form method='POST' action='add_to_cart.php?index=$index'>";
					echo "<input type='number' name='quantity' min=0>";
					echo "<button class='btn btn-success'>Add to Cart</button>";
				echo "</form>";
			}
			echo "</div>"; 
		}
	} //endforeach //endwhile
	echo "</div>";	

	//edit modal
	echo '<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Modal Header</h4>
	      </div>
	      <div class="modal-body" id="modal-body">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>';

	//delete modal
	// echo '<div id="deleteModal" class="modal fade" role="dialog">
	//   <div class="modal-dialog">
	//     <div class="modal-content">
	//       <div class="modal-header">
	//         <button type="button" class="close" data-dismiss="modal">&times;</button>
	//         <h4 class="modal-title">Modal Header</h4>
	//       </div>
	//       <div class="modal-body" id="delete-modal-body">
	//       </div>
	//       <div class="modal-footer">
	//         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	//       </div>
	//     </div>

	//   </div>
	// </div>';
} //end function display_content()

require "template.php";

?>

<script type="text/javascript">
	$("#add_item").click(function(){
		$.ajax({
			method: 'post',
			url: 'render_modal_body_endpoint.php',
			data: {
				add : true,
			},
			success: function(data){
				// alert(data)
				$("#modal-body").html(data);
				$("#myModal").modal('show');
			}
		})
	})

	$(".render_modal_body").click(function(){
		var index = $(this).data('index')
		// $.post('render_modal_body_endpoint.php',{
		// 	index : index	
		// },function(data){
		// 	$("#modal-body").html(data);
		// })

		$.ajax({
			method: 'post',
			url: 'render_modal_body_endpoint.php',
			data: {
				edit : true,
				index : index
			},
			success: function(data){
				$("#modal-body").html(data);
			}
		})
	})

	$(".delete_modal_body").click(function(){
		var index = $(this).data('index')
		$.ajax({
			method: 'post',
			url: 'delete_modal_body_endpoint.php',
			data: {
				index : index
			},
			success: function(data){
				$("#modal-body").html(data);
			}
		})
	})
</script>