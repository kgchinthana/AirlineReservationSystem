<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update.class_price</title>
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

        $class_id = $_GET["id"];

        $sql = "SELECT `add_price_raise` FROM `class_price` WHERE `class_id`='$class_id';";
        $result = $conn->query($sql);

        $row = $result->fetch_assoc();
        $price_raise = $row["add_price_raise"];

    }
    
    if (isset($_POST["update"])) {

        $id = $_POST["id"];
        $raise = $_POST["raise"];

        $sql = "UPDATE `class_price` SET `class_id`='$id', `add_price_raise`='$raise' WHERE `class_id` = '$class_id';";

        

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

        <!-- not allowing to change class_id in update side because it can cause error isn system -->
        <label for="id"> Class ID: </label>
        <input type="text" name="id" id="id" class="form-control" value="<?php echo $class_id; ?>" readonly><br>

        <label for="model"> Additional Price Raise : &nbsp; </label><br>
        <input type="text" name="raise" id="raise" class="form-control"  value="<?php echo $price_raise; ?>" required>

        <input type="submit" name="update" id="update" class="btn btn-success" value="Update"> 
        <a href="view.php" class="btn btn-secondary"> Go Back </a>

    </form>
    
</body>
</html>