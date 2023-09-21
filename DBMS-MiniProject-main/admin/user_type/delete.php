<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>delete.user_type</title>
    <link rel="stylesheet" href="../../styles/normal.css">
    <link rel="stylesheet" href="../../styles/styles.css">
</head>
<body class="container" style="margin: 10rem auto 10rem auto;">

    <?php
    
    include "../../genaral/config.php";

    if (isset($_GET["type"])) {


        $user_type = $_GET["type"];

        $sql = "DELETE FROM `user_type` WHERE `user_type`='$user_type';";

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