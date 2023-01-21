<?php
function connectToDb(&$conn){
    $conn = new mysqli('localhost', 'root', '', 'vle');
    if ($conn->connect_error) {
        die('Connection Failed : ' . $conn->connect_error);
    }
    return $conn;
}
?>