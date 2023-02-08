<?php
session_start();
    include("functions.php");

    if(isset($_GET["id"])){
        /*one of the following is going to be deleted
        1. Announcement
        2. Assignment
        3. Document
        because they have an ID in their database table */
        
        $id = $_GET["id"];

        connectToDb($conn);

        $table = $_SESSION['table'];
            
        $sql = "DELETE FROM $table WHERE id='$id' ";
        $conn->query($sql);
    
        header("Location: $table.php");
        exit;
    }
    else{
        /*A user is going to be deleted because the primary key of their database table
        is an email */

        $loginame = $_GET["loginame"];

        connectToDb($conn);

        $table = $_SESSION['table'];
            
        $sql = "DELETE FROM $table WHERE loginame='$loginame' ";
        $conn->query($sql);
    
        header("Location: $table.php");
        exit;
    }
   

?>