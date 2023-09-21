<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update.flight_detail</title>
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

        $sql = "SELECT * FROM `flight_detail` WHERE `flight_detail_id`='$id';";
        $result = $conn->query($sql);

        $row = $result->fetch_assoc();
        $plane = $row["plane_id"];
        $origin = $row["origin_id"];
        $dest = $row["dest_id"];
        $dist = $row["distance"];

    }
    
    if (isset($_POST["update"])) {

        $detail_id = $_POST["id"];
        $plane_id = $_POST["plane"];
        $origin_id = $_POST["origin"];
        $dest_id = $_POST["dest"];
        $distance = $_POST["dist"];

        $sql = "UPDATE `flight_detail` SET `flight_detail_id`='$detail_id', `plane_id`='$plane_id', `origin_id`='$origin_id', `dest_id`='$dest_id', `distance`='$distance' WHERE `flight_detail_id` = '$id';";

        

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

        <label for="id"> Flight Detail ID: </label>
        <input type="text" name="id" id="id" class="form-control" value="<?php echo $id ?>" required><br>

        <label for="plane"> Plane ID : &nbsp; </label><br>
        <select name="plane" id="plane" class="form-control" value="<?php echo $plane ?>" required>

            <?php

            $sql = "SELECT `plane_id` FROM `aircraft`";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

            ?>

            <option> <?php echo $row["plane_id"] ?> </option>

            <?php

                }
            }

            ?>

        </select><br>

        <label for="origin"> Origin : &nbsp; </label><br>
        <select name="origin" id="origin" class="form-control" value="<?php echo $origin ?>" required>

            <?php

            $sql = "SELECT `airport_code` FROM `airport`";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

            ?>

            <option> <?php echo $row["airport_code"] ?> </option>

            <?php

                }
            }

            ?>

        </select><br>

        <label for="dest"> Destination : &nbsp; </label><br>
        <select name="dest" id="dest" class="form-control" value="<?php echo $dest ?>" required>

            <?php

            $sql = "SELECT `airport_code` FROM `airport`";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

            ?>

            <option> <?php echo $row["airport_code"] ?> </option>

            <?php

                }
            }

            ?>

        </select><br>

        <label for="dist"> Distance: </label>
        <input type="text" name="dist" id="dist" class="form-control" value="<?php echo $dist ?>" required><br><br>

        <input type="submit" name="update" id="update" class="btn btn-success" value="Update"> 
        <a href="view.php" class="btn btn-secondary"> Go Back </a>

    </form>
    
</body>
</html>