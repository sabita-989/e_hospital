<?php
define('TITLE','Change Status');
define('PAGE','changestatus');
include('includes/header.php');
include('../dbconnection.php');

if(isset($_POST['submit'])){
    $id=$_GET['id'];
    $status= 1;
    $sql = "UPDATE appointment_db SET a_status=$status WHERE appointment_id=$id";
    if($conn->query($sql)==TRUE){
      //  header('Location: patientrequest.php');
     $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Doctor Updated Successfully</div>';
    }else{
     $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to Update Doctor</div>';
    }

    $d=$_GET['d'];
    $s=$_GET['s']; 
    $di=$_GET['di'];
    $sql2 ="select * from appointment_db where inputdate='$d' and shift='$s' and doctor_id=".$di;
    $results = $conn->query($sql2);
    $same_time_apt_cnt = mysqli_num_rows( $results);
    $hit_miss= 1 / $same_time_apt_cnt;
    if($results->num_rows > 0){
        while($rows=$results-> fetch_assoc()){
            $sql3 = "UPDATE appointment_db SET hit_miss=$hit_miss WHERE appointment_id=".$rows['appointment_id'];
            if($conn->query($sql3)==TRUE){
                header('Location: patientrequest.php');
             $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Doctor Updated Successfully</div>';
            }else{
             $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to Update Doctor</div>';
            }
        }}
}
?>
<div class="container">
    <br><br>
    <?php  $id=$_GET['id']; ?>
    <h1 style="font-family: 'Architects Daughter', cursive; text-align:center; color:#737373;">Do you want to accept appointment for ID#<?php echo $id; ?> ?</h1>
    <br> <br>
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
<form action="" method="POST">
    <button class="btn btn-success btn-block" name="submit">Accept Appointment</button>
</form><br><br>
<?php 
  $d=$_GET['d'];
  $s=$_GET['s']; 
  $sql2 ="select * from appointment_db where inputdate='$d' and shift='$s' ";
  $results = $conn->query($sql2);
  $same_time_apt_cnt = mysqli_num_rows( $results);
  $hit_miss= 1 / $same_time_apt_cnt;
  echo "Hit By: ".round($hit_miss,3);
?>
</div>
<div class="col-md-2"></div>
</div>
</div>
</div>



