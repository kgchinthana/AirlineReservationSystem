<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view.flight</title>
    <link rel="stylesheet" href="../../styles/normal.css">
    <link rel="stylesheet" href="../../styles/styles.css">
    <link rel="stylesheet" href="../../styles/virgin.css">
</head>
<body class="container" style="margin: 10rem auto auto auto;">

<div class="h2 text-center">Virgin Airlines</div><br><br>
    <center><h2 style="font-weight: 800;"> Upcoming Flights </h2></center><br><br>

    <?php

    include "../../genaral/config.php";

    if (isset($_GET["id"])) {
        $user_id = $_GET["id"];
    }

    $today = date("Y-m-d H:i:s");

    $sql = "SELECT * FROM `sheduled_flight` WHERE `time_of_departure` > '$today' ORDER BY `time_of_departure`;";

    $result = $conn->query($sql);

    ?>

    <table class="table">

        <thead>
            <th> Flight ID </th>
            <th> Available Seat Capasity </th>
            <th> Time of Departure </th>
            <th> Time of Arrival </th>
            <th> Delay Time (If Any) </th>
            <th> Plane ID </th>
            <th> Origin </th>
            <th> Destination</th>
            <th> Distance </th>
        </thead>

        <tbody>

                
            <?php
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            
            ?>

            <tr>

                <td> <?php echo $row["flight_id"]; ?> </td>
                <td> <?php echo $row["available_seat_cap"]; ?> </td>
                <td> <?php echo $row["time_of_departure"]; ?> </td>
                <td> <?php echo $row["time_of_arrival"]; ?> </td>
                <td> <?php echo $row["delay_time"]; ?> </td>
                <td> <?php echo $row["plane_id"]; ?> </td>
                <td> <?php echo $row["origin_id"]; ?> </td>
                <td> <?php echo $row["dest_id"]; ?> </td>
                <td> <?php echo $row["distance"]; ?> </td>

            </tr>

            <?php
            
                }
            }

            ?>

        </tbody>

    </table>

    <a href="../index.html" class="btn btn-secondary"> Go Back </a>

</body>
</html>