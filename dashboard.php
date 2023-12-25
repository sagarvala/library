<?php
require('process.php');
if(!isset($_COOKIE['login_flag']) || !$_COOKIE['login_flag'])
{
  header('Location: index.php');
  exit;
}

$result = mysqli_execute_query($connection, 'SELECT * FROM `user` WHERE `id_user` = '.(int)$_COOKIE['login_flag']);
foreach($result as $row)
{
  $username = $row['username'];
  break;
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php
      require('head.inc')
    ?>
  </head>
  <body>
    <div class="row">
      <?php include('panel.php'); ?>
      <div class="col-lg-10 float-left">
      </div>
      <div class="clearfix"></div>
    </div>
  </body>
</html>
