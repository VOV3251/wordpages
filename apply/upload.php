<?php
session_start();
error_reporting(0);
include 'header.php';
include('../connect.php');



$sql = "select * from admission where email='".$_SESSION['email']."'"; 
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);
$photo=$row['photo'];


if(isset($_POST['btnupload'])){
$image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
	$image_name= addslashes($_FILES['image']['name']);
	$image_size= getimagesize($_FILES['image']['tmp_name']);
	move_uploaded_file($_FILES["image"]["tmp_name"],"../upload/" . $_FILES["image"]["name"]);			
			$location="upload/" . $_FILES["image"]["name"];

 $sql = " update admission set ssce='$location' where email='".$_SESSION['email']."'";
   $_SESSION['reg_success']=$location;
   if (mysqli_query($conn, $sql)) {

    ?>
									
<script>
alert('SSCE has been Uploaded successfully ');
window.location = "upload.php";

</script>

	<?php	
}
}

?>

<title>Upload Image| </title>
	<style type="text/css">
<!--
.style1 {
	color: #0000FF;
	font-weight: bold;
}
.style2 {color: #FF0000}
-->
    </style>
	<div class="container">
  <div class="row">
    <div class="col-lg-6">
      <div class="well contact-form-container">
       	<form  class="wizard-big" method="post"  enctype="multipart/form-data">
          <fieldset>
            
			  <div class="form-group">
              <label class="col-lg-12 control-label" style="font-family:Noto Sans Lao, sans-serif;" for="uemail"><span class="style1" style="font-family:Noto Sans Lao, sans-serif;">Upload your SSCE Here </span><br />
              <br />
              ຊື່: <?php echo $_SESSION['fullname']; ?>
              </label>
            </div>
			
            <div class="form-group">
              <label class="col-lg-12 control-label" style="font-family:Noto Sans Lao, sans-serif;" for="uemail">ຈີເມວ: <?php echo $_SESSION['email']; ?>
             
              </label>
            </div>

<div class="form-group">
              <label class="col-lg-12 control-label" style="font-family:Noto Sans Lao, sans-serif;" for="uemail"> ລະຫັດຂອງນັກຮຽນ (N5900) : <?php echo $_SESSION['ApplicationID']; ?>
             
              </label>
            </div>

            <div class="form-group">
                  <label class="col-lg-12 control-label" style="font-family:Noto Sans Lao, sans-serif;" for="uemail"> ຫ້ອງ: <?php echo $row['room']; ?>
                  </label>
              </div>


			 <div class="form-group">
              <label class="col-lg-12 control-label" for="pass1"><span class="controls"><br />
              <br />
              <span class="style2" style="font-family:Noto Sans Lao, sans-serif;">N/B: ກະລູນາກອບປີ ຈີເມວ ແລະ ລະຫັດຂອງນັກຮຽນເອົາໄວ ເພື່ອຍັງຢື່ນ ແລະເຂົ່າຫນ້າໂປຣຟາຍຂອງຕົວເອງ</span> <br />
              <img src="../<?php echo $row['ssce'];?>"  width="333" height="333" border="6" /></span><br />
              <br />
             
                <input type="file" class="form-control" name="image">
              </label>
            </div>
		  <div class="form-group">
             
			 
		    <label class="col-lg-12 control-label" for="pass1"></label>
		  </div>
           


            <div style="height: 10px;clear: both"></div>




           
                <p>&nbsp;</p>
                <table width="233" border="0">
                  <tr>
                    <td width="81">&nbsp; 
					  <div class="form-group">
                        <div class="col-lg-10">
                          <div align="center">
                            <button class="btn btn-primary" type="submit" name="btnupload">Upload</button>
                          </div>
                        </div>
				      </div>
					  <div align="center"><a href="../login.php"></a></div></td>
                    <td width="142">&nbsp;
                      <div align="center"><a href="register.php"><h3 style="font-family:Noto Sans Lao, sans-serif;">ສຳເລັດ</h3> </a></div></td>
                  </tr>
          </table> 
             
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>
