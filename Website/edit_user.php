<?php
require 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="google-signin-client_id" content="1076189564255-qov3gglu390cab0ovg7a82msegai63fk.apps.googleusercontent.com">
  <title>Smart Home System</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/custom-style.css">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
</head>
<body onload="if (document.forms['myForm'] != null) {document.forms['myForm'].submit();}">  <nav class="navbar navbar-expand-sm navbar-light navbar-custom ">
  <div class="container-fluid"> 
    <a class="navbar-brand text-white" href="index.php">Smart Home</a>
    <button class="navbar-toggler" id="dropdown" type="button" data-toggle="collapse" data-target="#navbar-toggler" aria-controls="navbar-toggler" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars text-white"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbar-toggler">
      <div class="navbar-nav mr-auto">
        <a class="nav-item nav-link text-white" id="house-link" href="household.php">Households</a>
        <a class="nav-item nav-link text-white" id="device-link" href="devices.php">Devices</a>
        <a class="nav-item nav-link text-white" id="routine-link" href="routines.php">Routines</a>
      </div>
      <div class="navbar-nav ml-auto">
        <form action="user.php" method="post" id="myForm">
          <input style="display:none;" type="text" name="email" id="user_email" />
          <input style="display:none;"  type="text" name="google_id" id="user_id"/>
          <a href="#" id="submit_user" class="nav-item nav-link text-white active" onclick="document.getElementById('myForm').submit();">User</a>
        </form>
        <div class="nav-item g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
        <a class="nav-item nav-link text-white" id="signout" href="#">Logout</a>
      </div>
    </div>
  </div>
</nav>
<div class="body">
  <?php 
  if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['id']) && isset($_POST['avatar']) && isset($_POST['adafruit_key']) && isset($_POST['adafruit_user'])) {
    $stmt = $mysqli->prepare("UPDATE users SET name = ?, email = ?, avatar_url = ?, adafruit_io_key = ?, adafruit_io_user = ? WHERE user_id=?;");
    if (!$stmt->bind_param("sssssi", $_POST['name'], $_POST['email'], $_POST['avatar'], $_POST['adafruit_key'], $_POST['adafruit_user'], $_POST['id'])) {
      echo "(" . $stmt->errno . ") " . $stmt->error;
    }
    
    if (!$stmt->execute()) {
      echo '<div class="text-danger font-italic">'.$stmt->error.'</div>';
      exit();
    } else {
      echo '<div class="text-success">'.$_POST['name'].'\'s account was successfully editted.</div>';
      echo '<script> sessionStorage.setItem("email", "' . $_POST['email'] . '");</script>';
    }
    $stmt->close();
  } else {
    echo '<div class="text-danger font-italic">Missing Parameters</div>';
  }
  $mysqli->close();

  ?>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script src="https://kit.fontawesome.com/aad48dc15b.js" crossorigin="anonymous"></script>
<script src="https://apis.google.com/js/platform.js"></script>
</body>
</html>