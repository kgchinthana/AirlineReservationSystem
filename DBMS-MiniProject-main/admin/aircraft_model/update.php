<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update.aircraft_model</title>
    <link rel="stylesheet" href="../../styles/normal.css">
    <link rel="stylesheet" href="../../styles/styles.css">
    <link rel="stylesheet" href="../../styles/virgin.css">
</head>
<body class="container" style="margin: 10rem auto 10rem auto;">

<div class="h2 text-center">Virgin Airlines</div><br><br>
    <center><h2 style="font-weight: 800;"> Update Record </h2></center><br><br>

    <?php

    include "../../genaral/config.php";
    
    // get row values containing relavant id to fill the form when loading
    if (isset($_GET["model"])) {

        $model = $_GET["model"];

        $sql = "SELECT `seat_cap` FROM `aircraft_model` WHERE `model`='$model';";
        $result = $conn->query($sql);

        $row = $result->fetch_assoc();
        $seat_cap = $row["seat_cap"];

    }
    
    if (isset($_POST["update"])) {

        $plane_model = $_POST["model"];
        $seats = $_POST["seat_cap"];

        $sql = "UPDATE `aircraft_model` SET `model`='$plane_model', `seat_cap`='$seats' WHERE `model` = '$model';";

        

        try {
            $result = $conn->query($sql);
            echo "<script type='text/javascript'>alert('updated successfully!');</script>";
        }
        catch (Exception $ex) {
            echo "<script type='text/javascript'>alert('error occured!');</script>";
        }

    }

    
    ?>

    <form action="" method="POST">

        <label for="model"> Plane Model: </label>
        <input type="text" name="model" id="model" class="form-control" value="<?php echo $model; ?>" required><br>

        <label for="seat_cap"> Seat Capasity : </label><br>
        <input type="text" name="seat_cap" id="seat_cap" class="form-control" value="<?php echo $seat_cap; ?>" required><br><br>

        <input type="submit" name="update" id="update" class="btn btn-success" value="Update"> 
        <a href="view.php" class="btn btn-secondary"> Go Back </a>

    </form>
    
</body>
</html>