<?php
   require_once('./inc/connect.php');
   session_start();
    $error = "Please login - default user/user";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
       // username and password sent from form 
      $myusername =  htmlspecialchars($_POST["username"]);
	  $mypassword =  htmlspecialchars($_POST["password"]);
      
      $sql = "SELECT * FROM users WHERE username = '".$myusername."' and password = '".$mypassword."'";
	  // echo $sql;
      
      $result = mysqli_query($link,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $id = $row['id'];
	  $admin = $row['admin'];
	  
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         $_SESSION['login_user'] = $myusername;
         $_SESSION['user_id'] = $id;
		 $_SESSION['admin'] = $admin;
		 
         header("location: show.php");
      }else {
         $error = "Your Login Name or Password is invalid +";
      }
   }
?>
<html>
   
   <head>
      <title>Login Page</title>
      <meta charset="UTF-8">
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
			 <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
				
            </div>
				
         </div>
			
      </div>

   </body>
</html>