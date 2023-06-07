<?php
require_once('db.php');
session_start();

// Array formatting
function formatcode($arr){
  echo '<pre>';
  print_r($arr);
  echo '</pre>';
}

// Select Statement for employee table
function selectAll(){
  global $mysqli;
  $data = array();
  $stmt = $mysqli->prepare('SELECT * FROM employees');
  $stmt -> execute();
  $result = $stmt->get_result();
  if($result->num_rows===0){
    $_SESSION['message']= array('type'=>'danger','msg'=>'There are currently no records in the database');
  }
  else{
    while($row = $result->fetch_assoc()){
      $data[] = $row;
    }
  }
  $stmt->close();
  return $data;
}

//Select single statement for employee table
function selectSingle($id=NULL){
  global $mysqli;
  $stmt = $mysqli->prepare('SELECT * FROM employees WHERE id =?');
  $stmt->bind_param('i',$id);
  $stmt -> execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  $stmt->close();
  return $row;

}

//Insert into employee table
function insert($fname =NULL,$lname=NULL,$phone=NULL){
  global $mysqli;
  $stmt = $mysqli->prepare('INSERT INTO employees (fname,lname,phone) VALUES (?,?,?)');
  $stmt->bind_param('sss',$fname, $lname,$phone);
  $stmt->execute();
  $stmt->close();
  $_SESSION['message']= array('type'=>'success','msg'=>'Successfully added a new employee');
  header("Location: ./update.php?id=$mysqli->insert_id");
  exit();
}

//update employee table
function update($fname =NULL,$lname=NULL,$phone=NULL, $id=NULL){
  global $mysqli;
  $stmt = $mysqli->prepare('UPDATE employees SET fname = ?,lname = ? ,phone = ? WHERE id = ?');
  $stmt->bind_param('sssi',$fname, $lname,$phone, $id);
  $stmt->execute();
  if($stmt->affected_rows===0) {
    $_SESSION['message']= array('type'=>'danger','msg'=>'You did not make any changes');
  }
  else{
    $_SESSION['message']= array('type'=>'success','msg'=>'Successfully updated the selected employee');
  }

  $stmt->close();

}

//delete employee table
function delete($id=NULL){
  global $mysqli;
  $stmt = $mysqli->prepare('DELETE FROM employees WHERE id = ?');
  $stmt->bind_param('i', $id);
  $stmt->execute();
  $stmt->close();
  $_SESSION['message']= array('type'=>'success','msg'=>'Successfully deleted the selected employee');
  header('Location: ./index.php');
  exit();
}

// Login Statement
function doLogin($username =NULL, $password=NULL){
  global $mysqli;

  //look for user id and active user
  $stmt = $mysqli->prepare('SELECT * FROM users WHERE username =? AND active = 1');
  $stmt -> bind_param('s', $username);
  $stmt -> execute();
  $result = $stmt->get_result();
  if($result->num_rows===0):
    $_SESSION['message']= array('type'=>'danger','msg'=>'Your account has not been enabled. Please contact an administrator');
  
  else:
    while($row = $result->fetch_assoc()){
      $hash =$row['password'];
      //password verification
      if(password_verify($password, $hash)):
      $_SESSION['user']['id'] = $row['id'];
      $_SESSION['user']['fname'] = $row['fname'];
      $_SESSION['user']['lname'] = $row['lname'];
      $_SESSION['user']['username'] = $row['username'];
      $_SESSION['user']['level'] = $row['level'];
      header('Location: ./index.php');
      else:
        $_SESSION['message']= array('type'=>'danger','msg'=>'Your username or password is incorrect. Please try again');
      endif;
  }
endif;
  $stmt->close();
}

// Logout statement
function doLogout(){
  unset($_SESSION['user']);
  $_SESSION['message']= array('type'=>'success','msg'=>'You have been successfully logged out');
  header('Location: ./login.php');
  exit();
}

/* select all users from users table */
function selectAllUsers() {
  global $mysqli;
  $data = array();
  $stmt = $mysqli->prepare('SELECT * FROM users');
  $stmt->execute();
  $result = $stmt->get_result();
  if($result->num_rows === 0):
      $_SESSION['message'] = array('type'=>'danger', 'msg'=>'There are currently no records in the database');
  else:
      while($row = $result->fetch_assoc()){
          $data[] = $row;
      }
  endif;
  $stmt->close();
  return $data; 
}
// Select single statement for users table
function selectSingleUser($id=NULL){
    global $mysqli;
    $stmt = $mysqli->prepare('SELECT * FROM users WHERE id =?');
    $stmt->bind_param('i',$id);
    $stmt -> execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
  
    $stmt->close();
    return $row;
  }
//   $password = password_hash($password,PASSWORD_DEFAULT);

// create user for users table
function createUser($username = NULL, $password = NULL, $fname = NULL, $lname = NULL, $active = NULL, $level = NULL){
  global $mysqli;
  $stmt = $mysqli->prepare('SELECT * FROM users WHERE username =?');
  $stmt -> bind_param('s', $username);
  $stmt -> execute();
  $result = $stmt->get_result();

  //check for username and if already exist throw error msg
  if($result->num_rows !==0):
    $_SESSION['message']= array('type'=>'danger','msg'=>'Username you chose is taken, Please try again');
  
  //if username not taken insert the new user into users table
  else:
  $password = password_hash($password,PASSWORD_DEFAULT);
  $stmt = $mysqli->prepare('INSERT INTO users (username, password, fname, lname, active, level) VALUES (?,?,?,?,?,?)');
  
  //if active is NULL assign '0' active variable
  if($active == NULL):
    $active = 0;
  endif;
  //if level is NULL assign '0' level variable
  if($level == NULL):
    $level = 0;
  endif;

  $stmt->bind_param('ssssii',$username, $password, $fname, $lname,$active, $level);
  $stmt->execute();
  $stmt->close();

  //handle flash message
  if(isset($_SESSION['user'])):
  $_SESSION['message']= array('type'=>'success','msg'=>'Successfully added a new user');
  header("Location: ./users.php");
  else:
    $_SESSION['message']= array('type'=>'success','msg'=>'You have successfully created a new user, once approved you can log in here.');
    header("Location: ./login.php");
  endif;
  exit();
endif;
}

//update user table
function updateUser($username,$fname =NULL,$lname=NULL,$active,$level,$id){
  global $mysqli;
  $stmt = $mysqli->prepare('UPDATE users SET username = ?,fname = ? ,lname = ?, active = ?, level=? WHERE id = ?');
  $stmt->bind_param('sssiii',$username, $fname, $lname,$active, $level, $id);
  $stmt->execute();
  if($stmt->affected_rows===0) {
    $_SESSION['message']= array('type'=>'danger','msg'=>'You did not make any changes');
  }
  else{
    $_SESSION['message']= array('type'=>'success','msg'=>'Successfully updated the selected employee');
  }
  $stmt->close();
  
}
?>