<?php
session_start();
    include("functions.php");
    $errorMessage = "";
     if (isset($_POST['submitButton']) &&
        $_SERVER['REQUEST_METHOD'] == "POST"
        ) { //check if form was submitted
            $title = $_POST["title"];
            $description = $_POST["description"];
            $location = $_POST["location"];

            connectToDb($conn);
            do {
                if (empty($title) || empty($description) || empty($location) ||
                    stringIsNullOrWhitespace($title) || 
                    stringIsNullOrWhitespace($title) ||
                    stringIsNullOrWhitespace($title)) {
                        $errorMessage = "All fields are required";
                        break;
                    }

                $sql = "INSERT INTO documents (title, description, location)
                        VALUES ('$title', '$description', '$location')";

                if ($conn->query($sql)) {
                    echo "New record created successfully";

                    header("Location: documents.php");
                    die;
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } while (true);
            $conn->close();
        }
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./style.css?v=<?php echo time()?>" />
        <title>Add Document</title>
    </head>

    <body>
        <div class="form">
            <form  action="" method="post">

                <input type="hidden" name="id" value="<?php echo $id?>">

                <label for="title">Τίτλος</label>
                <textarea id="title" name="title"></textarea><br><br>

                <label for="description">Περιγραφή</label>
                <textarea id="description" name="description"></textarea><br><br>

                <label for="location">Όνομα αρχείου</label>
                <textarea id="location" name="location"></textarea><br><br>

                <input style="font-size:20px;" type="submit" value="Προσθήκη" name="submitButton">
                <input style="font-size:20px;" type="button" onclick="window.location.href='./documents.php'" value="Πίσω"> <br> <br>

                <?php echo $errorMessage ?>
            </form>
        </div>
    </body>
</html>