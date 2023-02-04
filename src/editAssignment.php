<?php
session_start();
    include("functions.php");
    connectToDb($conn);

    $id = "";
    $goals = "";
    $location = "";
    $required_files = "";
    $date = "";

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        if (!isset($_GET["id"])){
            header("Location: assignment.php");
            exit;
        }
    
        $id = $_GET["id"];

        $sql = "SELECT * FROM assingments WHERE id=$id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if(!$row){
            header("Location: index.php");
            exit;
        }

        $goals = $row['goals'];
        $location = $row['location'];
        $required_files = $row['required_files'];
        $date = $row['date'];

    }
    else {
            $id = $_POST["id"];
            $goals = $_POST["goals"];
            $location = $_POST["location"];
            $required_files = $_POST["required_files"];#
            $date = $_POST["date"];

            do{
                if(empty($id) || empty($goals) || empty($location) || empty($required_files) || empty($date)){
                    $errorMessage = "All fields are required";
                    break;
                }
    
                $sql = "UPDATE documents 
                SET goals ='$goals', location ='$location', required_files ='$required_files', date = '$date'
                WHERE id='$id' ";
    
                $result = $conn->query($sql);
    
                if ($result) {
                    echo "record edited successfully";
                    header("Location: assignments.php");
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

                <label for="goals"> <?php echo "Goals"?> </label>
                <textarea id="goals" name="goals"> <?php echo $goals?> </textarea> <br><br>

                <label for="location"> <?php echo "File Name"?> </label>
                <textarea id="location" name="location"> <?php echo $location ?> </textarea> <br><br>

                <label for="required_files"> <?php echo "Απαιτούμενα αρχεία"?> </label>
                <textarea id="required_files" name="required_files"> <?php echo $required_files ?> </textarea> <br><br>

                <label for="date"> <?php echo "Ημερομηνία Παράδοσης"?> </label>
                <textarea id="date" name="date"> <?php echo $date ?> </textarea> <br><br>

                <input style="font-size:20px;" type="submit" value="Ενημέρωση" name="submitButton"> <br> <br>
            </form>
        </div>

    </body>

</html>