<?php
define('TITLE','PatientRequest');
define('PAGE','patientrequest');
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
<div class="container">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Patient Name</th>
      <!-- <th scope="col">Gender/Age</th>
      <th scope="col">Problem</th>
      <th scope="col">Phone</th>
      <th scope="col">Address</th> -->
      <th scope="col">Date</th>
      <th scope="col">Shift</th>
      <th scope="col">Doctor</th>
      <th scope="col">Request Time</th>
      <th scope="col">Payment</th>
      <th scope="col">Hit/Miss</th>
      <th scope="col">View</th>
    </tr>
  </thead>
  <tbody>   

<?php
$sql ="select *from appointment_db order by appointment_id DESC";
$result = $conn->query($sql);
// print_r($result);
if(mysqli_num_rows($result) > 0){
   while($row=mysqli_fetch_assoc($result)){
        ?>
    <tr 
    data-id='<?php echo $row['appointment_id']; ?>'
    data-toggle="modal" data-target="#rowmodal"

    style="cursor:pointer;" 
    class="table_row <?php if($row['a_status']==0){echo "heads";}else{echo "headn";}?>">
      <th scope="row"><?php echo $row['appointment_id']; ?></th>
      <td><?php echo $row['p_name']; ?></td>
      <td><?php echo $row['inputdate']; ?></td> 
      <td> <?php echo $row['shift']; ?></td>
      <?php
        $doc_id= $row['doctor_id'];
        $sql2 ="SELECT * FROM doctor_db WHERE doctor_id=$doc_id";
        $results = $conn->query($sql2);
        if($results->num_rows > 0){
            while($rowa=$results-> fetch_assoc()){?>
                <td><?php echo $rowa['d_name']; ?> </td>
                <?php }}?>
      <td> <?php echo $row['appointment_time']; ?></td>
      <td> <?php 
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
      </td>
      
      <td> 
        <?php if($row['hit_miss']!=NULL)
        //upto 3 decimal palce by round()
        {echo round($row['hit_miss'],3);}else{echo "N/A";}?>
        </td>
      <td>
      <form action="" method="POST">
            <?php if($row['a_status']==0 && $row['hit_miss']==NULL){?>
            <a type="submit" href="ChangeStatus.php?id=<?php echo $row['appointment_id'];?>&d=<?php echo $row['inputdate'];?>&s=<?php echo $row['shift'];?>&di=<?php echo $row['doctor_id'];?> " 
            id="verify" class="btn btn-danger " value="Verify" name="verify">Accept</a>
            <?php }else if($row['a_status']==0 && $row['hit_miss']!=NULL){?>
              <a type="submit"  class=" " value="Missed" name="missed">Missed</a>
                <?php }else{?>
                <a type="submit" style="background-color:#99e699;" class="btn " value="Verify" name="verified">Accepted</a>
            <?php } ?> 
            </form>
      </td>
    </tr>
   
    <?php 
}}
            ?>
  </tbody>
</table>
            
                

              

          
</div>
          <!--  Modal -->

<div class="modal fade" id="rowmodal" tabindex="-1" role="dialog" aria-labelledby="rowmodalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="rowmodalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="generate_pdf.php" method="POST">
        <button type="button" id="print" class="btn btn-primary"><i class="fas fa-print" aria-hidden="true"></i> Print</button>
        </form>
      </div>
    </div>
  </div>
</div>



<style>
.heads{
    /* border-left: solid 4px #ff9999; */
    background-color: #ffb3b3;
}
.headn{
    /* border-left: solid 4px #99e699; */
    background-color:#c1f0c1;
}
.modal-body{
    margin:15px;
    padding:15px;
}
.age, .phone, .shift, .status{
    margin-left:55px;
}
</style>
<script src="../js/jquery-3.6.0.min.js"></script>

<script>
  $(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
    $(document).ready(function(){
        $("tr.table_row").click( function(){
            var id=$(this).data('id');
            document.getElementById("rowmodalLabel").innerHTML="Appointment #"+id;
            document.getElementById("print").value=id;
            $.ajax({
                url: 'ajaxfile.php',
                type: 'post',
                data: {id: id},
                success: function(response){ 
                    $('.modal-body').html(response); 
                    $('#rowmodal').modal('show'); 
                }
            });
        });
        $("#print").click(function(){
          var a_id= document.getElementById("print").value;
          console.log(a_id);
          window.location.href = "generate_pdf.php?id="+a_id;
              
           
        });
       
    });
</script>
<?php
 include('includes/footer.php');
?>