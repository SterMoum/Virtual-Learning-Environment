<?php
session_start();
    include("functions.php");
    $errorMessage = "";

     if (isset($_POST['submitButton']) &&
        $_SERVER['REQUEST_METHOD'] == "POST"
        ) { //check if form was submitted
            $firstName = $_POST["firstName"];
            $lastName = $_POST["lastName"];
            $loginame = $_POST["loginame"];
            $password = $_POST["password"];
            $role = $_POST["role"];

            connectToDb($conn);

            do {
                if (empty($firstName) || empty($lastName) || empty($loginame) || empty($password) || empty($role) ||
                stringIsNullOrWhitespace($firstName) || 
                stringIsNullOrWhitespace($lastName) || 
                stringIsNullOrWhitespace($loginame) ||
                stringIsNullOrWhitespace($password) || 
                !isset($_POST['role'])) {
                    $errorMessage = "All fields are required or date wrong format";
                    break;
                }

                $sql = "INSERT INTO users (firstName, lastName, loginame, password, role)
                    VALUES ('$firstName', '$lastName', '$loginame', '$password', '$role')";

                if ($conn->query($sql)) {
                    echo "New record created successfully";
                    header("Location: users.php");
                    die;
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
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
        <title>Add User</title>
    </head>

    <body>
        <div class="form">
            <form action="" method="post">
                <input type="hidden" name="loginame" value="<?php echo $loginame;?>">

                <label for="firstName"> <?php echo "Όνομα"?> </label>
                <textarea id="firstName" name="firstName"></textarea> <br><br>

                <label for="lastName"> <?php echo "Επίθετο"?> </label>
                <textarea id="lastName" name="lastName"></textarea> <br><br>
                
                <label for="loginame"> <?php echo "Email"?> </label>
                <textarea id="loginame" name="loginame"></textarea> <br><br>

                <label for="password"> <?php echo "Κωδικός"?> </label>
                <textarea id="password" name="password"></textarea> <br><br>

                <label for="student">Μαθητής</label>
                <input type="radio" id="student" name="role" value="Μαθητής"> <br><br>

                <label for="tutor">Καθηγητής</label>
                <input type="radio" id="tutor" name="role" value="Καθηγητής"> <br><br>

                <input style="font-size:20px;" type="submit" value="Προσθήκη" name="submitButton">
                <input style="font-size:20px;" type="button" onclick="window.location.href='./users.php'" value="Πίσω"> <br><br>

                <?php echo $errorMessage ?>
            </form>
        </div>
    </body>
</html>