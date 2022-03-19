<?php
    define('TITLE', 'Profile');
    define('PAGE', 'docprofile');

    include('includes/header.php');
    include('../dbconnection.php');
    session_start();
    if($_SESSION['is_doc_login']){
        $id= $_SESSION['d_id'];
    }
    else{
        echo "<script> location.href='index.php'</script>";
    }?>
    <!-- start 2nd column -->
    <div class="col-sm-6 mt-5 mx-3 ">
        <h3 class="text-center">Update Your Details</h3>
        <?php
    
           $sql= "SELECT * FROM doctor_db WHERE doctor_id =$id";
           $result = $conn -> query($sql);
           $row=$result-> fetch_assoc();
     
       
       if(isset($_REQUEST['docUpdate'])){
           if(($_REQUEST['d_name']=="")
           ||( $_REQUEST['d_email']=="")|| ($_REQUEST['d_shift']=="") || ($_REQUEST['d_eshift']=="") || 
           ($_REQUEST['d_interval']=="") ||($_REQUEST['d_phone']=="")){
               $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Fill All Fields</div>';
           }else{
               $dname = $_REQUEST['d_name'];
               $demail = $_REQUEST['d_email'];
               $dname = $_REQUEST['d_name'];
               $dshift =  $_REQUEST['d_shift'];
               $deshift =  $_REQUEST['d_eshift'];
               $dinterval =  $_REQUEST['d_interval'];
               $dphone = $_REQUEST['d_phone'];
               $sql = "UPDATE doctor_db SET d_name='$dname',d_email=$demail,
               d_shift='$dshift',d_eshift='$deshift',d_interval='$dinterval'
               , d_phone='$dphone',  WHERE doctor_id=$id" ;
               if($conn->query($sql)==TRUE){
                $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Doctor Updated Successfully</div>';
               }else{
                $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to Update Doctor</div>';
               }
           }
       }

       ?>
       
        <form action="" method="POST">
        <?php
            if(isset($msg)) {echo $msg;}
            ?>
            <div class="form-group">
                <label for="d_name">Name</label>
                <input type="text" class="form-control" name="d_name" id="d_name" Value="<?php if(isset($row['d_name'])){echo $row['d_name'];} ?>" >
            </div>
            <div class="form-group">
                <label for="d_email">Email</label>
                <input type="text" class="form-control" name="d_email" id="d_email" Value="<?php if(isset($row['d_email'])){echo $row['d_email'];} ?>" >
            </div>
            <div class="form-group">
                <label for="d_email">Password</label>
                <input type="password" class="form-control" name="d_email" id="d_email" Value="<?php if(isset($row['d_password'])){echo $row['d_password'];} ?>" >
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
    

<?php
 include('includes/footer.php');
?>