<?php $title="Bloff"; include 'blocks/header.php';
?>

<div class="description">
<p>Bloff it's site where I fix my new knowledges  about different programming languages or programming in general. Here you can see different articles about my projects,about their realization. In particular about back- and front- end of them,about GitHub and DVCS and etc.</p>
</div>
<br>
<form class="" action="#" method="post" style="display:inline-block;">
  <input type="text" name="search"  placeholder="Search">
  <select class="" name="categories">
    <option value="CSS">CSS</option>
    <option value="HTML">HTML</option>
    <option value="PHP">PHP</option>
    <option value="JavaScript">JavaScript</option>
    <option value="Business">Business</option>
  </select>
  <button type="button" name="find">Find</button>
</form>
<?php if ($_SESSION['status'] == 'login') { ?>
<a href="bloff/add" style="float:right;display:inline-block;"><div class="abutton">
  <span class="insideabutton">Add</span>
</div></a> <?php }; ?>
<hr>


<?php

$postsNumber = mysqli_fetch_array(mysqli_query($CONNECT , "SELECT COUNT(*) FROM `uarticles`"));
$i = $postsNumber[0];
while ($i >= 1) {
$post = mysqli_fetch_array(mysqli_query($CONNECT, "SELECT * FROM `uarticles` WHERE `id` = '".$i."'"));
$author = mysqli_fetch_array(mysqli_query($CONNECT, "SELECT * FROM `users` WHERE `id` = '".$post['author']."'"));
if ($post['status'] == "verified") {

/*  if (strlen($post['name']) > 75) {
    $postname=substr($post['name'], 0, 70)."...";
  } else {*/
      $postname = $post['name'];
//  }


echo '<a href="'.$post['author'].'/'.$i.'" class="postname" title="'.$post['name'].'" >'.$postname.'</a> / '.$post['category'];
echo "<span class='date'>".$post['date']."</span>";
echo '<br><span class="date" style="font-size:10px;color:#656565">'.$author['name'].' '.$author['lastname'].'</span>';
echo "<hr style=\"height:1px;\" >";}
$i--;
};
 ?>

<?php include 'blocks/content.php'; ?>
