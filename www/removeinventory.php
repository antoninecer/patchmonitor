<?php
require_once('inc/connect.php');
$error="Remove server from inventory";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST") {
date_default_timezone_set('Europe/Prague');
$hostname =  htmlspecialchars($_POST["hostname"]);
$excludedby = $_SESSION['login_user'];
$note = htmlspecialchars($_POST["note"]);
$datum = date('Y-m-d H:i:s');


if( isset($_POST['hostname']) ) {

$sql="delete from inventory where hostname ='".$hostname."';";
if ($link->query($sql) === TRUE) {
			echo "Record deleted successfully";
			$_SESSION['error'] = $hostname." deleted from inventory table";
		} else {
			echo "Error deleting record: " . $db->error;
		}	 

mysqli_close($link);
} else {
  echo "Tato stranka slouzi pro manipulaci dat o patchovanych serverech a ma byt volana pouze pres program";
}
}
?>

<html>
   
   <head>
      <title>Remove from inventory</title>
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
   <?php include('session.php');
   if ($_SESSION['admin'] != 'Y') {
      header("Location: logout.php");
   }
   
   include('servicemenu.php');   ?>
      <br>	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Remove from Inventory</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>Hostname  :</label><input type = "text" name = "hostname" class = "box"/><br /><br />
                  
                  <input type = "submit" value = " Submit "/><br />
               </form>
			 <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
				
            </div>
				
         </div>
			
      </div>

   </body>
</html>