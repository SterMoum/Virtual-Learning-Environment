<!--Μπορείτε να δείτε online τη σελίδα εδω-> https://stermoum.webpages.auth.gr/3620PartB/ -->
<?php 
session_start();
    include("functions.php");
    $errorMessage = "";
    if(isset($_SESSION['username'])) {
        header("Location: homepage.php"); // redirects them to homepage
        exit; // for good measure
   }

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
                    
                }else{
                    $errorMessage = "incorect password";
                }
            }else{
                $errorMessage = "No user with these credentials";
            }
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }    
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../style/style.css?v=<?php echo time(); ?>" />
        <title>Login</title>
    </head>
    <body>
        <div class="form">
            <form style="border: 2px solid black;" action="" method="post">
                <font size="+2"> ΠΙΣΤΟΠΟΙΗΣΗ </font> <br><br>

                <label for="login">Email</label>
                <input style="font-size:20px;" type="text" id="loginame" name="loginame"><br><br>

                <label for="pwd">Password</label>
                <input style="font-size:20px;" type="password" id="password" name="password"> <br><br>

                <input style="font-size:20px;" type="submit" value="Είσοδος" name="submitButton"> <br> <br>
                
                <font class="center"><?php echo $errorMessage ?></font>
            </form>
        </div>

    </body>

</html>
