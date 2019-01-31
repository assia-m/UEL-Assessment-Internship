<?php 
  include "../includes/db_handler.php";
?>

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <?php 
        if(isset($_SESSION['id'])) {
          ?>
          <a href="../home/lecturerHome.php"><img src="../uel.png" alt="UEL" name="UEL" style="width: 200px; height: 75px; margin-top: -10px; float: left; margin-left: -10px;"></a>
        <?php
        }
        else {
          ?>
          <img src="../uel.png" alt="UEL" name="UEL" style="width: 200px; height: 75px; margin-top: -10px; float: left; margin-left: -10px;">
        <?php
        }
      ?>
    </div>
    <div>
      <ul class="nav navbar-nav">
        <?php
            if(isset($_SESSION['id'])) {
              // Define each name associated with an URL
              $urls = array(
                  'Home' => '../home/lecturerHome.php', // Home depends on account type logged in 
                  'Logout' => '../logout.php',
              );

              foreach ($urls as $name => $url) {
                  echo '<li> <a href="'.$url.'">'.$name.'</a></li>';
              }
            }
        ?>
</ul>

<ul class="nav navbar-nav navbar-right">
      <?php
        echo '<li><a href="../login.php">Login/Logout</a></li>';
      ?>
    </div>
  </div>
</nav>

<style type="text/css">
    body {
      background-color: #e1e9eb;
    }
  
    .navbar-inverse .navbar-nav>li>a {
      color: #17a2b8;
      border: none!important;
      font-size: 12px;
      text-transform: uppercase;
      color: #ececec;
      font-family: "Raleway","Helvetica Neue","Helvetica","Roboto","Arial",sans-serif;
      font-feature-settings: "lnum";
      font-variant-numeric: lining-nums;
    }

    div {
        display: block;
    }

    .navbar-inverse {
        background-color: #17a2b8;
        border-color: #17a2b8;
        height: 75px;
    }

    .container-fluid {
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
        margin-top: 10px;
    }

    #container1 {
      margin-top: -65px;
      margin-bottom: 50px;
      margin-left: 255px
    }

    .nav ul {
        list-style: none;
        background-color: black;
        text-align: center;
        padding: 0;
        margin: auto;
        z-index: 1000;
        align-items: center;
    }

    ul, menu, dir {
        display: block;
        list-style-type: disc;
        -webkit-margin-before: 1em;
        -webkit-margin-after: 1em;
        -webkit-margin-start: 0px;
        -webkit-margin-end: 0px;
        -webkit-padding-start: 40px;
    }

    .nav ul {
      list-style: none;
      background-color: #17a2b8;
      text-align: center;
      padding: 0;
      margin: auto;
      z-index: 1000;
      background-color: #17a2b8;
      }

    .nav li {
      font-family: 'Gabriola', sans-serif;
      font-size: 1.2em;
      line-height: 40px;
      text-align: left;
      background-color: #17a2b8;
      }

    .nav a {
      text-decoration: none;
      color: #FFFFFF;
      display: block;
      padding-left: 15px;
      border-bottom: 1px solid #888;
      transition: .3s background-color;
      }

    .nav a:hover {
      background-color: #17a2b8;
    }

    .nav a:active {
      background-color: #aaa;
      color: #444;
      cursor: default;
    }    
</style>