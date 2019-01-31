<?php 
  include "../includes/admin-navbar.php";
  include "../includes/db_handler.php"; 
  session_start();

  if(isset($_SESSION['id'])) {
    $mod = $_GET['id'];
    $user = base64_decode(urldecode($mod));

    $sql = "DELETE FROM coursework WHERE id = '$user'";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    mysqli_close($conn);
    echo '<script type="text/javascript">','window.history.back(); location.reload()','</script>';
  }
  else {
    echo "<h1>Please login first</h1>";
  }
?>