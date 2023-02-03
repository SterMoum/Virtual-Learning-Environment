<?php
session_start();
    include("functions.php");
    connectToDb($conn);

    $id = "";
    $first = "";
    $second = "";
    $third = "";
    $fourth = "";

    $table = $_SESSION['table'];
    $first_column = $_SESSION['first'];
    $second_column = $_SESSION['second'];
    $third_column = $_SESSION['third'];
    
    if (isset($_SESSION['fourth'])){
        $fourth_column = $_SESSION['fourth'];
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        if (!isset($_GET["id"])){
            header("Location: $table.php");
            exit;
        }
    
        $id = $_GET["id"];

        $sql = "SELECT * FROM $table WHERE id=$id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if(!$row){
            header("Location: index.php");
            exit;
        }

        $first = $row[$first_column];
        $second = $row[$second_column];
        $third = $row[$third_column];

    }
    else {
            $id = $_POST["id"];
            $first = $_POST["first"];
            $second = $_POST["second"];
            $third = $_POST["third"];

            do{
                if(empty($id) || empty($first) || empty($second) || empty($third)){
                    $errorMessage = "All fields are required";
                    break;
                }
    
                $sql = "UPDATE $table 
                SET $first_column ='$first', $second_column ='$second', $third_column ='$third'
                WHERE id='$id' ";
    
                $result = $conn->query($sql);
    
                if ($result) {
                    echo "record edited successfully";
                    header("Location: $table.php");
                    die;
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    break;
                }
    
            }while(true);
            $conn->close();
        }
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./style.css?v=<?php echo time(); ?>" />
        <title>Login</title>
    </head>

    <body>
        <div class="form">
            <form  action="" method="post">
                <input type="hidden" name="id" value="<?php echo $id;?>">

                <label for="first"> <?php echo $first_column?> </label>
                <textarea id="first" name="first"> <?php echo $first?> </textarea> <br><br>

                <label for="second"> <?php echo $second_column?> </label>
                <textarea id="second" name="second"> <?php echo $second ?> </textarea> <br><br>

                <label for="third"> <?php echo $third_column?> </label>
                <textarea id="third" name="third"> <?php echo $third ?> </textarea> <br><br>

                <input style="font-size:20px;" type="submit" value="Ενημέρωση" name="submitButton"> <br> <br>
            </form>
        </div>



    </body>



</html>