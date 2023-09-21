<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add.aircraft_model</title>
    <link rel="stylesheet" href="../../styles/normal.css">
    <link rel="stylesheet" href="../../styles/styles.css">
    <link rel="stylesheet" href="../../styles/virgin.css">
</head>
<body class="container" style="margin: 10rem auto 10rem auto;">

<div class="h2 text-center">Virgin Airlines</div><br><br>
    <center><h2 style="font-weight: 800;"> Create New Record </h2></center><br><br>

    <?php
    
    include "../../genaral/config.php";


    if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {

        $model = $_POST["model"];
        $seat_cap = $_POST["seat_cap"];

        $sql = "INSERT INTO `aircraft_model` (`model`, `seat_cap`) VALUES ('$model', '$seat_cap');";

        

        try {
            $result = $conn->query($sql);
            echo "<script type='text/javascript'>alert('added successfully!');</script>";
        }
        catch (Exception $ex) {
            echo "<script type='text/javascript'>alert('error occured!');</script>";
        }

    }

    ?>

    <form action="" method="POST">

        <label for="model"> Plane Model: </label>
        <input type="text" name="model" id="model" class="form-control" required><br>

        <label for="seat_cap"> Seat Capasity : </label><br>
        <input type="text" name="seat_cap" id="seat_cap" class="form-control" required><br><br>

        <input type="submit" name="submit" id="submit" class="btn btn-success" value="Create"> 
        <a href="view.php" class="btn btn-secondary"> Go Back </a>

    </form>
    
</body>
</html>