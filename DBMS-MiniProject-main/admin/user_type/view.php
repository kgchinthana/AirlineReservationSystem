<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view.user_type</title>
    <link rel="stylesheet" href="../../styles/normal.css">
    <link rel="stylesheet" href="../../styles/styles.css">
    <link rel="stylesheet" href="../../styles/virgin.css">
</head>
<body class="container" style="margin: 10rem auto 10rem auto;">

<div class="h2 text-center">Virgin Airlines</div><br><br>
    <center><h2 style="font-weight: 800;"> User Type Table </h2></center><br><br>

    <?php

    include "../../genaral/config.php";

    $sql = "SELECT * FROM user_type;";

    $result = $conn->query($sql);

    ?>

    <table class="table">

        <thead>
            <th> User Type </th>
            <th> Discount </th>
            <th> Update or Delete </th>
        </thead>

        <tbody>

                
            <?php
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            
            ?>

            <tr>

                <td> <?php echo $row["user_type"]; ?> </td>
                <td> <?php echo $row["discount"]; ?> </td>
                <td>
                    <a href="update.php?type=<?php echo $row["user_type"]; ?>" class="btn btn-primary"> Update </a>
                    <a href="delete.php?type=<?php echo $row["user_type"]; ?>" class="btn btn-danger"> Delete </a>
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