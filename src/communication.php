<?php
session_start();
    include("functions.php");
    //require("/home/site/libs/PHPMailer-master/src/Exception.php");
    //require("/home/site/libs/PHPMailer-master/src/PHPMailer.php");
    //require("/home/site/libs/PHPMailer-master/src/SMTP.php");
    //error_reporting(0);
    $errorMessage = "";
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
                $errorMessage = "All fields required";
                break;
            }


            $sql = "SELECT loginame FROM users WHERE role = 'Tutor' ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $recipient = $row['loginame'];
                    echo $recipient;
                    //$recipient = $row['loginame'];
                    
                    //echo $recipient;
                    /*$mail = new PHPMailer\PHPMailer\PHPMailer();

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
                    $mail->setFrom('domain@example.com');   
                    $mail->addAddress('receipt@domain.com');

                    $mail->isHTML(true);                       // Set email format to HTML
                    $mail->Subject = 'Here is the subject';
                    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    $mail->send();*/

                    ini_set("SMTP", "aspmx.l.google.com");
                    ini_set("sendmail_from", $loginame);
                    
                    $headers = "From: $loginame";

                    mail($recipient, $subject, $message, $headers);
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
        <link rel="stylesheet" href="./style.css?v=<?php echo time(); ?>">
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
                        <label for="sender"><h3><b>Αποστολέας: </b></h3></label>
                        <textarea id="sender" name="sender" readonly> <?php echo $loginame ?> </textarea>
                        
                        <br>

                        <label for="subject"><h3><b>Θέμα: </b></h3></label>
                        <textarea id="subject" name="subject"></textarea>

                        <br>

                        <label for="message"><h3><b>Κείμενο: </b></h3></label>
                        <textarea id="message" name="message"></textarea>
                        
                        <br>

                        <div style="display:flex; justify-content: center; text-align: center;">
                            <input class="button-sidebar" type="submit" value="Αποστολή" name="sendButton">
                        </div>

                        <div style="display:flex; justify-content: center; text-align: center;font-size:x-large">
                            <?php echo $errorMessage ?>
                        </div>
                        <hr>

                        <h2><b>Αποστολή e-mail με χρήση e-mail διεύθυνσης</b></h2>
                            <h3>Εναλλακτικά μπορείτε να αποστείλετε e-mail στην 
                                παρακάτω διεύθυνση ηλεκτρονικού ταχυδρομείου 
                                <a href = "mailto: tutor@csd.auth.gr">tutor@csd.auth.gr</a></h3>

                    </form>
            </div>
        </div>
    </body>
</html>