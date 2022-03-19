<?php 
 include('../dbconnection.php');

$id = $_GET['id'];

$sql = "delete from appointment_db where appointment_id=$id";
$query = mysqli_query($conn,$sql);
 
$sqlp ="select ammount from payment_db where appointment_id=".$id;
$resultp = $conn->query($sqlp);
$rowp=$resultp-> fetch_assoc();
$ammount=intval($rowp['ammount']);
$updatedammount=$ammount-(0.9*$ammount);

$sqlu = "update payment_db set ammount='$updatedammount', payment_status='Cancelled Before Lock' where appointment_id=$id";
$query2 = mysqli_query($conn,$sqlu);
if($query ){
?>
<script type="text/javascript"> 
			alert("Cancelled Sucessfully!!"); location="notification.php";
		</script>
				
		<?php }else{ ?>
 <script type="text/javascript"> 
			alert("Not Cancelled  !!"); 
			location="notification.php";
		</script>
<?php } ?>