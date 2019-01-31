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
					$stname = $row['name'];
					$lid = $row['id'];
					$studid = $row['student_id'];

					echo $stname;
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
						$output = '';

						$sql1 = "SELECT * FROM module";
						$result1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));

						if(mysqli_num_rows($result1) > 0) {
							while($row1 = mysqli_fetch_array($result1)) {
								$mcode = $row1['module_code'];
								$mpro = $row1['programme'];
								$mname = $row1['name'];

								$mproid = base64_encode($mpro);

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
											  <div class="dropdown-menu">';

											  	$sql3 = "SELECT * FROM student_portfolio WHERE student_id = '$lid'";
											  	$result3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));

											  	if(mysqli_num_rows($result3) > 0) {

											  	}
											  	else {
											  		$output .= '<button class="dropdown-item" id="myBtn" name="myBtn">Submit Portfolio</button>';
											  	}

											  	$output .= '
												  <a class="dropdown-item" href="../student/view-assessments.php?id='.$modc.'">View Marks</a>
												  <a class="dropdown-item" href="../student/view-module-guide.php?id='.$modc.'">View Module Guide</a>
											  </div>
											</div></td>
									  </tr>';
							}
						}
						echo $output;
					?>
				</tbody>
			</table>
			<div id="myModal" class="modal">
			  <div class="modal-content">
			    <span class="close">&times;</span>
			    <form method="POST">
			    	<div class="row clearfix">
				    	<div class="col-md-6">
				    		<label><b><u>Student ID: </u></b></label>
				    		<input class="form-control" style="background: transparent; border: none;" type="hidden" name="stid" readonly id="stid" value="<?php echo $lid; ?>"><input class="form-control" style="background: transparent; border: none;" type="text" name="sid" readonly id="sid" value="<?php echo $studid; ?>">
				    	</div>
				    	<div class="col-md-6">
				    		<label><b><u>Name: </u></b></label>
				    		<input class="form-control" style="background: transparent; border: none;" type="text" name="sname" id="sname" readonly value="<?php echo $stname; ?>">
				    	</div>
				    	<div class="col-md-12">
				    		<label><b><u>Porfolio (Full URL/Link): </u></b></label>
				    		<input class="form-control" type="text" name="slink" id="slink" placeholder="Porfolio URL/Link">
				    	</div>
				    	<br>
				    	<br>
				    	<br>
				    	<br>
				    	<input style="margin-left: 15px;" type="submit" name="submit" id="submit" class="btn btn-lg btn-success" value="Submit Portfolio Link">
						<a href="../home/studentHome.php"><button style="color: white; margin-left: 5px;" type="button" class="btn btn-lg btn-info">Cancel</button></a>	
				    </div>
			    </form>
			  </div>
			</div>
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
    /* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
</style>

<script type="text/javascript">
	if(window.location.hash == '#student') {
		alert("Log in successful!");
	}
	if(window.location.hash == '#psaved') {
		alert("Portfolio Saved!");
	}
</script>

<script type="text/javascript">
	// Get the modal
	var modal = document.getElementById('myModal');

	// Get the button that opens the modal
	var btn = document.getElementById("myBtn");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks on the button, open the modal 
	btn.onclick = function() {
	    modal.style.display = "block";
	}

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	    modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	    if (event.target == modal) {
	        modal.style.display = "none";
	    }
	}
</script>

<?php 
	if(isset($_POST['submit'])) {
		$uid = mysqli_insert_id($conn);
		$stid1 = mysqli_real_escape_string($conn, $_REQUEST['stid']);
		$link1 = mysqli_real_escape_string($conn, $_REQUEST['slink']);

		$query = "INSERT INTO student_portfolio (id, student_id, website) VALUES ('" . $uid . "', '" . $stid1 . "', '" . $link1 . "')";
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));				

		mysqli_close($conn);
		echo '<script type="text/javascript">','window.location.href = "../home/studentHome.php#psaved"','</script>';
	}
?>

<?php
	}
	else {
		echo "<h1>Please login first</h1>";
	}
?>