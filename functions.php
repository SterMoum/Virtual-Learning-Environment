<?php
function connectToDb(&$conn){
    $conn = new mysqli('localhost', 'root', '', 'stermoum');
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
function uploadFile($pwd)
{
    $path_filename_ext = "";
    if (($_FILES[$pwd]['name'] != "")) {
        // Where the file is going to be stored
        $target_dir = "./uploads/";
        $file = $_FILES[$pwd]['name'];
        $path = pathinfo($file);
        $filename = $path['filename'];
        $ext = $path['extension'];
        $temp_name = $_FILES[$pwd]['tmp_name'];
        $path_filename_ext = $target_dir . $filename . "." . $ext;
        
        //upload file
        move_uploaded_file($temp_name, $path_filename_ext);
    }
    return $path_filename_ext;
}

function hidePwd($pwd){
    $length = strlen($pwd);
    $encryptPwd = "";
    for($i = 0; $i < $length; $i++){
        $encryptPwd .= '*';
    }
    
    return $encryptPwd;
}

function emailExists($email){
    //connect to db
    connectToDb($conn);

    $sql = "SELECT loginame FROM users where loginame = '$email' ";
    $result = $conn->query($sql);

    if($result){
        while ($row = $result->fetch_assoc()){
            $existing_email = $row['loginame'];

            if($email == $existing_email){
                //return true if email already exists
                return 1;
            }
        }
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    //return false if email doesnt exist
    return 0;
}
?>