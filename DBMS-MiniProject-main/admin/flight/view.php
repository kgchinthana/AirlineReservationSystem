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
<body class="container" style="margin: 10rem auto 10rem auto;">

<div class="h2 text-center">Virgin Airlines</div><br><br>
    <center><h2 style="font-weight: 800;"> Flight Table </h2></center><br><br>

    <?php

    include "../../genaral/config.php";

    $sql = "SELECT * FROM flight;";

    $result = $conn->query($sql);

    ?>

    <table class="table">

        <thead>
            <th> Flight ID </th>
            <th> Flight Detail ID </th>
            <th> Available Seat Capasity </th>
            <th> Time of Departure </th>
            <th> Time of Arrival </th>
            <th> Delay Time (If Any) </th>
            <th> Update or Delete </th>
        </thead>

        <tbody>

                
            <?php
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            
            ?>

            <tr>

                <td> <?php echo $row["flight_id"]; ?> </td>
                <td> <?php echo $row["flight_detail_id"]; ?> </td>
                <td> <?php echo $row["available_seat_cap"]; ?> </td>
                <td> <?php echo $row["time_of_departure"]; ?> </td>
                <td> <?php echo $row["time_of_arrival"]; ?> </td>
                <td> <?php echo $row["delay_time"]; ?> </td>
                <td>
                    <a href="update.php?id=<?php echo $row["flight_id"]; ?>" class="btn btn-primary"> Update </a>
                    <a href="delete.php?id=<?php echo $row["flight_id"]; ?>" class="btn btn-danger"> Delete </a>
                </td>
            
            </tr>

            <?php
            
                }
            }

            ?>

        </tbody>

    </table>

    <a href="create.php" class="btn btn-primary"> Create Record </a>
    <a href="../index.html" class="btn btn-secondary">Go Back</a>
    
</body>
</html>