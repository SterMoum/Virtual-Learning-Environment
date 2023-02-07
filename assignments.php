<?php
session_start();
    include("functions.php");
    if(!isset($_SESSION['username'])){ //if login in session is not set
        header("Location: index.php");
    }
    $_SESSION['table'] = 'assignments';
    connectToDb($conn);
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./style/style.css?v=<?php echo time(); ?>">
        <title>Assignments</title>
    </head>

    <body>
        <a name="top"></a>

        <div class="container">
                <div class="page-title">
                    <h1>Εργασίες</h1>
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

                    <?php
                        if ($_SESSION['role'] == "Tutor"){
                            ?>
                            <a style="font-size: larger;" href="./addAssignment.php">Προσθήκη νέας Εργασίας</a> <br> <br>
                            <?php
                    }
                    
                    $sql = "select * from assignments";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            $_SESSION['id'] = $row['id'] + 1;
                             ?> 
                             <h2 class="h2-style">Εργασία <?php echo $row['id']?> </h2>
                             <?php
                                if ($_SESSION['role'] == "Tutor") {
                                     
                                    echo "<a style='font-size: larger;' href='./editAssignment.php?id=$row[id]'>[Επεξεργασία] </a>";
                                    echo "<a style='font-size: larger;' href='./delete.php?id=$row[id]'>[Διαγραφη]</a> "; 
            
                                }
                             
                             ?>
                             
                            
                            <font class="center"><b>Στόχοι </b>: Οι στόχοι της εργασίας είναι: <br> <?php echo $row['goals'] ?> </font><br>
                            <font class="center"><b>Εκφώνηση </b>: Κατεβάστε την εκφώνηση απο -> <a href="./<?php echo $row["location"]?>">εδώ</a></font><br>
                            <font class="center"><b>Παραδοτέα: </b><?php echo $row['required_files'] ?> </font><br>
                            <font class="center" style="color: red;"><b> Ημερομηνία Παράδοσης: </b><?php echo $row['date'] ?> </font><br>
                          
                            <br><br>
                            <hr>
                            <?php 
                        }
                    } else{

                        ?> <h2 class="h2-style">ΔΕΝ ΥΠΑΡΧΟΥΝ ΕΡΓΑΣΙΕΣ </h2> <?php 
                    }
                    ?>
                
                        <a style="float: right; color: black;" href="#top"><font size="+3">Back to top</font></a>

                        <hr>
                    </div>
                </div>
            </div>
        </body>
</html>