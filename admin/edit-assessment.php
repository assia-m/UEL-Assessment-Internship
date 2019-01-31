<?php 
	include "../includes/admin-navbar.php";
	include "../includes/db_handler.php"; 
	session_start();

	if(isset($_SESSION['id'])) {
		$mod = $_GET['id'];
		$user = base64_decode(urldecode($mod));

		$sql = "SELECT * FROM coursework WHERE id = '$user'"; 
		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

	    while($row = mysqli_fetch_array($result)) { 
	    	$rid = $row['id'];
	    	$name = $row['name'];
	    	$weight = $row['weights'];
	    	$desc = $row['description'];
		}
?>

<!DOCTYPE html>
<html>
<head>
	<link href="//netdna.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//netdna.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<title></title>
</head>
<body>
	<br>
	<br>
	<form method="POST">
		<div class="container">
			<h2><b>Edit Assessment</b></h2>
			<hr>
		    <div class="row clearfix">
		    	<div class="col-md-6">
		    		<label>Name</label>
					<input type="text" name="name" class="form-control" value="<?php if (isset($_GET['id'])) { print $name; }?>">
		    	</div>
		    	<div class="col-md-6">
		    		<label>Weight</label>
					<input type="text" name="weight" class="form-control" value="<?php if (isset($_GET['id'])) { print $weight; }?>">
					<br>
		    	</div>
		    	<div class="col-md-12">
		    		<label>Description</label>
					<textarea style="resize: none;" type="text" name="desc" class="form-control"><?php if (isset($_GET['id'])) { print $desc; }?></textarea>
					<br>
		    	</div>
			</div>
			<input type="submit" name="submit" id="submit" class="btn btn-lg btn-success" value="Save Changes">
			<a href="../home/adminHome.php"><button style="color: white;" type="button" class="btn btn-lg btn-info">Cancel</button></a>	
		</div>
	</form>
</body>
</html>

<style type="text/css">
	body {
    	background-color: #e1e9eb;
	}
</style>

<?php 
	if(isset($_POST['submit'])) {
		$uid = mysqli_insert_id($conn);
		$name1 = mysqli_real_escape_string($conn, $_REQUEST['name']);
		$desc1 = mysqli_real_escape_string($conn, $_REQUEST['desc']);
		$weight1 = mysqli_real_escape_string($conn, $_REQUEST['weight']);
			
		$query = "UPDATE coursework SET name = '$name1', description = '$desc1', weights = '$weight1' WHERE id = '$rid'";

		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

		mysqli_close($conn);
		echo '<script type="text/javascript">','window.location.href = "../home/adminHome.php#eaCreated"','</script>';
	}
?>

<?php
	}
	else {
		echo "<h1>Please login first</h1>";
	}
?>