<?php
$connection = mysqli_connect('localhost', 'root', '', 'library');
if(isset ($_COOKIE['login_flag']))
$result = mysqli_execute_query($connection, 'SELECT * FROM `user` WHERE `id_user` = '.(int)$_COOKIE['login_flag']);
if(isset ($_COOKIE['login_flag']))
{
  foreach($result as $row)
  {
    $username = $row['username'];
    break;
  }
}
function d($array)
{
  echo '<pre>';
  print_r($array);
  echo '</pre>';
  die;
}
?>
