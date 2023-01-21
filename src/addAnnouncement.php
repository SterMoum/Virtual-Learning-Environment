<?php
session_start();
    include("functions.php");
     if (
        isset($_POST['submitButton']) &&
        $_SERVER['REQUEST_METHOD'] == "POST"
        ) { //check if form was submitted
            $date = $_POST["date"];
            $subject = $_POST["subject"];
            $message = $_POST["message"];

            connectToDb($conn);

            $sql = "INSERT INTO announcements (Date, Subject, Message)
            VALUES ('$date', '$subject', '$message')";

            if ($conn->query($sql)) {
                echo "New record created successfully";

                header("Location: announcement.php");
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
        <title>Login</title>
    </head>

    <body>
        <form  action="" method="post">
            <label for="date">Ημερομηνία</label>
            <input style="font-size:20px;" type="text" id="date" name="date" placeholder="yyyy-mm-dd"><br><br>

            <label for="subject">Θέμα</label>
            <input style="font-size:20px;" type="text" id="subject" name="subject"> <br><br>

            <label for="message">Μήνυμα</label>
            <input style="font-size:20px;" type="text" id="message" name="message"> <br><br>

            <input style="font-size:20px;" type="submit" value="Προσθήκη" name="submitButton"> <br> <br>
        </form>



    </body>



</html>