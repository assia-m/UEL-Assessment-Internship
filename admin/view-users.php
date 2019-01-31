<?php
	include "../includes/admin-navbar.php";
	include "../includes/db_handler.php"; 
	session_start();

	if(isset($_SESSION['id'])) {
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
		<h2 style="text-align: center;"><b> Table Of Users </b></h2>
		<hr>
		  <table class="table table-striped">
		    <div class="dropdown">
		      <a style="color: white;" href="add-user.php"><button class="btn btn-lg btn-success" style="margin-top: 17px; float: right; margin-right: 5px;">Add User</button></a>
		      <a href="../home/adminHome.php"><button style="color: white;" type="button" class="btn btn-lg btn-info">Go Back</button></a>
		  </div>
		</div>
		     <thead>
		        <tr class="row-name">
		           <th>Name</th>
		           <th>Username</th>
		           <th>Rank</th>
		           <th>Settings</th>
		        </tr>
		     </thead>   
		     <tbody>
		     	<?php
		     		$output = '';
		     		$sql = "SELECT * FROM users";
		     		$result = mysqli_query($conn, $sql) or die(mysql_error($conn));

		     		while($row = mysqli_fetch_array($result)) {
		     			$username = $row["username"];
		     			$uid = $row["id"];
              			$husername = base64_encode($username);
              			$hid = base64_encode($uid);

		     			$output .= '<tr class="row-content">
		     					<td>'.$row["name"].'</td>
		           				<td>'.$row["username"].'</td>
		           				<td>'.$row["rank"].'</td>
		           				<td> 
					              <a class="btn btn-warning edit" href="edit-user.php?id=' . $husername . '" aria-label="Settings">
					                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					              </a>
					              &nbsp
					              <a class="btn btn-danger edit" href="remove-one-user.php?id=' . $hid . '" aria-label="Settings">
					                <i class="fa fa-trash" aria-hidden="true"></i>
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