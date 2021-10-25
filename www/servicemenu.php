<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="styles.css">
   <script src="jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
   <title>Menu</title>
</head>
<body>

<div id='cssmenu'>
<ul>
   <li ><?php echo "<b><i>".$_SESSION['login_user']."</b>";?></i></li>
   <li><a href = "show.php"> Show servers </a></li>
   <li><a href = "out.php"> Other servers </a></li>
      <?php 
   if ($_SESSION['admin'] == 'Y') {
		echo "<li>"."<a href='removeprocess.php'>Remove Process</a></li>";
		echo "<li>"."<a href='removeinventory.php'>Remove Inventory</a></li>"; 
		echo "<li>"."<a href='massdelete.php'>Mass Deletion</a></li>";
		echo "<li>"."<a href='users.php'>Users</a></li>";
   }
?>
   <li><a href = "logout.php"> Sign Out </a></li>
</ul>
</div>
<?php
if (isset($_SESSION['error'])) {echo $_SESSION['error'];
$_SESSION['error'] = ""; }
?>
</body>
<html>