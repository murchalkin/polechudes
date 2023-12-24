<?php
include 'config.php';
use configuration\config;
$yourid = $_GET['id'];
$context = file_get_contents("users.txt");
if(in_array($yourid, explode(',', $context))){
$showedwords = file_get_contents("game/unhidded.txt");
echo $showedwords;
}else{
  echo config::$codeerrordontauthorized;
}
?>