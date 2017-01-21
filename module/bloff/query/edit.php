<?php
$post = mysqli_fetch_array(mysqli_query($CONNECT, "SELECT * FROM `bloff` WHERE `id` = '".$_POST['post']."'"));
if ($_SESSION['position'] != 'admin' and $post['author'] != $_SESSION['id']) {MessageSend(1,"Вы не можете просматривать эту страницу","/bloff/".$page);} else {

$_POST['name'] = FormChars($_POST['name']);
$vowels = array("<br />", "<br /><br />", "<br /><br /><br />");
$_POST['text'] = str_replace($vowels, "<br />", nl2br(trim($_POST['text'])));
if ($_SESSION['position'] == 'admin') {$status = "verified";} else {$status = "inspection";};
mysqli_query($CONNECT , "UPDATE `bloff` SET `name` = '".$_POST['name']."',`status` = '".$status."' ,`category` = '".$_POST['category']."',`text` = '".$_POST['text']."' WHERE `id` = '".$_POST['post']."'");

MessageSend(2, 'Запись отредактирована.', '/bloff/'.$_POST['post']);
}

 ?>
