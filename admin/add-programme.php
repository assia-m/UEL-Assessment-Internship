<?php
	include "../includes/admin-navbar.php";
	include "../includes/db_handler.php"; 
	session_start();

	if(isset($_SESSION['id'])) {
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
			<h2><b>Create A New Programme</b></h2>
			<hr>
		    <div class="row clearfix">
		    	<div class="col-md-12">
		    		<label>Programme Name</label>
					<input type="text" name="name" class="form-control" placeholder="Programme Name">
					<br>
		    	</div>
		    	<div class="col-md-6">
		    		<label>Leader</label>
					<?php
						$query = "SELECT id, name FROM users WHERE rank = 'Programme Leader' ORDER BY name DESC";
						$result = mysqli_query($conn, $query);
				    ?>
						<select required class="form-group form-control" data-show-subtext="true" data-live-search="true" id="proleader" name="proleader" style="margin-left: -1px;">
							<option selected disabled>-- SELECT --</option>
							<?php 
								while ($row = mysqli_fetch_array($result))
								{
								    echo "<option value='$row[0]'>$row[1] $row[2]</option>";
								}
							?>        
						</select>
					<br>
		    	</div>
		    	<div class="col-md-6">
		    		<label>Category</label>
					<select name="category" id="category" class="form-control">
				    	<option disabled selected>-- SELECT --</option>
				    	<option value="Bachelor">Bachelor</option>
				    	<option value="Masters">Masters</option>
				    </select>
					<br>
		    	</div>
				<div class="col-md-12 column">
					<label>Modules</label>
					<table class="table table-bordered table-hover" id="tab_logic">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Module Code</th>
								<th class="text-center">Module Name</th>
								<th class="text-center">Credit</th>
								<th class="text-center">Type</th>
								<th class="text-center">Leader</th>
								<th class="text-center">Description</th>
							</tr>
						</thead>
						<tbody>
							<tr id='addr0'>
								<td>1</td>
								<td>
									<input type="text" name='mcode[]' placeholder='Module Code' class="form-control"/>
								</td>
								<td>
									<input type="text" name='mname[]' placeholder='Module Name' class="form-control"/>
								</td>
								<td>
									<select name="mweight[]" id="mweight" class="form-control">
								    	<option disabled selected>-- SELECT --</option>
								    	<option value="15">15 Credit</option>
								    	<option value="30">30 Credit</option>
								    	<option value="45">45 Credit</option>
								    </select>
								</td>
								<td>
									<select name="mtype[]" id="mtype" class="form-control">
								    	<option disabled selected>-- SELECT --</option>
								    	<option value="Optional">Optional</option>
								    	<option value="Core">Core</option>
								    </select>
								</td>
								<td>
									<?php
										$query = "SELECT id, name FROM users WHERE rank = 'Module Leader' ORDER BY name DESC";
										$result = mysqli_query($conn, $query);

										$list = '';
								    ?>
										<select required class="form-group form-control" data-show-subtext="true" data-live-search="true" id="mleader" name="mleader[]" style="margin-left: -1px;">
											<option selected disabled>-- SELECT --</option>
											<?php 
												while ($row = mysqli_fetch_array($result))
												{
												    echo "<option value='$row[0]'>$row[1] $row[2]</option>";
												    $list .= "<option value='$row[0]'>$row[1] $row[2]</option>";
												}
											?>        
										</select>
								</td>
								<td>
									<textarea style="resize: none;" type="text" name='mdesc[]' placeholder='Module Description' class="form-control"/></textarea>
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
			<input type="submit" name="submit" id="submit" class="btn btn-lg btn-success" value="Create Programme">
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
      	$('#addr'+i).html("<td>"+ (i+1) +"</td><td><input name='mcode[]"+i+"' type='text' placeholder='Module Code' class='form-control input-md'  /> </td><td><input name='mname[]"+i+"' type='text' placeholder='Module Name' class='form-control input-md'  /> </td><td><select name='mweight[]"+i+"' id='mweight' class='form-control'><option disabled selected>-- SELECT --</option><option value='15'>15 Credit</option><option value='30'>30 Credit</option><option value='45'>45 Credit</option></select></td><td><select name='mtype[]"+i+"' id='mtype' class='form-control'><option disabled selected>-- SELECT --</option><option value='Optional'>Optional</option><option value='Core'>Core</option></select></td><td><select required class='form-group form-control' data-show-subtext='true' data-live-search='true' id='mleader' name='mleader[]"+i+"' style='margin-left: -1px;''><option selected disabled>-- SELECT --</option>'<?php echo $list; ?>'</select></td><td><textarea style='resize: none;' type='text' name='mdesc[]"+i+"' placeholder='Module Description' class='form-control'/></textarea></td>");

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
		$name1 = mysqli_real_escape_string($conn, $_REQUEST['name']);
		$proleader1 = mysqli_real_escape_string($conn, $_REQUEST['proleader']);
		$category1 = mysqli_real_escape_string($conn, $_REQUEST['category']);

		$query = "INSERT INTO programme (id, name, category, leader) VALUES ('" . $uid . "', '" . $name1 . "', '" . $category1 . "', '" . $proleader1 . "')";

		if(mysqli_query($conn, $query)) {
			$sid = mysqli_insert_id($conn);

			if (isset($_POST['mcode']) && isset($_POST['mname']) && isset($_POST['mweight']) && isset($_POST['mtype']) && isset($_POST['mleader']) && isset($_POST['mdesc'])) {
				foreach ($_POST['mcode'] as $key => $value) {
					$mcode1 = $_POST['mcode'][$key];
					$mname1 = $_POST['mname'][$key];
					$mweight1 = $_POST['mweight'][$key];
					$mtype1 = $_POST['mtype'][$key];
					$mleader1 = $_POST['mleader'][$key];
					$mdesc1 = $_POST['mdesc'][$key];

					$query = "INSERT INTO module (id, module_code, programme, leader, name, type, weight, description) VALUES ('" . $uid . "', '" . $mcode1 . "', '" . $sid . "', '" . $mleader1 . "', '" . $mname1 . "', '" . $mtype1 . "', '" . $mweight1 . "', '" . $mdesc1 . "')";

					$result = mysqli_query($conn, $query) or die(mysqli_error($conn));				
				}
			}
		}

		mysqli_close($conn);
		echo '<script type="text/javascript">','window.location.href = "../home/adminHome.php#pCreated"','</script>';
	}
?>

<?php
	}
	else {
		echo "<h1>Please login first</h1>";
	}
?>