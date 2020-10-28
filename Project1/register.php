<?php 
session_start();
$_SESSION['message'] = '';
$mysqli = new mysqli('localhost', 'root', '', 'showshouts');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // two passwords are equal
    if ($_POST['password'] == $_POST['confirmpassword']) {

        $username = $mysqli->real_escape_string($_POST['username']);
        $email = $mysqli->real_escape_string($_POST['email']);
        $password = md5($_POST['password']); // md5 hash password security

        $_SESSION['username'] = $username;
        
        $sql = "INSERT INTO users (username, email, pword) VALUES ('$username', '$email', '$password')";

        // if the query is successfull, redirect to index.php
        if ($mysqli->query($sql) === true) {
            $_SESSION['message'] = "Registration successful!";
             header("location: /Project1/index.php");
        }
        else {
            $_SESSION['message'] = "User could not be registered.";
        }
    }
    else {
        $_SESSION['message'] = "The passwords do not match!";
    }
}
?>
<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/form.css" type="text/css">
<div class="body-content">
    <h1>ShowShouts</h1>
  <div class="module">
      <div class="header">
        <h2>Create an account</h2>
    </div>
    <form class="form" action="register.php" method="post" enctype="multipart/form-data" autocomplete="off">
      <!-- <div class="alert alert-error"> <?php $_SESSION['message'] ?> </div> -->
      <input type="text" placeholder="User Name" name="username" required />
      <input type="email" placeholder="Email" name="email" required />
      <input type="password" placeholder="Password" name="password" autocomplete="new-password" required />
      <input type="password" placeholder="Confirm Password" name="confirmpassword" autocomplete="new-password" required />
      <input type="submit" value="Register" name="register" class="btn btn-block btn-primary" />
      <p class="ahaa">Already have an account? <a href="login.php">Sign In</a></p>
    </form>
  </div>
</div>