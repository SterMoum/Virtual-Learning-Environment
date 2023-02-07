<?php
include("functions.php");
    session_start();
    if(!isset($_SESSION['username'])){ //if login in session is not set
        header("Location: index.php");
    }
    $_SESSION['table'] = 'documents';
    connectToDb($conn);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./style/style.css?v=<?php echo time();?>">
        <title>Documents</title>
    </head>
    <body>
        <a name="top"></a>
        
        <div class="container">
                <div class="page-title">
                    <h1>Έγγραφα μαθήματος</h1>
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
                
                    <a href="assignments.php" > 
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
                            <a style="font-size: larger;" href="./addDocument.php">Προσθήκη νέου Εγγράφου</a> <br> <br>
                            <?php
                        }
                    
                    $sql = "select * from documents";
                    $result = $conn->query($sql);
                    
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                             ?> 
                             <h2 class="h2-style"><?php echo $row['title'] ?> </h2>
                             <?php
                                if ($_SESSION['role'] == "Tutor") {
                                     
                                    echo "<a style='font-size: larger;' href='./editDocument.php?id=$row[id]'>[Επεξεργασία] </a>";
                                    echo " <a style='font-size: larger;' href='./delete.php?id=$row[id]'>[Διαγραφη]</a> "; 
            
                                }
                             
                             ?>
                             
                             
                            <font class="center"><b>Περιγραφή</b>: <?php echo $row['description']?></font><br><br>
                            <font class="center"><a href="./<?php echo $row['location']?>">Download</a></font>
                            
                            <br><br>
                            <hr>
                            <?php 
                        }
                    } else{

                        ?> <h2 class="h2-style">ΔΕΝ ΥΠΑΡΧΟΥΝ ΕΓΓΡΑΦΑ </h2> <?php 
                    }
                    ?>
                

                    <a style="float: right; color: black;" href="#top"><font size="+3">Back to top</font></a>

                </div>

                
            </div>
    </body>
</html>