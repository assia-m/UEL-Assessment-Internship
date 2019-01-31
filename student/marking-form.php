<?php
	include "../includes/student-navbar.php";
	include "../includes/db_handler.php"; 
	session_start();

	if(isset($_SESSION['id'])) {
		$mod = $_SESSION['id'];

		$sql = "SELECT * FROM users WHERE username = '$mod'";
		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

		while($row = mysqli_fetch_array($result)) {
			$stid = $row['student_id'];
			$sname = $row['name'];
			$sid = $row['id'];
		}

		$sql1 = "SELECT * FROM marks WHERE student_id = '$sid'";
		$result1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));

		while($row1 = mysqli_fetch_array($result1)) {
			$marker = $row1['marker'];
			$cw = $row1['coursework'];
		}

		$sql2 = "SELECT * FROM users WHERE id = '$marker'";
		$result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

		while($row2 = mysqli_fetch_array($result2)) {
			$mname = $row2['name'];
		}

		$sql3 = "SELECT * FROM coursework WHERE id = '$cw'";
		$result3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));

		while($row3 = mysqli_fetch_array($result3)) {
			$cwname = $row3['name'];
		}

		$sql5 = "SELECT * FROM student_portfolio WHERE student_id = '$sid'";
		$result5 = mysqli_query($conn, $sql5) or die(mysqli_error($conn));

		while($row5 = mysqli_fetch_array($result5)) {
			$sweb = $row5['website'];
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
	</script>
</head>
<body id="target">
	<br>
	<br>
	<div class="container" id="container">
		<a href="../home/studentHome.php"><button style="color: white;" type="button" class="btn btn-lg btn-info">Home</button></a>
		<button name="export" id="export" onclick="exportPDF()" style="float: right;" class="btn-lg btn-success">Export As PDF</button>
		<hr>
		<form method="POST">
			<h2>Student</h2>
			<table class="table">
				<tr>
					<th class="table-primary">Student ID</th>
					<td class="table-secondary">
						<input type="text" value="<?php echo $stid; ?>" style="background: transparent; border: none;" readonly>
					</td>
				</tr>
				<tr>
					<th class="table-primary">Student Name</th>
					<td class="table-secondary">
						<input type="text" value="<?php echo $sname; ?>" style="background: transparent; border: none;" readonly>
					</td>
				</tr>
				<tr>
					<th class="table-primary">Marker</th>
						<td class="table-secondary">
							<input type="text" value="<?php echo $mname; ?>" style="background: transparent; border: none;" readonly>
						</td>
				</tr>
				<tr>
					<th class="table-primary">Coursework</th>
						<td class="table-secondary">
							<input type="text" value="<?php echo $cwname; ?>" style="background: transparent; border: none;" readonly>
						</td>
				</tr>
			</table>
			<iframe style="border: 2px solid black;" name="iframeshow" id="iframeshow" src="<?php echo $sweb; ?>" width="100%" height="500" allowfullscreen>
			  <p>Your browser does not support iframes.</p>
			</iframe>
			<br>
			<hr>
			<h2>Marking Scheme</h2>
			<table class="table" id="commentPlace" style="border: 2px solid black;">
			  <tbody>
			  	<?php
				  	$sql4 = "SELECT DISTINCT type FROM LO WHERE coursework = '$cw'";
			    	$result4 = mysqli_query($conn, $sql4) or die(mysqli_error($conn));

			    	while($row4 = mysqli_fetch_array($result4)) {
			    		$tid = $row4['type'];
			    	?>

			    	  <tr>
		    			<th colspan="2" style="background-color: #5D5D5D; color: white;"><?php echo $row4['type']; ?></th>
		    		  </tr>

	    		  <?php
			  		$sql1 = "SELECT * FROM marks WHERE student_id = '$sid'";
					$result1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));

					while($row1 = mysqli_fetch_array($result1)) {
						$marker = $row1['marker'];
						$loid = $row1['LO'];
						$bandid = $row1['band'];
						$scomments = $row1['feedback'];
						$icomments = $row1['improve'];
						$ograd = $row1['overall_mark'];

						$sql = "SELECT * FROM LO WHERE content = '$loid' AND type = '$tid'"; 
						$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

					    while($row = mysqli_fetch_array($result)) { 
					    	$rid = $row['id'];
					    	$i = 1;

					    	?>
				    		  <tr style="background-color: white;">
				    		  	<td style="width: 60%;"><input style="background: transparent; border: none;" readonly name="<?php echo "LOcontent[]" . $i;?>" id="LOcontent" value="<?php echo $row['content']; ?>"></td>
				    		  	<td>

				    		  		<?php 
				    		  			$sql3 = "SELECT * FROM LO_bands WHERE id = '$bandid'";
				    		  			$result3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));

				    		  			while($row3 = mysqli_fetch_array($result3)) {
				    		  				$band = $row3['band'];
				    		  				$lid = $row3['LO_ID'];
				    		  				$comment = $row3['comment'];
				    		  		?>

				    				<select disabled="true" id="bandselect" name="<?php echo "bandselect[]" . $i;?>" onchange="showComment(<?php echo $rid; ?>, this.value)">
						       			<option selected disabled>-- SELECT --</option>
						       			<option value="Very Poor (below 20%)"<?php echo ($band == 'Very Poor (below 20%)' ? ' selected = "selected"' : ''); ?>>Very Poor (below 20%)</option>
										<option value="Poor (20%-30%)"<?php echo ($band == 'Poor (20%-30%)' ? ' selected = "selected"' : ''); ?>>Poor (20%-30%)</option>
										<option value="Some Engagement (31%-39%)"<?php echo ($band == 'Some Engagement (31%-39%)' ? ' selected = "selected"' : ''); ?>>Some Engagement (31%-39%)</option>
										<option value="Satisfactory (40%-50%)"<?php echo ($band == 'Satisfactory (40%-50%)' ? ' selected = "selected"' : ''); ?>>Satisfactory (40%-50%)</option>
										<option value="Good (50%-60%)"<?php echo ($band == 'Good (50%-60%)' ? ' selected = "selected"' : ''); ?>>Good (50%-60%)</option>
										<option value="Very Good (60%-70%)"<?php echo ($band == 'Very Good (60%-70%)' ? ' selected = "selected"' : ''); ?>>Very Good (60%-70%)</option>
										<option value="Excellent (70%-80%)"<?php echo ($band == 'Excellent (70%-80%)' ? ' selected = "selected"' : ''); ?>>Excellent (70%-80%)</option>
										<option value="Outstanding (80%+)"<?php echo ($band == 'Outstanding (80%+)' ? ' selected = "selected"' : ''); ?>>Oustanding (80+)</option>
						      		</select>
					      		</td>
				    		  </tr>
				    		  <tr style="background-color: white;">
				    		  	<td style="color: #CD2323;"><b>Feedback/Comment:</b></td>
				    		  	<td><input style="background: transparent; border: none;" readonly type="text" value="<?php echo $comment; ?>"></td>
				    		  </tr>
		    		<?php 
				    		$i++;
				    		}
				    	}
		    			} 
		    		} 
		    		?>
			  </tbody>
		    </table>
		    <hr>
		    <table class="table">
				<tr>
					<th class="table-primary">Summary Comments</th>
					<td class="table-secondary">
						<textarea id="extraComments" readonly name="extraComments"><?php echo $scomments; ?></textarea>
					</td>
				</tr>
				<tr>
					<th class="table-primary">How To Improve Your Work?</th>
					<td class="table-secondary">
						<textarea id="improveComments" readonly name="improveComments"><?php echo $icomments; ?></textarea>
					</td>
				</tr>
				<tr>
					<th class="table-primary">Overall Grade</th>
					<td class="table-secondary">
						<input type="number" readonly id="overallMark" name="overallMark" value="<?php echo $ograd; ?>">
					</td>
				</tr>
			</table>
			<a href="../home/studentHome.php"><button style="color: white;" type="button" class="btn btn-lg btn-info">Home</button></a>	
		</form>
	</div>
</body>
</html>

<style type="text/css">
	body {
    	background-color: #e1e9eb;
	}
	textarea, input {
		background-color: transparent;
		border: none;
		resize: none;
		width: 100%;
	}
	textarea {
		height: 150px;
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
		        kendo.drawing.pdf.saveAs(group, "<?php echo $cwname; ?>-Marking-Scheme.pdf")
		    });
		}
</script>

<?php
	}
	else {
		echo "<h1>Please login first</h1>";
	}
?>