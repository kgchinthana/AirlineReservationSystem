<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view.seat</title>
    <link rel="stylesheet" href="../../styles/normal.css">
    <link rel="stylesheet" href="../../styles/styles.css">
    <link rel="stylesheet" href="../../styles/virgin.css">
</head>
<body class="container" style="margin: 10rem auto 10rem auto;">

<div class="h2 text-center">Virgin Airlines</div><br><br>
    <center><h2 style="font-weight: 800;"> Seat Table </h2></center><br><br>

    <?php

    include "../../genaral/config.php";

    $sql = "SELECT * FROM seat;";

    $result = $conn->query($sql);

    ?>

    <table class="table">

        <thead>
            <th> Seat No </th>
            <th> Plane ID </th>
            <th> Class ID </th>
            <th> Update or Delete </th>
        </thead>

        <tbody>

                
            <?php
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            
            ?>

            <tr>

                <td> <?php echo $row["seat_no"]; ?> </td>
                <td> <?php echo $row["plane_id"]; ?> </td>
                <td> <?php echo $row["class_id"] ?> </td>

                <td>
                    <a href="update.php?no=<?php echo $row["seat_no"]; ?>" class="btn btn-primary"> Update </a>
                    <a href="delete.php?no=<?php echo $row["seat_no"]; ?>" class="btn btn-danger"> Delete </a>
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