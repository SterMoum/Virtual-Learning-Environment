<?php
session_start();
    include("functions.php");
     if (
        isset($_POST['submitButton']) &&
        $_SERVER['REQUEST_METHOD'] == "POST"
        ) { //check if form was submitted
            $title = $_POST["title"];
            $description = $_POST["description"];
            $location = $_POST["location"];

            connectToDb($conn);

            $sql = "INSERT INTO documents (title, description, location)
            VALUES ('$title', '$description', '$location')";

            if ($conn->query($sql)) {
                echo "New record created successfully";

                header("Location: documents.php");
                die;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
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

                <label for="location">Τοποθεσία</label>
                <textarea id="location" name="location"></textarea><br><br>

                <input style="font-size:20px;" type="submit" value="Προσθήκη" name="submitButton"> <br> <br>
            </form>
        </div>
    </body>
</html>