<?php
  include('includes/functions.php');
  $allEmployees = selectAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Document</title>
  <?php include('theme/header-scripts.php'); ?>  
  
</head>
<body>
  <?php include('theme/header.php');?>
  <div class="container-fluid">
  <h1><em class="fa fa-check-circle"></em> Welcome to DevDrawer</h1>
  <table class ="table table-striped datatable">
    <thead>
      <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Phone</th>
        <th></th>
      </tr>
</thead>
</table>
  </div>

  <?php include('theme/footer-scripts.php'); ?>
</body>
</html>