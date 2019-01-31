<?php
	include "../includes/lecturer-navbar.php";
	include "../includes/db_handler.php"; 
	session_start();

	if(isset($_SESSION['id'])) {
		$mod = $_GET['id'];
		$user = base64_decode(urldecode($mod)); 
	?>

<!DOCTYPE html>
<html>
<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<title></title>
	<script>
		function showUser(str) {
		  if (str == "") {
		    document.getElementById("txtHint").innerHTML = "";
		    return;
		  } 
		  if (window.XMLHttpRequest) {
		    // code for IE7+, Firefox, Chrome, Opera, Safari
		    xmlhttp = new XMLHttpRequest();
		  } else { // code for IE6, IE5
		    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  }
		  xmlhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		      document.getElementById("txtHint").innerHTML = this.responseText;
		    }
		  }
		  xmlhttp.open("GET","get-student.php?q="+str,true);
		  xmlhttp.send();
		}
	</script>
	<script>
		function getWeb(str1) {
		  if (str1 == "") {
		    document.getElementById("iframeshow").innerHTML = "";
		    return;
		  } 
		  if (window.XMLHttpRequest) {
		    // code for IE7+, Firefox, Chrome, Opera, Safari
		    xmlhttp = new XMLHttpRequest();
		  } else { // code for IE6, IE5
		    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  }
		  xmlhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		    	document.getElementById("iframeshow").style.display = 'block';
		      	var newsrc = this.responseText;
		      	document.getElementById('iframeshow').src = newsrc;
		    }
		  }
		  xmlhttp.open("GET","get-student-portfolio.php?q="+str1,true);
		  xmlhttp.send();
		}
	</script>
	<script>
		function showComment(lid, bid) {
		  if (lid == "" && bid == "") {
		    document.getElementById("commentPlace").innerHTML = "";
		    return;
		  } 
		  if (window.XMLHttpRequest) {
		    // code for IE7+, Firefox, Chrome, Opera, Safari
		    xmlhttp = new XMLHttpRequest();
		  } else { // code for IE6, IE5
		    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  }
		  xmlhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		      document.getElementById(lid).innerHTML = this.responseText;
		    }
		  }
		  xmlhttp.open("GET","get-band-comment.php?q="+lid+"&a="+bid,true);
		  xmlhttp.send();
		}
	</script>
</head>
<body>
	<br>
	<br>
	<form method="POST">
		<div class="container" id="container">
			<h2>Student</h2>
			<table class="table">
				<tr>
					<th class="table-primary">Student ID</th>
					<td class="table-secondary">
						<?php
							$output = '';
							$sql = "SELECT * FROM users WHERE rank = 'Student'";
							$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

							while($row = mysqli_fetch_array($result)) {
								$stid = $row['id'];

								$sql5 = "SELECT * FROM marks WHERE student_id = '$stid' AND coursework = '$user'";
								$result5 = mysqli_query($conn, $sql5) or die(mysqli_error($conn));

								if(mysqli_num_rows($result5) > 0) {

								}
								else {
									$output .= '<option value="'.$row['id'].'">'.$row['student_id'].'</option>';
								}
							}
						?>
						<select name="student" id="student" onchange="showUser(this.value); getWeb(this.value);">
							<option disabled selected>-- SELECT --</option>
							<?php echo $output; ?>
						</select>
					</td>
				</tr>
				<tr>
					<th class="table-primary">Student Name</th>
					<td class="table-secondary" id="txtHint"></td>
				</tr>
				<tr>
					<th class="table-primary">Marker</th>
						<?php
							$uid = $_SESSION['id'];
							$sql2 = "SELECT * FROM users WHERE username = '$uid'";
							$result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

							while($row2 = mysqli_fetch_array($result2)) {
								echo '<td class="table-secondary"><input type="hidden" name="marker" id="marker" value="'.$row2['id'].'"><input style="background: transparent; border: none;" readonly value="'.$row2['name'].'"></td>';
							}
						?>
				</tr>
			</table>
			<iframe style="border: 2px solid black; display: none;" name="iframeshow" src="" id="iframeshow" width="100%" height="500" allowfullscreen>
			  <p>Your browser does not support iframes.</p>
			</iframe>
			<br>
			<hr>
			<h2>Marking Scheme</h2>
			<table class="table" id="commentPlace" style="border: 2px solid black;">
			  <tbody>
			  	<?php
				  	$sql4 = "SELECT DISTINCT type FROM LO WHERE coursework = '$user'";
			    	$result4 = mysqli_query($conn, $sql4) or die(mysqli_error($conn));

			    	while($row4 = mysqli_fetch_array($result4)) {
			    		$tid = $row4['type'];
			    	?>

			    	  <tr>
		    			<th colspan="2" style="background-color: #5D5D5D; color: white;"><?php echo $row4['type']; ?></th>
		    		  </tr>
		    		<?php 

					$sql = "SELECT * FROM LO WHERE coursework = '$user' AND type = '$tid'"; 
					$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

				    while($row = mysqli_fetch_array($result)) { 
				    	$rid = $row['id'];
				    	$i = 1;

				 		?>
			    		  <tr style="background-color: white;">
			    		  	<td style="width: 60%;"><input style="background: transparent; border: none;" readonly name="<?php echo "LOcontent[]" . $i;?>" id="LOcontent" value="<?php echo $row['content']; ?>"></td>
			    		  	<td>
			    				<select id="bandselect" name="<?php echo "bandselect[]" . $i;?>" onchange="showComment(<?php echo $rid; ?>, this.value)">
					       			<option selected disabled>-- SELECT --</option>
					       			<?php 
					       				$sql3 = "SELECT * FROM LO_bands WHERE LO_ID = '$rid'";
					       				$result3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));

					       				while($row3 = mysqli_fetch_array($result3)) {
								    		echo "<option value='$row3[0]'>$row3[2]</option>";
					       				}
					       			?>
					      		</select>
				      		</td>
			    		  </tr>
			    		  <tr style="background-color: white;">
			    		  	<td style="color: #CD2323;"><b>Feedback/Comment:</b></td>
			    		  	<td id="<?php echo $rid; ?>"></td>
			    		  </tr>
		    		<?php 
			    		$i++;
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
						<textarea id="extraComments" name="extraComments"></textarea>
					</td>
				</tr>
				<tr>
					<th class="table-primary">How To Improve Your Work?</th>
					<td class="table-secondary">
						<textarea id="improveComments" name="improveComments"></textarea>
					</td>
				</tr>
				<tr>
					<th class="table-primary">Overall Grade</th>
					<td class="table-secondary">
						<input type="number" id="overallMark" name="overallMark">
					</td>
				</tr>
			</table>
			<input type="submit" name="submit" id="submit" class="btn btn-lg btn-success" value="Save Changes">
			<a href="../home/lecturerHome.php"><button style="color: white;" type="button" class="btn btn-lg btn-info">Cancel</button></a>	
		</div>
	</form>
</body>
</html>

<style type="text/css">
	body {
    	background-color: #e1e9eb;
	}
	textarea {
		resize: none;
		width: 100%;
		height: 150px;
	}
	#overallMark {
		width: 100%;
		border: 1px solid black;
	}
</style>

<?php 
	if(isset($_POST['submit'])) {
		$uid = mysqli_insert_id($conn);
		$stud1 = mysqli_real_escape_string($conn, $_REQUEST['student']);
		$mark1 = mysqli_real_escape_string($conn, $_REQUEST['marker']);
		$moreComments1 = mysqli_real_escape_string($conn, $_REQUEST['extraComments']);
		$improve1 = mysqli_real_escape_string($conn, $_REQUEST['improveComments']);
		$overall1 = mysqli_real_escape_string($conn, $_REQUEST['overallMark']);

			foreach ($_POST['LOcontent'] as $key => $value) {
				$LOcontent1 = $_POST['LOcontent'][$key];
				$bandselect1 = $_POST['bandselect'][$key];

				$query = "INSERT INTO marks (id, student_id, coursework, marker, LO, band, feedback, improve, overall_mark) VALUES ('" . $uid . "', '" . $stud1 . "', '" . $user . "', '" . $mark1 . "' ,'" . $LOcontent1 . "', '" . $bandselect1 . "', '" . $moreComments1 . "', '" . $improve1 . "', '" . $overall1 . "')";
			
				$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
			}
		mysqli_close($conn);
		echo '<script type="text/javascript">','window.location.href = "../home/adminHome.php#maCreated"','</script>';
	}
?>

<?php
	}
	else {
		echo "<h1>Please login first</h1>";
	}
?>