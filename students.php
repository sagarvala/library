<?php
require('process.php');
if(!isset($_COOKIE['login_flag']) || !$_COOKIE['login_flag'])
{
  header('Location: index.php');
  exit;
}
if(isset($_GET['id_student']) && isset($_GET['delete']))
{
  $id_student  = $_GET['id_student'];
  mysqli_execute_query($connection,'DELETE FROM `student` WHERE `id_student`='.(int)$id_student);
  header('Location: students.php');
  exit;
}
$data_student = mysqli_execute_query($connection,'SELECT * FROM `student`');
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
          <a href="student-add.php" class="btn btn-secondary">Add student</a>
          <a type="button" class="btn btn-secondary">Middle</a>
          <a type="button" class="btn btn-secondary">Right</a>
        </div>
        <div class="clearfix"></div>
        <br />

        <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Id_student</th>
        <th scope="col">FirstName</th>
        <th scope="col">LastName</th>
        <th scope="col">Gender</th>
        <th scope="col">BirthDate</th>
        <th scope="col">Course</th>
        <th scope="col">Semester</th>
        <th scope="col">MobileNo</th>
        <th scope="col">Address</th>
        <th scope="col">BloodGroup</th>
        <th scope="col">BookName</th>
        <th scope="col">IssueDate</th>
        <th scope="col">Edit</th>
        <th scope="col">delete</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($data_student as $row){
        echo '<tr>
        <td>'.$row['id_student'].'</td>
        <td>'.$row['first_name'].'</td>
        <td>'.$row['last_name'].'</td>
        <td>'.$row['gender'].'</td>
        <td>'.$row['dob'].'</td>
        <td>'.$row['course'].'</td>
        <td>'.$row['semester'].'</td>
        <td>'.$row['mobile_no'].'</td>
        <td>'.$row['address'].'</td>
        <td>'.$row['blood_group'].'</td>
        <td>'.$row['book_name'].'</td>
        <td>'.$row['issue_date'].'</td>
        <td><a href="student-add.php?id_student='.$row['id_student'].'">Edit</td>
        <td><a href="students.php?id_student='.$row['id_student'].'&delete">Delete</td>
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
