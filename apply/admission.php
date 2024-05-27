<?php
// Function to generate room options based on the exam number
function generateRoomOptions($examNumber)
{
    // Define the maximum number of rooms per exam
    $maxRooms = 5;

    // Generate room options based on the exam number
    for ($i = 1; $i <= $maxRooms; $i++) {
        echo "<option value='$examNumber/$i'>Room $examNumber/$i</option>";
    }
}

session_start();
error_reporting(1);
include 'header.php';
include('../connect.php');

//update scratch card status
$sqli = "UPDATE scratchcard SET status='1' WHERE serial='" . $_SESSION['serial'] . "'";
mysqli_query($conn, $sqli);

date_default_timezone_set('Africa/Lagos');
$current_date = date('Y-m-d');

if (isset($_POST["btnsubmit"])) {

    //Get application ID
    function applicationID()
    {
        $string = (uniqid(rand(), true));
        return substr($string, 0, 5);
    }

    $applicationID = "NSA/" . date("Y") . "/" . applicationID();

    $fullname = mysqli_real_escape_string($conn, $_POST['txtfullname']);
    $sex = mysqli_real_escape_string($conn, $_POST['cmdsex']);
    $phone = mysqli_real_escape_string($conn, $_POST['txtphone']);
    $email = mysqli_real_escape_string($conn, $_POST['txtemail']);
    $lga = mysqli_real_escape_string($conn, $_POST['txtlga']);
    $state = mysqli_real_escape_string($conn, $_POST['txtstate']);
    $jambno = mysqli_real_escape_string($conn, $_POST['txtjambno']);
    $jambscore = mysqli_real_escape_string($conn, $_POST['txtjambscore']);
    $faculty = mysqli_real_escape_string($conn, $_POST['txtfaculty']);
    $dept = mysqli_real_escape_string($conn, $_POST['txtdept']);
    // $exam = mysqli_real_escape_string($conn, $_POST['txtexam']);
    // $selected_room_id = mysqli_real_escape_string($conn, $_POST['room_id']); // New: Fetch selected room_id
    $photo='upload/default.jpg';
    $credential='upload/Result-Report-card-software.png';
    // $credential = 'upload/Result-Report-card-software.png';

    $status = '0';

    // Insert form data into the admission table
    $sql = "INSERT INTO admission (fullname, sex, phone, email, lga, state, jamb_number, jamb_score, faculty, dept, ssce, status, photo, date_admission, applicationID) VALUES ('$fullname', '$sex', '$phone', '$email', '$lga', '$state', '$jambno', '$jambscore', '$faculty', '$dept', '$credential', '$status', '$photo', '$current_date', '$applicationID')";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        // Set session variables
        $_SESSION['email'] = $email;
        $_SESSION['fullname'] = $fullname;
        $_SESSION['ApplicationID'] = $applicationID;

        // Redirect to upload.php
        header("Location: upload.php");
    } else {
?>
        <script>
            alert('Problem Occurred, Try Again');
        </script>
<?php
    }
}
?>


<title style="font-family:Noto Sans Lao, sans-serif;">ກະລູນາປ້ອນຂໍ້ມູນຂອງນັກຮຽນໃຫ້ຄົບຖ້ວນ </title>
<?php if ($msg <> "") { ?>
  <style type="text/css">
    *{
      font-family:Noto Sans Lao, sans-serif;
      
    }
    .contact-form-container {
  text-align: center; /* Center align the contents */
}

.contact-form-container fieldset {
  display: inline-block; /* Make the fieldset inline-block */
}
<!--
.style1 {
    font-size: 12px;
    color: #FF0000;
}
-->
  </style>
  <div class="alert alert-dismissable alert-<?php echo $msgType; ?>">
    <button data-dismiss="alert" class="close" type="button">x</button>
    <p><?php echo $msg; ?></p>
  </div>
<?php } ?>
<p><h4><?php echo "<p> <font color=red font face='arial' size='3pt'>$msg_error</font> </p>"; ?></h4>  </p>
  <h4><?php echo "<p> <font color=green font face='arial' size='3pt'>$msg_success</font> </p>"; ?></h4>  </p>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="well contact-form-container">


<form class="form-horizontal contactform" action="" method="post" name="f" >
          <fieldset>
    
          <div class="form-group">
    <label class="col-lg-12 control-label fs-3 mt-2" style="font-family:Noto Sans Lao, sans-serif; margin-bottom: 1rem;" for="pass1">ຊື້ ແລະນາມສະກຸນ:
        <input type="text" id="pass1" class="form-control" name="txtfullname" value="<?php if (isset($_POST['txtfullname'])) echo $_POST['txtfullname']; ?>" required="">
    </label>
</div>

            <div class="form-group">
              <label class="col-lg-12 control-label" style="font-family:Noto Sans Lao, sans-serif; margin-bottom: 1rem;" for="pass1">ເພດ:
               <select name="cmdsex" id="gender" class="form-control" required="">
                                                    <option style="font-family:Noto Sans Lao, sans-serif;" value=" ">--ເລືອກ ເພດ--</option>
                                                     <option style="font-family:Noto Sans Lao, sans-serif;" value="Male">Male</option>
                                                      <option style="font-family:Noto Sans Lao, sans-serif;" value="Female">Female</option>
                                              </select>
              </label>
            </div>

            <div class="form-group">
              <label class="col-lg-12 control-label" style="font-family:Noto Sans Lao, sans-serif; margin-bottom: 1rem;" for="pass1">ວັນເດືອນປີເກີດ:
                <input type="text"  id="pass1" class="form-control" name="txtjambno"  value="<?php if (isset($_POST['txtjambno']))?><?php echo $_POST['txtjambno']; ?>" required="">
              </label>
            </div>

              <div class="form-group">
              <label class="col-lg-12 control-label" style="font-family:Noto Sans Lao, sans-serif; margin-bottom: 1rem;" for="pass1">ເບີໂທ:
                <input type="text"  id="pass1" class="form-control" name="txtphone" value="<?php if (isset($_POST['txtphone']))?><?php echo $_POST['txtphone']; ?>" required="">
              </label>
            </div>
            <div class="form-group">
              <label class="col-lg-12 control-label" style="font-family:Noto Sans Lao, sans-serif; margin-bottom: 1rem;" for="uemail">ຈີເມວ:
             <input type="email" name="txtemail" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  value="<?php if (isset($_POST['txtemail']))?><?php echo $_POST['txtemail']; ?>" required>
              </label>
            </div>


            <div class="form-group">
              <label class="col-lg-12 control-label" style="font-family:Noto Sans Lao, sans-serif; margin-bottom: 1rem;" for="pass1">ບາ້ນ:
                <input type="text"  id="pass1" class="form-control" name="txtdept"  value="<?php if (isset($_POST['txtdept']))?><?php echo $_POST['txtdept']; ?>" required="">
              </label>
            </div>

             <div class="form-group">
              <label class="col-lg-12 control-label" style="font-family:Noto Sans Lao, sans-serif; margin-bottom: 1rem;" for="pass1">ເມື່ອງ :
                <input type="text"  id="pass1" class="form-control" name="txtlga" value="<?php if (isset($_POST['txtlga']))?><?php echo $_POST['txtlga']; ?> " required="">
              </label>
            </div>


                <div class="form-group">
              <label class="col-lg-12 control-label" style="font-family:Noto Sans Lao, sans-serif; margin-bottom: 1rem;" for="pass1">ແຂວງ:
                <input type="text"  id="pass1" class="form-control" name="txtstate" value="<?php if (isset($_POST['txtstate']))?><?php echo $_POST['txtstate']; ?>" required="">
              </label>
            </div>
            
                        <div class="form-group">
              <label class="col-lg-12 control-label" style="font-family:Noto Sans Lao, sans-serif; margin-bottom: 1rem;" for="pass1">ຊື່ຜູ້ປົກຄ້ອງ:
                <input type="text"  id="pass1" class="form-control" name="txtfaculty"  value="<?php if (isset($_POST['txtfaculty']))?><?php echo $_POST['txtfaculty']; ?>" required="">
              </label>
            </div>

            <div class="form-group">
              <label class="col-lg-12 control-label" style="font-family:Noto Sans Lao, sans-serif; margin-bottom: 1rem;" for="pass1">ເບີຕິດຕໍ່ຜູ້ປົກຄອງ :
                <input type="text"  id="pass1" class="form-control" name="txtjambscore"  value="<?php if (isset($_POST['txtjambscore']))?><?php echo $_POST['txtjambscore']; ?>" required="">
              </label>
            </div>
            
            <div style="height: 10px;clear: both"></div>

            <div class="form-group">
            
            
              <div class="col-lg-10">
                <button class="btn btn-lg fs-3 btn-primary" type="submit" name="btnsubmit">Submit</button> 
              </div>
            </div>
          </fieldset>
        </form>


      </div>
    </div>
  </div>
</div>

<p>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p data-v-6f398a90="">&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

