<?php
	include "../includes/lecturer-navbar.php";
	include "../includes/db_handler.php"; 
	session_start();

	if(isset($_SESSION['id'])) {
		$mod = $_GET['id'];
		$user = base64_decode(urldecode($mod));

		$sql = "SELECT * FROM module WHERE module_code = '$user'"; 
		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

	    while($row = mysqli_fetch_array($result)) { 
	    	$rid = $row['id'];
	    	$mcode = $row['module_code'];
	    	$name = $row['name'];
	    	$programme = $row['programme'];
		}
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
		<h2 style="text-align: center;"><b> <?php echo $user; ?> Assessments Table </b></h2>
		<hr>
		  <table class="table table-striped">
		    <div class="dropdown">
		      <a href="../home/lecturerHome.php"><button style="color: white;" type="button" class="btn btn-lg btn-info">Go Back</button></a>
		  </div>
		</div>
		     <thead>
		        <tr class="row-name">
		           <th>Name</th>
		           <th>Weights</th>
		           <th>Mark Student</th>
		        </tr>
		     </thead>   
		     <tbody>
		     	<?php
		     		$output = '';
		     		$sql = "SELECT * FROM coursework WHERE module = '$mcode'";
		     		$result = mysqli_query($conn, $sql) or die(mysql_error($conn));

		     		while($row = mysqli_fetch_array($result)) {
		     			$uid = $row["id"];
              			$hid = base64_encode($uid);

		     			$output .= '<tr class="row-content">
		     					<td>'.$row["name"].'</td>
		     					<td>'.$row['weights'].'%</td>
		           				<td width="25%;"> 
					              <a class="btn btn-warning edit" href="marking-form.php?id=' . $hid . '" aria-label="Settings">
					                <i title="Mark Student" class="fa fa-pencil-square-o" aria-hidden="true"></i>
					              </a> 
					           </td>
		     				  </tr>';
		     		}
		     		echo $output;
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