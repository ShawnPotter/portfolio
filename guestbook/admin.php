<?php
  //turn on error reporting
  ini_set('displayerrors', 1);
  error_reporting(E_ALL);

  session_start();

  require('includes/database.php');
  require('includes/checkLogin.php');
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
<div class="container-fluid pt-2 bg-dark" id="main">
  <div class="row">
    <div class="col">
      <a class="btn btn-primary" href="index.html">Go To Guestbook</a>
    </div>
    <div class="col d-flex flex-column align-items-end">
      <a class="btn btn-warning" href="logout.php">Logout</a>
    </div>
  </div>
</div>

<!-- Table Container -->
<div class="container-fluid bg-dark justify-content-center" id="table-container">



  <h1>Guestbook Entries</h1>
  <table id="guestbook-table" class="display responsive">
    <thead>
    <tr>
      <td>Name</td>
      <td>Job Title</td>
      <td>LinkedIn URL</td>
      <td>Email</td>
      <td class="px-5">How We Met</td>
      <td class="w-25">Other (Descrip)</td>
      <td >Mail List?</td>
      <td >Mail Format</td>
      <td class="px-5">Date Received</td>
    </tr>
    </thead>
    <tbody>
    <?php
    $sql = "SELECT * FROM guestbook";
    $result = mysqli_query($cnxn, $sql);
    //var_dump($result);
    foreach($result as $row){
        //var_dump($row);
        $fname = $row['firstName'];
        $lname = $row['lastName'];
        $title = $row['title'];
        $linkedin = $row['linkedin'];
        $email = $row['email'];
        $meetType = $row['meetType'];
        $other = $row['other'];
        $mailingList = $row['mailingList'];
        $mailFormat = $row['mailFormat'];
        $date = date("M d, Y g:i a", strtotime($row['date']) );

        echo "<tr>";
        echo "<td>$fname $lname</td>";
        echo "<td>$title</td>";
        echo "<td>$linkedin</td>";
        echo "<td>$email</td>";
        echo "<td>$meetType</td>";
        echo "<td>$other</td>";
        echo "<td>$mailingList</td>";
        echo "<td>$mailFormat</td>";
        echo "<td>$date</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
  </table>
</div>
<!-- /container -->

<!-- scripts -->
<script src="js/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/table.js"></script>
</body>
</html>