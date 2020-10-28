<?php header('Content-type: text/plain; charset=utf-8');

    $dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "";
    $dbName =  "showshouts";


    // Databse connection
    $conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

    // check connection
    if(!$conn){
        die("Connection Failed: " . mysqli_connect_error());
    }

    // post to db
    if (isset($_POST['submit'])) {

        $eventName = $_POST['eventName'];
        $description = $_POST['description'];
        $artist = $_POST['artist'];
        $fullContent = $_POST['fullContent'];

        $sql_query = "INSERT INTO events (title, content, artist, fullContent) VALUES ('$eventName','$description', '$artist', '$fullContent')";

        if (mysqli_query($conn, $sql_query))
        {
            echo "New event created successfully...";

            create a new webpage for event

            //get the unique ID
            $sql_query = "SELECT eventId FROM events WHERE (title = `$eventName`) LIMIT=1";
            $result = $conn->query($sql_query);
            $row = $result->fetch_assoc();

            if ($result->num_rows > 0)
            {   

                $newcontent = file_get_contents("post.html");
                if (!file_exists($row['eventId'].'.html')) { $handle = fopen($row['eventId'].'.php','w+'); fwrite($handle,$newcontent); fclose($handle); }
            }
            else 
            {
                echo "CANNOT CREATE MORE THAN ONE FILE AT A TIME";
                echo "Error: " . $sql . "" . mysqli_error($conn);
            }
        }
        else 
        {
            echo "Error: " . $sql . "" . mysqli_error($conn);
        }
    }   
?>