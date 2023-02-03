<?php
session_start();
    include("functions.php");
    if(!isset($_SESSION['username'])){ //if login in session is not set
        header("Location: index.php");
    }
    $_SESSION['table'] = 'announcements';
    connectToDb($conn);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./style.css?v=<?php echo time(); ?>">
        <title>announcements</title>
    </head>

    <body>

        <a name="top"></a>
        
        <div class="container">
                <div class="page-title">
                    <h1>Ανακοινώσεις</h1>
                    <a style="float:right" href="./logout.php">Logout</a>
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
                
                    <a href="homework.php"> 
                        <button class="button-sidebar" role="button">Εργασίες</button>
                    </a>
                </div>
                <div class="main-content">
                <?php
                    
                    if ($_SESSION['role'] == "Tutor"){
                        ?>
                        <a style="font-size: larger;" href="./addAnnouncement.php">Προσθήκη νέας Ανακοίνωσης</a> <br> <br>
                        <?php
                    }
                    
                    $sql = "select * from announcements";
                    $result = $conn->query($sql);
                    
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                             ?> 
                             <h2 class="h2-style">Ανακοίνωση <?php echo $row['id'] ?> </h2>
                             <?php
                                if ($_SESSION['role'] == "Tutor") {
                                     
                                    echo "<a style='font-size: larger;' href='./editAnnouncement.php?id=$row[id]'>[Επεξεργασία] </a>";
                                    echo " <a style='font-size: larger;' href='./delete.php?id=$row[id]'>[Διαγραφη]</a> "; 
            
                                }
                             
                             ?>
                             
                             <div class="center">
                                <font size="+2"><b>Ημερομηνία</b>: <?php echo $row['date'] ?> </font> <br> <br>
                                <font size="+2"><b>Θέμα</b>: <?php echo $row['subject'] ?> </font> <br> <br>
                                <font size="+2"><?php echo $row['message'] ?> </font>
                            </div>
                            <br><br>
                            <hr>
                            <?php 
                        }
                    } else{

                        ?> <h2 class="h2-style">ΔΕΝ ΥΠΑΡΧΟΥΝ ΑΝΑΚΟΙΝΩΣΕΙΣ </h2> <?php 
                    }
                    ?>
                
                <a style="float: right; color: black;" href="#top"><font size="+3">Back to top</font></a>

                </div>
            </div>
        </body>
</html>