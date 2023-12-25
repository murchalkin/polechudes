<?php
include 'config.php';
use configuration\config;
$yourid = $_GET['id'];
$context = file_get_contents("users.txt");
$winner = file_get_contents("game/winned.txt");
if($context == ""){
  if($winner != ""){
  echo $winner;
  return;
  }
}
if(file_get_contents("game/gamestarted.txt") == ""){
  echo config::$codeerrordontstarted;
  return;
}
if(in_array($yourid, explode(',', $context))){
$showedwords = file_get_contents("game/unhidded.txt");
echo $showedwords;
}else{
  echo config::$codeerrordontauthorized;
}
?>
