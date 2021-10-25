<?php
require_once('inc/connect.php');

$tabulka = htmlspecialchars($_POST["tabulka"]);


if( isset($_POST['tabulka']) ) {
//slozeni prikazu pro sql
$sql="delete from ".$tabulka.";";

if ($link->query($sql) === TRUE) {
  echo "Table ".$tabulka." deleted successfully";
} else {
  echo "Error: " . $sql . "<br>" . $link->error;
}

mysqli_close($link);
} else {
  echo "Tato stranka slouzi pro odmazani dat v DB a ma byt volana pouze pres ANSIBLE a ocekava POST parametr tabulka(proces/inventory)";
}
?>