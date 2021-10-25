<?php
require_once('inc/connect.php');
$error="Add Exception";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST") {
date_default_timezone_set('Europe/Prague');
$hostname =  htmlspecialchars($_POST["hostname"]);
$excludedby = $_SESSION['login_user'];
$note = htmlspecialchars($_POST["note"]);
$datum = date('Y-m-d H:i:s');


if( isset($_POST['hostname']) ) {
//slozeni prikazu pro zjisteni jestli zaznam jiz existuje
$jetu="select * from exclude where hostname ='".$hostname."'";
// slozeni zaznamu pro zapis
$sql="insert into exclude (hostname,excluded,excludedby,note,stamp) values ('".$hostname."',True,'".$excludedby."','".$note."','".$datum."');";
if($kontrola = mysqli_query($link, $jetu)){
  if(mysqli_num_rows($kontrola) > 0){
    mysqli_free_result($kontrola);
    $sql="update exclude set excluded=True, excludedby='".$excludedby."', note='".$note."', stamp='".$datum."' where hostname='".$hostname."';";
  }
} else{
echo "ERROR: Could not able to execute". mysqli_error($link);
}
// vlozeni/update zaznamu do db
if ($link->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $link->error;
}

mysqli_close($link);
} else {
  echo "Tato stranka slouzi pro vkladani dat do DB o patchi  ma byt volana pouze pres ANSIBLE a ocekava POST parametry hostname, excludedby, note";
}
}
?>

<html>
   
   <head>
      <title>Add Exception</title>
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
 
  if (($_SESSION['admin'] == 'Y') || ($_SESSION['admin'] == 'S')) {
	//echo "Loged as Superuser or Admin";
   } else {
	   	header("Location: logout.php");
   }

   
   include('menu.php');   ?>
	<br>
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Add Exception</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>Hostname  :</label><input type = "text" name = "hostname" class = "box"/><br /><br />
                  <label>Note  :</label><textarea  name = "note" rows="3" cols="30" maxlength="255" style="resize: none;"></textarea><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
			 <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
				
            </div>
				
         </div>
			
      </div>

   </body>
</html>