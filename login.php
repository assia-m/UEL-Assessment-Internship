<?php
  if(!isset($_SESSION)) {
    session_start();
  }
  include "includes/db_handler.php";  
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
    <div id="login">
        <h3 class="text-center text-white pt-5">UEL Curriculum & Assessment System</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                <input type="submit" name="submit" class="btn btn-success btn-md" value="Login">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<style type="text/css">
	body {
	  margin: 0;
	  padding: 0;
	  background-color: #17a2b8;
	  height: 100vh;
	}
	#login .container #login-row #login-column #login-box {
	  margin-top: 120px;
	  max-width: 600px;
	  height: 320px;
	  border: 1px solid #9C9C9C;
	  background-color: #EAEAEA;
	}
	#login .container #login-row #login-column #login-box #login-form {
	  padding: 20px;
	}
	#login .container #login-row #login-column #login-box #login-form #register-link {
	  margin-top: -85px;
	}
</style>

<?php
  if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$pass'";
    $result = mysqli_query($conn, $sql) or die("Could not connect database " . mysqli_error($conn));

    if (!$row = $result->fetch_assoc()) {
      // ERROR MESSAGE SHOWS AT THE TOP OF THE PAGE
    } else {
      $_SESSION['id'] = $row['username'];
      $uname = $row['username'];
      $login = $row['username'];

      if($row['rank'] == 'Programme Leader' || $row['rank'] == 'Module Leader' || $row['rank'] == 'Student') {

        $_SESSION['rank'] = $row['rank'];

        if(isset($_SESSION['rank'])) {
          if($_SESSION['rank'] == 'Programme Leader') {
            echo "<script type='text/javascript'>window.location.href = 'home/adminHome.php';</script>";
          }
          else if($_SESSION['rank'] == 'Module Leader') {
            echo "<script type='text/javascript'>window.location.href = 'home/lecturerHome.php';</script>";
          }
          else if($_SESSION['rank'] == 'Student') {
            echo "<script type='text/javascript'>window.location.href = 'home/studentHome.php';</script>";
          }
        }
      }
      else {
        echo "Role not found.";
      }
    }
  }
?>