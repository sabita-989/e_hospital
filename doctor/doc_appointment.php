<?php
define('TITLE', 'Appointment');
define('PAGE', 'Myappointment');
include('includes/header.php');
include('../dbconnection.php');
session_start();
if($_SESSION['is_doc_login']){
    $id= $_SESSION['d_id'];
}
else{
    echo "<script> location.href='index.php'</script>";
}
?>


<!-- start 2nd column -->
<div class="container">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Patient Name</th>
      <th scope="col">Gender</th>
      <th scope="col">Age</th>
      <th scope="col">Problem</th>
      <th scope="col">Phone</th>
      <th scope="col">Address</th>
      <th scope="col">Date</th>
      <th scope="col">Shift</th>

    </tr>
  </thead>
  <tbody>   

<?php
$sql ="select *from appointment_db where doctor_id=".$id;
$result = $conn->query($sql);
// print_r($result);
if(mysqli_num_rows($result) > 0){
   while($row=mysqli_fetch_assoc($result)){
        ?>
    <tr 
    data-id='<?php echo $row['appointment_id']; ?>'
    data-toggle="modal" data-target="#rowmodal"
    style="cursor:pointer;" 
    class="table_row">
    <?php if($row['a_status']==1){?>
      <th scope="row"><?php echo $row['appointment_id']; ?></th>
      <td><?php echo $row['p_name']; ?></td>
      <td><?php echo $row['gender']; ?></td>
      <td><?php echo $row['age']; ?></td>
      <td><?php echo $row['problem']; ?></td>
      <td><?php echo $row['phone']; ?></td>
      <td><?php echo $row['p_address']; ?></td>
      <td><?php echo $row['inputdate']; ?></td> 
      <td> <?php echo $row['shift']; ?></td>
    </tr>
   
    <?php 
}}}
            ?>
  </tbody>
</table>
            
                

              

          
</div>
<style>
.heads{
    /* border-left: solid 4px #ff9999; */
    background-color:#ffb3b3;
}
.headn{
    /* border-left: solid 4px #99e699; */
    background-color:#adebad;
}
.modal-body{
    margin:15px;
    padding:15px;
}
</style>
<?php
 include('includes/footer.php');
?>