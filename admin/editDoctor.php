<?php
define('TITLE','Edit Doctor');
define('PAGE','editDoctor');
include('includes/header.php');
include('../dbconnection.php');
session_start();
if(isset($_SESSION['is_adminlogin'])){
    $aEmail = $_SESSION['aEmail'];
}else{
    echo "<script>location.href='index.php'</script>";
}
?>

<!-- start 2nd column -->
<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Update Doctor Details</h3>
    <?php
   if(isset($_REQUEST['edit'])){
       $sql= "SELECT * FROM doctor_db WHERE doctor_id ={$_REQUEST['id']}";
       $result = $conn -> query($sql);
       $row=$result-> fetch_assoc();
   }
   
   if(isset($_REQUEST['docUpdate'])){
       if(($_REQUEST['doctor_id']=="") || ($_REQUEST['d_name']=="") || ($_REQUEST['d_speciality']=="")
       || ($_REQUEST['d_shift']=="") || ($_REQUEST['d_phone']=="") || ($_REQUEST['nmc_no']=="")){
           $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Fill All Fields</div>';
       }else{
           $did = $_REQUEST['doctor_id'];
           $dname = $_REQUEST['d_name'];
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
           $sql = "UPDATE doctor_db SET doctor_id='$did', d_name='$dname',d_shift='$dshift',d_eshift='$deshift',d_interval='$dinterval', d_phone='$dphone', nmc_no='$dnmc', speciality_id='$speciality_id' WHERE doctor_id='$did' ";
           if($conn->query($sql)==TRUE){
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Doctor Updated Successfully</div>';
           }else{
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to Update Doctor</div>';
           }
       }
   }

   $sqlS ="SELECT * FROM speciality_db";
    $query = $conn->query($sqlS);
    $data=array();
        while($rows = $query-> fetch_assoc()){
            array_push($data,$rows);
        }
   ?>
    <form action="" method="POST">
    <?php
        if(isset($msg)) {echo $msg;}
        ?>

        <div class="form-group">
            <label for="doctor_id">Doctor ID</label>
            <input type="text" class="form-control" name="doctor_id" id="doctor_id" Value="<?php if(isset($row['doctor_id'])){echo $row['doctor_id'];} ?>" readonly>
        </div>
        <div class="form-group">
            <label for="d_name">Name</label>
            <input type="text" class="form-control" name="d_name" id="d_name" Value="<?php if(isset($row['d_name'])){echo $row['d_name'];} ?>" >
        </div>
        <div class="form-group"> 
            <i class="fas fa-user"></i>  
            <label for="d_speciality" class="font-weight-bold pl-2">Speciality</label>
            <select name="d_speciality" class="form-control" id="d_speciality">
                <?php foreach($data as $value){ ?>
                <option><?php echo $value['speciality_name'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group"> 
            <i class="fas fa-user"></i>  
            <label  class="font-weight-bold pl-2">Shift</label><br>
            <label for="d_shift"> Start Time</label>
            <input type="time" class= "form-control" name="d_shift" id="d_shift" Value="<?php if(isset($row['d_shift'])){echo $row['d_shift'];} ?>">
            <label for="d_eshift"> End Time</label>
            <input type="time" class= "form-control" name="d_eshift" id="d_eshift" Value="<?php if(isset($row['d_eshift'])){echo $row['d_eshift'];} ?>">
            <label for="d_interval">Interval</label>
            <input type="text"  class= "form-control" name="d_interval" id="d_interval" Value="<?php if(isset($row['d_interval'])){echo $row['d_interval'];} ?>">
        </div>
      
        
        <div class="form-group">
            <label for="d_phone">Phone</label>
            <input type="number" class="form-control" name="d_phone" id="d_phone" Value="<?php if(isset($row['d_phone'])){echo $row['d_phone'];} ?>">
        </div>
        <div class="form-group">
            <label for="nmc_no">NMC Number</label>
            <input type="number" class="form-control" name="nmc_no" id="nmc_no" Value="<?php if(isset($row['nmc_no'])){echo $row['nmc_no'];} ?>" readonly>
        </div>
        <div class="text-center">
        <button type="submit" class="btn btn-danger" id="docUpdate" name="docUpdate">Update</button>
        <a href="doctors.php" class="btn btn-secondary">Close</a>
        </div>

        
    </form>
</div>

<!-- end 2nd column -->

<?php
 include('includes/footer.php');
?>