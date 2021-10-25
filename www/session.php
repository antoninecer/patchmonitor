<?php
   require_once('./inc/connect.php');
   
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
   $user_check = $_SESSION['login_user'];
   $ses_sql = mysqli_query($link,"select username from users where username = '".$user_check."';");
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   $login_session = $row['username'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
      die();
   }
?>