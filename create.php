<?php
require_once('includes/functions.php');
if(isset($_POST['btnInsert'])) :
insert($_POST['fname'],$_POST['lname'],$_POST['phone']);
endif;
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
<?php include('theme/header.php'); ?>
  <h1><i class="fa fa-plus-square"></i>Insert </h1>
  <div class="container-fluid">
  <form action="" method="post" class="form">
    <div class="row">
      <div class="col-md-6">
      <label for="fname">First Name</label>
    <input type="text" name ="fname" class = "form-control" id = "fname">
    <br>
      </div>
      <div class="col-md-6">
      <label for="lname">Last Name</label>
    <input type="text" name ="lname" class = "form-control" id = "lname">
    <br>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
      <label for="phone">Phone Number</label>
    <input type="text" name ="phone" class = "form-control phone" id = "phone">
    <br>
      </div>
    </div>

    <button name="btnInsert" class="btn btn-primary">Insert Record</button>
    </div>
    <?php include('theme/footer-scripts.php'); ?>
  </form>
</body>
</html>