<?php

// Clear browser cache
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");


  if(!isset($_SESSION['user'])){
    header('Location: ./login.php');
    exit();
  }
?>

<!-- Showing user name -->
<?php

  $loggedInuser= selectSingleuser($_SESSION['user']['id']);
  $welcome = 'Welcome, '.$loggedInuser['fname']. ' '.$loggedInuser['lname']. '(<a href="./logout.php">Logout</a>)';
?>
<?php if(isset($_SESSION['message'])):?>
    <div class="alert alert-<?php echo $_SESSION['message']['type'];?>" role="alert">
    <?php echo $_SESSION['message']['msg'];?>
  </div>
    <?php unset($_SESSION['message']);?>
  <?php endif; ?>

  <div class="card">
    <div class="card-body">
<header>
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <img src="./images/logo.svg" class="img-fluid">
      </div>
      <div class="col-md-11 text-right">
        <nav>
          <ul>
            <li><a href="/DBProject">Dashboard</a></li>
            <li><a href="/DBProject/create.php">New Employee </a></li>
            <li><a href="/DBProject/users.php">Users </a></li>
            <li><?php echo $welcome?></li>
          </ul>
        </nav>
      </div>
    </div>
    </div>
</header>