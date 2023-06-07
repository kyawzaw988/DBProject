<?php
require_once('includes/functions.php');
$user = array();
if(isset($_GET['id'])){
  $user = $_GET['id'];
  delete($user);
}else{
  exit();
}
?>