<?php
session_start();
    include("functions.php");

    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;

    require './PHPMailer/Exception.php';
    require './PHPMailer/PHPMailer.php';
    require './PHPMailer/SMTP.php';

    $displayMessage = "";
    if(!isset($_SESSION['username'])){ //if login in session is not set
        header("Location: index.php");
        
    }
    $loginame = $_SESSION['username'];

    if (isset($_POST['sendButton']) && $_SERVER['REQUEST_METHOD'] == "POST") {
        $sender = $_POST["sender"];
        $subject = $_POST["subject"];
        $message = $_POST["message"];

        
        //connect to db
        connectToDb($conn);
        do {
            if(empty($sender) || empty($subject) || empty($message) ||
            stringIsNullOrWhitespace($sender) ||
            stringIsNullOrWhitespace($subject) ||
            stringIsNullOrWhitespace($message)){
                $displayMessage = "All fields required";
                break;
            }
            $sql = "SELECT loginame FROM users WHERE role = 'Tutor' ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    $recipient = $row['loginame'];

                    $mail = new PHPMailer();
                    // Settings
                    $mail->IsSMTP();
                    $mail->CharSet = 'UTF-8';
                    $mail->Host       = "mail.example.com";    // SMTP server example
                    $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
                    $mail->SMTPAuth   = true;                  // enable SMTP authentication
                    $mail->Port       = 25;                    // set the SMTP port for the GMAIL server
                    $mail->Username   = "username";            // SMTP account username example
                    $mail->Password   = "password";            // SMTP account password example
                    // Content
                    $mail->setFrom($loginame);   
                    $mail->addAddress($recipient);              
                    $mail->Subject = $subject;
                    $mail->Body    = $message;
                    try{
                        $mail->send();
                        $displayMessage = "Message Successfully Sent to Tutors";
                    } catch(Exception $e){
                        $displayMesasge = "Error!" . $e->errorMessage();
                    } 
                }
                break;
            }else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } while (true);
        
        $conn->close();
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./style/style.css?v=<?php echo time(); ?>">
        <title>Communication</title>
    </head>
    
    <body>
        <div class="container">
            <div class="page-title">
                <h1>Επικοινωνία</h1>
                <div style="float:right;">
                    <button class="button-sidebar" role="button" onclick="window.location.href='./logout.php' ">Logout</button>
                </div>
            </div>
            <div class="sidebar">
                    <a href="homepage.php">
                        <button class="button-sidebar" role="button">Αρχική Σελίδα</button>
                    </a><br>
                
                    <a href="announcements.php"> 
                        <button class="button-sidebar" role="button">Ανακοινώσεις</button>    
                    </a><br>
                
                    <a href="communication.php">
                        <button class="button-sidebar" role="button">Επικοινωνία</button>   
                    </a><br>
                
                    <a href="documents.php">
                        <button class="button-sidebar" role="button">Έγγραφα μαθήματος</button>
                    </a><br>
                
                    <a href="assignments.php"> 
                        <button class="button-sidebar" role="button">Εργασίες</button>
                    </a><br>
                    
                    <?php if($_SESSION['role'] == 'Tutor'){
                        ?>
                        <a href="users.php">
                            <button class="button-sidebar" role="button" style="color:red">Διαχείριση Χρηστών </button>
                        </a>
                        <?php
                    }
                    ?>
                </div>
            <div class="main-content">
                <h2 class="h2-style">
                    Μπορείτε να επικοινωνήσετε με τον διδάσκοντα είτε μέσω της web φόρμας 
                    που βρίσκεται παρακάτω είτε μέσω email 
                </h2>
                    <h2><b>Αποστολή e-mail μέσω web φόρμας</b></h2>
                    <form action="" method="post">
                        <label for="sender"><h3><b>Αποστολέας:</b></h3></label>
                        <textarea id="sender" name="sender"><?php echo $loginame ?></textarea>
                        
                        <br>

                        <label for="subject"><h3><b>Θέμα:</b></h3></label>
                        <textarea id="subject" name="subject"></textarea>

                        <br>

                        <label for="message"><h3><b>Κείμενο:</b></h3></label>
                        <textarea id="message" name="message"></textarea>
                        
                        <br>

                        <div style="display:flex; justify-content: center; text-align: center;">
                            <input class="button-sidebar" type="submit" value="Αποστολή" name="sendButton">
                        </div>

                        <div style="display:flex; justify-content: center; text-align: center;font-size:x-large">
                            <?php echo $displayMessage ?>
                        </div>
                        <hr>

                        <h2><b>Αποστολή e-mail με χρήση e-mail διεύθυνσης</b></h2>
                            <h3>Εναλλακτικά μπορείτε να αποστείλετε e-mail στην 
                                παρακάτω διεύθυνση ηλεκτρονικού ταχυδρομείου <br>
                                <?php 
                                    connectToDb($conn);

                                    $sql = "SELECT loginame FROM users where role = 'Tutor' ";
                                    $tutor_email = "";
                                    $result = $conn->query($sql);
                                    if($result){
                                        while($row = $result->fetch_assoc()){
                                            $tutor_email = $row['loginame'];
                                            ?> <a style="font-size:large;" href = "mailto: <?php echo $tutor_email ?>"><?php echo $tutor_email ?></a><br></h3> <?php 
                                        }
                                       
                                    }else{
                                        echo "Error: " . $sql . "<br>" . $conn->error;
                                    }
                               ?>
                    </form>
            </div>
        </div>
    </body>
</html>