<?php
	include "../includes/admin-navbar.php";
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
	    	$programme = $row['programme'];
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
			<h2><b>Add Assessment For <?php echo $user; ?></b></h2>
			<hr>
		    <div class="row clearfix">
		    	<div class="col-md-6">
		    		<label>Module</label>
					<input type="text" name="mod" class="form-control" readonly value="<?php if (isset($_GET['id'])) { print $user . ' - ' . $name; }?>">
		    	</div>
		    	<div class="col-md-6">
		    		<label>Assessment</label>
					<input type="text" name="name" class="form-control" placeholder="Assessment Name">
					<br>
		    	</div>
		    	<div class="col-md-6">
		    		<label>Weight</label>
					<input type="text" name="weight" class="form-control" placeholder="Assessment Weight">
					<br>
		    	</div>
		    	<div class="col-md-6">
		    		<label>Description</label>
					<textarea style="resize: none;" type="text" name="desc" class="form-control" placeholder="Description"></textarea>
					<br>
		    	</div>
				<div class="col-md-12 column">
					<label>Learning Objective's</label>
					<table class="table table-bordered table-hover" id="tab_logic">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Name</th>
								<th class="text-center">Type</th>
							</tr>
						</thead>
						<tbody>
							<tr id='addr0'>
								<td style="text-align: center;">1</td>
								<td>
									<input type="text" name='LOname[]' id="LOname" placeholder='Name' class="form-control"/>
								</td>
								<td>
									<select name="type[]" id="type" class="form-control">
								    	<option disabled selected>-- SELECT --</option>
								    	<option value="Subject Based Practical Skills">Subject Based Practical Skills</option>
								    	<option value="Skills For Life And Work">Skills For Life And Work</option>
								    	<option value="Knowledge">Knowledge</option>
								    	<option value="Thinking Skills">Thinking Skills</option>
								    </select>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input type="text" name="LO[]" class="form-control" readonly value="Very Poor (below 20%)">
								</td>
								<td>
									<textarea style="resize: none;" type="text" name='LOComment[]' class="form-control" placeholder="Feedback/Comment Here"></textarea>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input type="text" name="LO[]" class="form-control" readonly value="Poor (20%-30%)">
								</td>
								<td>
									<textarea style="resize: none;" type="text" name='LOComment[]' class="form-control" placeholder="Feedback/Comment Here"></textarea>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input type="text" name="LO[]" class="form-control" readonly value="Some Engagement (31%-39%)">
								</td>
								<td>
									<textarea style="resize: none;" type="text" name="LOComment[]" class="form-control" placeholder="Feedback/Comment Here"></textarea>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input type="text" name="LO[]" class="form-control" readonly value="Satisfactory (40%-50%)">
								</td>
								<td>
									<textarea style="resize: none;" type="text" name="LOComment[]" class="form-control" placeholder="Feedback/Comment Here"></textarea>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input type="text" name="LO[]" class="form-control" readonly value="Good (50%-60%)">
								</td>
								<td>
									<textarea style="resize: none;" type="text" name="LOComment[]" class="form-control" placeholder="Feedback/Comment Here"></textarea>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input type="text" name="LO[]" class="form-control" readonly value="Very Good (60%-70%)">
								</td>
								<td>
									<textarea style="resize: none;" type="text" name="LOComment[]" class="form-control" placeholder="Feedback/Comment Here"></textarea>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input type="text" name="LO[]" class="form-control" readonly value="Excellent (70%-80%)">
								</td>
								<td>
									<textarea style="resize: none;" type="text" name="LOComment[]" class="form-control" placeholder="Feedback/Comment Here"></textarea>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input type="text" name="LO[]" class="form-control" readonly value="Outstanding (80%+)">
								</td>
								<td>
									<textarea style="resize: none;" type="text" name="LOComment[]" class="form-control" placeholder="Feedback/Comment Here"></textarea>
								</td>
							</tr>					
		                    <tr id='addr1'></tr>
						</tbody>
					</table>
				</div>
			</div>
			<a id='delete_row' class="btn btn-danger" style="color: white; float: right;">Delete Row</a><a id="add_row" class="btn btn-success" style="margin-right: 5px; color: white; float: right;">Add Row</a>
			<br>
			<br>
			<input type="submit" name="submit" id="submit" class="btn btn-lg btn-success" value="Add Assessment">
			<a href="../home/adminHome.php"><button style="color: white;" type="button" class="btn btn-lg btn-info">Cancel</button></a>	
		</div>
	</form>
</body>
</html>

<style type="text/css">
	body {
    	background-color: #e1e9eb;
	}
	#tab_logic {
		background-color: white;
	}
</style>

<script type="text/javascript">
 $(document).ready(function(){
      var i = 1;
      var max = 15;

     $("#add_row").click(function(){
      if(i < max) {
	      $('#tab_logic').append('<tr id="addr'+(i+1)+'"><td style="text-align: center;">'+ (i+1) +'</td><td><input type="text" id="LOname" name="LOname[]'+i+'" placeholder="Name" class="form-control input-md"  /> </td><td><select name="type[]'+i+'" id="type" class="form-control"><option disabled selected>-- SELECT --</option><option value="Subject Based Practical Skills">Subject Based Practical Skills</option><option value="Skills For Life And Work">Skills For Life And Work</option><option value="Knowledge">Knowledge</option><option value="Thinking Skills">Thinking Skills</option></select></td></tr><tr><td></td><td><input type="text" name="LO[]'+i+'" class="form-control" readonly value="Very Poor (below 20%)"></td><td><textarea style="resize: none;" type="text" name="LOComment[]'+i+'" class="form-control" placeholder="Feedback/Comment Here"></textarea></td></tr><tr><td></td><td><input type="text" name="LO[]'+i+'" class="form-control" readonly value="Poor (20%-30%)"></td><td><textarea style="resize: none;" type="text" name="LOComment[]'+i+'" class="form-control" placeholder="Feedback/Comment Here"></textarea></td></tr><tr><td></td><td><input type="text" name="LO[]'+i+'" class="form-control" readonly value="Some Engagement (31%-39%)"></td><td><textarea style="resize: none;" type="text" name="LOComment[]'+i+'" class="form-control" placeholder="Feedback/Comment Here"></textarea></td></tr><tr><td></td><td><input type="text" name="LO[]'+i+'" class="form-control" readonly value="Satisfactory (40%-50%)"></td><td><textarea style="resize: none;" type="text" name="LOComment[]'+i+'" class="form-control" placeholder="Feedback/Comment Here"></textarea></td></tr><tr><td></td><td><input type="text" name="LO[]'+i+'" class="form-control" readonly value="Good (50%-60%)"></td><td><textarea style="resize: none;" type="text" name="LOComment[]'+i+'" class="form-control" placeholder="Feedback/Comment Here"></textarea></td></tr><tr><td></td><td><input type="text" name="LO[]'+i+'" class="form-control" readonly value="Very Good (60%-70%)"></td><td><textarea style="resize: none;" type="text" name="LOComment[]'+i+'" class="form-control" placeholder="Feedback/Comment Here"></textarea></td></tr><tr><td></td><td><input type="text" name="LO[]'+i+'" class="form-control" readonly value="Excellent (70%-80%)"></td><td><textarea style="resize: none;" type="text" name="LOComment[]'+i+'" class="form-control" placeholder="Feedback/Comment Here"></textarea></td></tr><tr><td></td><td><input type="text" name="LO[]'+i+'" class="form-control" readonly value="Outstanding (80%+)"></td><td><textarea style="resize: none;" type="text" name="LOComment[]'+i+'" class="form-control" placeholder="Feedback/Comment Here"></textarea></td></tr>');
	      i++;
      } 
      if(i == max) {
      	document.getElementById('add_row').style.visibility = 'hidden';
      }
  });
     $("#delete_row").click(function() {
    	 if(i > 1){
			 $("#addr" + (i - 1)).html('');
			 i--;
			 document.getElementById('add_row').style.visibility = 'visible';
		 }
	 });

});
</script>

<?php 
	if(isset($_POST['submit'])) {
		$uid = mysqli_insert_id($conn);
		$name1 = mysqli_real_escape_string($conn, $_REQUEST['name']);
		$desc1 = mysqli_real_escape_string($conn, $_REQUEST['desc']);
		$weight1 = mysqli_real_escape_string($conn, $_REQUEST['weight']);

		$query = "INSERT INTO coursework (id, name, programme, module, description, weights) VALUES ('" . $uid . "', '" . $name1 . "', '" . $programme . "', '" . $user . "', '" . $desc1 . "', '" . $weight1 . "')";

		if(mysqli_query($conn, $query)) {
			$sid = mysqli_insert_id($conn);

			if (isset($_POST['LOname']) && isset($_POST['type'])) {
				foreach ($_POST['LOname'] as $key => $value) {
					$LOname1 = $_POST['LOname'][$key];
					$LOtype1 = $_POST['type'][$key];

					$query = "INSERT INTO LO (id, content, type, assessment_criteria, coursework) VALUES ('" . $uid . "', '" . $LOname1 . "', '" . $LOtype1 . "', ' ', '" . $sid . "')";

					if(mysqli_query($conn, $query)) {
						$lid = mysqli_insert_id($conn);

						if (isset($_POST['LO']) && isset($_POST['LOComment'])) {
							foreach ($_POST['LO'] as $key => $value) {
								$LO1 = $_POST['LO'][$key];
								$LOComment1 = $_POST['LOComment'][$key];

								$query = "INSERT INTO LO_bands (id, LO_ID, band, comment) VALUES ('" . $uid . "', '" . $lid . "', '" . $LO1 . "', '" . $LOComment1 . "')";

								$result = mysqli_query($conn, $query) or die(mysqli_error($conn));				
							}
						}
					}			
				}
			}
		}
		mysqli_close($conn);
		echo '<script type="text/javascript">','window.location.href = "../home/adminHome.php#aCreated"','</script>';
	}
?>

<?php
	}
	else {
		echo "<h1>Please login first</h1>";
	}
?>