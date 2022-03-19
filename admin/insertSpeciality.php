<?php
define('TITLE','Add Speciality');
define('PAGE','addSpeciality');
include('includes/header.php');
include('../dbconnection.php');
session_start();
if(isset($_SESSION['is_adminlogin'])){
    $aEmail = $_SESSION['aEmail'];
}else{
    echo "<script>location.href='index.php'</script>";
}

if(isset($_REQUEST['addSpeciality'])){
    if($_REQUEST['d_speciality']==""){
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Fill All Fields</div>';
    }else{
        $dspeciality =  $_REQUEST['d_speciality'];
        $sql = "INSERT INTO speciality_db(speciality_name) VALUES ('$dspeciality')";
        if($conn->query($sql)==TRUE){
         $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Added Successfully</div>';
        }else{
         $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to Add</div>';
        }
    }
}
?>

<!-- start 2nd column -->
<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Add Speciality</h3>
    <form action="" class="shadow-lg p-4" method="POST">
    <?php if(isset($msg)) {echo $msg;} ?>
        <div class="form-group"> 
            <i class="fas fa-user"></i>  
            <label for="d_name" class="font-weight-bold pl-2">Speciality Name</label>
            <input type="text" class= "form-control" name="d_speciality" id="d_speciality">
        </div>

        <button type="submit" class="btn btn-danger" name="addSpeciality" id="addSpeciality">Submit</button>
        <a href="speciality.php" class="btn btn-secondary">Close</a>
            
                           
        
    
    </form>
</div>
<!-- end 2nd column -->


<?php
 include('includes/footer.php');
?>