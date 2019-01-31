<?php
	include "../includes/student-navbar.php";
	include "../includes/db_handler.php"; 
	session_start();

	if(isset($_SESSION['id'])) {
		$mod = $_GET['id'];
		$user = base64_decode(urldecode($mod));

		$sql = "SELECT * FROM module WHERE module_code = '$user'"; 
		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

	    while($row = mysqli_fetch_array($result)) { 
	    	$rid = $row['id'];
	    	$name = $row['name'];
			$mlead = $row['leader'];
	    	$mother = $row['other_tutor'];
		}

		$sql1 = "SELECT * FROM users WHERE id = '$mlead'";
		$result1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));

		while($row1 = mysqli_fetch_array($result1)) {
			$mlname = $row1['name'];
			$mlphone = $row1['phone'];
			$mlroom = $row1['room'];
			$mlstud = $row1['student_hours'];
		}

		$sql2 = "SELECT * FROM users WHERE id = '$mother'";
		$result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

		while($row2 = mysqli_fetch_array($result2)) {
			$oname = $row2['name'];
			$ophone = $row2['phone'];
			$oroom = $row2['room'];
			$ostud = $row2['student_hours'];
		}

		$sql4 = "SELECT * FROM module_guide WHERE module_code = '$user'";
		$result4 = mysqli_query($conn, $sql4) or die(mysqli_error($conn));

		while($row4 = mysqli_fetch_array($result4)) {
			$term = $row4['term'];
		}
	?>

<!DOCTYPE html>
<html>
<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://kendo.cdn.telerik.com/2017.2.621/js/jquery.min.js"></script>
 	<script src="https://kendo.cdn.telerik.com/2017.2.621/js/jszip.min.js"></script>
 	<script src="https://kendo.cdn.telerik.com/2017.2.621/js/kendo.all.min.js"></script>
	<title></title>
</head>
<body id="target">
	<br>
	<br>
	<div class="container" id="container">
		<a href="../home/studentHome.php"><button style="color: white;" type="button" class="btn btn-lg btn-info">Cancel</button></a>	
		<button name="export" id="export" onclick="exportPDF()" style="float: right;" class="btn-lg btn-success">Export As PDF</button>
		<br>
		<form method="POST">
			<table class="table" border="1">
			    <tr>
			      <th scope="col" style="text-align: center; background-color: #5D5D5D; color: white;" colspan="2"><h2><?php echo $user . ' ' . $name; ?></h2></th>
			    </tr>
			    <tr>
			    	<th style="text-align: center; background-color: white;" colspan="2"><h3>Module Guide</h3></th>
			    </tr>
			  <tbody>
			  	<tr>
			    	<td colspan="4">
			    		<label>Term Dates:</label>
			    		<select name="termdates">
			    			<option disabled selected>-- SELECT --</option>
							<option value="Term 1"<?php echo ($term == 'Term 1' ? ' selected = "selected"' : ''); ?>>Term 1</option>
							<option value="Term 2"<?php echo ($term == 'Term 2' ? ' selected = "selected"' : ''); ?>>Term 2</option>
							<option value="Term 1 & Term 2"<?php echo ($term == 'Term 1 & Term 2' ? ' selected = "selected"' : ''); ?>>Term 1 & Term 2</option>
			    		</select>
			    	</td>
			    </tr>
			    <tr>
			    	<td style="width: 50%;">
			    		<b><u>Module Leader</u></b>
		    			<div><b>Name: </b><?php echo $mlname; ?></div>
		    			<div><b>Contact Details: </b><?php echo $mlphone; ?></div>
		    			<div><b>Room: </b><?php echo $mlroom; ?></div>
		    			<div><b>Student Hours: </b><?php echo $mlstud; ?></div>
		    		</td>
			    	<td style="width: 50%;">
			    		<b><u>Other Tutor</u></b>
		    			<div><b>Name: </b><?php echo $oname; ?></div>
		    			<div><b>Contact Details: </b><?php echo $ophone; ?></div>
		    			<div><b>Room: </b><?php echo $oroom; ?></div>
		    			<div><b>Student Hours: </b><?php echo $ostud; ?></div>
		    		</td>
			    </tr>
			  </tbody>
			</table>
			<h4><b>Timetabled Teaching</b></h4>
			<div class="col-md-12 column">
				<table class="table table-bordered table-hover" id="tab_logic">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">DAYS & DATES</th>
							<th class="text-center">ACTIVITY</th>
							<th class="text-center">TIME</th>
							<th class="text-center">ROOM</th>
						</tr>
					</thead>
					<tbody>
						<tr id='addr0'>
							<?php
								$i = 1;
								$sql3 = "SELECT * FROM module_guide_table WHERE module_code = '$user'";
								$result3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));

								while($row3 = mysqli_fetch_array($result3)) {
									?>

									<td><?php echo $i++; ?></td>
									<td>
										<input readonly type="text" name='tdates[]' id="tdates" value="<?php echo $row3['table_date']; ?>" class="form-control"/>
									</td>
									<td>
										<input readonly type="text" name='tactivity[]' id="tactivity" value="<?php echo $row3['table_activity']; ?>" class="form-control"/>
									</td>
									<td>
										<input readonly type="text" name='ttime[]' id="ttime" value="<?php echo $row3['table_time']; ?>" class="form-control"/>
									</td>
									<td>
										<input readonly type="text" name='troom[]' id="troom" value="<?php echo $row3['table_room']; ?>" class="form-control"/>
									</td>
								</tr>

							<?php
								}
							?>
	                    <tr id='addr1'></tr>
					</tbody>
				</table>
			</div>
			<br>
			<br>
		</form>
	</div>
</body>
</html>

<style type="text/css">
	body {
    	background-color: #e1e9eb;
	}
	td {
		background-color: white;
	}
	#table1 {
		border: 1px solid black;
    	border-collapse: collapse;
	}
	div[contenteditable = true] {
	   background-color: #C1C1C1;
	   resize: none; /* disable resizing */
	}
	#tab_logic {
		background-color: white;
	}
</style>

<script>
     function exportPDF(){ 
		kendo.drawing
		    .drawDOM("#target", 
		    { 
		        paperSize: "A4",
		        margin: {},
		        scale: 0.8,
		        height: 500
		    })
		        .then(function(group){
		        kendo.drawing.pdf.saveAs(group, "<?php echo $user; ?>-Module-Guide.pdf")
		    });
		}
</script>

<?php
	}
	else {
		echo "<h1>Please login first</h1>";
	}
?>