<?php $title="Edit profile ".$_SESSION['name']." ".$_SESSION['lastname']; include 'blocks/header.php'; ?>

<h1 align="center">Profile editing</h1>
<center>
<form method="POST" action="query/editing" enctype="multipart/form-data">
<br><input type="text" name="name" placeholder="Name" maxlength="10" pattern="[A-Za-z-0-9-А-Яа-яЁё]{4,10}" title="Не менее 4 и неболее 10 латынских символов или цифр." ><br>
<br><input type="text" name="lastname" placeholder="Last name" maxlength="20" pattern="[A-Za-z-0-9-А-Яа-яЁё]{3,20}" title="Не менее 3 и неболее 20 латынских символов или цифр." ><br>
<br><label>Birthday : <input type="date" name="birthday" ></label><br>
<br><label>Avatar : <input type="file" value="" name="avatar"></label><br>
<br><textarea type="text" name="about" placeholder="About yourself" cols="60" rows="10"></textarea><br>
<br><input type="submit" name="enter" value="Сохранить">
</form>
</center>

<?php include 'blocks/content.php'; ?>
