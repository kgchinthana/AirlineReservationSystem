<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Query Tester</title>
    <link rel="stylesheet" href="../styles/normal.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/virgin.css">
</head>


<body class="container" style="margin: 10rem auto 10rem auto;">

<div class="h2 text-center">Virgin Airlines</div><br><br>
    <center><h2 style="font-weight: 800;"> Query Tester</h2></center><br><br>
    <h5 style="font-weight: 800;"> You can use only viewing queries! (SELECT, SHOW, DESCRIBE)</h5>

        <?php $json_result = ""; ?>

        <form action="" method="POST">

        <label for="query"> Query : </label>
        <input type="text" name="query" id="query" class="form-control"><br>

        <input type="submit" value="Run" name="submit" id="submit" class="btn btn-primary">
        <a href="index.html" class="btn btn-secondary"> GO back </a> <br><br><br>

        </form>
    
        <label> Result : </label>
        <div class="card" style="padding: 1.2rem;">

            <?php
            
            include "../genaral/config.php";

            // source ; geeksforgeeks.com
            function startsWith ($string, $startString) {
                $len = strlen($startString);
                return (substr($string, 0, $len) === $startString);
            }

            if (isset($_POST["submit"])) {
                
                $sql = $_POST["query"];

                if (isPermitted($sql)) {

                    try {
                        
                        $result = $conn->query($sql);
                        $arr = array();

                        while ($row = $result->fetch_assoc()) {
                            $arr[] = $row;
                        }

                        echo  "<pre>" . json_encode($arr, JSON_PRETTY_PRINT) . "</pre>";

                    }
                    catch (Exception $ex) {
                        echo "<script type='text/javascript'>alert('error occured!');</script>";
                    }

                }

                else {
                    echo "Permission Denied!";
                }

            }
            
            ?>

        </div>

        <?php
        
        function isPermitted($query) {

            return startsWith($query, "SELECT") || startsWith($query, "select") || startsWith($query, "DESCRIBE") || startsWith($query, "describe") || startsWith($query, "SHOW") || startsWith($query, "show");

        }
        
        ?>

</body>
</html>