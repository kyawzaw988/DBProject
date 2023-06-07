<?php
  include('includes/functions.php');
  if(isset($_POST['btnUpdateUser'])):
    $username = $_POST['username'];
    // $password = $_POST['password'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $active = $_POST['active'];
    $level = $_POST['level'];
    $id = $_POST['id'];
    updateUser($username,$fname,$lname,$active,$level,$id);
  endif;
  $user = (isset($_GET['id'])) ? selectSingleUser($_GET['id']) : false;

  $activeArr = array( 0 =>'Inactive', 1 =>'Active');
  $levelArr = array(0 =>'0 - View Only', 1 =>'1 - Admin');
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
  <h1><em class="fa fa-user"></em> Users</h1>
<form action="" method="post" class = "register">
          <input type="hidden" value = "<?php echo $_GET['id']; ?>" name = "id">
          <div class="row">
            <div class="col-md-6">
            <label for="fname">First Name</label>
          <input type="text" name = "fname" id="fname" class= "form-control" value="<?php echo $user['fname']?>">
          <br>
            </div>
            <div class="col-md-6">
            <label for="lname">Last Name</label>
          <input type="text" name = "lname" id="lname" class= "form-control" value="<?php echo $user['lname']?>">
          <br>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
            <label for="level">Level</label>
          <select type="text" name = "level" id="level" class= "form-control">
            <?php
                foreach($levelArr as $key => $level) : 
                  if($key == $user['level']):
                    $selected = ' selected';
                  else:
                    $selected = '';
                  endif;
                  echo '<option value="'.$key.'"'.$selected.'> '.$level.'</option>';
                endforeach;
            ?>
            <!-- <option value="0">0 - Ready Only</option>
            <option value="1">1 - Admin</option> -->
          </select>
          <br>
            </div>
            <div class="col-md-6">
            <label for="active">Active</label>
          <select type="text" name = "active" id="active" class= "form-control">
          <?php
                foreach($activeArr as $key => $active) : 
                  if($key == $user['active']):
                    $selected = ' selected';
                  else:
                    $selected = '';
                  endif;
                  echo '<option value="'.$key.'"'.$selected.'> '.$active.'</option>';
                endforeach;
            ?>
          <!-- <option value="0" selected>0 - Inactive</option>
            <option value="1">1 - Active</option> -->
          </select>
          <br>
            </div>
          </div>
          <label for="username">Username</label>
          <input type="text" name = "username" id="username" class= "form-control" value="<?php echo $user['username']?>" readonly>
          <br>
<!--     
          <label for="password">Password</label>
          <input type="password" name = "password" id="password" class= "form-control">
          <br> -->
          <button name ="btnUpdateUser" class ="btn btn-primary">Update</button>
      
          <a href="./users.php"class="col-md-11">Cancel</a>
          <a href="#" class="col-md-11">Reset Password</a>
        </form>
</div> 

  <?php include('theme/footer-scripts.php'); ?>
</body>
</html>