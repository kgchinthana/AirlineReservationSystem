<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update.flight</title>
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
    if (isset($_GET["id"])) {

        $id = $_GET["id"];

        $sql = "SELECT * FROM `flight` WHERE `flight_id`='$id';";
        $result = $conn->query($sql);

        $row = $result->fetch_assoc();
        $detail_id = $row["flight_detail_id"];
        $seat_cap = $row["available_seat_cap"];
        $depart = $row["time_of_departure"];
        $arrive = $row["time_of_arrival"];
        $delay = $row["delay_time"];

    }
    
    if (isset($_POST["update"])) {

        $flight_id = $_POST["id"];
        $flight_detail_id = $_POST["detail_id"];
        $ava_seat_cap = $_POST["seats"];
        $depart_time = $_POST["depart"];
        $arr_time = $_POST["arrive"];
        $delay_time = $_POST["delay"];

        $sql = "UPDATE `flight` SET `flight_id`='$flight_id', `flight_detail_id`='$flight_detail_id', `available_seat_cap`='$ava_seat_cap', `time_of_departure`='$depart_time', `time_of_arrival`='$arr_time', `delay_time`='$delay_time' WHERE `flight_id` = '$id';";

        

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

        <label for="id"> Flight ID: </label>
        <input type="text" name="id" id="id" class="form-control" value="<?php echo $id; ?>" required><br>

        <label for="detail_id"> Detail ID : &nbsp; </label><br>
        <select name="detail_id" id="detail_id" class="form-control" required>

            <option selected> <?php echo $detail_id; ?> </option>

            <?php

            $sql = "SELECT flight_detail_id FROM flight_detail";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

                    if ($row["flight_detail_id"] != $detail_id) {

            ?>

            <option> <?php echo $row["flight_detail_id"] ?> </option>

            <?php

                    }
                }
            }

            ?>

        </select><br>

        <label for="seats"> Available Seat Capasity: </label>
        <input type="text" name="seats" id="seats" class="form-control" value="<?php echo $seat_cap ?>" required><br>

        <label for="depart"> Time of Departure: </label>
        <input type="datetime-local" name="depart" id="depart" class="form-control" value="<?php echo $depart ?>" required><br>

        <label for="arrive"> Time of Arrival: </label>
        <input type="datetime-local" name="arrive" id="arrive" class="form-control" value="<?php echo $arrive ?>" required><br>

        <label for="delay"> Delay Time: </label>
        <input type="time" name="delay" id="delay" class="form-control" value="<?php echo $delay ?>" required><br>

        <input type="submit" name="update" id="update" class="btn btn-success" value="Update"> 
        <a href="create_flight_detail.php" class="btn btn-warning"> Create New Flight Detail </a>
        <a href="view.php" class="btn btn-secondary"> Go Back </a>

    </form>
    
</body>
</html>