<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view.user</title>
    <link rel="stylesheet" href="../../styles/normal.css">
    <link rel="stylesheet" href="../../styles/styles.css">
    <link rel="stylesheet" href="../../styles/virgin.css">
</head>
<body class="container" style="margin: 10rem auto 10rem auto;">

<div class="h2 text-center">Virgin Airlines</div><br><br>
    <center><h2 style="font-weight: 800;"> User Table </h2></center><br><br>

    <?php

    include "../../genaral/config.php";

    $sql = "SELECT * FROM user;";

    $result = $conn->query($sql);

    ?>

    <table class="table">

        <thead>
            <th> User ID </th>
            <th> First Name </th>
            <th> Last Name </th>
            <th> User Type </th>
            <th> Date of Birth </th>
            <th> Address Line 1 </th>
            <th> Address Line 2 </th>
            <th> Address Line 3 </th>
            <th> Telephone Number 1 </th>
            <th> Telephone Number 2 </th>
            <th> Delete </th>
        </thead>

        <tbody>

                
            <?php
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            
            ?>

            <tr>

                <td> <?php echo $row["user_id"]; ?> </td>
                <td> <?php echo $row["first_name"]; ?> </td>
                <td> <?php echo $row["last_name"]; ?> </td>
                <td> <?php echo $row["user_type"]; ?> </td>
                <td> <?php echo $row["date_of_birth"]; ?> </td>
                <td> <?php echo $row["address_line_1"]; ?> </td>
                <td> <?php echo $row["address_line_2"]; ?> </td>
                <td> <?php echo $row["address_line_3"]; ?> </td>
                <td> <?php echo $row["telephone_number"]; ?> </td>
                <td> <?php echo $row["additional_telephone_number"]; ?> </td>
                <td>
                    <a href="delete.php?id=<?php echo $row["user_id"]; ?>" class="btn btn-danger"> Delete </a>
                </td>
            
            </tr>

            <?php
            
                }
            }

            ?>


        </tbody>

    </table>

    <a href="../index.html" class="btn btn-secondary">Go Back</a>
    
</body>
</html>