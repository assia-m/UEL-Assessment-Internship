<?php
	include "../includes/admin-navbar.php";
	include "../includes/db_handler.php"; 
	session_start();

	if(isset($_SESSION['id'])) {
		$mod = $_GET['id'];
		$user = base64_decode(urldecode($mod));

		$sql = "SELECT * FROM coursework WHERE id = '$user'"; 
		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

	    while($row = mysqli_fetch_array($result)) { 
	    	$rid = $row['id'];
	    	$name = $row['name'];
	    	$weight = $row['weights'];
	    	$desc = $row['description'];
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
			<h2><b>Manage Learning Objectives</b></h2>
			<hr>
		    <div class="row clearfix">
		    	<div class="col-md-12">
		    		<label>Assessment Name</label>
					<input type="text" name="name" class="form-control" readonly value="<?php if (isset($_GET['id'])) { print $name; }?>">
					<br>
		    	</div>
				<div class="col-md-12 column">
					<label>Learning Objectives</label>
					<table class="table table-bordered table-hover" id="tab_logic">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Name</th>
								<th class="text-center">Type</th>
								<th class="text-center">Remove?</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$sql1 = "SELECT * FROM LO WHERE coursework = '$rid'";
								$result1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));

								$i = 1;

								if(mysqli_num_rows($result1) > 0) {
									while($row1 = mysqli_fetch_array($result1)) {
										$LODBid = $row1['id'];
										$LODBidH = base64_encode($LODBid);
										?>
										<tr id='addr0'>
											<td><input type="hidden" name="id[]" id="id" value="<?php print $row1['id']; ?>"/><?php echo $i++; ?></td>
											<td>
												<input type="text" name='LOname[]' id="LOname" class="form-control" value="<?php if (isset($_GET['id'])) { print $row1['content']; }?>" />
											</td>
											<td>
												<select name="type[]" id="type" class="form-control">
													<option disabled selected>-- SELECT --</option>
													<option value="Subject Based Practical Skills"<?php echo ($row1['type'] == 'Subject Based Practical Skills' ? ' selected = "selected"' : ''); ?>>Subject Based Practical Skills</option>
													<option value="Skills For Life And Work"<?php echo ($row1['type'] == 'Skills For Life And Work' ? ' selected = "selected"' : ''); ?>>Skills For Life And Work</option>
													<option value="Knowledge"<?php echo ($row1['type'] == 'Knowledge' ? ' selected = "selected"' : ''); ?>>Knowledge</option>
													<option value="Thinking Skills"<?php echo ($row1['type'] == 'Thinking Skills' ? ' selected = "selected"' : ''); ?>>Thinking Skills</option>
											    </select>
											</td>
											<td>
												<form class="form-horizontal" role="form" method="post" action="remove-LO.php?id=<?php echo $LODBidH;?>">
													<input type="submit" name="removeLO" class="btn btn-danger" value="Remove"/>
												</form>
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
      var max = 15;

     $("#add_row").click(function(){
      if(i < max) {
      	$('#addr'+i).html("<td>"+ (i+1) +"</td><td><input name='LOnew[]"+i+"' type='text' placeholder='Name' class='form-control input-md'  /> </td><td><select name='LOtypenew[]"+i+"' id='type' class='form-control'><option disabled selected>-- SELECT --</option><option value='Subject Based Practical Skills'>Subject Based Practical Skills</option><option value='Skills For Life And Work'>Skills For Life And Work</option><option value='Knowledge'>Knowledge</option><option value='Thinking Skills'>Thinking Skills</option></select></td>");

	      $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
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

		if (isset($_POST['LOname']) && isset($_POST['type'])) {
			foreach ($_POST['LOname'] as $key => $value) {
				$LOid = $_POST['id'][$key];
				$LOname1 = $_POST['LOname'][$key];
				$LOtype1 = $_POST['type'][$key];

				$query = "UPDATE LO SET content = '$LOname1', type = '$LOtype1' WHERE id = '$LOid'";

				$result = mysqli_query($conn, $query) or die(mysqli_error($conn));				
			}
		}

		if (isset($_POST['LOnew']) && isset($_POST['LOtypenew'])) {
			foreach ($_POST['LOnew'] as $key => $value) {
				$LOnew1 = $_POST['LOnew'][$key];
				$LOtypenew1 = $_POST['LOtypenew'][$key];

				$query = "INSERT INTO LO (id, content, type, assessment_criteria, coursework) VALUES ('" . $uid . "', '" . $LOnew1 . "', '" . $LOtypenew1 . "', ' ', '" . $user . "')";

				$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
				
			}
		}

		mysqli_close($conn);
		echo '<script type="text/javascript">','window.location.href = "../home/adminHome.php#eloCreated"','</script>';
	}
?>

<?php
	}
	else {
		echo "<h1>Please login first</h1>";
	}
?>