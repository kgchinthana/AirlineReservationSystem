<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add.airport</title>
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

        $code = $_POST["code"];
        $name = $_POST["name"];
        $city = $_POST["city"];
        $state = $_POST["state"];
        $country = $_POST["country"];

        $sql = "INSERT INTO `airport` (`airport_code`, `name`, `city`, `state`, `country`) VALUES ('$code', '$name', '$city', '$state', '$country');";

        

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

        <label for="code"> Airport Code : </label>
        <input type="text" name="code" id="code" class="form-control" required><br>

        <label for="name"> Airport Name : &nbsp; </label><br>
        <input type="text" name="name" id="name" class="form-control" required><br>

        <label for="city"> City : </label><br>
        <input type="text" name="city" id="city" class="form-control" required><br>

        <label for="state"> State : </label><br>
        <input type="text" name="state" id="state" class="form-control"><br>

        <label for="model"> Country : </label><br>
        <input type="text" name="country" id="country" class="form-control" required><br>

        <input type="submit" name="submit" id="submit" class="btn btn-success" value="Create"> 
        <a href="view.php" class="btn btn-secondary"> Go Back </a>

    </form>
    
</body>
</html>