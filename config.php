<?php
namespace configuration {
class config{
  // Global
  public static $passwordcipher = "password"; // password cipher
  public static $codeerrorserver = "Ошибка сервера"; // error server code returning to client
  public static $clientsstart = 2; // clients on server for start, set -1, if dont allow connect
  
  // Auth
  public static $token = "мырон"; // token auth
  public static $minrandomid = -1000; // minimum random generating id
  public static $maxrandomid = 1; // maximum random generating id(max length:19), dont use negative number or 0
  public static $codeerrorauth = "Ошибка авторизации"; // error auth code returning to client
  public static $codeerrorfull = "Сервер переполнен"; // error id or number clients full code returning to client
  public static $minkeepalivesneed = 50; // minimum keep alives need every minute, if less the value, then kick client(checking inactivity clients, happens when new user want connect on full server)

  // Game
  public static $words = "табуретка,пряник,торт,шаурма,бургер,кошка,хотдог"; // words generating(dont use spaces, dont use numbers)
  public static $codeerrordontstarted = "Игра не начата"; // error game not started code returning to client
  public static $codeerrordontauthorized = "Вы не авторизованы"; // code error when dont authorized
  public static $codesuccessletter = "Буква правильная"; // success send letter code returning to client
  public static $codewrongletter = "Буква неверная"; // wrong letter code returning to client
  public static $codeexistsletter = "Такую букву уже угадали"; // letter already exists code returning to client
  public static $codeerrorlengthletter = "Буква не может содержать больше двух букв"; // error when length letter more than 2 code returning to client
  public static $codeyouwin = "Ты выиграл"; // code when player is win returning to client
  
}
}
?>
