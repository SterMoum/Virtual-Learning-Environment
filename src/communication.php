<?php
session_start();
    if(!isset($_SESSION['username'])){ //if login in session is not set
        header("Location: index.php");
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
                <a href="./logout.php" style="float:right;">
                        <button class="button-sidebar" role="button">Logout</button></a>
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
                    <form>
                        <label for="sender-email"><h3><b>Αποστολέας: </b></h3></label>
                        <textarea name="sender-email" rows="1" cols="20" maxlength="40"></textarea>
                        
                        <br>

                        <label for="subject"><h3><b>Θέμα: </b></h3></label>
                        <textarea name="subject" rows="2" cols="40" wrap="hard" maxlength="100"></textarea>

                        <br>

                        <label for="message"><h3><b>Κείμενο: </b></h3></label>
                        <textarea name="message" rows="4" cols="40"></textarea>
                        
                        <br>

                        <input type="submit" value="Αποστολή" id="submit-button">

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