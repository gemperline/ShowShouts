<?php

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
?>