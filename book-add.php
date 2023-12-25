<?php
require('process.php');
if(!isset($_COOKIE['login_flag']) || !$_COOKIE['login_flag'])
{
  header('Location: index.php');
  exit;
}
if(isset($_POST['submit']))
{
$connection = mysqli_connect('127.0.0.1', 'root', '', 'library');
if(isset($_POST['id_books']) && $_POST['id_books'])
  {
    $sql='UPDATE `books` SET
    `name` = \''.$_POST['name'].'\',
    `publication` = \''.$_POST['publication'].'\',
    `author` = \''.$_POST['author'].'\',
    `price` = '.(float)$_POST['price'].',
    `pages` = '.(int)$_POST['pages'].',
    `isbn` = \''.$_POST['isbn'].'\',
    `cover_type` = \''.$_POST['cover_type'].'\',
    `edition` = '.(int)$_POST['edition'].',
    `date_add` = \''.$_POST['date_add'].'\'
     WHERE `id_books` = '.(int)$_POST['id_books'];
    $result = mysqli_execute_query($connection, $sql);

    header('location: books.php');
    exit;
  }
  else {
    $query = 'INSERT INTO `books`(`name`,`publication`,`author`,`price`,`pages`,`isbn`,`cover_type`,`edition`, `date_add`) VALUES(
      \''.$_POST['name'].'\',
      \''.$_POST['publication'].'\',
      \''.$_POST['author'].'\',
      \''.$_POST['price'].'\',
      \''.$_POST['pages'].'\',
      \''.$_POST['isbn'].'\',
      \''.$_POST['cover_type'].'\',
      \''.$_POST['edition'].'\',
      \''.$_POST['date_add'].'\'
    )';
    $result = mysqli_execute_query($connection, $query);
  }
  }

if(isset($_GET['id_books']))
{
  $id_books = $_GET['id_books'];
  $result = mysqli_execute_query($connection,'SELECT * FROM `books` WHERE `id_books` ='.(int)$id_books);
  $Edit_book = null;
  foreach ($result as $book) {
    $Edit_book = $book;
  }
}
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
      <?php include('panel.php'); ?>
      <div class="col-lg-10 float-left">
      <form class="" action="book-add.php" method="post" enctype="multipart/form-data">
        <table class="tbl">
          <thead>
            <tr>
              <td colspan="2" id="table-heading">registration form</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <label for="name"> name</label>
              </td>
              <td>
                <input type="text" name="name" id="name" value="<?php echo isset($Edit_book['name'])?$Edit_book['name']:''?>" class="form-control">
              </td>
            </tr>
            <tr>
              <td>
                <label for="publication">publication</label>
              </td>
              <td>
                  <input type="text" name="publication" id="pb" value="<?php echo isset($Edit_book['publication'])?  $Edit_book['publication']:''?>" class="form-control">
              </td>
            </tr>
            </tr>
            <tr>
              <td>
                <label for="author">author</label>
              </td>
              <td>
                <input type="text" name="author" value="<?php echo isset($Edit_book['author'])?  $Edit_book['author']:''?>" class="form-control">
              </td>
            </tr>
            <tr>
              <td>
                <label for="price">price</label>
              </td>
              <td>
                <input type="number" name="price" value="<?php echo isset($Edit_book['price'])?  $Edit_book['price']:''?>" class="form-control">
              </td>
            </tr>
            <tr>
              <td>
                <label for="pages">pages</label>
              </td>
              <td>
                <input type="number" name="pages" value="<?php echo isset($Edit_book['pages'])?  $Edit_book['pages']:''?>" class="form-control">
              </td>
            </tr>
            <tr>
              <td>
                <label for="isbn">isbn</label>
              </td>
              <td>
                <input type="number" name="isbn" value="<?php echo isset($Edit_book['isbn'])?  $Edit_book['isbn']:''?>" class="form-control">
              </td>
            </tr>

            <tr>
              <td>
                <label for="cover_type">cover_type</label>
              </td>
              <td>
                <select class="form-control" name="cover_type">
                    <option value="">- select -</option>
                    <option value="pepar_back" <?php echo (isset($Edit_book['cover_type']) && $Edit_book['cover_type'] == 'pepar_back')? 'selected ="selected"':''?> >pepar_back</option>
                    <option value="hard_copy" <?php echo (isset($Edit_book['cover_type']) && $Edit_book['cover_type'] == 'hard_copy')? 'selected ="selected"':''?> >hard_copy</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>
                <label for="edition">edition</label>
              </td>
              <td>
                <input type="text" name="edition" value="<?php echo isset($Edit_book['edition'])?  $Edit_book['edition']:''?>" class="form-control">

              </td>
            </tr>
            <tr>
              <td>
                <label for="date_add">date</label>
              </td>
              <td>
                <input type="date_add" name="date_add" value="<?php echo isset($Edit_book['date_add'])? $Edit_book['date_add']:''?>" class="form-control">
              </td>
            </tr>
            <tr>
              <td>
                <input type="hidden" name="id_books" id="id_books" value="<?php echo isset($Edit_book['id_books'])?$Edit_book['id_books']:''?>" />
                <input type="submit" name="submit" id="button"/>
              </td>
            </tr>

          </tbody>
        </table>
      </form>
      </div>
      <div class="clearfix"></div>
    </div>
  </body>
</html>
