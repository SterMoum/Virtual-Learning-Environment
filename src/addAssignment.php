<?php
session_start();
    include("functions.php");
    $errorMessage = "";
     if (isset($_POST['submitButton']) &&
        $_SERVER['REQUEST_METHOD'] == "POST"
        ) { //check if form was submitted
            $id = $_SESSION['id'];
            $goals = $_POST["goals"];
            $required_files = $_POST["required_files"];
            $date = $_POST["date"];
            $location = uploadFile("assignmentToUpload");

            connectToDb($conn);

            do {
                if (empty($goals) || empty($location) || empty($required_files) || empty($date) ||
                    stringIsNullOrWhitespace($goals) || 
                    stringIsNullOrWhitespace($required_files) || 
                    stringIsNullOrWhitespace($date) ||
                    !validateDate($date)) {
                        $errorMessage = "All fields are required or wrong date format";
                        break;
                    }
                //insert to assignments
                $sql1 = "INSERT INTO assignments (goals, location, required_files,date)
                        VALUES ('$goals', '$location', '$required_files', '$date')";

                //insert to announcements
                $current_date = date("Y-m-d");
                $subject = "Υποβλήθηκε η εργασία $id";
                $message = "Η ημερομηνία παράδοσης της εργασίας είναι $date";
                $sql2 = "INSERT INTO announcements (date,subject,message)
                        VALUES('$current_date', '$subject', '$message')";

                if ($conn->query($sql1) && $conn->query($sql2)) {
                    echo "New records created successfully";

                    header("Location: assignments.php");
                    die;
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }while (true);
            $conn->close();
        }
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../style/style.css?v=<?php echo time(); ?>" />
        <title>Add Assignment</title>
    </head>

    <body>
        <div class="form">
            <form  action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id;?>">

                <label for="goals">Στόχοι</label>
                <textarea id="goals" name="goals"></textarea> <br><br>

                <label for="required_files">Παραδοτέα</label>
                <textarea id="required_files" name="required_files"></textarea> <br><br>

                <label for="date">Ημερομηνία Παράδοσης</label>
                <textarea id="date" name="date" placeholder="yyyy-mm-dd"></textarea> <br><br>

                <font style="font-size:larger">Εκφώνηση:</font>
                <input style="font-size:20px;" type="file" name="assignmentToUpload" id="fileToUpload"> <br><br>

                <input style="font-size:20px;" type="submit" value="Προσθήκη" name="submitButton">
                <input style="font-size:20px;" type="button" onclick="window.location.href='./assignments.php'" value="Πίσω"> <br>
    
                <font class="center"><?php echo $errorMessage ?></font>
            </form>
        </div>



    </body>



</html>