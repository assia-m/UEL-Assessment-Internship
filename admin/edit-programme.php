<?php 
	include "../includes/admin-navbar.php";
	include "../includes/db_handler.php"; 
	session_start();

	if(isset($_SESSION['id'])) {
		$mod = $_GET['id'];
		$user = base64_decode(urldecode($mod));

		$sql = "SELECT * FROM programme WHERE id = '$user'"; 
		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

	    while($row = mysqli_fetch_array($result)) { 
	    	$rid = $row['id'];
	    	$name = $row['name'];
	    	$rank = $row['category'];
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
			<h2><b>Edit Programme</b></h2>
			<hr>
		    <div class="row clearfix">
		    	<div class="col-md-6">
		    		<label>Name</label>
					<input type="text" name="name" class="form-control" value="<?php if (isset($_GET['id'])) { print $name; }?>">
		    	</div>
		    	<div class="col-md-6">
		    		<label>Category</label>
					<select id="rank" name="rank" class="form-control">
						<option disabled selected>-- SELECT --</option>
						<option value="Bachelor"<?php echo ($rank == 'Bachelor' ? ' selected = "selected"' : ''); ?>>Bachelor</option>
						<option value="Masters"<?php echo ($rank == 'Masters' ? ' selected = "selected"' : ''); ?>>Masters</option>
					</select>
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
		$rank1 = mysqli_real_escape_string($conn, $_REQUEST['rank']);
			
		$query = "UPDATE programme SET name = '$name1', category = '$rank1' WHERE id = '$rid'";
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

		mysqli_close($conn);
		echo '<script type="text/javascript">','window.location.href = "../home/adminHome.php#epCreated"','</script>';
	}
?>

<?php
	}
	else {
		echo "<h1>Please login first</h1>";
	}
?>