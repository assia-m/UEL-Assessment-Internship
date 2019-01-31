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
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<title></title>
</head>
<body>
	<br>
	<br>
	<div class="container">
    	<h1 class="well">Add User</h1>
		<div class="col-lg-12 well">
			<div class="row">
				<form role="form" method="POST">
					<div class="col-md-12">
						<div class="row">
							<div class="col-sm-6 form-group">
								<label>First Name</label>
								<input type="text" name="name" id="name" placeholder="Enter First Name Here.." class="form-control">
							</div>
							<div class="col-sm-6 form-group">
								<label>Last Name</label>
								<input type="text" name="sname" id="sname" placeholder="Enter Last Name Here.." class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label>Username</label>
							<input type="text" name="email" id="email" placeholder="Enter Username Here.." class="form-control">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="text" name="password" id="password" placeholder="Enter Password Here.." class="form-control">
						</div>
						<div class="form-group">
							<label>Account Type</label>
							<select id="rank" name="rank" class="form-control">
								<option disabled selected>-- SELECT --</option>
								<option value="Programme Leader">Programme Leader</option>
								<option value="Module Leader">Module Leader</option>
								<option value="Student">Student</option>
							</select>
						</div>
						<div style="display: none;" id="hideDiv" class="form-group">
							<label>Student ID</label>
							<input name="stid" id="stid" type="text" placeholder="Enter Student ID Here.." class="form-control">
						</div>
					<input type="submit" name="submit" id="submit" class="btn btn-lg btn-success" value="Add User">
					<a href="../home/adminHome.php"><button style="color: white;" type="button" class="btn btn-lg btn-info">Cancel</button></a>				
					</div>
				</form> 
			</div>
		</div>
	</div>
</body>
</html>

<style type="text/css">
	@import "font-awesome.min.css";
	@import "font-awesome-ie7.min.css";
	/* Space out content a bit */
	body{
	    font-family: Arial;
	    font-size: 14px;
	    background-color: #e1e9eb;
	}

	/* Everything but the jumbotron gets side spacing for mobile first views */
	.header,
	.marketing,
	.footer {
	  padding-right: 15px;
	  padding-left: 15px;
	}

	/* Custom page header */
	.header {
	  border-bottom: 1px solid #e5e5e5;
	}
	/* Make the masthead heading the same height as the navigation */
	.header h3 {
	  padding-bottom: 19px;
	  margin-top: 0;
	  margin-bottom: 0;
	  line-height: 40px;
	}

	/* Custom page footer */
	.footer {
	  padding-top: 19px;
	  color: #777;
	  border-top: 1px solid #e5e5e5;
	}

	/* Customize container */
	@media (min-width: 768px) {
	  .container {
	    max-width: 730px;
	  }
	}
	.container-narrow > hr {
	  margin: 30px 0;
	}

	/* Main marketing message and sign up button */
	.jumbotron {
	  text-align: center;
	  border-bottom: 1px solid #e5e5e5;
	}
	.jumbotron .btn {
	  padding: 14px 24px;
	  font-size: 21px;
	}

	/* Supporting marketing content */
	.marketing {
	  margin: 40px 0;
	}
	.marketing p + h4 {
	  margin-top: 28px;
	}

	/* Responsive: Portrait tablets and up */
	@media screen and (min-width: 768px) {
	  /* Remove the padding we set earlier */
	  .header,
	  .marketing,
	  .footer {
	    padding-right: 0;
	    padding-left: 0;
	  }
	  /* Space out the masthead */
	  .header {
	    margin-bottom: 30px;
	  }
	  /* Remove the bottom border on the jumbotron for visual effect */
	  .jumbotron {
	    border-bottom: 0;
	  }
	}
</style>

<!-- SCRIPT BELOW IS FOR CHECKING IF EMAIL FIELD HAS A @ AND . DOMAIN (e.g. .com, .co.uk, etc) -->
<script type="text/javascript">
	$(document).ready(function(){
	    var errors = false;
	    $('.required').parent().find('.input').on('blur', function() {
	        var error_div = $(this).parent().find('.error_message');
	        var field_container = $(this).parent();
	        if (!$.empty_field_validation($(this).val())) {
	            error_div.html('This field is required.');
	            error_div.css('display', 'block');
	            field_container.addClass('error');
				errors = true;
	        } else {
	            error_div.html('');
	            error_div.css('display', 'none');
	            field_container.removeClass('error');
				errors = false;
	        }
	    });
	    $('#email').on('blur', function(){
	        var error_div = $(this).parent().find('.error_message');
	        var field_container = $(this).parent();
	        if (!$.email_validation($(this).val())) {
	            error_div.html('Expected Input: email');
	            error_div.css('display', 'block');
	            field_container.addClass('error');
				errors = true;
	        } else {
	            error_div.html('');
	            error_div.css('display', 'none');
	            field_container.removeClass('error');
				errors = false;
	        }
	    });
		$('#contact_form').submit(function(event) {
			event.preventDefault();
			 $('.required').parent().find('.input').trigger('blur');
	        if (!errors)
	            $.ajax({
	                url: '/echo/json/',
	                data: {
	                    json: JSON.stringify($(this).serializeObject())
	                },
	                type: 'post',
	                success: function(data) {
	                    var message = 'Hi '+data.name+'. Your message was sent and received.';
	                    $('#after_submit').html(message);
	                    $('#after_submit').css('display', 'block');
	                },
	                error: function() {
	                    var message = 'Hi '+data.name+'. Your message could not be sent or received. Please try again later';
	                    $('#after_submit').html(message);
	                    $('#after_submit').css('display', 'block'); 
	                }
	            });
			else
				alert("You didn't completed the form correctly. Check it out and try again!");
		});
	});

	$.empty_field_validation = function(field_value) {
	    if (field_value.trim() == '') return false;
	    return true;
	}
	    
	$.email_validation = function(email) {
	    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	    return regex.test(email);
	}
	$.fn.serializeObject = function()
	{
	   var o = {};
	   var a = this.serializeArray();
	   $.each(a, function() {
	       if (o[this.name]) {
	           if (!o[this.name].push) {
	               o[this.name] = [o[this.name]];
	           }
	           o[this.name].push(this.value || '');
	       } else {
	           o[this.name] = this.value || '';
	       }
	   });
	   return o;
	};
</script>

<script type="text/javascript">
	$(function() {
	    $('#hideDiv').hide(); 
	    $('#rank').change(function(){
	        if($('#rank').val() == 'Student') {
	        	$('#hideDiv').show(); 
	        	document.getElementById("stid").required = true;
	        } else {
	        	$('#hideDiv').hide(); 
	        	document.getElementById("stid").required = false;
	        } 
	    });
	});
</script>

<?php 
	if(isset($_POST['submit'])) {
		$uid = mysqli_insert_id($conn);
		$name1 = mysqli_real_escape_string($conn, $_REQUEST['name']);
		$sname1 = mysqli_real_escape_string($conn, $_REQUEST['sname']);
		$username1 = mysqli_real_escape_string($conn, $_REQUEST['email']);
		$password1 = mysqli_real_escape_string($conn, $_REQUEST['password']);
		$rank1 = mysqli_real_escape_string($conn, $_REQUEST['rank']);
			
		$fname = $name1 . ' ' . $sname1;

		if($rank1 == 'Student') {
			$query = "INSERT INTO users (id, name, username, password, rank) VALUES ('" . $uid . "', '" . $fname . "', '" . $username1 . "', '" . $password1 . "', 'Student')";

			if(mysqli_query($conn, $query)) {
				$sid = mysqli_insert_id($conn);

				$estid = mysqli_real_escape_string($conn, $_REQUEST['stid']);

				$query1 = "INSERT INTO students (id, student_id) VALUES ('" . $sid . "', '" . $estid . "')";
				$result1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));
			}
		}
		else {
			$query = "INSERT INTO users (id, name, username, password, rank) VALUES ('" . $uid . "', '" . $fname . "', '" . $username1 . "', '" . $password1 . "', '" . $rank1 . "')";

			$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
		}

		mysqli_close($conn);
		echo '<script type="text/javascript">','window.location.href = "../home/adminHome.php#uCreated"','</script>';
	}
?>

<?php
	}
	else {
		echo "<h1>Please login first</h1>";
	}
?>