<?php 
session_start();
    include("functions.php");
 
    if (isset($_POST['submitButton']) && $_SERVER['REQUEST_METHOD'] == "POST"){ //check if form was submitted
        $loginame = $_POST['loginame'];
        $password = $_POST['password'];

        //connect to database
        connectToDb($conn);

        
        $query = "select * from users where loginame = '$loginame'";
        $result = mysqli_query($conn, $query); 

        if ($result) {
            if ($result && mysqli_num_rows($result) > 0){
                $user_data = mysqli_fetch_assoc($result);
                if ($user_data['password'] == $password) {
                    //succesfull login
                    $_SESSION['username'] = $loginame;
                    $_SESSION['role'] = $user_data['role'];
                    header("Location: homepage.php");
                    die;
                }
            }
        }    
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./style.css?v=<?php echo time(); ?>" />
        <title>Login</title>
    </head>
    <body>
        <div class="login">
            <form style="border: 2px solid black;" action="" method="post">
                <font size="+2"> ΠΙΣΤΟΠΟΙΗΣΗ </font> <br><br>

                <label for="login">Login</label>
                <input style="font-size:20px;" type="text" id="loginame" name="loginame"><br><br>

                <label for="pwd">Password</label>
                <input style="font-size:20px;" type="password" id="password" name="password"> <br><br>

                <input style="font-size:20px;" type="submit" value="Είσοδος" name="submitButton"> <br> <br>
                
            </form>
        </div>

    </body>

</html>
