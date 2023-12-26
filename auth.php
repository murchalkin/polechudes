<?php
include 'config.php';
use configuration\config;
if(config::$clientsstart > config::$maxrandomid - config::$minrandomid){
  echo config::$codeerrorserver;
  return;
}
if(config::$maxrandomid <= 0){
  echo config::$codeerrorserver;
  return;
}
if(str_contains(config::$words, ' ')){
  echo config::$codeerrorserver;
  return;
}
for($i = 0; $i < 9; $i++){
  if(str_contains(config::$words, "{$i}")){
    echo config::$codeerrorserver;
    return;
  }
}
$clienttoken = openssl_decrypt($_GET['token'], "AES-128-ECB", config::$passwordcipher);
$servertoken = config::$token;
if($clienttoken == $servertoken){
  $context = file_get_contents("users.txt");
  if(count(explode(',', $context)) >= config::$clientsstart){
    $minute = date('i');
    $hour = date('H');
    $newtime = $minute + ($hour + 3) * 60;
    if(abs(intval(file_get_contents("game/timeng.txt")) - $newtime) >= 1){
        $keepaliver = "";
      $context = explode(',', file_get_contents("users.txt"));
      $arraykeepalive = explode(',', file_get_contents("game/countkeepalives.txt"));
      $indexika = 0;
      foreach($context as $keepalivee){
          if($arraykeepalive[$indexika] < config::$minkeepalivesneed){
            unset($arraykeepalive[$indexika]);
            unset($context[$indexika]);
          }
          $indexika++;

      }
      file_put_contents("game/countkeepalives.txt", implode(',', $arraykeepalive));
      file_put_contents("users.txt", $context);
      file_put_contents("game/timeng.txt", strval($newtime));
    }
    else{
      file_put_contents("game/timeng.txt", strval($newtime));
      echo config::$codeerrorfull;
      return;
    }
    
  }
  $rand = rand(config::$minrandomid,config::$maxrandomid);
  $attempts = 0;
  for($i = 0; $i < 100 * config::$maxrandomid; $i++){
    if(!in_array("{$rand}", explode(',', $context))){
       $attempts++;
       break;
    }else{
      $rand = rand(config::$minrandomid,config::$maxrandomid);
      $attempts++;
    }
  }
  if($attempts >= 100 * config::$maxrandomid){
    echo config::$codeerrorfull;
    return;
  }
  
  if($context == ""){
    file_put_contents("users.txt", "{$rand}");
  }else{
    $context = $context . ",{$rand}";
    file_put_contents("users.txt", $context);
  }
  $keepaliverr = "";
  foreach(explode(',', $context) as $keepalivee){
    if($keepaliverr == ""){
      $keepaliverr = $keepaliverr . "0";
    }else{
      $keepaliverr = $keepaliverr . "," . "0";
    }
  }
  file_put_contents("game/countkeepalives.txt", $keepaliverr);
  if(count(explode(',', $context)) >= config::$clientsstart){
    if(file_get_contents("game/gamestarted.txt") != "true"){
    $massivkaword = explode(',', config::$words);
    $randomizedword = $massivkaword[rand(0, count($massivkaword) - 1)];
    file_put_contents("game/word.txt", openssl_encrypt($randomizedword, "AES-128-ECB", config::$passwordcipher));
    file_put_contents("game/unhidded.txt", str_repeat('*', mb_strlen($randomizedword)));
      file_put_contents("game/winned.txt", "");
      $minutenew = date('i');
      $hournew = date('H');
      $newtimenew = $minutenew + ($hournew + 3) * 60;
      file_put_contents("game/timeng.txt", strval($newtimenew));
    file_put_contents("game/gamestarted.txt", "true");
  }
  }
  echo $rand;
}else{
  echo config::$codeerrorauth;
}
?>
