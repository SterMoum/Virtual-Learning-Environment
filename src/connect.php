<?php 
session_start();
    
    $loginame = $_POST['loginame'];
    $password = $_POST['password'];
   
    //connect to database
    $conn = new mysqli('localhost', 'root', '', 'vle');
    if($conn->connect_error){
        die('Connection Failed : ' . $conn->$connect_error);
    }else{
    //connection successfull
        $query = "select * from users where loginame = '$loginame'";
        $result = mysqli_query($conn, $query);
        
        if($result){
            if($result && mysqli_num_rows($result) > 0){
                $user_data = mysqli_fetch_assoc($result);
                if($user_data['password'] == $password){
                    //succesfull login
                    header("Location: homepage.php");
                    die;
                }else{
                    header("Location: index.php");
                    die;
                }
            }else{
                header("Location: index.php");
                    die;
            }
        }
    }
?>