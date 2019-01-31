<?php 
	include "../includes/admin-navbar.php";
	include "../includes/db_handler.php"; 
	session_start();

	if(isset($_SESSION['id'])) {
		$mod = $_GET['id'];
		$user = base64_decode(urldecode($mod));

		$sql = "SELECT * FROM users WHERE username = '$user'"; 
		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

	    while($row = mysqli_fetch_array($result)) { 
	    	$rid = $row['id'];
	    	$name = $row['name'];
	    	$user = $row['username'];
	    	$pass = $row['password'];
	    	$rank = $row['rank'];
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
			<h2><b>Edit User</b></h2>
			<hr>
		    <div class="row clearfix">
		    	<div class="col-md-6">
		    		<label>Name</label>
					<input type="text" name="name" class="form-control" value="<?php if (isset($_GET['id'])) { print $name; }?>">
		    	</div>
		    	<div class="col-md-6">
		    		<label>Username</label>
					<input type="text" name="username" class="form-control" value="<?php if (isset($_GET['id'])) { print $user; }?>">
					<br>
		    	</div>
		    	<div class="col-md-12">
		    		<label>Account Type</label>
					<select id="rank" name="rank" class="form-control">
						<option disabled selected>-- SELECT --</option>
						<option value="Programme Leader"<?php echo ($rank == 'Programme Leader' ? ' selected = "selected"' : ''); ?>>Programme Leader</option>
						<option value="Module Leader"<?php echo ($rank == 'Module Leader' ? ' selected = "selected"' : ''); ?>>Module Leader</option>
						<option value="Student"<?php echo ($rank == 'Student' ? ' selected = "selected"' : ''); ?>>Student</option>
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
		$username1 = mysqli_real_escape_string($conn, $_REQUEST['username']);
		$rank1 = mysqli_real_escape_string($conn, $_REQUEST['rank']);
			
		$query = "UPDATE users SET name = '$name1', username = '$username1', rank = '$rank1' WHERE id = '$rid'";
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

		mysqli_close($conn);
		echo '<script type="text/javascript">','window.location.href = "../home/adminHome.php#euCreated"','</script>';
	}
?>

<?php
	}
	else {
		echo "<h1>Please login first</h1>";
	}
?>