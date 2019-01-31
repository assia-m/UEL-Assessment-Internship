<?php
    $q = intval($_GET['q']);

    include "../includes/db_handler.php"; 

    mysqli_select_db($conn,"ajax_demo");
    $sql = "SELECT * FROM users WHERE id = '".$q."'";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    while($row = mysqli_fetch_array($result)) {
        echo $row['name'];
    }
    mysqli_close($conn);
?>