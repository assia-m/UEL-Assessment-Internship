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
	?>

<!DOCTYPE html>
<html>
<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<title></title>
</head>
<body>
	<br>
	<br>
	<div class="container" id="container">
		<a href="../home/adminHome.php"><button style="color: white;" type="button" class="btn btn-lg btn-info">Cancel</button></a>	
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
			    			<option value="Term 1">Term 1</option>
			    			<option value="Term 2">Term 2</option>
			    			<option value="Term 1 & Term 2">Term 1 & Term 2</option>
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
							<td>1</td>
							<td>
								<input type="date" name='tdates[]' id="tdates" placeholder='Day and/or Date' class="form-control"/>
							</td>
							<td>
								<input type="text" name='tactivity[]' id="tactivity" placeholder='Activity' class="form-control"/>
							</td>
							<td>
								<select class="form-control" name="ttime[]" id="ttime">
									<option selected disabled>-- SELECT --</option>
									<?php
										$output = '';
										for($hours=0; $hours<24; $hours++) // the interval for hours is '1'
										    for($mins=0; $mins<60; $mins+=30) // the interval for mins is '30'
						                        $output .= '<option>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'
										                       .str_pad($mins,2,'0',STR_PAD_LEFT).'</option>';

				                       echo $output;
									?>
								</select>
							</td>
							<td>
								<input type="text" name='troom[]' id="troom" placeholder='Room' class="form-control"/>
							</td>
						</tr>
	                    <tr id='addr1'></tr>
					</tbody>
				</table>
			</div>
			<a id='delete_row' class="btn btn-danger" style="color: white; float: right;">Delete Row</a><a id="add_row" class="btn btn-success" style="margin-right: 5px; color: white; float: right;">Add Row</a>
			<br>
			<br>
			<input type="submit" name="submit" id="submit" class="btn btn-lg btn-success" value="Save Module Guide">
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

<script type="text/javascript">
 $(document).ready(function(){
      var i = 1;

     $("#add_row").click(function(){
      	$('#addr'+i).html("<td>"+ (i+1) +"</td><td><input type='date' name='tdates[]"+i+"' id='tdates' placeholder='Day and/or Date' class='form-control'/></td><td><input type='text' name='tactivity[]"+i+"' id='tactivity' placeholder='Activity' class='form-control'/></td><td><select class='form-control' name='ttime[]"+i+" id='ttime'><option selected disabled>-- SELECT --</option><?php echo $output; ?></select></td><td><input type='text' name='troom[]"+i+"' id='troom' placeholder='Room' class='form-control'/></td>");

	      $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
	      i++;
  });
     $("#delete_row").click(function() {
    	 if(i > 1){
			 $("#addr" + (i - 1)).html('');
			 i--;
		 }
	 });

});
</script>

<?php 
	if(isset($_POST['submit'])) {
		$uid = mysqli_insert_id($conn);
		$term1 = mysqli_real_escape_string($conn, $_REQUEST['termdates']);

		$query = "INSERT INTO module_guide (id, module_code, leader, other_tutor, term) VALUES ('" . $uid . "', '" . $user . "', '" . $mlead . "', '" . $mother . "', '" . $term1 . "')";
		
		if(mysqli_query($conn, $query)) {
			$sid = mysqli_insert_id($conn);

			if (isset($_POST['tdates']) && isset($_POST['tactivity']) && isset($_POST['ttime']) && isset($_POST['troom'])) {
				foreach ($_POST['tdates'] as $key => $value) {
					$tdates1 = $_POST['tdates'][$key];
					$tactivity1 = $_POST['tactivity'][$key];
					$ttime1 = $_POST['ttime'][$key];
					$troom1 = $_POST['troom'][$key];

					$query = "INSERT INTO module_guide_table (id, module_guide_id, module_code, table_date, table_activity, table_time, table_room) VALUES ('" . $uid . "', '" . $sid . "', '" . $user . "', '" . $tdates1 . "', '" . $tactivity1 . "', '" . $ttime1 . "', '" . $troom1 . "')";

					$result = mysqli_query($conn, $query) or die(mysqli_error($conn));				
				}
			}
		}

		mysqli_close($conn);
		echo '<script type="text/javascript">','window.location.href = "../home/adminHome.php#mgCreated"','</script>';
	}
?>

<?php
	}
	else {
		echo "<h1>Please login first</h1>";
	}
?>