<?php
session_start();
    include("functions.php");
    $errorMessage = "";

     if (isset($_POST['submitButton']) &&
        $_SERVER['REQUEST_METHOD'] == "POST"
        ) { //check if form was submitted
            $date = $_POST["date"];
            $subject = $_POST["subject"];
            $message = $_POST["message"];

            connectToDb($conn);

            do {
                if (empty($date) || empty($subject) || empty($message) || 
                stringIsNullOrWhitespace($date) || 
                stringIsNullOrWhitespace($subject) || 
                stringIsNullOrWhitespace($message) || 
                !validateDate($date) ) {
                    $errorMessage = "All fields are required or date wrong format";
                    break;
                }

                $sql = "INSERT INTO announcements (date, subject, message)
                    VALUES ('$date', '$subject', '$message')";

                if ($conn->query($sql)) {
                    echo "New record created successfully";
                    header("Location: announcements.php");
                    die;
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }while(true);
            $conn->close();
        }
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./style/style.css?v=<?php echo time(); ?>" />
        <title>Add Announcement</title>
    </head>

    <body>
        <div class="form">
            <form  action="" method="post">
                <input type="hidden" name="id" value="<?php echo $id?>">

                <label for="date">Ημερομηνία</label>
                <textarea id="date" name="date" placeholder="yyyy-mm-dd"></textarea> <br><br>

                <label for="subject">Θέμα</label>
                <textarea id="subject" name="subject"></textarea> <br><br>

                <label for="message">Μήνυμα</label>
                <textarea id="message" name="message"></textarea> <br><br>

                <input style="font-size:20px;" type="submit" value="Προσθήκη" name="submitButton">

                <input style="font-size:20px;" type="button" onclick="window.location.href='./announcements.php'" value="Πίσω"> <br><br>
                
                <font class="center"><?php echo $errorMessage ?></font>
            </form>
        </div>
    </body>
</html>