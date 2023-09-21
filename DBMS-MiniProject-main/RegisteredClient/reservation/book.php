<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
    <link rel="stylesheet" href="../../styles/normal.css">
    <link rel="stylesheet" href="../../styles/styles.css">
    <link rel="stylesheet" href="../../styles/virgin.css">
</head>
<body class="container" style="margin: 10rem auto auto auto;">

<div class="h2 text-center">Virgin Airlines</div><br><br>
    <center><h2 style="font-weight: 800;"> Confirm Reservation </h2></center><br><br>
    
    <?php

    include "../../genaral/config.php";
    
    if (isset($_GET["class"])) {
        session_start();
        $user_id = $_SESSION["user_id"];
        $flight_id = $_SESSION["flight_id"];
        $class_id = $_GET["class"];
    }

    // price calculation
    // get base price
    $sql = "SELECT `base_price` FROM `plane_base_price` WHERE `flight_detail_id` IN (SELECT `flight_detail_id` FROM `flight` WHERE `flight_id`='$flight_id');";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $base_price = (double)$row['base_price'];
    // price raise for class selected
    $sql = "SELECT `add_price_raise` FROM `class_price` WHERE `class_id` ='$class_id';";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $price_raise = (double)$row['add_price_raise'];
    // discount for user type
    $sql = "SELECT `discount` FROM `user_type` WHERE `user_type` IN (SELECT `user_type` FROM `user` WHERE `user_id`='$user_id');";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $discount = 1 - (double)$row['discount'];

    $price = ($base_price * ($price_raise / 100)) * $discount;

    ?>

    <h5 style="font-weight: 800;"> <?php echo "Your Price is : " . $price . "$" ?> </h5><br>

    <form action="" method="POST">

        <label for="seat"> Select Seat : </label>
        <select name="seat" id="seat" class="form-control" required>

            <?php
            
            $sql = "SELECT `seat_no` FROM `seat` WHERE `class_id`='$class_id' AND `plane_id` IN (SELECT `plane_id` FROM `flight_detail` WHERE `flight_detail_id` IN (SELECT `flight_detail_id` FROM `flight` WHERE `flight_id`='$flight_id')) AND `seat_no` NOT IN (SELECT `seat_no` FROM `reservation` WHERE `flight_id`=$flight_id);";
            $result = $conn->query($sql);

            $haveSeats = true;
            
            if ($result->num_rows <= 0) {

                $haveSeats = false;

            ?>

            <option selected> No Seats Avialble for Selected Class and Flight! </option>

            <?php
                
            }

            else {

                while ($row = $result->fetch_assoc()) {
            
            ?>

            <option> <?php echo $row["seat_no"]; ?> </option>

            <?php
            
                }
            }
            
            ?>

        </select><br>

        <?php 

        if ($haveSeats) {

        ?>

        <input type="submit" value="Confirm" class="btn btn-primary" name="submit" id="submit">
        <a href="../index.html" class="btn btn-secondary"> Go Back </a>

        <?php
        
        }
        else {
        
        ?>

        <a href="select_class.php" class="btn btn-primary"> Select Another Class </a>
        <a href="../index.html" class="btn btn-secondary"> Go Back To Main Menu </a>

        <?php
        
        }
        
        ?>


    </form>


    <?php
    
    if (isset($_POST["submit"])) {

        $seat_no = $_POST["seat"];

        $date = date("Y-m-d H:i:s");

        $sql_query = "INSERT INTO `reservation` (`flight_id`, `user_id`, `seat_no`, `price`, `booking_date`) VALUES ('$flight_id', '$user_id', '$seat_no', '$price', '$date');";
        
        try {

            $result_query = $conn->query($sql_query);
            echo "<script type='text/javascript'>alert('added successfully!');</script>";

        }
        catch (Exception $ex) {

            echo "<script type='text/javascript'>alert('error occured');</script>";

        }
 
    }
    
    ?>


</body>
</html>