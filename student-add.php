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

if(isset($_POST['id_student']) && $_POST['id_student'])
{
    $sql = 'UPDATE `student` SET `first_name`= \''.$_POST['first_name'].'\',
    `last_name`= \''.$_POST['last_name'].'\',
    `gender` = \''.$_POST['gender'].'\',
    `dob` = \''.$_POST['dob'].'\',
    `course` = \''.$_POST['course'].'\',
    `semester` = \''.$_POST['semester'].'\',
    `mobile_no` = \''.$_POST['mobile_no'].'\',
    `address` = \''.$_POST['address'].'\',
    `blood_group` = \''.$_POST['blood_group'].'\',
    `book_name` = \''.$_POST['book_name'].'\',
    `issue_date` = \''.$_POST['issue_date'].'\'
    WHERE id_student = '.(int)$_POST['id_student'].'';
    $result = mysqli_execute_query($connection,$sql);
    header('Location: students.php');
    exit;
}
  else {
    $query = 'INSERT INTO `student`(`first_name`,`last_name`,`gender`,`dob`,`course`,
        `semester`,`mobile_no`,`address`,`blood_group`,`book_name`,`issue_date`)
        VALUES (\''.$_POST['first_name'].'\',
        \''.$_POST['last_name'].'\',
        \''.$_POST['gender'].'\',
        \''.$_POST['dob'].'\',
        \''.$_POST['course'].'\',
        '.$_POST['semester'].',
        \''.$_POST['mobile_no'].'\',
        \''.$_POST['address'].'\',
        \''.$_POST['blood_group'].'\',
        \''.$_POST['book_name'].'\',
        \''.$_POST['issue_date'].'\')';
        $result = mysqli_execute_query($connection,$query);
        header('Location: students.php');
        exit;
    }
}

    if(isset($_GET['id_student']))
    {
      $id_student = $_GET['id_student'];
      $result = mysqli_execute_query($connection,'SELECT * FROM `student` WHERE `id_student`='.(int)$id_student);
      $edit_student = null;
      foreach($result as $student)
      {
        $edit_student = $student;
      }
    }
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Student registration</title>
    <?php
      require('head.inc');
     ?>
  </head>
  <body>
      <form class="" action="student-add.php" method="post">




      <div class="card shadow-2-strong card-registration bg-info text-black" style="border-radius: 15px;">
        <div class="card-body p-4 p-md-5">
            <h3 class="mb-3 pb-2 pb-md-0 mb-md-5 ">Registration Form</h3>
            <div class="row">
              <div class="col-md-6 mb-3">

                <div class="form-outline">
                  <label class="form-label" for="first_name">First Name*</label>
                  <input type="text" id="first_name"  name="first_name" class="form-control form-control-md" value="<?php echo isset($edit_student['first_name'])?$edit_student['first_name']:'' ?>"/>
                </div>

              </div>
              <div class="col-md-6 mb-3">

                <div class="form-outline">
                  <label class="form-label" for="last_name">Last Name*</label>
                  <input type="text" id="last_name" name="last_name" class="form-control form-control-md" value="<?php echo isset($edit_student['last_name'])?$edit_student['last_name']:'' ?>"/>
                </div>

              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3 d-flex align-items-center">

                <div class="form-outline datepicker w-100">
                  <label for="dob" class="form-label">Birthday</label>
                  <input type="text" class="form-control form-control-md" id="birth_date" name="dob" value="<?php echo isset($edit_student['birth_date'])?$edit_student['birth_date']:'' ?>"/>
                </div>

              </div>
              <div class="col-md-6 mb-3 pb-2">

                <div class="form-outline">
                  <label class="form-label" for="mobile_no">Phone Number</label>
                  <input type="tel" id="mobile_no" name="mobile_no" class="form-control form-control-md" value="<?php echo isset($edit_student['mobile_no'])?$edit_student['mobile_no']:'' ?>"/>
                </div>

              </div>
            </div>

            <div class="row">
              <div class="col-12 mb-3 pb-2">
                <div class="form-outline">
                    <label class="form-label" for="address">Address</label>
                  <input type="textarea" id="address" name="address" class="form-control form-control-md" value="<?php echo isset($edit_student['address'])?$edit_student['address']:'' ?>"/>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3 pb-2">
                <label class="form-label select-label">Choose Course</label>
                <select class="select form-control-sm " name="course" id="course">
                  <option  value="" >Choose Course</option>
                  <option value="BCA" <?php echo (isset($edit_student['course']) && $edit_student['course'] == 'BCA')?"selected=selected":'';?> >BCA</option>
                  <option value="BBA" <?php echo (isset($edit_student['course']) && $edit_student['course'] == 'BBA')?"selected=selected":'';?> >BBA</option>
                  <option value="B.Com" <?php echo (isset($edit_student['course']) && $edit_student['course'] == 'B.Com')?"selected=selected":'';?> >B.Com</option>
                  <option value="B.Sc" <?php echo (isset($edit_student['course']) && $edit_student['course'] == 'B.Sc')?"selected=selected":'';?> >B.Sc</option>
                  <option value="BA" <?php echo (isset($edit_student['course']) && $edit_student['course'] == 'BA')?"selected=selected":'';?> >BA</option>
                  <option value="MSc.IT" <?php echo (isset($edit_student['course']) && $edit_student['course'] == 'Msc.IT')?"selected=selected":'';?> >Msc.IT</option>
                </select>
              </div>
              <div class="col-md-6 mb-3 pb-2" >
                <label class="form-label select-label">Choose Sem</label>
                <select class="select form-control-sm" name="semester" id="semester">
                  <option  >Choose Semester</option>
                  <option value="1" <?php echo (isset($edit_student['semester']) && $edit_student['semester'] == '1')?"selected=selected":'';?> >sem 1</option>
                  <option value="2" <?php echo (isset($edit_student['semester']) && $edit_student['semester'] == '2')?"selected=selected":'';?> >sem 2</option>
                  <option value="3" <?php echo (isset($edit_student['semester']) && $edit_student['semester'] == '3')?"selected=selected":'';?> >sem 3</option>
                  <option value="4" <?php echo (isset($edit_student['semester']) && $edit_student['semester'] == '4')?"selected=selected":'';?> >sem 4</option>
                  <option value="5" <?php echo (isset($edit_student['semester']) && $edit_student['semester'] == '5')?"selected=selected":'';?> >sem 5</option>
                  <option value="6" <?php echo (isset($edit_student['semester']) && $edit_student['semester'] == '6')?"selected=selected":'';?> >sem 6</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3 pb-2">

                <div class="form-outline">
                    <label class="form-label" for="blood_group">Blood Group</label>
                  <input type="text" id="blood_group" name="blood_group" class="form-control form-control-md" value="<?php echo isset($edit_student['blood_group'])?$edit_student['blood_group']:'' ?>"/>
                </div>

              </div>
              <div class="col-md-6 mb-3">

                <h6 class="mb-2 pb-1">Gender: </h6>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="femaleGender"
                    value="female" <?php echo (isset($edit_student['gender']) && $edit_student['gender'] == 'female')?"checked=checked":'';?>/>
                  <label class="form-check-label" for="femaleGender">Female</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="maleGender"
                    value="male" <?php echo (isset($edit_student['gender']) && $edit_student['gender'] == 'male')?"checked=checked":'';?>/>
                  <label class="form-check-label" for="maleGender">Male</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="otherGender"
                    value="other" <?php echo (isset($edit_student['gender']) && $edit_student['gender'] == 'other')?"checked=checked":'';?>/>
                  <label class="form-check-label" for="otherGender">Other</label>
                </div>

              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3 pb-2">

                <div class="form-outline">
                    <label class="form-label" for="book_name">Book Name*</label>
                  <input type="text" id="book_name" name="book_name" class="form-control form-control-md" value="<?php echo isset($edit_student['book_name'])?$edit_student['book_name']:'' ?>"/>
                </div>

              </div>
              <div class="col-md-6 mb-3 pb-2">

                <div class="form-outline">
                    <label class="form-label" for="issue_date">Issue Date</label>
                  <input type="text" id="issue_date" name="issue_date" class="form-control form-control-md" value="<?php echo isset($edit_student['issue_date'])?$edit_student['issue_date']:'' ?>"/>
                </div>

              </div>
            </div>
            <input type="hidden" name="id_student" id="id_student" value="<?php echo isset($edit_student['id_student'])?$edit_student['id_student']:''; ?>">
            <div class="mt-3 pt-2">
              <input class="btn btn-primary btn-md" type="submit" name="submit" id="saveStudent" value="Submit" />
            </div>
        </div>
      </div>
    </div>
  </div>


      </form>
  </body>
</html>
