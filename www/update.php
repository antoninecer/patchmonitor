<?php
require_once('inc/connect.php');

date_default_timezone_set('Europe/Prague');
$hostname =  htmlspecialchars($_POST["hostname"]);
$os = htmlspecialchars($_POST["os"]);
$kernel = htmlspecialchars($_POST["kernel"]);
$patchlevel = htmlspecialchars($_POST["patch"]);
$datum = date('Y-m-d H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];
$tabulka = htmlspecialchars($_POST["tabulka"]);
$done = htmlspecialchars($_POST["done"]);

if( isset($_POST['tabulka']) ) {
//slozeni prikazu pro zjisteni jestli zaznam jiz existuje
$jetu="select * from ".$tabulka." where hostname ='".$hostname."'";
// slozeni zaznamu pro zapis
$sql="insert into ".$tabulka." (hostname,os,kernel,patchlevel,stamp,done) values ('".$hostname."','".$os."','".$kernel."','".$patchlevel."','".$datum."','".$done."');";
if($kontrola = mysqli_query($link, $jetu)){
  if(mysqli_num_rows($kontrola) > 0){
    mysqli_free_result($kontrola);
    $sql="update ".$tabulka." set os='".$os."', kernel='".$kernel."', patchlevel='".$patchlevel."', stamp='".$datum."', done='".$done."' where hostname='".$hostname."';";
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
  echo "Tato stranka slouzi pro vkladani dat do DB o patchi  ma byt volana pouze pres ANSIBLE a ocekava POST parametry hostname, os, kernel, patch a jmeno tabulky(proces/inventory)";
}
?>
