<!--Μπορείτε να δείτε online τη σελίδα και στο https://users.auth.gr/stermoum/ergasiaEPDmerosA/index.html -->
<?php
session_start();
    include("functions.php");
    if(!isset($_SESSION['username'])){ //if login in session is not set
        header("Location: index.php");
    }
    $_SESSION['table'] = 'users';
    connectToDb($conn);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./style.css?v=<?php echo time(); ?>">
        <title>Users Management</title>
    </head>

    <body>
        <div class="container">

        <div class="page-title">
            <h1>Διαχείριση Χρηστών</h1>
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
            </a> <br>
            
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
            <div class="table-wrapper">
                <thead>
                <?php

                    $query = "SELECT * FROM users";
                    echo '<table class="fl-table"> 
                    <tr> 
                        <td> <font face="Arial">First Name</font> </td> 
                        <td> <font face="Arial">Last Name</font> </td> 
                        <td> <font face="Arial">Email</font> </td> 
                        <td> <font face="Arial">Password</font> </td> 
                        <td> <font face="Arial">Role</font> </td> 
                    </tr>';
                ?>
                </thead>
                <?php   
                if ($result = $conn->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    $firstName = $row["firstName"];
                    $lastName = $row["lastName"];
                    $loginame = $row["loginame"];
                    $password = $row["password"];
                    $role = $row["role"];

                    echo "<tr> 
                                <td>$firstName</td> 
                                <td>$lastName</td> 
                                <td>$loginame</td> 
                                <td>$password</td> 
                                <td>$role</td>
                                <td> <a href='./editUser.php?loginame=$row[loginame]'>[Επεξεργασία] </a>
                                <td> <a href='./delete.php?loginame=$row[loginame]'>[Διαγραφή] </a>
                            </tr>";
                }
                $result->free();
            }
            ?>
            </div>
            <div style="text-align:center;float:left;">
                <a style="font-size: larger;" href='./addUser.php' >Προσθήκη Χρήστη</button
            </div> 
        </div>
    </body>
</html>