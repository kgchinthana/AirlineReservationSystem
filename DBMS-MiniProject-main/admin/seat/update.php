<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update.seat</title>
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
    if (isset($_GET["no"])) {

        $seat_no = $_GET["no"];

        $sql = "SELECT * FROM `seat` WHERE `seat_no`='$seat_no';";
        $result = $conn->query($sql);

        $row = $result->fetch_assoc();
        $plane_id = $row["plane_id"];
        $class_id = $row["class_id"];

    }
    
    if (isset($_POST["update"])) {

        $seat = $_POST["seat"];
        $plane = $_POST["plane"];
        $class = $_POST["class"];

        $sql = "UPDATE `seat` SET `seat_no`='$seat', `plane_id`='$plane', `class_id`='$class' WHERE `seat_no` = '$seat_no';";

        

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

        <label for="plane"> Plane ID : &nbsp; </label><br>
        <select name="plane" id="plane" class="form-control" required>

            <option selected> <?php echo $plane_id ?> </option>

            <?php

            $sql = "SELECT `plane_id` FROM `aircraft`";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

                    if ($row["plain_id"] != $plane_id) {

            ?>

            <option> <?php echo $row["plane_id"] ?> </option>

            <?php

                    }
                }
            }

            ?>

        </select><br>

        <label for="seat"> Seat No : &nbsp; </label><br>
        <input type="text" name="seat" id="seat" class="form-control" value="<?php echo $seat_no ?>" required>

        <label for="class"> Class ID : &nbsp; </label><br>
        <select name="class" id="class" class="form-control" required>

            <option selected> <?php echo $class_id ?> </option>

            <?php

            $sql = "SELECT class_id FROM class_price";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

                    if ($row["class_id"] != $class_id) {

            ?>

            <option> <?php echo $row["class_id"] ?> </option>

            <?php

                    }
                }
            }

            ?>

        </select><br><br>

        <input type="submit" name="update" id="update" class="btn btn-success" value="Update"> 
        <a href="view.php" class="btn btn-secondary"> Go Back </a>

    </form>
    
</body>
</html>