<?php
session_start();
include_once 'setting.php';
include_once 'php/UMC.php';

if ($_SESSION['position'] == 'admin') {
error_reporting(E_ALL);
ini_set('display_errors', 1);
};

$params = array();// Массив параметров из URI запроса.
$query_string = str_replace("q=","",trim($_SERVER['REQUEST_URI']));//получили строку
$query_string = urldecode($query_string);//получили строку
$query_params = explode("/",$query_string);// разбиваем на массив
foreach ($query_params as $query_param) // и проверяем
 if ($query_param != "")                // а вдруг в конец слеш не дописали
    $params[] =  $query_param;

$module = array_shift($params);
$page = array_shift($params);
$ident1 = array_shift($params);
$ident2 = array_shift($params);


  if ($module == false ) {include "module/bloff/index.php";}
  else if ($page == false and intval($module) ) {include "module/users/profile.php" ;}
 else if ($page == false and file_exists("page/$module.php")) {include "page/$module.php" ;}
 else if (file_exists("module/$module") and ($page == false) ) { include "module/$module/index.php" ;}
 else if ($page == "query") { include "module/$module/$page/$ident1.php" ;}
 else if (intval($page) && !$ident1) { include "module/$module/post.php" ;}
 else if (intval($ident1) && $module == "users") {include "module/users/umessage.php" ;}
 else if ($ident1 == "edit" && file_exists("module/$module")) {include "module/$module/edit.php" ;}
 else if ($ident1 == "delete" && file_exists("module/$module")) {include "module/$module/query/delete.php" ;}
 else if ($ident1 == "verify" && file_exists("module/$module")) {include "module/$module/query/verify.php" ;}
 else if (file_exists("module/$module/$page.php")) { include "module/$module/$page.php" ;}
 else {header('HTTP/1.0 404 Not Found');exit(include("page/404.php"));};




?>
