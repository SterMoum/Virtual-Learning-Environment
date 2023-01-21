<!--Μπορείτε να δείτε online τη σελίδα και στο https://users.auth.gr/stermoum/ergasiaEPDmerosA/index.html -->
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
        <title>Homepage</title>
    </head>

    <body>

        <div class="container">

                <div class="page-title">
                    <h1>Αρχική Σελίδα</h1>
                    <a style="float:right" href="./logout.php">Logout</a>
                </div>

                <div class="sidebar">
                    <a href="homepage.php">
                        <button class="button-sidebar" role="button">Αρχική Σελίδα</button>
                    </a><br>
                
                    <a href="announcement.php"> 
                        <button class="button-sidebar" role="button">Ανακοινώσεις</button>    
                    </a><br>
                
                    <a href="communication.php">
                        <button class="button-sidebar" role="button">Επικοινωνία</button>   
                    </a><br>
                
                    <a href="documents.php">
                        <button class="button-sidebar" role="button">Έγγραφα μαθήματος</button>
                    </a><br>
                
                    <a href="homework.php"> 
                        <button class="button-sidebar" role="button">Εργασίες</button>
                    </a>
                </div>
                <div class="main-content">
                    <h2 class="h2-style" style="text-align: center;">
                        Εισαγωγή στο προγραμματισμό με γλώσσα C
                    </h2>

                    <p><font size="+3">Καλώς ήρθατε στο μάθημα Εισαγωγής στο προγραμματισμό με γλώσσα C. Στο παρόν μάθημα θα διδαχθείτε
                        τις βασικές λειτουργίας της γλώσσας C
                    </p></font>

                    <p><font size="+2">Στις επιμέρους σελίδες θα βρείτε:</font></p>

                    <font size="+2"><b>Ανακοινώσεις:</b> Θα βρείτε όλες τις ανακοινώσεις που αναρτώνται για το μάθημα (Π.χ για τις διαλέξεις)</font> <br> <br>
                        
                    <font size="+2"><b>Επικοινωνία:</b> Μπορείτε να επικοινωνήσετε με τον καθηγητή μέσω της φόρμας ή μέσω email</font> <br> <br>

                    <font size="+2"><b>Έγγραφα μαθήματος:</b> Θα βρείτε όλες τις διαφάνειες/σημειώσεις του μαθήματος</font> <br> <br>

                    <font size="+2"><b>Εργασίες:</b> Θα βρείτε όλες τις εργασίες που αναρτώνται ανά πάσα στιγμή</font> <br> <br>
                        
                        <img src="../media/c_1.png" class="image-homepage">
                </div>
            </div>
        </body>
</html>