<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sign Up </title>
    <style> .err { color: #FF0000; font-size: 0.8rem;} </style>
    <link rel="stylesheet" href="../styles/normal.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/virgin.css">
</head>
<body class="container" style="margin: 10rem auto 10rem auto;">

    <div class="h2 text-center">Virgin Airlines</div><br><br>
    <center><h2 style="font-weight: 800;"> Register Here </h2></center><br><br>

    <?php

        include "config.php";

        
        if (isset($_POST["submit"])) {

            $fname_err = $lname_err = $passwd_err = "";
            $dob_err = $tele_err = $tele2_err = "";
            $add1_err = $add2_err = $add3_err = "";

            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $passwd1 = $_POST["passwd1"];
            $passwd2 = $_POST["passwd2"];
            $dob = $_POST["dob"];
            $add1 = $_POST["add1"];
            $add2 = $_POST["add2"];
            $add3 = $_POST["add3"];
            $tele = $_POST["tele"];
            $tele2 = $_POST["tele2"];

            $error_in_form = false;

            // first name error check
            if (preg_match("/^[a-zA-Z-']$/", $fname)) {
                $fname_err = "a name can only contain letters and spaces!";
                $error_in_form = true; 
            }

            // last name validation
            if (preg_match("/^[a-zA-Z-']$/", $lname)) {
                $lname_err = "a name can only contain letters and spaces!";
                $error_in_form = true; 
            }

            // passwd confirmation check
            if ($passwd1 != $passwd2) {
                $passwd_err = "passwords do not match!";
                $error_in_form = true; 
            }
            // passwrd legth check
            elseif (strlen($passwd1) < 8) {
                $passwd_err = "password is too short!";
                $error_in_form = true; 
            }
            elseif (strlen($passwd1) > 20) {
                $passwd_err = "password is too long!";
                $error_in_form = true; 
            }

            // address err check
            if (strlen($add1) > 100) {
                $add1_err = "address line is too long";
                $error_in_form = true; 
            }
            if (strlen($add2) > 100) {
                $add2_err = "address line is too long";
                $error_in_form = true; 
            }
            if (strlen($add3) > 100) {
                $add3_err = "address line is too long";
                $error_in_form = true; 
            }

            // telephone number validation
            if (preg_match("/^+[0-9-']$/", $tele)) {
                $tele_err = "a telephone number can only contain numbers and +";
                $error_in_form = true; 
            }
            if (preg_match("/^+[0-9-']$/", $tele2)) {
                $tele2_err = "a telephone number can only contain numbers and +";
                $error_in_form = true; 
            }

            // if there is no errors,
            // add user as normal user
            if (!$error_in_form) {

                $user_id = create_id($conn);
                $user_type = "Normal";
                
                if (isset($_POST["add3"]) && isset($_POST["tele2"])) {
                    $sql = "INSERT INTO `user` (`user_id`, `password`, `first_name`, `last_name`, `user_type`, `date_of_birth`, `address_line_1`, `address_line_2`, `address_line_3`, `telephone_number`, `additional_telephone_number`) 
                        VALUES ('$user_id', '$passwd1', '$fname', '$lname', '$user_type', '$dob', '$add1', '$add2', '$add3', '$tele', '$tele2');";
                }
                elseif (!isset($_POST["add3"])) {
                    $sql = "INSERT INTO `user` (`user_id`, `password`, `first_name`, `last_name`, `user_type`, `date_of_birth`, `address_line_1`, `address_line_2`, `telephone_number`, `additional_telephone_number`) 
                        VALUES ('$user_id', '$passwd1', '$fname', '$lname', '$user_type', '$dob', '$add1', '$add2', '$tele', '$tele2');";
                }
                elseif(!isset($_POST["tele2"])) {
                    $sql = "INSERT INTO `user` (`user_id`, `password`, `first_name`, `last_name`, `user_type`, `date_of_birth`, `address_line_1`, `address_line_2`, `address_line_3`, `telephone_number`) 
                        VALUES ('$user_id', '$passwd1', '$fname', '$lname', '$user_type', '$dob', '$add1', '$add2', '$add3', '$tele');";
                }
                else {
                    $sql = "INSERT INTO `user` (`user_id`, `password`, `first_name`, `last_name`, `user_type`, `date_of_birth`, `address_line_1`, `address_line_2`, `telephone_number`) 
                        VALUES ('$user_id', '$passwd1', '$fname', '$lname', '$user_type', '$dob', '$add1', '$add2', '$tele');";
                }
                
                
                try {
                    $conn->query($sql);
                    //echo "<script type='text/javascript'>alert('Please Sign in to your created account');</script>";
                    header("Location:../index.html");
                    
                }
                catch (Exception $ex) {
                    echo "<script type='text/javascript'>alert('error occured!');</script>";
                }

            }

        }
        
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">

        <label for="fname"> First Name : </label>
        <input type="text" class="form-control" name="fname" id="fname" required>
        <p class="err" > <?php echo $fname_err ?> </p>

        <label for="lname"> Last Name : </label>
        <input type="text" class="form-control" name="lname" id="lname" required>
        <p class="err" > <?php echo $lname_err ?> </p>

        <label for="passwd1"> Password : </label>
        <input type="password" class="form-control" name="passwd1" id="passwd1" required>
        <p class="err" > <?php echo $passwd_err ?> </p>

        <label for="passwd2"> Confirm Password : </label>
        <input type="password" class="form-control" name="passwd2" id="passwd2" required>
        <p class="err" > <?php echo $passwd_err ?> </p>

        <label for="dob"> Date of Birth : </label>
        <input type="date" class="form-control" name="dob" id="dob" required>
        <p class="err" > <?php echo $dob_err ?> </p>

        <label for="add1"> Address Line 1 : </label>
        <input type="text" class="form-control" name="add1" id="add1" required>
        <p class="err" > <?php echo $add1_err ?> </p>

        <label for="add2"> Address Line 2 : </label>
        <input type="text" class="form-control" name="add2" id="add2" required>
        <p class="err" > <?php echo $add2_err ?> </p>

        <label for="add3"> Address Line 3 : </label>
        <input type="text" class="form-control" name="add3" id="add3">
        <p class="err" > <?php echo $add3_err ?> </p>

        <label for="tele"> Telephone Number : </label>
        <input type="text" class="form-control" name="tele" id="tele" required>
        <p class="err" > <?php echo $tele_err ?> </p>

        <label for="tele2"> Additional Telephone Number : </label>
        <input type="text" class="form-control" name="tele2" id="tele2">
        <p class="err" > <?php echo $tele_err ?> </p><br>

        <input type="submit" name="submit" id="submit" value="Register" class="btn btn-primary">
        <a href="../index.html" class="btn btn-secondary"> Go Back </a>

    </form>

    <?php
    
    function create_id($conn) {

        $sql = "SELECT `user_id` FROM `user`;";

        $result = $conn->query($sql);
        
        $arr = array();
        while ($row = $result->fetch_assoc()) {
            array_push($arr, $row["user_id"]);
        }

        do {
            $id = rand(10000, 99999);
        } while (in_array($id, $arr));

        return $id;

    }
    
    ?>
    
</body>
</html>