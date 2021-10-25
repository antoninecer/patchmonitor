<?php
	include('session.php');
	require_once('inc/connect.php');
    session_start();
	$navrat=FALSE;
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$stranka = 'users.php';
		if ($_SESSION['admin'] == 'Y') {
			//$hash = md5($_POST["password"]);
			$sql = "update users set password ='".$_POST["password"]."' where id = ".$_GET['id'];
			if ($link->query($sql) === TRUE) {
				echo "Record updated successfully";
			} else {
				echo "Error update record: " . $link->error;
			}
		$navrat=TRUE;
		}
	}
?>
<html>  
   <head>
      <?php if($navrat) { header('Location: '.$stranka);} ?>
   </head>
   <body>   
		<?php
		include('servicemenu.php');
		?>
		<h1 align="center">Change password </h1>
		<?php
		$sql = "SELECT id, username, admin FROM users where id = ".$_GET['id'];
		$result = $link->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
			$user = $row["id"]. " : " . $row["username"];
			echo "<center><h2>".$user."</h2></center> <br>";
			}
		}	
		?>
		<div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Change password</b></div>
				
            <div style = "margin:30px">
               <form action = "" method = "post">
					<label>New Password:</label><input type = "password" name = "password" class = "box"/><br /><br />
					<input type = "submit" value = " Update "/><br />
               </form>
            </div>
         </div>
      </div>
   </body>   
</html>