<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view.flight_detail</title>
    <link rel="stylesheet" href="../../styles/normal.css">
    <link rel="stylesheet" href="../../styles/styles.css">
    <link rel="stylesheet" href="../../styles/virgin.css">
</head>
<body class="container" style="margin: 10rem auto 10rem auto;">

<div class="h2 text-center">Virgin Airlines</div><br><br>
    <center><h2 style="font-weight: 800;"> Flight Detail Table </h2></center><br><br>

    <?php

    include "../../genaral/config.php";

    $sql = "SELECT * FROM flight_detail;";

    $result = $conn->query($sql);

    ?>

    <table class="table">

        <thead>
            <th> Flight Detail ID </th>
            <th> Plane ID </th>
            <th> Origin </th>
            <th> Destination </th>
            <th> Distance (km) </th>
            <th> Update or Delete </th>
        </thead>

        <tbody>

                
            <?php
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            
            ?>

            <tr>

                <td> <?php echo $row["flight_detail_id"]; ?> </td>
                <td> <?php echo $row["plane_id"]; ?> </td>
                <td> <?php echo $row["origin_id"]; ?> </td>
                <td> <?php echo $row["dest_id"]; ?> </td>
                <td> <?php echo $row["distance"]; ?> </td>
                <td>
                    <a href="update.php?id=<?php echo $row["flight_detail_id"]; ?>" class="btn btn-primary"> Update </a>
                    <a href="delete.php?id=<?php echo $row["flight_detail_id"]; ?>" class="btn btn-danger"> Delete </a>
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