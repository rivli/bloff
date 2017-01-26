<div class="sidebar">
  <div class="sb_block">
    <?php
      if ($_SESSION['status'] != 'login') {
        include 'module/users/login.php';
      } else {
        echo "тут если у user'a есть проеkты они выводятся с индикатором обновлений (Количество комментарие и тп)";
      }
     ?>
  </div>

</div>
