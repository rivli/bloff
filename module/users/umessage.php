<?php $title="Сообщения"; include 'blocks/header.php';




$umessages = mysqli_fetch_array(mysqli_query($CONNECT, "SELECT * FROM `umessages` WHERE `user` = '".$_SESSION['id']."'")); //or die("Ошибка MySQL: " . mysql_error());//получаем собесетников
if (!$umessages) {//если таблицы собеседников нет,то создаем
  mysqli_query($CONNECT , "INSERT INTO `umessages`  VALUES ('','".$_SESSION['id']."', '".$ident1."')");
}
$umessages = mysqli_fetch_array(mysqli_query($CONNECT, "SELECT * FROM `umessages` WHERE `user` = '".$_SESSION['id']."'")); //обновляем собеседников
if (!$umessages['companions']) {
    mysqli_query($CONNECT,"UPDATE `umessages` SET `companions`=CONCAT(`companions`,'".$ident1."') WHERE `id` = '".$_SESSION['id']."'");
} else {
  $companions = explode("/",$umessages['companions']);//получаем собеседников пользователя и добавляем нового если нет его в списке
  if (!in_array($ident1,$companions)) {
    mysqli_query($CONNECT,"UPDATE `umessages` SET `companions`=CONCAT(`companions`,'/".$ident1."') WHERE `id` = '".$_SESSION['id']."'");
  };
  }

//далее добавляем таблицу собеседников для переговорщика
//если таковой нет
//и в собеседники приписываем пользователя

$umessagesNew = mysqli_fetch_array(mysqli_query($CONNECT, "SELECT * FROM `umessages` WHERE `user` = '".$ident1."'")) ;//получаем собесетников
if (!$umessagesNew) {
  mysqli_query($CONNECT , "INSERT INTO `umessages`  VALUES ('','".$ident1."','".$_SESSION['id']."')");
}
$umessagesNew = mysqli_fetch_array(mysqli_query($CONNECT, "SELECT * FROM `umessages` WHERE `user` = '".$ident1."'")) ;//получаем собесетников

if (!$umessagesNew['companions']) {
    mysqli_query($CONNECT,"UPDATE `umessages` SET `companions`=CONCAT(`companions`,'".$_SESSION['id']."') WHERE `id` = '".$ident1."'");
} else {
  $companionsNew = explode("/",$umessagesNew['companions']);
  if (!in_array($_SESSION['id'],$companionsNew)) {
    mysqli_query($CONNECT,"UPDATE `umessages` SET `companions`=CONCAT(`companions`,'/".$_SESSION['id']."') WHERE `id` = '".$ident1."'");
  }
  }

//далее получаем сообщения между пользователями

if ($ident1 < $_SESSION['id']) {$tableName = $ident1."-".$_SESSION['id'];} else {$tableName = $_SESSION['id']."-".$ident1;};
$messages = mysqli_fetch_array(mysqli_query($MESSAGEBD, "SELECT * FROM `".$tableName."`"));
if (!$messages) {
  $sql = "CREATE TABLE `".$tableName."` ( `id` INT NOT NULL AUTO_INCREMENT , `status` VARCHAR(255) NOT NULL , `sender` INT(255) NOT NULL , `recipient` INT(255) NOT NULL , `text` TEXT NOT NULL , `date` DATE NOT NULL , `time` TIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
  mysqli_query($MESSAGEBD, $sql);
};
$companion = mysqli_fetch_array(mysqli_query($CONNECT, "SELECT * FROM `users` WHERE `id` = '".$ident1."'"));



echo 'Переписка с <a href="/'.$ident1.'" class="postname" >'.$companion['name'].' '.$companion['lastname'].'</a>';
echo '  <img src="'.$companion['avatar'].'" title="'.$companion['name']." ".$companion['lastname'].'" class="usersMessagingAva" ><br>';

$messagesNumber = mysqli_fetch_array(mysqli_query($MESSAGEBD , "SELECT COUNT(*) FROM `".$tableName."`"));
$i = $messagesNumber[0];
echo '<br><br><div style="overflow-y: scroll;height:300px;  display:inline-block;width:100%;">';
while ($i >= 1) {
$message = mysqli_fetch_array(mysqli_query($MESSAGEBD, "SELECT * FROM `".$tableName."` WHERE `id` = '".$i."'"));
if ($message['sender'] == $_SESSION['id']) {
  echo '
  <div style="width:100%;display:inline-block;"><div  class="usersMessaging" > <span style="font-size:10px;">'.$message['date']." ".$message['time']."</span><br>".$message['text'].'</div></div>
  ';
} else {
  if ($message['status']==0) {$NewMessage='style="background:#b56464;"';} else {$NewMessage='style="background:#b0e8dc;"';};
  echo '
  <div style="width:100%;display:inline-block;"><div class="usersMessaging2" '.$NewMessage.' ><span style="font-size:10px;">'.$message['date']." ".$message['time']."</span><br>".$message['text'].'</div></div>
  ';
};
$i--;
};
echo '</div>';
?>
<br><br>
<form class="" action="/users/query/message" method="post">
  <input type="hidden" name="recipient" value="<?php echo $ident1; ?>" >
  <input type="hidden" name="tablename" value="<?php echo $tableName; ?>" >
  <div style="display:inline-block;width:90.1%;">
    <textarea type="text" id="textarea" name="text" placeholder="Text"  required></textarea>
  </div><br>
    <div class="addButton" style="display:inline-block;width:30px;" title="Вставить ссылку" id="addhref">С</div>
      <div class="addButton" style="display:inline-block;width:30px;" title="Вставить изображение" id="addimage">И</div>
      <div class="addButton" style="display:inline-block;width:30px;" title="Вставить аудиозапись" id="addaudio">А</div>
      <div class="addButton" style="display:inline-block;width:30px;" title="Вставить видео" id="addvideo">В</div>


  <input style="float:right;position:relative;top:15px;" type="submit" name="add" value="Отправить">
</form>
<?php

mysqli_query($MESSAGEBD, "UPDATE `".$tableName."` SET `status` = '1' WHERE `recipient` = '".$_SESSION['id']."'");
//Помечаем непрочитанные сообщения прочитанными
 include 'blocks/content.php'; ?>
