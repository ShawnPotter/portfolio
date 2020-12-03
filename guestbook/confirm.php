<?php
//turn on error reporting
ini_set('displayerrors', 1);
error_reporting(E_ALL);
if(empty($_POST)){
  header("location: index.html");
}

require('includes/database.php');
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
    <!-- custom css -->
    <link rel="stylesheet" href="css/guestbook-style.css">
    <link rel="icon" type="image/png" href="images/favicon.png" sizes="16x16">
</head>

<body>
<!-- Main container -->
<div class="container bg-dark py-3 vh-100" id="main">

    <header class="jumbotron bg-darker">
        <div class="container-fluid">
            <h1 class="display-4">Thank you for reaching out!</h1>
        </div>
    </header>

    <div class="w-50 mx-auto justify-content-center" id="thankyou">
        <?php
//          $debug = $_POST["meetType"];
//          echo "<h1>$debug</h1>";

          function validString($string){
            return !empty($string);
          }
          function validEmail($email){
            return filter_var($email, FILTER_VALIDATE_EMAIL);
          }

          //data valid
          $isValid = true;

          //validate first name
          if(validString($_POST['fName'])){
            $first = $_POST['fName'];
          } else{
            echo "<p>Invalid first name</p>";
            $isValid = false;
          }

          //validate last name
          if(validString($_POST['lName'])){
            $last = $_POST['lName'];
          } else{
            echo "<p>Invalid last name</p>";
            $isValid = false;
          }

          //validate that their title, if entered is valid
          if(empty($_POST['title'])){
            $title = $_POST['title'];
          } else if (!empty($_POST['title']) and preg_match("/^[a-z\d\-_\s]+$/i", $_POST['title'])){
            $title = $_POST['title'];
          } else {
            echo "<p>Invalid title</p>";
            $isValid = false;
          }
          //validate that the linkedin link is correct
          if(strpos($_POST["linkedIn"], "https://www.linkedin.com/in/") !== false or
            strpos($_POST["linkedIn"], "http://www.linkedin.com/in/") !== false ){
            $linkedin = $_POST["linkedIn"];
          } else if(empty($_POST["linkedIn"])){
            $linkedin = $_POST["linkedIn"];
          } else {
            echo "<p>Invalid social media link</p>";
            $isValid = false;
          }

          //valid whether the email is valid if it is entered
          if(!empty($_POST['email']) and validEmail($_POST['email']))
            $email = $_POST['email'];
          else if(empty($_POST['email']))
            $email = $_POST['email'];
          else {
            echo "<p>Invalid email</p>";
            $isValid = false;
          }

          //validate the meeting type
          if(
                  ($_POST["meetType"] == "meetup") ||
                  ($_POST["meetType"] == "job fair") ||
                  ($_POST["meetType"] == "none") ||
                  ($_POST["meetType"] == "other")
          ){
            $meetType = $_POST["meetType"];
          } else{
            echo "<p>Invalid met type</p>";
            $isValid = false;
          }

          //validate the other textarea
          if($_POST["meetType"] == "other" and
              empty($_POST["otherDescription"])){
            echo "<p>Invalid Meeting Other Description</p>";
            $isValid = false;
          } else
            $other = $_POST["otherDescription"];





          //$title = $_POST['title'];
          //$linkedin = $_POST["linkedIn"];
          //$email = $_POST['email'];
          //$meetType = $_POST["meetType"];
          //$other = $_POST["otherDescription"];
          $mailFormat = NULL;

          if(isset($_POST["addToList"]) and empty($_POST['email'])){
            echo "<p>If adding to mail list email must be entered.</p>";
            $isValid = false;
          }



          if(isset($_POST["addToList"])){$mailingList = "yes";}
          else{$mailingList = "no";}

          if(isset($_POST["addToList"]) && isset($_POST["mailHtml"])){$mailFormat = "html";}
          elseif (isset($_POST["addToList"]) && isset($_POST["mailText"])){$mailFormat = "text";}

          //prevent sql injection
          $first = mysqli_real_escape_string($cnxn, $first);
          $last = mysqli_real_escape_string($cnxn, $last);
          $title = mysqli_real_escape_string($cnxn, $title);
          $linkedin = mysqli_real_escape_string($cnxn, $linkedin);
          $email = mysqli_real_escape_string($cnxn, $email);
          $meetType = mysqli_real_escape_string($cnxn, $meetType);
          $other = mysqli_real_escape_string($cnxn, $other);
          $mailingList = mysqli_real_escape_string($cnxn, $mailingList);
          $mailFormat = mysqli_real_escape_string($cnxn, $mailFormat);

          $sql = "INSERT INTO guestbook(firstName, lastName, title, linkedin, email, meetType, other, mailingList, mailFormat)
                  VALUES ('$first', '$last','$title','$linkedin','$email','$meetType','$other','$mailingList','$mailFormat')";




          if($isValid == true){
            $success = mysqli_query($cnxn, $sql);


            echo "<p>Name: $first $last</p>";
            echo "<p>Title: $title</p>";
            echo "<p>LinkedIn URL: $linkedin</p>";
            echo "<p>Email: $email</p>";
            echo "<p>How we met: $meetType</p>";
            echo "<p>Other (if appliciable): $other</p>";
            echo "<p>Add to Mailing List: $mailingList</p>";
            echo "<p>Format for Mailing List: $mailFormat</p>";

            echo "<p>I'll be in contact with you soon $first $last!</p>";
          }
          if(!$success){
            echo "<p>There was an error...</p>";
            return;
          }

        ?>
    </div>

</div>
<!-- /container -->

<!-- scripts -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/popper.min.js"></script>
</body>
</html>