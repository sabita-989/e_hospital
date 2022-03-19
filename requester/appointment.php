<?php
    define('TITLE', 'Profile');
    define('PAGE', 'Appointment');

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
<div class="container appointment-co">
    <h3 class="mt-3 mb-3">Select Doctor:</h3>
    <?php
     $sql ="SELECT * FROM doctor_db";
     $result = $conn->query($sql);
     if($result->num_rows > 0){
        while($row=$result-> fetch_assoc()){
            $speciality_id = $row['speciality_id'];
            $sqlS = "SELECT speciality_name FROM speciality_db WHERE speciality_id = $speciality_id";
            $query = mysqli_query($conn, $sqlS);
            $speciality_name_array = mysqli_fetch_assoc($query);
            $speciality_name = $speciality_name_array['speciality_name'];
    ?>
        <a class="btn hey" href="getappointment.php?id=<?php echo $row['doctor_id']; ?>">
       <span class="docname"><?php echo $row['d_name']; ?></span> <br>
       <span>(<?php echo $speciality_name; ?>)</span>

    </a>
    <?php }} ?>
</div>
<style>
    .docname{
        font-size:17px;
    }
    .appointment-co .hey{
        margin:8px;
        padding:35px;
        color: #3334ff;
        width:245px;
        box-shadow:  5px 10px 18px #888888;
        /* border: 2px solid #66ccff; */
        background-color:#eef3ff;
         border-radius:5px !important; 
    }
    .appointment-co .hey:hover{
        transition-duration: 1.8s !important;
       
        transform:scale(1.08);
    }   
 
</style>
<?php
 include('includes/footer.php');
?>