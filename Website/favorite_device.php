<?php
require 'config.php';
if (isset($_SESSION['email']) && isset($_GET['id']) && isset($_GET['favorite']) && isset($_GET['return'])) {
  if (!($stmt = $mysqli->prepare("SELECT * FROM users WHERE email=?;"))) {
    echo '<div class="text-danger font-italic">('.$mysqli->errno.") " . $mysqli->error.'</div>';
  }
  $stmt->bind_param("s", $_SESSION['email']);
  if (!$stmt->execute()) {
    echo '<div class="text-danger font-italic">'.$stmt->error.'</div>';
    exit();
  }
  $user = $stmt->get_result()->fetch_assoc();
  $stmt->close();
  if (!($stmt = $mysqli->prepare("UPDATE devices SET favorite = ? WHERE device_id = ?;"))) {
    echo '<div class="text-danger font-italic">('.$mysqli->errno.") " . $mysqli->error.'</div>';
  }
  $stmt->bind_param("ii", $_GET['favorite'], $_GET['id']);
  if (!$stmt->execute()) {
    echo '<div class="text-danger font-italic">'.$stmt->error.'</div>';
    exit();
  }
  $stmt->close();
  if ($_GET['return'] == 0) {
    header('Location: edit_device.php?id='.$_GET['id']);
  } else {
    header('Location: devices.php');
  } 
}
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
<body>  <nav class="navbar navbar-expand-sm navbar-light navbar-custom ">
  <div class="container-fluid"> 
    <a class="navbar-brand text-white" href="index.php">Smart Home</a>
    <button class="navbar-toggler" id="dropdown" type="button" data-toggle="collapse" data-target="#navbar-toggler" aria-controls="navbar-toggler" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars text-white"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbar-toggler">
      <div class="navbar-nav mr-auto">
        <a class="nav-item nav-link text-white" id="house-link" href="household.php">Households</a>
        <a class="nav-item nav-link text-white active" id="device-link" href="devices.php">Devices</a>
        <a class="nav-item nav-link text-white" id="routine-link" href="routines.php">Routines</a>
      </div>
      <div class="navbar-nav ml-auto">
        <form action="user.php" method="post" id="myForm">
          <input style="display:none;" type="text" name="email" id="user_email" />
          <input style="display:none;"  type="text" name="google_id" id="user_id"/>
          <a href="#" id="submit_user" class="nav-item nav-link text-white" onclick="document.getElementById('myForm').submit();">User</a>
        </form>
        <div class="nav-item g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
        <a class="nav-item nav-link text-white" id="signout" href="#">Logout</a>
      </div>
    </div>
  </div>
</nav>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script src="https://kit.fontawesome.com/aad48dc15b.js" crossorigin="anonymous"></script>
<script src="https://apis.google.com/js/platform.js"></script>
</body>
</html>