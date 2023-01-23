<?php
    include("functions.php");

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        
        //connect to db
        connectToDb($conn);

        $sql = "DELETE FROM announcements WHERE id='$id' ";
        $conn->query($sql);

    }

    header("Location: announcement.php");
    exit;

?>