<?php
	include "../includes/lecturer-navbar.php";
	include "../includes/db_handler.php"; 
	session_start();

	if(isset($_SESSION['id'])) {
		$userid = $_SESSION['id'];
	?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<title></title>
</head>
<body>
	<div class="containter">
		<div class="col-md-12">
			<br>
			<h1 align="center">Hi <?php 
				$sql = "SELECT * FROM users WHERE username = '$userid'";
				$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

				while($row = mysqli_fetch_array($result)) {
					echo $row['name'];
					$lid = $row['id'];
				}

			?></h1>
			<hr>
			<table class="table">
				<thead>
					<th>Programme</th>
					<th>Module</th>
					<th>Options</th>
				</thead>
				<tbody>
					<?php 
						$sql1 = "SELECT * FROM module WHERE leader = '$lid'";
						$result1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));

						if(mysqli_num_rows($result1) > 0) {
							while($row1 = mysqli_fetch_array($result1)) {
								$mcode = $row1['module_code'];
								$mpro = $row1['programme'];
								$mname = $row1['name'];

								$sql2 = "SELECT * FROM programme WHERE id = '$mpro'";
								$result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

								while($row2 = mysqli_fetch_array($result2)) {
									$mproname = $row2['name'];
								}

								$modc = base64_encode($mcode);

								echo '<tr>
										<td>'.$mproname.'</td>
										<td>'.$mname.' '.$mcode.'</td>
										<td><div class="dropdown">
											  <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Options
											  <span class="caret"></span></button>
											  <div class="dropdown-menu">
												  <a class="dropdown-item" href="../moduleLeader/view-assessments.php?id='.$modc.'">Mark Student</a>
												  <a class="dropdown-item" href="../moduleLeader/view-marks.php?id='.$modc.'">View Marks</a>
												  <a class="dropdown-item" href="../moduleLeader/view-module-guide.php?id='.$modc.'">View Module Guide</a>
											  </div>
											</div></td>
									  </tr>';
							}
						}
					?>
				</tbody>
			</table>		
		</div>
	</div>
</body>
</html>

<style type="text/css">
	body {
    	background-color: #e1e9eb;
	}
	table {
        font-family:' Calibri';
        font-size: 15px;
        color: #333;
        margin-top: 10px;
    }
    tr, th, td {
    	background-color: white;
    }
    a {
    	color: black;
    }
</style>

<script type="text/javascript">
	if(window.location.hash == '#lecturer') {
		alert("Log in successful!");
	}
	if(window.location.hash == '#maCreated') {
		alert("Mark Saved!");
	}
</script>

<?php
	}
	else {
		echo "<h1>Please login first</h1>";
	}
?>