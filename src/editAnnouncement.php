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
                    header("Location: announcement.php");
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
        <form  action="" method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>">

            <label for="date">Ημερομηνία</label>
            <input style="font-size:20px;" type="text" id="date" name="date" value=<?php echo $date ?> ><br><br>

            <label for="subject">Θέμα</label>
            <input style="font-size:20px;" type="text" id="subject" name="subject" value=<?php echo $subject ?>>  <br><br>

            <label for="message">Μήνυμα</label>
            <input style="font-size:20px;" type="text" id="message" name="message" value=<?php echo $message ?>> <br><br>

            <input style="font-size:20px;" type="submit" value="Ενημέρωση" name="submitButton"> <br> <br>
        </form>



    </body>



</html>