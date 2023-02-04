<?php
session_start();
    include("functions.php");
    connectToDb($conn);

    $id = "";
    $title = "";
    $description = "";
    $location = "";

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        if (!isset($_GET["id"])){
            header("Location: documents.php");
            exit;
        }
    
        $id = $_GET["id"];

        $sql = "SELECT * FROM documents WHERE id=$id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if(!$row){
            header("Location: index.php");
            exit;
        }

        $title = $row['title'];
        $description = $row['description'];
        $location = $row['location'];

    }
    else {
            $id = $_POST["id"];
            $title = $_POST["title"];
            $description = $_POST["description"];
            $location = $_POST["location"];

            do{
                if(empty($id) || empty($title) || empty($description) || empty($location)){
                    $errorMessage = "All fields are required";
                    break;
                }
    
                $sql = "UPDATE documents 
                SET title ='$title', description ='$description', location ='$location'
                WHERE id='$id' ";
    
                $result = $conn->query($sql);
    
                if ($result) {
                    echo "record edited successfully";
                    header("Location: documents.php");
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
        <title>Login</title>
    </head>

    <body>
        <div class="form">
            <form  action="" method="post">
                <input type="hidden" name="id" value="<?php echo $id;?>">

                <label for="title"> <?php echo "Title"?> </label>
                <textarea id="title" name="title"> <?php echo $title?> </textarea> <br><br>

                <label for="description"> <?php echo "Description"?> </label>
                <textarea id="description" name="description"> <?php echo $description ?> </textarea> <br><br>

                <label for="location"> <?php echo "file Name"?> </label>
                <textarea id="location" name="location"> <?php echo $location ?> </textarea> <br><br>

                <input style="font-size:20px;" type="submit" value="Ενημέρωση" name="submitButton"> <br> <br>
            </form>
        </div>

    </body>

</html>