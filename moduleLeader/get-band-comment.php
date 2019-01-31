<!DOCTYPE html>
<html>
    <head></head>
    <body>

        <?php
            $q = intval($_GET['q']);
            $a = intval($_GET['a']);
            include "../includes/db_handler.php"; 

            mysqli_select_db($conn,"ajax_demo");
            $sql = "SELECT * FROM LO_bands WHERE id = '$a' AND LO_ID = '" . $q . "'";
            $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

            while($row = mysqli_fetch_array($result)) {
                echo $row['comment'];
            }
            mysqli_close($conn);
        ?>
</body>
</html>