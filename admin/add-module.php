<?php
	include "../includes/admin-navbar.php";
	include "../includes/db_handler.php"; 
	session_start();

	if(isset($_SESSION['id'])) {$mod = $_GET['id'];
		$user = base64_decode(urldecode($mod));

		$sql = "SELECT * FROM programme WHERE id = '$user'"; 
		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

	    while($row = mysqli_fetch_array($result)) { 
	    	$rid = $row['id'];
	    	$name = $row['name'];
		}

		$mcode = array();
		$mname = array();

		$sql1 = "SELECT * FROM module WHERE programme = '$rid'";
		$result1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));

		if(mysqli_num_rows($result1) > 0) {
			while($row1 = mysqli_fetch_array($result1)) {
				$mcode[] = $row1['module_code'];
				$mname[] = $row1['name'];
			}
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
			<h2><b>Add Module</b></h2>
			<hr>
		    <div class="row clearfix">
		    	<div class="col-md-12">
		    		<label>Programme Name</label>
					<input type="text" name="programme" class="form-control" readonly value="<?php if (isset($_GET['id'])) { print $name; }?>">
					<br>
		    	</div>
		    	<div class="col-md-6">
		    		<label>Module Code</label>
					<input type="text" name="code" class="form-control" placeholder="Module Code" onchange="checkCode(this)"><div style="display: none;" id="codeOk"><span>Module Code is available</span></div><div style="display: none;" id="codeAlert"><span>Module Code is taken. Try another</span></div>
					<br>
		    	</div>
		    	<div class="col-md-6">
		    		<label>Module Name</label>
					<input type="text" name="name" class="form-control" placeholder="Module Name" onchange="checkName(this)"><div style="display: none;" id="nameOk"><span>Module Name is available</span></div><div style="display: none;" id="nameAlert"><span>Module Name is taken. Try another</span></div>
					<br>
		    	</div>
		    	<div class="col-md-6">
		    		<label>Module Leader</label>
					<?php
						$query = "SELECT id, name FROM users WHERE rank = 'Module Leader' ORDER BY name DESC";
						$result = mysqli_query($conn, $query);
				    ?>
						<select required class="form-group form-control" data-show-subtext="true" data-live-search="true" id="leader" name="leader" style="margin-left: -1px;">
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
		    		<label>Other Tutor</label>
					<?php
						$query = "SELECT id, name FROM users WHERE rank = 'Module Leader' ORDER BY name DESC";
						$result = mysqli_query($conn, $query);
				    ?>
						<select required class="form-group form-control" data-show-subtext="true" data-live-search="true" id="othertutor" name="othertutor" style="margin-left: -1px;">
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
		    	<div class="col-md-4">
		    		<label>Weight</label>
					<select name="weight" id="weight" class="form-control">
				    	<option disabled selected>-- SELECT --</option>
				    	<option value="15">15 Credit</option>
				    	<option value="30">30 Credit</option>
				    	<option value="45">45 Credit</option>
				    </select>
					<br>
		    	</div>
		    	<div class="col-md-4">
		    		<label>Type</label>
		    		<select name="type" id="type" class="form-control">
				    	<option disabled selected>-- SELECT --</option>
				    	<option value="Optional">Optional</option>
				    	<option value="Core">Core</option>
				    </select>
		    	</div>
		    	<div class="col-md-4">
		    		<label>Peer Marking</label>
					<select name="peer" id="peer" class="form-control">
						<option  disabled selected>-- SELECT --</option>
						<option value="No">No</option>
						<option value="Yes">Yes</option>
					</select>
					<br>
		    	</div>
		    	<div class="col-md-12">
		    		<label>Description</label>
					<textarea style="resize: none;" type="text" name="desc" class="form-control" placeholder="Module Description"></textarea>
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
							<tr id='addr0'>
								<td>1</td>
								<td>
									<input type="text" name='aname[]' id="aname" placeholder='Assessment Name' class="form-control"/>
								</td>
								<td>
									<input type="text" name='adesc[]' id="adesc" placeholder='Assessment Description' class="form-control"/>
								</td>
								<td>
									<input type="number" name='assessweight[]' id="assessweight" placeholder='Assessment Weight' class="assessweight form-control"/>
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
	var codes = [<?php echo '"'.implode('","', $mcode).'"' ?>];

	function checkCode(codeEntered) {
		var requestedCode = codeEntered.value;
		var i = codes.indexOf(requestedCode);

		if(i > -1) {
			$('#codeAlert').show();
			$('#codeOk').hide();
			$('#submit').hide();
		}
		else {
			$('#codeOk').show();
			$('#codeAlert').hide();
			$('#submit').show();
		}
	}
</script>

<script type="text/javascript">
	var names = [<?php echo '"'.implode('","', $mname).'"' ?>];

	function checkName(nameEntered) {
		var requestedName = nameEntered.value;
		var i = names.indexOf(requestedName);

		if(i > -1) {
			$('#nameAlert').show();
			$('#nameOk').hide();
			$('#submit').hide();
		}
		else {
			$('#nameOk').show();
			$('#nameAlert').hide();
			$('#submit').show();
		}
	}
</script>

<script type="text/javascript">
 $(document).ready(function(){
      var i = 1;

     $("#add_row").click(function(){
      	$('#addr'+i).html("<td>"+ (i+1) +"</td><td><input type='text' name='aname[]"+i+"' id='aname' placeholder='Assessment Name' class='form-control'/></td><td><input type='text' name='adesc[]"+i+"' id='adesc' placeholder='Assessment Description' class='form-control'/></td><td><input type='number' name='assessweight[]"+i+"' id='assessweight' placeholder='Assessment Weight' class='assessweight form-control'/></td>");

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

<script type="text/javascript">
    $(document).on('change', '.assessweight', function() {
        var atotal = 0;
        $('.assessweight').each(function(){
            atotal += parseFloat($(this).val());
        });
        if(atotal == 100) {
        	$('#add_row').hide();
        	$('.assessweight').css("color", "black");
        	subPerfectWeight();
        	document.getElementById('submit').style.display ='block';
        }
        else if(atotal < 100) {
        	$('#add_row').show();
        	$('.assessweight').css("color", "red");
        	subLowerWeight();
        	document.getElementById('submit').style.display ='block';
        }
        else if(atotal > 100) {
        	$('#add_row').hide();
        	$('.assessweight').css("color", "red");
        	subHigherWeight();
        	document.getElementById('submit').style.display ='none';
        }
    });
</script>

<script src="https://rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>
<script type="text/javascript">
	function subHigherWeight() {
		$.notify("Total weight greater than 100% [x]", { 
			globalPosition: 'top center',
			clickToHide: true,
  			autoHide: true,
  			className: 'error',
  			autoHideDelay: 3000
		});
	}
	function subLowerWeight() {
		$.notify("Total weight less than 100% [x]", { 
			globalPosition: 'top center',
			clickToHide: true,
  			autoHide: true,
  			className: 'error',
  			autoHideDelay: 3000
		});
	}
	function subPerfectWeight() {
		$.notify("Total weight equals 100% [x]", { 
			globalPosition: 'top center',
			clickToHide: true,
  			autoHide: true,
  			className: 'success',
  			autoHideDelay: 3000
		});
	}
</script>

<?php 
	if(isset($_POST['submit'])) {
		$uid = mysqli_insert_id($conn);
		$code1 = mysqli_real_escape_string($conn, $_REQUEST['code']);
		$name1 = mysqli_real_escape_string($conn, $_REQUEST['name']);
		$desc1 = mysqli_real_escape_string($conn, $_REQUEST['desc']);
		$weight1 = mysqli_real_escape_string($conn, $_REQUEST['weight']);
		$type1 = mysqli_real_escape_string($conn, $_REQUEST['type']);
		$peer1 = mysqli_real_escape_string($conn, $_REQUEST['peer']);
		$leader1 = mysqli_real_escape_string($conn, $_REQUEST['leader']);
		$otutor1 = mysqli_real_escape_string($conn, $_REQUEST['othertutor']);

		$query = "INSERT INTO module (id, module_code, programme, leader, other_tutor, name, type, weight, description, peer_marking) VALUES ('" . $uid . "', '" . $code1 . "', '" . $user . "', '" . $leader1 . "', '" . $otutor1 . "', '" . $name1 . "', '" . $type1 . "', '" . $weight1 . "', '" . $desc1 . "', '" . $peer1 . "')";

		if(mysqli_query($conn, $query)) {
			$sid = mysqli_insert_id($conn);

			if (isset($_POST['aname']) && isset($_POST['adesc']) && isset($_POST['assessweight'])) {
				foreach ($_POST['aname'] as $key => $value) {
					$LOname1 = $_POST['aname'][$key];
					$LOdesc1 = $_POST['adesc'][$key];
					$LOtype1 = $_POST['assessweight'][$key];

					$query = "INSERT INTO coursework (id, name, programme, module, description, weights) VALUES ('" . $uid . "', '" . $LOname1 . "', '" . $user . "', '" . $sid . "', '" . $LOdesc1 . "', '" . $LOtype1 . "')";

					$result = mysqli_query($conn, $query) or die(mysqli_error($conn));				
				}
			}
		}

		mysqli_close($conn);
		echo '<script type="text/javascript">','window.location.href = "../home/adminHome.php#mCreated"','</script>';
	}
?>

<?php
	}
	else {
		echo "<h1>Please login first</h1>";
	}
?>