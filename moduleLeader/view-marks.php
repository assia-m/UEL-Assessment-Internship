<?php
	include "../includes/lecturer-navbar.php";
	include "../includes/db_handler.php"; 
	session_start();

	if(isset($_SESSION['id'])) {
		$mod = $_GET['id'];
		$user = base64_decode(urldecode($mod));

		$sql = "SELECT * FROM coursework WHERE module = '$user'";
		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

		while($row = mysqli_fetch_array($result)) {
			$cwid = $row['id'];
			$cwname = $row['name'];
	?>

<!DOCTYPE html>
<html>
<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"> 
	<title></title>
</head>
<body>
	<br>
	<div class="col-md-12">
		<h2 style="text-align: center;"><b><?php echo $cwname; ?> Marks</b></h2>
		<hr>
		  <table class="table table-striped">
		    <div class="dropdown">
		      <a href="../home/lecturerHome.php"><button style="color: white;" type="button" class="btn btn-lg btn-info">Go Back</button></a>
		  </div>
		</div>
		<br>
		     <thead>
		        <tr class="row-name">
		           <th>Student ID</th>
		           <th>Name</th>
		           <th>Mark</th>
		        </tr>
		     </thead>   
		     <tbody>
		     	<?php
		     		$sql2 = "SELECT DISTINCT student_id, overall_mark FROM marks WHERE coursework = '$cwid'";
		     		$result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

		     		while($row2 = mysqli_fetch_array($result2)) {
		     			$stid = $row2['student_id'];
						$mark = $row2['overall_mark']; 

						$sql1 = "SELECT * FROM users WHERE id = '$stid'";
			     		$result1 = mysqli_query($conn, $sql1) or die(mysql_error($conn));

			     		while($row1 = mysqli_fetch_array($result1)) {
			     			echo '<tr class="row-content">
			     					<td>'.$row1["student_id"].'</td>
			           				<td>'.$row1["name"].'</td>
			           				<td>'.$mark.'</td>
			     				  </tr>';
			     		}
		     		}
		     	}
		     	?>
		     </tbody>
		  </table>
	</div>
</body>
</html>

<style type="text/css">
	body {
    	background-color: #e1e9eb;
	}

	tr.row-name
	{
	    font-size: 18px;
	    color:#448aff;
	}

	tr.row-content
	{
	    color:#6c7173;
	}

	table
	{
	    border-bottom: 8px solid #448aff;
	}

	td.check
	{
	    text-align: center;
	}

	.table-striped>tbody>tr:nth-of-type(odd)
	{
	    background: white; !important; 
	}

	tr {
		background-color: white;
	}
</style>

<?php
	}
	else {
		echo "<h1>Please login first</h1>";
	}
?>