<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>delete.class_price</title>
    <link rel="stylesheet" href="../../styles/normal.css">
    <link rel="stylesheet" href="../../styles/styles.css">
</head>
<body class="container" style="margin: 10rem auto 10rem auto;">

    <?php

    if (isset($_GET["id"])) {

        include "../../genaral/config.php";

        $class_id = $_GET["id"];

        $sql = "DELETE FROM `class_price` WHERE `class_id`='$class_id';";

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