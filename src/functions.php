<?php
function connectToDb(&$conn){
    $conn = new mysqli('localhost', 'root', '', 'vle');
    if ($conn->connect_error) {
        die('Connection Failed : ' . $conn->connect_error);
    }
    return $conn;
}
function validateDate($date, $format = 'Y-m-d'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}
function stringIsNullOrWhitespace($text){
    return ctype_space($text) || $text === "" || $text === null;
}
?>