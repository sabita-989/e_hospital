<?php 
 include('../dbconnection.php');

$id = $_GET['id'];

$sql = "delete from appointment_db where appointment_id=$id";
$query = mysqli_query($conn,$sql);
 
$sqlp ="select ammount from payment_db where appointment_id=".$id;
$resultp = $conn->query($sqlp);
$rowp=$resultp-> fetch_assoc();


$sqlu = "update payment_db set ammount='0', payment_status='Fully Refunded' where appointment_id=$id";
$query2 = mysqli_query($conn,$sqlu);
if($query){
?>
<script type="text/javascript"> 
			alert("Cancelled Sucessfully!!"); location="notification.php";
		</script>
				
		<?php }else{ ?>
 <script type="text/javascript"> 
			alert("Not Cancelled  !!"); location="notification.php";
		</script>
<?php } ?>