<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Class</title>
    <link rel="stylesheet" href="../../styles/normal.css">
    <link rel="stylesheet" href="../../styles/styles.css">
    <link rel="stylesheet" href="../../styles/virgin.css">
</head>
<body class="container" style="margin: 10rem auto 10rem auto;">

<div class="h2 text-center">Virgin Airlines</div><br><br>
    <center><h2 style="font-weight: 800;"> Select Class </h2></center><br><br>

    <?php
    
    include "../../genaral/config.php";

    if (isset($_GET["id"])) {
        $flight_id = $_GET["id"];
        session_start();
        $_SESSION["flight_id"] = $flight_id;
    }
    
    ?>

    <form action="book.php" method="GET">

        <input type="text" value="<?php echo $user_id; ?>" name="id" id="id" hidden>
        <input type="text" name="flight" id="flight" value="<?php echo $flight_id ?>" hidden>

        <label for="class"> Select Class :  </label>
        <select name="class" id="class" class="form-control">

            <?php
            
            $sql = "SELECT * FROM `class_price`";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
            
            ?>

            <option value="<?php echo $row["class_id"] ?>"> <?php echo $row["class_id"] . " - Additional Fee : " . $row["add_price_raise"] . "% of base price "; ?> </option>

            <?php
            
                }
            }
            
            ?>

        </select><br>

        <input type="submit" name="next" id="next" value="Next" class="btn btn-primary">
        <a href="view_flight.php" class="btn btn-secondary"> Go back </a>

    </form>
    
</body>
</html>