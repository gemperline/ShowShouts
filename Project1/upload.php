<?php
     require_once 'dbConfig.php';

     $status = $statusMsg = '';
     
     // if the upload form is submitted
     if(isset($_POST["submit"])) {
        $status = 'error';

        $eventName = $_POST['eventName'];
        $description = $_POST['description'];
        $artist = $_POST['artist'];
        $fullContent = $_POST['fullContent'];

        if(!empty($_FILES["image"]["name"])) {
            // get file info
            $fileName = basename($_FILES["image"]["name"]);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            // allow certain file formats
            $allowTypes = array('jpg','png','jpeg','gif');

            if(in_array($fileType, $allowTypes)) {
                $image = $_FILES['image']['tmp_name'];
                $imgContent = addslashes(file_get_contents($image));

                // insert image content into database
                $sql_query = "INSERT INTO events (title, content, artist, fullContent, publishDate, photo) VALUES ('$eventName','$description', '$artist', '$fullContent', NOW(), '$imgContent')";
                 if(mysqli_query($conn, $sql_query)) {
                     $status = 'success';
                     $statusMsg = "File uploaded successfully.";

                 }
                 else {
                     $statusMsg = "File uplaod failed, please try again.";
                 }
            }
            else {
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed.';
            }
        }
        else {
            $statusMsg = 'Please select an image file to upload.';
        }
     }
?>