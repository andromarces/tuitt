<div id='sidebar'>
	<?php

	if(isset($_SESSION['username'])) :
		echo "<h4>Hello ".$_SESSION['username'];
	else : ?>
	<form method="POST" action="authenticate.php">
		<div class="form-group">
			<label for="email">Username:</label>
			<input type="text" class="form-control" id="username" name="username">
		</div>
		<div class="form-group">
			<label for="pwd">Password:</label>
			<input type="password" class="form-control" id="pwd" name="password">
		</div>
		<div class="checkbox">
			<label><input type="checkbox"> Remember me</label>
		</div>
		<input type="submit" name="login" class="btn btn-default" value="Login">
		<!-- <button type="submit" class="btn btn-default">Submit</button> -->
	</form>
	<?php endif; ?>
</div>
