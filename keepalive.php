<?php
include 'config.php';
use configuration\config;
$yourid = $_GET['id'];
$context = file_get_contents("game/users.txt");
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
if(in_array(openssl_encrypt($yourid, "AES-128-ECB", config::$passwordcipher), explode(',', $context))){
$showedwords = file_get_contents("game/unhidded.txt");
$arraykeepalive = explode(',', file_get_contents("game/countkeepalives.txt"));
$indexik = array_search($yourid, explode(',', $context));
$arraykeepalive[$indexik] = intval($arraykeepalive[$indexik]) + 1;
file_put_contents("game/countkeepalives.txt", implode(',', $arraykeepalive));
echo $showedwords;
}else{
  echo config::$codeerrordontauthorized;
}
?>
