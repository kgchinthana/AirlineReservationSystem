<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>delete.seat</title>
    <link rel="stylesheet" href="../../styles/normal.css">
    <link rel="stylesheet" href="../../styles/styles.css">
</head>
<body class="container" style="margin: 10rem auto 10rem auto;">

    <?php

    if (isset($_GET["no"])) {

        include "../../genaral/config.php";

        $seat_no = $_GET["no"];

        $sql = "DELETE FROM `seat` WHERE `seat_no`='$seat_no';";

        try {
            $result = $conn->query($sql);
            echo "<script type='text/javascript'>alert('deleted successfully!');</script>";
        }
        catch (Exception $ex) {
            echo "<script type='text/javascript'>alert('error occured!');</script>";
        }

    }

    ?>

    <a href="view.php" class="btn btn-secondary"> Go Back </a>
    
</body>
</html>