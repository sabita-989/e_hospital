<?php
    define('TITLE', 'Appointment');
    define('PAGE', 'notification');
    include('includes/header.php');
    include('../dbconnection.php');
    
    session_start();
    if($_SESSION['is_login']){
        $rEmail= $_SESSION['rEmail'];
    }
    else{
        echo "<script> location.href='requesterLogin.php'</script>";
    }
   
    
    ?>

<div class="container"><br>
<?php
$reschedule_delete_flag=0;
$user_id= $_SESSION['u_id'];
//echo $user_id;
$sql ="SELECT * FROM appointment_db WHERE r_login_id=$user_id ORDER BY appointment_id desc";
$result = $conn->query($sql);
if($result->num_rows > 0){
   while($row=$result-> fetch_assoc()){
    $sqlp ="select ammount from payment_db where appointment_id=".$row['appointment_id'];
    $resultp = $conn->query($sqlp);
    $rowp=$resultp-> fetch_assoc();
            if(isset($rowp['ammount'])=='100') { $payment_flag=1;
            }else {$payment_flag=0; }?>
        
        
<div class="row">
<div class="card col-md-11">
  <div class="card-header <?php if($row['a_status']==0){echo "heads";}else{echo "headn";}?>">
    Appointment #<?php echo $row['appointment_id']; ?>
    <div class="float-right">
      <form action="" method="POST">
      <?php if($row['a_status']==0  && $row['hit_miss']==NULL){?><!--  only appointment request -->
        <a href="nolockdelete.php?id=<?php echo $row['appointment_id']; ?>" class="btn btn-danger" name="delete" 
        onclick="return confirm('Are you sure you want to cancel this appointment? \nRefunded By deducting 10% from yor payment if payment is done.');"
         value="<?php echo $row["appointment_id"]; ?>">Cancel X</a>
         <?php } else if($row['a_status']==0 && $row['hit_miss']!=NULL && $payment_flag==1){ ?>
          <!--  missed appointment with payment -->
          <a href="scheduledelete.php?id=<?php echo $row['appointment_id']; ?>" class="btn btn-danger" name="delete" 
          onclick="return confirm('Are you sure you want to cancel this appointment? \nRefunded 100%. ');"
           value="<?php echo $row["appointment_id"]; ?>">Cancel X</a> 
        <?php }else if($row['a_status']==0 && $row['hit_miss']!=NULL ){ ?><!--  missed appointment w/o payment -->
        <a href="nolockdelete.php?id=<?php echo $row['appointment_id']; ?>" class="btn btn-danger" name="delete" 
        onclick="return confirm('Are you sure you want to cancel this appointment?');"
         value="<?php echo $row["appointment_id"]; ?>">Cancel X</a> 
        
          <?php }else{ ?>
            <!--  hit appointment w/o checking payment  -->
          <a href="lockdelete.php?id=<?php echo $row['appointment_id']; ?>" class="btn btn-danger" name="delete" 
        onclick="return confirm('Are you sure you want to cancel this appointment? \nRefunded By deducting 20% from yor payment if payment is done. ');"
         value="<?php echo $row["appointment_id"]; ?>">Cancel X</a> <?php } ?>
        </div>
      </form>
  </div>
  <div class="card-body">
    <?php 
  if($row['a_status']==0 && $row['hit_miss']!=NULL){

    ?>
    <p class="card-text"> Your Appointment was missed on the given shift. Please select any other timeslots. </p>
    <?php
    $sqlp ="select ammount from payment_db where appointment_id=".$row['appointment_id'];
            $resultp = $conn->query($sqlp);
            $rowp=$resultp-> fetch_assoc();
                    if(isset($rowp['ammount'])=='100'){?>
    <a href="reschedule.php?aid=<?php echo $row['appointment_id'];?>&id=<?php echo $row['doctor_id'];?>" class="btn btn-primary print "><i class="fas fa-calendar"></i>Re-schedule</a>
    <!-- <a class="btn btn-danger print" href="scheduledelete.php?did=<?php echo $row['appointment_id'];?>">Cancel X</a> -->
    <?php }}else{  ?>
  
    <h5 class="card-title">Patient Name: &nbsp;<?php  echo $row['p_name']; ?></h5>
    <p class="card-text">Gender: &nbsp;<?php echo $row['gender'];?> &nbsp;&nbsp;&nbsp;Problem : &nbsp; <?php echo $row['problem'];?> </p>
    <p class="card-text">Time: &nbsp;<?php echo $row['shift'];?> &nbsp;&nbsp;&nbsp;Phone : &nbsp; <?php echo $row['phone'];?> </p>
    <p class="card-text">Address: &nbsp;<?php echo $row['p_address'];?> &nbsp;&nbsp;&nbsp;Date : &nbsp; <?php echo $row['inputdate'];?> </p>
    <?php
      $sqls ="select d_name from doctor_db where doctor_id=".$row['doctor_id'];
      $results = $conn->query($sqls);
      $rows=$results-> fetch_assoc();
      $doctor_name = $rows['d_name'];
    ?>
    <p class="card-text">Doctor: &nbsp;<?php echo $doctor_name;?> </p>
    <p class="card-text">Status: &nbsp;<?php if($row['a_status']==0){ echo "Not Verified";} else{echo "Verified";}?>  </p>
    <p class="card-text">Payment:&nbsp;<?php 
            $sqlp ="select ammount from payment_db where appointment_id=".$row['appointment_id'];
            $resultp = $conn->query($sqlp);
            
            $rowp=$resultp-> fetch_assoc();
                    if(isset($rowp['ammount'])=='100'){
                      echo "Paid";
                    }
                    else{
                      echo "Not Paid";
                    }
                  ?>
    </p>
    <?php if($row['a_status']==1){ ?>
      <hr>
      <i>Print this copy of appointment to submit</i>
    <a href="generate_pdf.php?id=<?php echo $row['appointment_id']; ?>" class="btn btn-primary print float-right"><i class="fas fa-print"></i>Print</a>
    <?php } } ?>
    </div>
  </div>
</div>
<br>
<?php
   }}else echo '<h3 >No Notifications</h3>';
?>
   
    

</div>
<style>
  .print{
    padding: 2px 12px 2px 12px !important;
  }
.heads{
    background-color:#ff9999; 
}
.headn{
    background-color: #99e699; 
}
</style>
<?php
 include('includes/footer.php');
?>