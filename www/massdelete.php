<?php
require_once('inc/connect.php');
$error="Be carefull -  use this option only when you know what you are doing !!!";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST") {

echo "<table>";
    foreach ($_POST as $key => $value) {
        echo "<tr>";
        echo "<td>";
        echo $key;
        echo "</td>";
        echo "<td>";
        echo $value;
        echo "</td>";
        echo "</tr>";
    }
echo "</table>";

date_default_timezone_set('Europe/Prague');
$datum = date('Y-m-d H:i:s');


if( isset($_POST['Clear_Inventory']) || isset($_POST['Clear_Process']) || isset($_POST['Clear_Exception']))
 {
  if ( isset($_POST['Clear_Inventory']))
  {
	$sql="delete from inventory;";
    if ($link->query($sql) === TRUE) {
			echo "Records deleted successfully";
			$_SESSION['error'] = " delete from inventory;";
		} else {
			echo "Error deleting record: " . $link->error;
		}	 
  }	
  if ( isset($_POST['Clear_Process']))
  {
	$sql="delete from process;";
    if ($link->query($sql) === TRUE) {
			echo "Records deleted successfully";
			$_SESSION['error'] = " delete from process;";
		} else {
			echo "Error deleting record: " . $link->error;
		}	 
  }	
  if ( isset($_POST['Clear_Exception']))
  {
	$sql="delete from exclude;";
    if ($link->query($sql) === TRUE) {
			echo "Records deleted successfully";
			$_SESSION['error'] = " delete from exclude";
		} else {
			echo "Error deleting record: " . $link->error;
		}	 
  }	

mysqli_close($link);
} else {
  echo "Tato stranka slouzi pro manipulaci dat o patchovanych serverech a ma byt volana pouze pres program";
}
}
?>

<html>
   
   <head>
      <title>Mass Deletion</title>
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
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Mass Deletion</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">       
				  <input type="radio" id="Clear_Inventory" name="Clear_Inventory" value="Clear_Inventory">
				  <label for="Clear_Inventory">Clear_Inventory</label><br>
				  <input type="radio" id="Clear_Process" name="Clear_Process" value="Clear_Process">	
				  <label for="Clear_Process">Clear_Process</label><br>
				  <input type="radio" id="Clear_Exception" name="Clear_Exception" value="Clear_Exception">	
				  				  <label for="Clear_Exception">Clear_Exception</label><br>
                  <input type = "submit" value = "submit"/><br />
				                 </form>
			 <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
				
            </div>
				
         </div>
			
      </div>

   </body>
</html>
