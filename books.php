<?php
require('process.php');
if(!isset($_COOKIE['login_flag']) || !$_COOKIE['login_flag'])
{
  header('Location: index.php');
  exit;
}
if(isset($_GET['delete']) && isset($_GET['id_books']))
{
  $id_books = $_GET['id_books'];
  mysqli_execute_query($connection,'DELETE FROM `books` WHERE `id_books` ='.(int)$id_books);
  header('Location: books.php');
  exit;
}
$result = mysqli_execute_query($connection,'SELECT * FROM `books`');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php
      require('head.inc');
    ?>
  </head>
  <body>
    <div class="row">
      <?php require('panel.php'); ?>
      <div class="col-lg-10 float-left">
        <br />
        <div class="btn-group float-right" role="group" aria-label="Basic example">
          <a href="book-add.php" class="btn btn-secondary">Add book</a>
          <a type="button" class="btn btn-secondary">Middle</a>
          <a type="button" class="btn btn-secondary">Right</a>
        </div>
        <div class="clearfix"></div>
        <br />

        <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">id_books</th>
        <th scope="col">name</th>
        <th scope="col">publication</th>
        <th scope="col">author</th>
        <th scope="col">price</th>
        <th scope="col">pages</th>
        <th scope="col">isbn</th>
        <th scope="col">cover_type</th>
        <th scope="col">edition</th>
        <th scope="col">date_add</th>
        <th scope="col">Edit</th>
        <th scope="col">delete</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($result as $row){
        echo '<tr>
        <td>'.$row['id_books'].'</td>
        <td>'.$row['name'].'</td>
        <td>'.$row['publication'].'</td>
        <td>'.$row['author'].'</td>
        <td>'.$row['price'].'</td>
        <td>'.$row['pages'].'</td>
        <td>'.$row['isbn'].'</td>
        <td>'.$row['cover_type'].'</td>
        <td>'.$row['edition'].'</td>
        <td>'.$row['date_add'].'</td>
        <td><a href="book-add.php?id_books='.$row['id_books'].'">Edit</a></td>
        <td><a href="books.php?id_books='.$row['id_books'].'&delete">delete</a></td>
        </tr>';
      }
      ?>
    </tbody>
  </table>
      </div>
      <div class="clearfix"></div>
    </div>
  </body>
</html>
