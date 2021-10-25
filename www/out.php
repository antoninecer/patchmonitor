<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
</head>
<body>
<?php 
include('session.php');
include('menu.php'); 
require_once('inc/connect.php'); 
// sql query muzu ovlivnit GET sql=
if( isset($_GET['sql']) ){
$w=" ".htmlspecialchars($_GET["sql"]);
} else {
$w='';
}     
   
// Attempt select query execution
$sql = "select * from process where hostname not in( select hostname from inventory)".$w;
// id | hostname           | os       | kernel                      | patchlevel | done | stamp     
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table><tr>";
        echo "<th bgcolor='#03fce8'>Hostname</th>";
        echo "<th bgcolor='#03fce8'>OS</th>";
		echo "<th bgcolor='#03fce8'>Current Kernel</th>";
        echo "<th bgcolor='#03fce8'>Current Patch</th>";
        echo "<th bgcolor='#03f4fc'>Done</th>";
		 echo "<th bgcolor='#03f4fc'>TimeStamp</th>";
			
        echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            if ($row['done'] == 'YES') { 
            $tr="<td bgcolor='#03fc4e'>";
            } 
            elseif ($row['done'] == 'obsolete') { 
            $tr="<td bgcolor='#EA7AEB'>";
            } 
            else { 
            $tr= "<td bgcolor='#fcdb03'>";
            }
            echo "<tr>";          
            echo "<td>" . $row['hostname'] . "</td>";
            echo "<td>" . $row['os'] . "</td>";
            echo "<td>" . $row['kernel'] . "</td>";
            echo "<td>" . $row['patchlevel'] . "</td>";
            echo $tr . $row['done'] . "</td>";
			echo "<td>" . $row['stamp'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>
</body>
