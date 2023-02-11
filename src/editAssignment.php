<?php
session_start();
    include("functions.php");
    connectToDb($conn);

    $id = "";
    $goals = "";
    $location = "";
    $required_files = "";
    $date = "";
    $errorMessage = "";

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        if (!isset($_GET["id"])){
            header("Location: assignment.php");
            exit;
        }
    
        $id = $_GET["id"];

        $sql = "SELECT * FROM assignments WHERE id=$id";
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
            $required_files = $_POST["required_files"];#
            $date = $_POST["date"];
            $location = uploadFile("assignmentToUpload");

            do{
                if(empty($goals) || empty($location) || empty($required_files) || empty($date) || 
                    stringIsNullOrWhitespace($goals) || 
                    stringIsNullOrWhitespace($location) ||
                    stringIsNullOrWhitespace($required_files) ||
                    stringIsNullOrWhitespace($date))
                    {
                        $errorMessage = "All fields are required or wrong date format";
                        break;
                    }
    
                $sql = "UPDATE assignments 
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
            
        }
        $conn->close();
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../style/style.css?v=<?php echo time(); ?>" />
        <title>Edit Assignment</title>
    </head>

    <body>
        <div class="form">
            <form  action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id;?>">

                <label for="goals"> <?php echo "Στόχοι"?> </label>
                <textarea id="goals" name="goals"><?php echo $goals?></textarea> <br><br>

                <label for="required_files"> <?php echo "Απαιτούμενα αρχεία"?> </label>
                <textarea id="required_files" name="required_files"><?php echo $required_files ?></textarea><br><br>

                <label for="date"> <?php echo "Ημερομηνία Παράδοσης"?> </label>
                <textarea id="date" name="date"><?php echo $date ?></textarea><br><br>

                <font style="font-size:larger">Εκφώνηση</font>
                <input style="font-size:20px;" type="file" name="assignmentToUpload" id="fileToUpload"><br><br>

                <input style="font-size:20px;" type="submit" value="Ενημέρωση" name="submitButton">
                <input style="font-size:20px;" type="button" onclick="window.location.href='./assignments.php'" value="Πίσω"> <br> <br>

                <font class="center"><?php echo $errorMessage ?></font>
            </form>
        </div>

    </body>

</html>