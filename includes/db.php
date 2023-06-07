<?php
  $mysqli = new mysqli("localhost","root","","devdrawer");
  if($mysqli->connect_error){
    exit('Error connecting to database');
  }
?>