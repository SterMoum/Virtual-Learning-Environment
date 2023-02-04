<?php
session_start();
    include("functions.php");
    connectToDb($conn);

    $firstName = "";
    $lastName = "";
    $loginame = "";
    $password = "";
    $role = "";

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        if (!isset($_GET["loginame"])){
            header("Location: users.php");
            exit;
        }
      
        $loginame = $_GET["loginame"];

        $sql = "SELECT * FROM users WHERE loginame= '$loginame' ";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if(!$row){
            header("Location: index.php");
            exit;
        }
         
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $password = $row['password'];
        $role = $row['role'];

    }
    else {
            $loginame = $_POST["loginame"];
            $firstName = $_POST["firstName"];
            $lastName = $_POST["lastName"];
            $password = $_POST["password"];
            $role = $_POST["role"];

            do{
                if(empty($loginame) || empty($firstName) || empty($lastName) || empty($password) || empty($role)){
                    $errorMessage = "All fields are required";
                    break;
                }
    
                $sql = "UPDATE users 
                SET firstName='$firstName', lastName='$lastName', password='$password', role = '$role'
                WHERE loginame='$loginame' ";
    
                $result = $conn->query($sql);
    
                if ($result) {
                    echo "record edited successfully";
                    header("Location: users.php");
                    die;
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    break;
                }
    
            }while(true);
            $conn->close();
        }
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./style.css?v=<?php echo time(); ?>" />
        <title>Edit User</title>
    </head>

    <body>
        <div class="form">
            <form  action="" method="post">
                <input type="hidden" name="loginame" value="<?php echo $loginame;?>">

                <label for="firstName"> <?php echo "firstName"?> </label>
                <textarea id="firstName" name="firstName"> <?php echo $firstName?> </textarea> <br><br>

                <label for="lastName"> <?php echo "lastName"?> </label>
                <textarea id="lastName" name="lastName"> <?php echo $lastName ?> </textarea> <br><br>

                <label for="password"> <?php echo "password"?> </label>
                <textarea id="password" name="password"> <?php echo $password ?> </textarea> <br><br>

                <label for="student">Student</label>
                <input type="radio" id="student" name="role" value="Student" 
                    <?php if($role == "Student"){
                                ?> checked <?php
                    }?>> <br><br>
                

                <label for="tutor">Tutor</label>
                <input type="radio" id="tutor" name="role" value="Tutor"
                        <?php if($role == "Tutor"){
                                ?> checked <?php
                        }?>> <br><br>
                

                <input style="font-size:20px;" type="submit" value="Ενημέρωση" name="submitButton"> <br> <br>
            </form>
        </div>



    </body>



</html>