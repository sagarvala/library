<?php
require('process.php');
if(!isset($_COOKIE['login_flag']) || !$_COOKIE['login_flag'])
{
  header('Location: index.php');
  exit;
}
$result = mysqli_execute_query($connection,'SELECT * FROM `books`');
$data_student = mysqli_execute_query($connection,'SELECT * FROM `student`');
if(isset($_POST['button']))
  {
$query = 'INSERT INTO `transaction`(`id_books`,`id_student`,`days`,`t_date`)
VALUES(
  \''.$_POST['id_book'].'\',
  \''.$_POST['id_student'].'\',
  \''.$_POST['days'].'\',
  \''.$_POST['date'].'\')';
  echo $query;
  die;
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/transaction.css">
    <?php
      require('head.inc');
    ?>
  </head>
  <body>
    <div class="row">
      <?php include('panel.php'); ?>
      <div class="col-lg-10 float-left">
        <form class="" action="transaction.php" method="post">
        <div class="class1">
          <div class="name">
            <label for="student">book name:</label>
            <select name="id_book" id="id_book">
              <option value="">-choose name-</option>
              <?php
                foreach ($result as $book)
                {
                    echo '<option value="'.$book['id_books'].'">'.$book['name'].'</option>';
                }
              ?>
            </select>
            </div>

            <div class="name">
              <label for="book">student name:</label>

              <select name="id_student" id="id_student">
                <option value="">-choose book_name-</option>
                <?php
                foreach ($data_student as $book)
                {
                    echo '<option value="'.$book['id_student'].'">'.$book['first_name'].' '.$book['last_name'].'</option>';
                }
                ?>
              </select>
              <label for="days">choose days:</label>

                <input type="text" name="days" value="" >


              <label class="form-label" for="t_date">date</label>
              <input type="text" name="date" value="">
            </div>
            <div class="submit">
              <input type="submit" name="button" value="save" class="button">
            </div>
        </div>
        </form>
<div class="clearfix"></div>
</div>
</div>

</body>
</html>
