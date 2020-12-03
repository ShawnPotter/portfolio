<?php
  if(!isset($_SESSION['loggedin'])){
    //store page current on in session array
    $_SESSION['page'] = $_SERVER['SCRIPT_URI'];

    //redirect to login page
    header("location: login.php");
  }