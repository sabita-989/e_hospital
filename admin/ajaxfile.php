
<?php
include('../dbconnection.php');
$id = $_POST['id'];
 
$sql ="select *from appointment_db where appointment_id =".$id;
$result = $conn->query($sql);
// print_r($result);
if(mysqli_num_rows($result) > 0){
   while($row=mysqli_fetch_assoc($result)){
?>
        <p>Name : <?php echo $row['p_name']; ?> <br> </p>
        <p>Gender : <?php echo $row['gender']; ?> 
       <span class="age">Age : <?php echo $row['age']; ?></span>  
       <span class="phone"> Phone : <?php echo $row['phone']; ?></span> <br> </p> 
        <p>Address : <?php echo $row['p_address']; ?> <br> </p>
        <p>Problem : <?php echo $row['problem']; ?> <br> </p>
        <p>Date : <?php echo $row['inputdate']; ?> 
        <span class="shift">Shift : <?php echo $row['shift']; ?> </span><br> </p>
        <p>Doctor :
       <?php
            $doc_id= $row['doctor_id'];
            $sql2 ="SELECT * FROM doctor_db WHERE doctor_id=$doc_id";
            $results = $conn->query($sql2);
            if($results->num_rows > 0){
             while($rowa=$results-> fetch_assoc()){?>
                   <?php echo $rowa['d_name']; ?> <br> </p>
                   <?php }}?>
        <p>Request Time : <?php echo $row['appointment_time']; ?>
        <span class="status">Status : <?php if($row['a_status']==1){echo "Verified";} else {echo "Not Verified";} ?></span><br> </span>
      
 
<?php } }?>