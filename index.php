<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
var_dump($_POST);
    if(isset($_POST['submit'])){
        $file = $_FILES['file'];

        $fileName = $_FILES['file']['name']; // or $fileName = $file['name']
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];


        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png', 'pdf');

        if(in_array($fileActualExt, $allowed)){
            if($fileError === 0){
                if($fileSize<10000000){
                    $fileNameNew = uniqid('',true) . "." . $fileActualExt;

                    $fileDestination = 'uploads/' . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    echo "file has been uploaded";
                }else{
                    echo 'You file is too big';
                }
            }else{
                echo 'There was an error uploading your file!';    
            }
        }else{
            echo 'you cannot file of this type!';   
        }
        
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File</title>
</head>
<body>
<form action="/PHPUpload/index.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file">
    <button type="submit" name="submit">UPLOAD</button>
</form>   
</body>
</html>