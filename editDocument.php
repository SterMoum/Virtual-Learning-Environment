<?php
session_start();
    include("functions.php");
    connectToDb($conn);

    $id = "";
    $title = "";
    $description = "";
    $location = "";

    $errorMessage = "";

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
            $location = uploadFile("documentToUpload");

            do{
                if(empty($title) || empty($description) || empty($location) ||
                    stringIsNullOrWhitespace($title) || 
                    stringIsNullOrWhitespace($description) || 
                    stringIsNullOrWhitespace($location)){
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
            
        }
    $conn->close();
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./style/style.css?v=<?php echo time();?>" />
        <title>Edit Document</title>
    </head>

    <body>
        <div class="form">
            <form  action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id;?>">

                <label for="title"> <?php echo "Τίτλος"?> </label>
                <textarea id="title" name="title"><?php echo $title?></textarea><br><br>

                <label for="description"> <?php echo "Περιγραφή"?> </label>
                <textarea id="description" name="description"><?php echo $description ?></textarea><br><br>

                <font style="font-size:larger">Αρχείο</font>
                <input style="font-size:20px;" type="file" name="documentToUpload" id="fileToUpload"><br><br>

                <input style="font-size:20px;" type="submit" value="Ενημέρωση" name="submitButton">
                <input style="font-size:20px;" type="button" onclick="window.location.href='./documents.php'" value="Πίσω"> <br><br>
                
                <font class="center"><?php echo $errorMessage ?></font>
            </form>
        </div>
    </body>
</html>