<?php
include 'config.php';
use configuration\config;
if(file_get_contents("game/gamestarted.txt") == ""){
  echo config::$codeerrordontstarted;
  return;
}
$indexmy = 0;
$letter = $_GET['letter'];
$yourid = $_GET['id'];
$showedwords = file_get_contents("game/unhidded.txt");
$context = file_get_contents("game/users.txt");
$word = openssl_decrypt(file_get_contents("game/word.txt"), "AES-128-ECB", config::$passwordcipher);
if(mb_strlen($letter) > 1){
   echo config::$codeerrorlengthletter;
  return;
}
if(!in_array(openssl_encrypt($yourid, "AES-128-ECB", config::$passwordcipher), explode(',', $context))){
    echo config::$codeerrordontauthorized;
    return;
}
    if(str_contains($showedwords, $letter)){
      echo config::$codeexistsletter;
      return;
    }
    if(str_contains($word, $letter)){
      $wordget = "";
        foreach (mb_str_split($word) as $char) {
          if($letter == $char){
            $wordget = $wordget . $letter;
          }else{
            if($char == ""){
            $wordget = $wordget . "*";
            }
            if($char != "*"){
              $wordget = $wordget . mb_substr($showedwords, $indexmy, 1);
            }
          }
            $indexmy++;
       }
      file_put_contents("game/unhidded.txt", $wordget);
    
      if(!str_contains(file_get_contents("game/unhidded.txt"), "*")){
        echo config::$codeyouwin;
        file_put_contents("game/gamestarted.txt", "");
        file_put_contents("game/word.txt", "");
        file_put_contents("game/unhidded.txt", "");
        file_put_contents("game/users.txt", "");
        file_put_contents("game/winned.txt", $yourid);
        file_put_contents("game/timeng.txt", "");
        return;
      }
      
      echo config::$codesuccessletter;
      return;
    }else{
      echo config::$codewrongletter;
      return;
    }

?>
