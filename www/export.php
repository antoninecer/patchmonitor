<?php
    require_once('inc/connect.php');
    //fetch table rows from mysql db
    $sql = "select * from preview";
    if($result = mysqli_query($link, $sql)){
        //create an array
        $emparray = array();
        while($row = mysqli_fetch_assoc($result)){
			$emparray[] = $row;
        }
        echo json_encode($emparray);
		//mysqli_free_result($result);
        } 
        else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);

?>
