<?php
session_start();
    include("functions.php");
    connectToDb($conn);

    $id = "";
    $date = "";
    $subject = "";
    $message = "";

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        if (!isset($_GET["id"])){
            header("Location: announcement.php");
            exit;
        }
      
        $id = $_GET["id"];

        $sql = "SELECT * FROM announcements WHERE id=$id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if(!$row){
            header("Location: index.php");
            exit;
        }
         
        $date = $row['date'];
        $subject = $row['subject'];
        $message = $row['message'];

    }
    else {
            $id = $_POST["id"];
            $date = $_POST["date"];
            $subject = $_POST["subject"];
            $message = $_POST["message"];

            do{
                if(empty($id) || empty($date) || empty($subject) || empty($message)){
                    $errorMessage = "All fields are required";
                    break;
                }
    
                $sql = "UPDATE announcements 
                SET date='$date', subject='$subject', message='$message'
                WHERE id='$id' ";
    
                $result = $conn->query($sql);
    
                if ($result) {
                    echo "record edited successfully";
                    header("Location: announcements.php");
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
        <title>Edit announcement</title>
    </head>

    <body>
        <div class="form">
            <form  action="" method="post">
                <input type="hidden" name="id" value="<?php echo $id;?>">

                <label for="date"> <?php echo "Date"?> </label>
                <textarea id="date" name="date"> <?php echo $date?> </textarea> <br><br>

                <label for="subject"> <?php echo "Subject"?> </label>
                <textarea id="subject" name="subject"> <?php echo $subject ?> </textarea> <br><br>

                <label for="message"> <?php echo "message"?> </label>
                <textarea id="message" name="message"> <?php echo $message ?> </textarea> <br><br>

                <input style="font-size:20px;" type="submit" value="Ενημέρωση" name="submitButton"> <br> <br>
            </form>
        </div>



    </body>



</html>