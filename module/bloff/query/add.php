<?php

if ($_SESSION['status'] != 'login') {MessageSend(1,"Вы не можете просматривать эту страницу","/");} else {

  if ($_SESSION['position'] == 'admin') {$status = "verified";} else {$status = "inspection";};


$_POST['name'] = FormChars($_POST['name']);
$_POST['text'] = nl2br(trim($_POST['text']));
mysqli_query($CONNECT , "INSERT INTO `bloff`  VALUES ('','".$status."', '".$_POST['category']."', '".$_POST['name']."', '".$_POST['text']."', '".$_SESSION['id']."',NOW())");


$query = "SELECT * FROM `bloff` WHERE (`name` = '".$_POST['name']."') and (`author` = '".$_SESSION['id']."')";
$result = mysqli_query($CONNECT, $query);
$post = mysqli_fetch_array($result);


MessageSend(2, 'Запись отправлена на проверку', '/bloff/'.$post['id']);
}

 ?>
