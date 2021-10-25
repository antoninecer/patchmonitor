<html lang="en">
<head>
<meta charset="utf-8"/>
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
require_once('./inc/connect.php'); 



$celkem='select count(*) as celkem from inventory';
echo "<table>";
if($rcelkem = mysqli_query($link, $celkem)){
    if(mysqli_num_rows($rcelkem) > 0){
	    
            echo "<tr><th bgcolor='#03fce8'>Total</th></tr>";
		 while($row = mysqli_fetch_array($rcelkem)){
            echo "<tr><td>" . $row['celkem'] . "</td></tr>";
    }
}}    

$done='select done,count(*) as pocet from process group by done';	
echo "<br>";
if($rdone = mysqli_query($link, $done)){
    if(mysqli_num_rows($rdone) > 0){
            echo "<tr><th bgcolor='#03fce8'>done</th><th bgcolor='#03fce8'>Count</th></tr>";
		 while($row = mysqli_fetch_array($rdone)){
            echo "<tr><td>" . $row['done'] . "</td><td>".$row['pocet']."</tr>";
    }
}}    
echo "</table><br>";

// sql query muzu ovlivnit GET sql=
if( isset($_GET['sql']) ){
$w=" ".htmlspecialchars($_GET["sql"]);
} else {
$w='';
}     
// Attempt select query execution
$sql = "SELECT * FROM preview".$w;
// hostname  | curros | currkernel | currpatch | newkernel | newpatch | newos | stamp | done | discartedby | note   

if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table><tr>";
        echo "<th bgcolor='#03fce8'>Hostname</th>";
        echo "<th bgcolor='#03fce8'>OS</th>";
		echo "<th bgcolor='#03fce8'>Current Kernel</th>";
        echo "<th bgcolor='#03fce8'>Current Patch</th>";
        echo "<th bgcolor='#03f4fc'>New Kernel</th>";
		echo "<th bgcolor='#03f4fc'>New Patch</th>";
        echo "<th bgcolor='#03f4fc'>Done</th>";
		echo "<th bgcolor='#03f4fc'>Excluded</th>";
		echo "<th bgcolor='#03f4fc'>Excluded By</th>";
		echo "<th bgcolor='#03f4fc'>Note</th>";
		
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
            echo "<td>" . $row['curros'] . "</td>";
            echo "<td>" . $row['currkernel'] . "</td>";
            echo "<td>" . $row['currpatch'] . "</td>";
            echo "<td>" . $row['newkernel'] . "</td>";
            echo "<td>" . $row['newpatch'] . "</td>";
            echo $tr . $row['done'] . "</td>";
			echo "<td>" . $row['excluded'] . "</td>";
			echo "<td>" . $row['excludedby'] . "</td>";
			echo "<td>" . $row['note'] . "</td>";
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
