<?php
define('TITLE','Add Doctor');
define('PAGE','addDoctor');
include('includes/header.php');
include('../dbconnection.php');
session_start();
if(isset($_SESSION['is_adminlogin'])){
    $aEmail = $_SESSION['aEmail'];
}else{
    echo "<script>location.href='index.php'</script>";
}

if(isset($_REQUEST['addDoc'])){
    $sql="SELECT nmc_no FROM doctor_db WHERE nmc_no='".$_REQUEST['nmc_no']."'";
        $result = $conn->query($sql);
        if($result->num_rows>0){
            $errors['nmc_no'] = "NMC number Already Exists.It must be unique";
        }

        $data = [];
        $flag = true;
        $errors = [];
        if(preg_match("/^[0-9]{10}$/", $_REQUEST['d_phone'])) {
            // $phone is valid
          }
          else{
              $errors['d_phone']="Phone number must be exactly 10 numbers";
          }

    if(empty($errors)){
    if(($_REQUEST['d_name']=="") ||($_REQUEST['d_email']=="") || ($_REQUEST['d_speciality']=="") ||  ($_REQUEST['d_shift']=="")
     || ($_REQUEST['d_phone']=="") || ($_REQUEST['nmc_no']=="")){
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Fill All Fields</div>';
    }else{
        $dname = $_REQUEST['d_name'];
        $demail = $_REQUEST['d_email'];
        $dspeciality =  $_REQUEST['d_speciality'];
        $sqlI = "SELECT speciality_id FROM speciality_db WHERE speciality_name = '$dspeciality'";
       $query = mysqli_query($conn, $sqlI);
       $speciality_id_array = mysqli_fetch_assoc($query);
       $speciality_id = $speciality_id_array['speciality_id'];
        $dshift =  $_REQUEST['d_shift'];
        $deshift =  $_REQUEST['d_eshift'];
        $dinterval =  $_REQUEST['d_interval'];
     
        $dphone = $_REQUEST['d_phone'];
        $dnmc = $_REQUEST['nmc_no'];

        $sql = "INSERT INTO doctor_db (d_name,d_email,d_password,d_shift,d_eshift,d_interval,d_phone,nmc_no,speciality_id) VALUES ('$dname','$demail','12345','$dshift','$deshift','$dinterval','$dphone','$dnmc','$speciality_id')";
        if($conn->query($sql)==TRUE){
         $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Added Successfully</div>';
        }else{
         $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to Add</div>';
        }
    }
    }
}
?>  

<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Add New Doctor</h3>
    <form action="" class="shadow-lg p-4" method="POST">
    <?php if(isset($msg)) {echo $msg;} ?>
        <div class="form-group"> 
            <i class="fas fa-user"></i>  
            <label for="d_name" class="font-weight-bold pl-2">Name</label>
            <input type="text" class= "form-control" name="d_name" id="d_name">
        </div>
        <div class="form-group"> 
            <i class="fas fa-user"></i>  
            <label for="d_email" class="font-weight-bold pl-2">Email</label>
            <input type="text" class= "form-control" name="d_email" id="d_email">
        </div>

        <div class="form-group"> 
            <i class="fas fa-user"></i>  
            <label for="d_speciality" class="font-weight-bold pl-2">Speciality</label>
            <select name="d_speciality" class="form-control" id="d_speciality">
                <option>Select Speciality</option>
                <?php $sqlS ="SELECT * FROM speciality_db";
                      $query = $conn->query($sqlS); 
                      while($rows = $query-> fetch_assoc()){
                          ?>
                <option><?php echo $rows['speciality_name'] ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group"> 
            <i class="fas fa-user"></i>  
            <label  class="font-weight-bold pl-2">Shift</label><br>
            <label for="d_shift"> Start Time</label>
            <input type="time" class= "form-control" name="d_shift" id="d_shift">
            <label for="d_eshift"> End Time</label>
            <input type="time" class= "form-control" name="d_eshift" id="d_shift">
            <label for="d_interval">Interval</label>
            <input type="text"  class= "form-control" name="d_interval" id="d_interval">
        </div>

        <div class="form-group"> 
            <i class="fas fa-phone"></i> 
            <label for="d_phone" class="font-weight-bold pl-2">Phone</label>
            <input type="number" class= "form-control" name="d_phone" id="d_phone">
            <?php echo (isset($errors['d_phone'])) ? '<p class="alert alert-danger mt-2">' . $errors['d_phone'] . '</p>' : null; ?>
        </div>


        <div class="form-group"> 
            <i class="fas fa-key"></i>  
            <label for="nmc_no" class="font-weight-bold pl-2">NMC Number</label>
            <input type="number" class= "form-control" name="nmc_no" id="nmc_no">
            <?php echo (isset($errors['nmc_no'])) ? '<p class="alert alert-danger">' . $errors['nmc_no'] . '</p>' : null; ?>
        </div>

        <button type="submit" class="btn btn-danger" name="addDoc" id="addDoc">Submit</button>
        <a href="doctors.php" class="btn btn-secondary">Close</a>
            
                           
        
    
    </form>
</div>
<!-- end 2nd column -->


<?php
 include('includes/footer.php');
?>