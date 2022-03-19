<?php
define('TITLE','View Appointment');
define('PAGE','viewWork');
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
<div class="col-sm-6 mt-5 mx-3">
<h3 class="text-center">Appointment Details</h3>
<?php
 if(isset($_REQUEST['view'])){
    $sql="SELECT submitrequest_db.*,doctor_db.d_name as doctor_name,speciality_db.speciality_name as speciality_name FROM submitrequest_db join doctor_db on submitrequest_db.r_doctor = doctor_db.doctor_id join speciality_db on submitrequest_db.r_speciality = speciality_db.speciality_id WHERE r_id={$_REQUEST['id']}";
    $result = $conn-> query($sql);
    $row = $result->fetch_assoc(); ?>

    <table class="table table-bordered">
        <tbody>
            <tr>
                <td>Request ID</td>
                <td><?php if(isset($row['r_id'])){
                    echo $row['r_id'];} ?></td>                
            </tr>
            <tr>
                <td>Name</td>
                <td><?php if(isset($row['r_name'])){
                    echo $row['r_name'];} ?></td>                
            </tr>
            <tr>
                <td>Disease</td>
                <td><?php if(isset($row['r_illness'])){
                    echo $row['r_illness'];} ?></td>                
            </tr>
            <tr>
                <td>Shift</td>
                <td><?php if(isset($row['r_shift'])){
                    echo $row['r_shift'];} ?></td>                
            </tr>
           
            <tr>
                <td>Gender</td>
                <td><?php if(isset($row['r_gender'])){
                    echo $row['r_gender'];} ?></td>                
            </tr>

            <tr>
                <td>Age</td>
                <td><?php if(isset($row['r_age'])){
                    echo $row['r_age'];} ?></td>                
            </tr>
            
            <tr>
                <td>Phone</td>
                <td><?php if(isset($row['r_phone'])){
                    echo $row['r_phone'];} ?></td>                
            </tr>
        
            <tr>
                <td>Doctor Speciality</td>
                <td><?php if(isset($row['speciality_name'])){
                    echo $row['speciality_name'];} ?></td>                
            </tr>
            <tr>
                <td>Assigned doctor</td>
                <td><?php if(isset($row['doctor_name'])){
                    echo $row['doctor_name'];} ?></td>                
            </tr>
            <tr>
                <td> doctor Date</td>
                <td><?php if(isset($row['r_date'])){
                    echo date('dS M, Y',strtotime($row['r_date']));} ?></td>                
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <?php 
                        if(isset($row['r_status']) && $row['r_status'] == 0 ){
                            echo 'unverified';
                        }elseif(isset($row['r_status']) && $row['r_status'] == 1 ){
                            echo 'approved';
                        }elseif(isset($row['r_status']) && $row['r_status'] == 2 ){
                            echo 'closed';
                        }elseif(isset($row['r_status']) && $row['r_status'] == 3 ){
                            echo 'checked';
                        }
                     ?>
                        
                </td>                
            </tr>
        </tbody>
    </table>
    <div class="text-right mb-5">
        <a href="ChangeStatus.php?id=<?php echo $row['r_id']; ?>" class="btn btn-success">Checked</a>
        <a href="AppointmentOrder.php" class="btn btn-primary">Close</a>        
    </div>
 <?php } ?>
</div>

<!-- end 2nd column -->

<?php
 include('includes/footer.php');
?>