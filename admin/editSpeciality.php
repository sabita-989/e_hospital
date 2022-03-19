<?php
define('TITLE','Edit Speciality');
define('PAGE','editSpeciality');
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
    <h3 class="text-center">Update Speciality</h3>
    <?php
   if(isset($_REQUEST['edit'])){
       $sql= "SELECT * FROM speciality_db WHERE speciality_id ={$_REQUEST['id']}";
       $result = $conn -> query($sql);
       $row=$result-> fetch_assoc();
   }
   
   if(isset($_REQUEST['specialityUpdate'])){
        if(($_REQUEST['speciality_name']=="")){
           $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Fill All Fields</div>';
       }else{
           $sid = $_REQUEST['speciality_id'];
           $sname = $_REQUEST['speciality_name'];
           $sql = "UPDATE speciality_db SET speciality_id='$sid', speciality_name='$sname' WHERE speciality_id='$sid' ";
           if($conn->query($sql)==TRUE){
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Speciality Updated Successfully</div>';
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
            <label for="speciality_id">Speciality ID</label>
            <input type="text" class="form-control" name="speciality_id" id="speciality_id" Value="<?php if(isset($row['speciality_id'])){echo $row['speciality_id'];} ?>" readonly>
        </div>
        <div class="form-group">
            <label for="speciality_name">Speciality Name</label>
            <input type="text" class="form-control" name="speciality_name" id="speciality_name" Value="<?php if(isset($row['speciality_name'])){echo $row['speciality_name'];} ?>" >
        </div>
        <div class="text-center">
        <button type="submit" class="btn btn-danger" id="specialityUpdate" name="specialityUpdate">Update</button>
        <a href="speciality.php" class="btn btn-secondary">Close</a>
        </div>

        
    </form>
</div>

<!-- end 2nd column -->

<?php
 include('includes/footer.php');
?>