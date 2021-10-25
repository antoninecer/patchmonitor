<?php
if ( isset($_POST['hostname']) ) {
  $hostname = $_POST['hostname'];
}
if ( isset($_GET['hostname']) ) {
  $hostname = $_GET['hostname'];
}
if (isset($hostname)){ 
    require_once('inc/connect.php');
    //fetch table rows from mysql db
    $sql = "select excluded from exclude where hostname ='".$hostname."';";
	//echo $sql;
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
	      while($row = mysqli_fetch_array($result)){
			if ($row['excluded'] == '1') {
				echo "1";
			}
		  }
        } 
        else{
     echo "0";
}
} else { 
    echo "problem s SQL";
}
}
else {
 echo "Tato stranka slouzi pro vyziskani logicke 1 nebo 0 jestli je na tento PC vyjimka pro patchovani, samozrejme pokud je bud GET nebo POST zaslan hostname";
}

 
// Close connection
mysqli_close($link);

?>