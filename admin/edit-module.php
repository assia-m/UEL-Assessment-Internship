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
	    	$lead = $row['leader'];
	    	$mother = $row['other_tutor'];
	    	$desc = $row['description'];
	    	$weight = $row['weight'];
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
			<h2><b>Edit Module</b></h2>
			<hr>
		    <div class="row clearfix">
		    	<div class="col-md-4">
		    		<label>Module Code</label>
					<input type="text" name="modc" class="form-control" value="<?php if (isset($_GET['id'])) { print $user; }?>">
		    	</div>
		    	<div class="col-md-4">
		    		<label>Module Name</label>
					<input type="text" name="modn" class="form-control" value="<?php if (isset($_GET['id'])) { print $name; }?>">
					<br>
		    	</div>
		    	<div class="col-md-4">
		    		<label>Module Leader</label>
					<select id="mnewleader" name="mnewleader" class="form-control">
						<?php 
							$sql2 = "SELECT * FROM users WHERE rank = 'Module Leader'";
							$result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

							while($row2 = mysqli_fetch_array($result2)) {
								$mlid = $row2['id'];

								if($mlead == $mlid) {
									echo '<option selected value="'.$mlid.'">'.$row2['name'].'</option>';
								}
								else {
									echo '<option value="'.$mlid.'">'.$row2['name'].'</option>';
								}
							}
						?>
					</select>
					<br>
		    	</div>
		    	<div class="col-md-4">
		    		<label>Other Tutor</label>
					<select id="mnewother" name="mnewother" class="form-control">
						<?php 
							$sql2 = "SELECT * FROM users WHERE rank = 'Module Leader'";
							$result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

							while($row2 = mysqli_fetch_array($result2)) {
								$motherid = $row2['id'];

								if($mother == $motherid) {
									echo '<option selected value="'.$motherid.'">'.$row2['name'].'</option>';
								}
								else {
									echo '<option value="'.$motherid.'">'.$row2['name'].'</option>';
								}
							}
						?>
					</select>
					<br>
		    	</div>
		    	<div class="col-md-4">
		    		<label>Weight</label>
					<select id="weight" name="weight" class="form-control">
						<option disabled selected>-- SELECT --</option>
						<option value="15"<?php echo ($weight == '15' ? ' selected = "selected"' : ''); ?>>15 Credits</option>
						<option value="30"<?php echo ($weight == '30' ? ' selected = "selected"' : ''); ?>>30 Credits</option>
						<option value="45"<?php echo ($weight == '45' ? ' selected = "selected"' : ''); ?>>45 Credits</option>
					</select>
					<br>
		    	</div>
		    	<div class="col-md-4">
		    		<label>Description</label>
					<textarea style="resize: none;" type="text" name="desc" class="form-control"><?php if (isset($_GET['id'])) { print $desc; }?></textarea>
					<br>
		    	</div>
				<div class="col-md-12 column">
					<label>Assessments</label>
					<table class="table table-bordered table-hover" id="tab_logic">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Name</th>
								<th class="text-center">Description</th>
								<th class="text-center">Weight</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$sql1 = "SELECT * FROM coursework WHERE module = '$user'";
								$result1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));

								if(mysqli_num_rows($result1) > 0) {
									while($row1 = mysqli_fetch_array($result1)) {
										?>
										<tr id='addr0'>
											<td>1<input type="hidden" name="id[]" id="id" value="<?php print $row1['id']; ?>"/></td>
											<td>
												<input type="text" name='aname[]' value="<?php if (isset($_GET['id'])) { print $row1['name']; }?>" class="form-control"/>
											</td>
											<td>
												<textarea style="resize: none;" type="text" name='adesc[]' class="form-control"><?php if (isset($_GET['id'])) { echo $row1['description']; }?></textarea>
											</td>
											<td>
												<input type="number" name='aweight[]' value="<?php if (isset($_GET['id'])) { print $row1['weights']; }?>" class="form-control"/>
											</td>
										</tr>
										<?php
									}
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<a id='delete_row' class="btn btn-danger" style="color: white; float: right;">Delete Row</a><a id="add_row" class="btn btn-success" style="margin-right: 5px; color: white; float: right;">Add Row</a>
			<br>
			<br>
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
	#tab_logic {
		background-color: white;
	}
</style>

<script type="text/javascript">
 $(document).ready(function(){
      var i = 1;

     $("#add_row").click(function(){
      	$('#addr'+i).html("<td>"+ (i+1) +"</td><td><input placeholder='Assessment Name' type='text' name='newaname[]"+i+"' class='form-control'/></td><td><textarea style='resize: none;' type='text' name='newadesc[]"+i+"' placeholder='Assessment Description' class='form-control'></textarea></td><td><input placeholder='Assessment Weight' type='number' name='newaweight[]"+i+"' class='form-control'/></td>");

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
		$code1 = mysqli_real_escape_string($conn, $_REQUEST['modc']);
		$name1 = mysqli_real_escape_string($conn, $_REQUEST['modn']);
		$weight1 = mysqli_real_escape_string($conn, $_REQUEST['weight']);
		$desc1 = mysqli_real_escape_string($conn, $_REQUEST['desc']);
		$mnewlead = mysqli_real_escape_string($conn, $_REQUEST['mnewleader']);
		$mnewother1 = mysqli_real_escape_string($conn, $_REQUEST['mnewother']);

		$query = "UPDATE module SET module_code = '$code1', name = '$name1', description = '$desc1', leader = '$mnewlead', other_tutor = '$mnewother1', weight = '$weight1' WHERE id = '$rid'";
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

		if (isset($_POST['aname']) && isset($_POST['adesc']) && isset($_POST['aweight'])) {
			foreach ($_POST['aname'] as $key => $value) {
				$cid = $_POST['id'][$key];
				$aname1 = $_POST['aname'][$key];
				$adesc1 = $_POST['adesc'][$key];
				$aweight1 = $_POST['aweight'][$key];

				$query1 = "UPDATE coursework SET name = '$aname1', description = '$adesc1', weights = '$aweight1' WHERE id = '$cid'";
				$result1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));
			}
		}

		if (isset($_POST['newaname']) && isset($_POST['newadesc']) && isset($_POST['newaweight'])) {
			foreach ($_POST['newaname'] as $key => $value) {
				$newaname1 = $_POST['newaname'][$key];
				$newadesc1 = $_POST['newadesc'][$key];
				$newaweight1 = $_POST['newaweight'][$key];

				$query = "INSERT INTO coursework (id, name, programme, module, description, weights) VALUES ('" . $uid . "', '" . $newaname1 . "', '" . $programme . "', '" . $rid . "', '" . $newadesc1 . "', '" . $newaweight1 . "')";

				$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
				
			}
		}

		mysqli_close($conn);
		echo '<script type="text/javascript">','window.location.href = "../home/adminHome.php#emCreated"','</script>';
	}
?>

<?php
	}
	else {
		echo "<h1>Please login first</h1>";
	}
?>