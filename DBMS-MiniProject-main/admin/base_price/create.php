<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add.plane_base_price</title>
    <link rel="stylesheet" href="../../styles/normal.css">
    <link rel="stylesheet" href="../../styles/styles.css">
    <link rel="stylesheet" href="../../styles/virgin.css">
</head>
<body class="container" style="margin: 10rem auto 10rem auto;">

<div class="h2 text-center">Virgin Airlines</div><br><br>
    <center><h2 style="font-weight: 800;"> Create New Record </h2></center><br><br>

    <?php
    
    include "../../genaral/config.php";

    // read already added base_prices for price-added function use
    $sql = "SELECT `flight_detail_id` FROM `plane_base_price`;";
    $result_price_added = $conn->query($sql);

    if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {

        $detail_id = $_POST["detail_id"];
        $base_price = $_POST["base_price"];

        $sql = "INSERT INTO `plane_base_price` (`flight_detail_id`, `base_price`) VALUES ('$detail_id', '$base_price');";

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

        <label for="detail_id"> Flight Detail ID : &nbsp; </label><br>
        <select name="detail_id" id="detail_id" class="form-control" required>

            <?php

            $sql = "SELECT flight_detail_id FROM flight_detail";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

                    // check whether base price is already added
                    if (!price_added($row, $result_price_added)) {

            ?>

            <option> <?php echo $row["flight_detail_id"] ?> </option>

            <?php

                    }
                }
            }

            ?>

        </select><br><br>

        <label for="base_price"> Base Price: </label>
        <input type="text" name="base_price" id="base_price" class="form-control" required><br>

        <input type="submit" name="submit" id="submit" class="btn btn-success" value="Create"> 
        <a href="view.php" class="btn btn-secondary"> Go Back </a>

    </form>

    <?php
    
    // check whether price for selected flight is already added
    // if added user can use update function to change price value
    // user cannot add new record with same value
    // actually this prevents making duplicate primary keys which raise an exception-
    // -which is also already handled
    function price_added($row, $result) {

        $arr = array();
        while ($ref_row = $result->fetch_assoc()) {
            array_push($arr, $ref_row["flight_detail_id"]);
        }

        return in_array($row["flight_detail_id"], $arr);

    }
    
    ?>
    
</body>
</html>