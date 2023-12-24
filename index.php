<?php
require('process.php');
if(isset($_COOKIE['login_flag']) && $_COOKIE['login_flag'])
{
  header('Location: dashboard.php');
  exit;
}

if(isset($_POST['submitLogin']))
{
  $username = $_POST['username'];
  $passwd = $_POST['passwd'];

  if($username && $passwd)
  {

      $query = 'SELECT * FROM `user` WHERE `username` = \''.$username.'\' AND `passwd` = \''.md5($passwd).'\'';
      $result = mysqli_execute_query($connection, $query);
      if($result->num_rows > 0)
      {
          $id_user = 0;
          foreach($result as $row)
          {
              $id_user = $row['id_user'];
              break;
          }
          setcookie('login_flag', $id_user, time()+3600, '/');
          header('Location: dashboard.php');
          exit;
      }
      else{
        $msg = 'Either user does not exists or password is invalid';
      }
      
  }
  else {
    $msg = 'Please, enter valid username and password';
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Librabry Login </title>
    <?php
      require('head.inc')
    ?>
  </head>
  <body>
    <form method="POST" action="index.php">
  <div class="container m-auto">
    <div class="bg-dark h1 m-0 p-2 text-white text-center">
      Login
    </div>
    <div class="bg-secondary">
      <?php
        if(isset($msg)) {
          echo '<div class="alert alert-danger">'.$msg.'</div>';
        }
      ?>
      <div class="form-group pl-4 pr-4 pt-4 pb-1">
        <label class="control-label" for="email">Email address</label>
        <input class="form-control" type="text" class="col-12" id="email" name="username" placeholder="Enter email">
      </div>
      <div class="form-group pl-4 pr-4 pt-1 pb-1">
        <label class="control-label" for="pass">Password</label>
        <input class="form-control" type="password" class="col-12" id="pass" name="passwd" placeholder="Password">
      </div>
      <button type="submit" name="submitLogin" class="btn btn-primary m-3 float-right">Submit</button>
      <div class="clearfix">
sagarvala
      </div>
    </div>
  </div>
</form>
  </body>
</html>
