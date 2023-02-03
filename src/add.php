<?php
session_start();
    include("functions.php");
    
    $table = $_SESSION['table'];
    $first_column = $_SESSION['first'];
    $second_column = $_SESSION['second'];
    $third_column = $_SESSION['third'];

     if (
        isset($_POST['submitButton']) &&
        $_SERVER['REQUEST_METHOD'] == "POST"
        ) { //check if form was submitted
            $first = $_POST["first"];
            $second = $_POST["second"];
            $third = $_POST["third"];

            connectToDb($conn);

            $sql = "INSERT INTO $table ($first_column, $second_column, $third_column)
            VALUES ('$first', '$second', '$third')";

            if ($conn->query($sql)) {
                echo "New record created successfully";

                header("Location: $table.php");
                die;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./style.css?v=<?php echo time(); ?>" />
        <title>Add <?php echo $table ?> </title>
    </head>

    <body>
        <div class="form">
            <form  action="" method="post">
                <input type="hidden" name="id" value="<?php echo $id;?>">

                <label for="first"> <?php echo $first_column?> </label>
                <textarea id="first" name="first"></textarea> <br><br>

                <label for="second"> <?php echo $second_column?> </label>
                <textarea id="second" name="second"></textarea> <br><br>

                <label for="third"> <?php echo $third_column?> </label>
                <textarea id="third" name="third"></textarea> <br><br>

                <input style="font-size:20px;" type="submit" value="Προσθήκη" name="submitButton"> <br> <br>
            </form>


    </body>



</html>