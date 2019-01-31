<?php
    $q = intval($_GET['q']);

    include "../includes/db_handler.php"; 

    mysqli_select_db($conn,"ajax_demo");
    $sql = "SELECT * FROM student_portfolio WHERE student_id = '".$q."'";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    while($row = mysqli_fetch_array($result)) {
        echo $row['website'];
    }
    mysqli_close($conn);
?>