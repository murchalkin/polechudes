<?php
namespace configuration {
class config{
  // Global
  public static $passwordcipher = "password"; // password cipher
  public static $codeerrorserver = "Ошибка сервера"; // error server code returning to client
  public static $clientsstart = 2; // clients on server for start, set -1, if dont allow connect
  
  // Auth
  public static $token = "мырон"; // token auth
  public static $minrandomid = -100; // minimum random generating id
  public static $maxrandomid = 1; // maximum random generating id(max length:19), dont use negative number or 0
  public static $codeerrorauth = "Ошибка авторизации"; // error auth code returning to client
  public static $codeerrorfull = "Сервер переполнен"; // error id or number clients full code returning to client
  public static $codesuccessauth = ""; // success auth code returning to client

  // Game
  public static $words = "стол,кошка,табуретка"; // words generating(dont use spaces, dont use numbers)
  public static $codeerrordontstarted = "Игра не начата"; // error game not started code returning to client
  public static $codeerrordontauthorized = "Вы не авторизованы"; // code error when dont authorized
  public static $codedontqueue = "Не ваша очередь называть букву"; // code dont you queue returning to client
  public static $codesuccessletter = "Буква правильная"; // success send letter code returning to client
  public static $codewrongletter = "Буква неверная"; // wrong letter code returning to client
  public static $codeexistsletter = "Такую букву уже угадали"; // letter already exists code returning to client
  public static $codeerrorlengthletter = "Буква не может содержать больше двух букв"; // error when length letter more than 2 code returning to client
  public static $codeyouwin = "Ты выиграл"; // code when player is win returning to client
  
}
}
?>
