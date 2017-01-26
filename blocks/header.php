<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="/blocks/style.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type='text/javascript' src='/js/scrollup.js'></script>
  </head>
  <body>
    <?php
    $inspection = mysqli_fetch_array(mysqli_query($CONNECT, "SELECT COUNT(*) FROM `uarticles` WHERE `status` = 'inspection'"));
     if ($_SESSION['position']=='admin') { ?>
       <a href="/p/inspectionposts">
      <div class="inspection">
      <?php echo $inspection[0]; ?>
      </div>
    </a>
    <?php }; if ($_SESSION['status']=='login') {  ?>
    <a href="/m">
   <div class="inspection" style="top:100px;" title="Непрочитанных сообщений">
   <?php echo $unreadMessagesSumm; ?>
   </div>
 </a>
 <?php ;}; ?>
    <div class="header" align="center">
        <a href="/" class="menua"><div class="menu">Bloff</div></a>
        <a href="/projects" class="menua"><div class="menu">Projects</div></a>
        <a href="/<?php if ($_SESSION['id']) {echo $_SESSION['id'];} else echo 1; ?>" class="menua"><div class="menu">Me</div></a>
    </div>
    <div class="mainpart">
    <?php  if ($_SESSION['message']) MessageShow(); ?>
    <div class="content">
