<?php
session_start();
    include("functions.php");

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        
        //connect to db
        connectToDb($conn);

        $table = $_SESSION['table'];
        

        $sql = "DELETE FROM $table WHERE id='$id' ";
        $conn->query($sql);

    }

    header("Location: $table.php");
    exit;

?>