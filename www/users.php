<?php
	include('session.php');
	require_once('inc/connect.php');
	
	
	if ($_SESSION['admin'] == 'Y') {
		$error = "Add user";
        	



	} else {
		$error = "You are not Administrator!";
	}
	
    
	if($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_SESSION['admin'] == 'Y' || $_POST['typ'] == "ADD" ) {
		$sql = "insert into users ( username, password, admin) values ('".$_POST['username']."','".$_POST['password']."','".strtoupper($_POST['admin'])."');";
		//echo $sql;
		
		if ($link->query($sql) == TRUE) {
			$_SESSION['error'] =  "New record created successfully";
		} else {
			$_SESSION['error'] = "Error: ". $link->error;
		}
	} 
    }
?>
<html>  
   <head>
      <title>Add new user</title>
	  <meta charset="UTF-8">
   </head>
   <body>   
      <?php include('servicemenu.php'); ?>
	  <h2 align="center">Users</h2>
	   <?php
	   $radek = 0;
	   echo "<table align='center' border=0>";
	   echo "<tr style='background-color: #e0e0eb'><td>Username</td><td>Rights</td><td>Password</td><td>Delete</td></tr>";
   
	
		$sql = "SELECT id, username, admin FROM users order by username";
		$result = $link->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$radek = $radek + 1;
				if ($radek % 2 == 0) { 
				  echo "<tr style='background-color: #f0f0f5'>"; 
				  } 
				else {  
				  echo "<tr style='background-color:  #ffffff'>";
				  }
				echo "<td>".$row["username"]."</td>";
				echo "<td>";
				switch ($row["admin"]) {
					case 'N':
						echo "User";
						break;
					case 'Y':
						echo "Administrator";
						break;
					case 'S':
						echo "Super User";
						break;
				}
				echo "</td>";
				//echo "<td>".$row["admin"]."</td>";
				echo "<td><a href='userpwd.php?id=".$row["id"]."'><img src='img/edit16.png' title='Password'></a></td>";
				echo "<td>";
				if ($row["username"] == $_SESSION['login_user']) {
					echo "<img src='img/user16.png' title='Cannot delete itself' >";
					} 
				else { 
				    echo "<a href='userdel.php?id=".$row["id"]."'><img src='img/delete16.png' title='Delete'</a>";
					}
				echo "</td>";
				echo "</tr>";
				}	
		}
		?> 
	</table>
	 <hr> 
		 <div align = "center">
         <div style = "width:330px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b> Add new user </b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
			    <table border="0" cellpadding="1" cellspacing="1" >
				 <tr>
                  <td align="right">Username :</td><td align="left"><input type = "text" name = "username" /></td>
				 </tr><tr> 
                  <td align="right">Password :</td><td align="left"><input type = "password" name = "password" /></td>
				 </tr><tr> 
				  <input type="hidden" name="typ" value="ADD">
				  <td align="right">User Rights :</td><td align="left">
				  <select name="admin" id="admin" align="right">
					<option value="Y">Administrator</option>
					<option value="S" selected>Super User</option>
					<option value="N">Normal User </option>
				  </select>
                  </td></tr>
				  
				  <tr><td/><td align="right"><input type = "submit" value = " Submit "/>
				  </td></tr>
				  </table>
               </form>
			 <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
				
            </div>
				
         </div>
			
      </div>	  
   </body>
   
</html>




