<?php
  //turn on error reporting
  ini_set('displayerrors', 1);
  error_reporting(E_ALL);

  //star session
  session_start();

  //if the form is submitted
  $err = false;
  if($_SERVER['REQUEST_METHOD']=='POST'){
    //get user & pass
    $username=strtolower(trim($_POST['username']));
    $password = $_POST['password'];
    require("includes/user.php");
    if($username == $adminUser && $password = $adminPassword){
      $_SESSION['loggedin'] = true;

      //Redirect to page the user was on, or index page
      if (!isset($_SESSION['page'])) {
        $_SESSION['page'] = 'index.php';
      }
      header("location: " . $_SESSION['page']);
    }

    //set error flag
    $err = true;

  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- meta tags -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <!-- title -->
  <title>Guestbook</title>
  <!-- bootstrap css -->
  <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" media="screen">
  <!-- jQuery Data Tables css -->
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
  <!-- custom css -->
  <link rel="stylesheet" href="css/admin-style.css">
  <link rel="icon" type="image/png" href="images/favicon.png" sizes="16x16">
</head>

<body>
<!-- Main container -->
<div class="container w-25 py-3 bg-dark" id="main">
  <div class="row justify-content-center">
    <a class="btn btn-primary" href="index.html">Go To Guestbook</a>
  </div>
</div>

<!-- Table Container -->
<div class="container py-4 mt-5 w-25 bg-dark justify-content-center">
  <?php

  ?>
  <form action="#" method="post">
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" id="username" name="username">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" name="password">
    </div>

    <?php if ($err) : ?>
      <span class="err text-light">Incorrect login</span><br>
    <?php endif; ?>

    <button type="submit" class="btn btn-primary mt-2">Login</button>
  </form>
</div>
<!-- /container -->

<!-- scripts -->
<script src="js/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/popper.min.js"></script>
</body>
</html>