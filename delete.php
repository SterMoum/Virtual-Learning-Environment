<?php
session_start();
    include("functions.php");

    if(isset($_GET["id"])){
        $id = $_GET["id"];

        connectToDb($conn);

        $table = $_SESSION['table'];
            
        $sql = "DELETE FROM $table WHERE id='$id' ";
        $conn->query($sql);
    
        header("Location: $table.php");
        exit;
    }
    else{
        $loginame = $_GET["loginame"];

        connectToDb($conn);

        $table = $_SESSION['table'];
            
        $sql = "DELETE FROM $table WHERE loginame='$loginame' ";
        $conn->query($sql);
    
        header("Location: $table.php");
        exit;
    }
   

?>