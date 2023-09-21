<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add.flight</title>
    <link rel="stylesheet" href="../../styles/normal.css">
    <link rel="stylesheet" href="../../styles/styles.css">
    <link rel="stylesheet" href="../../styles/virgin.css">
</head>
<body class="container" style="margin: 10rem auto 10rem auto;">

<div class="h2 text-center">Virgin Airlines</div><br><br>
    <center><h2 style="font-weight: 800;"> Create New Record </h2></center><br><br>

    <?php
    
    include "../../genaral/config.php";

    
    if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
        
        $flight_id = $_POST["id"];
        $detail_id = $_POST["detail_id"];
        $depart = $_POST["depart"];
        $arrive = $_POST["arrive"];
        $delay = $_POST["delay"];
        
        //calculating using database
        $seat_cap = get_available_seats($detail_id, $conn);

        $sql = "INSERT INTO `flight` (`flight_id`, `flight_detail_id`, `available_seat_cap`, `time_of_departure`, `time_of_arrival`, `delay_time`) VALUES ('$flight_id', '$detail_id', '$seat_cap', '$depart', '$arrive', '$delay');";

        try {
            $result = $conn->query($sql);
            echo "<script type='text/javascript'>alert('added successfully!');</script>";
        }
        catch (Exception $ex) {
            echo "<script type='text/javascript'>alert('error occured!');</script>";
        }

    }

    ?>

    <form action="" method="POST">

        <label for="id"> Flight ID: </label>
        <input type="text" name="id" id="id" class="form-control" required><br>

        <label for="detail_id"> Detail ID : &nbsp; </label><br>
        <select name="detail_id" id="detail_id" class="form-control" required>

            <?php

            $sql = "SELECT flight_detail_id FROM flight_detail";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

            ?>

            <option> <?php echo $row["flight_detail_id"] ?> </option>

            <?php

                }
            }

            ?>

        </select><br>

        <label for="depart"> Time of Departure: </label>
        <input type="datetime-local" name="depart" id="depart" class="form-control" required><br>

        <label for="arrive"> Time of Arrival: </label>
        <input type="datetime-local" name="arrive" id="arrive" class="form-control" required><br>

        <label for="delay"> Delay Time: </label>
        <input type="time" name="delay" id="delay" class="form-control" value="00:00:00" required><br>

        <input type="submit" name="submit" id="submit" class="btn btn-success" value="Create"> 
        <a href="create_flight_detail.php" class="btn btn-warning"> Create New Flight Detail </a>
        <a href="view.php" class="btn btn-secondary"> Go Back </a>

    </form>


    <?php
    
    // get max seat cap available using database
    // assuming no reservations when sheduling a flight
    function get_available_seats($flight_detail_id, $conn) {

        $sql = "SELECT `seat_cap` FROM `aircraft_model` NATURAL JOIN `aircraft` NATURAL JOIN `flight_detail` WHERE `flight_detail_id` = '$flight_detail_id';";

        $result =  $conn->query($sql);

        $row = $result->fetch_assoc();

        return $row["seat_cap"];

    }

    ?>
    
</body>
</html>