<?php
define('TITLE','Dasboard');
define('PAGE','dashboard');
include('includes/header.php');
include('../dbconnection.php');
session_start();
if(isset($_SESSION['is_adminlogin'])){
    $aEmail = $_SESSION['aEmail'];
}else{
    echo "<script>location.href='index.php'</script>";
}
//count appointment
$sql ="select * from appointment_db";
$result = $conn->query($sql);
$appointmentcount = mysqli_num_rows( $result );

//count verified
$sql ="select * from appointment_db where a_status=1";
$result = $conn->query($sql);
$verifiedcount = mysqli_num_rows( $result );

//count pending (pending is hitmiss= null && status=0) 
$sql ="select * from appointment_db where a_status= 0 AND hit_miss IS NULL";
$result = $conn->query($sql);
$pendingcount = mysqli_num_rows( $result );

//count missed (missed is status=0 && hitmiss= some integer)
$sql ="select * from appointment_db where a_status=0 AND hit_miss IS NOT NULL";
$result = $conn->query($sql);
$missedcount = mysqli_num_rows( $result );

//countusers
$sql ="select * from doctor_db";
$result = $conn->query($sql);
$doctorscount = mysqli_num_rows( $result );

//countusers
$sql ="select * from requesterlogin_db";
$result = $conn->query($sql);
$userscount = mysqli_num_rows( $result );

//countspeciality
$sql ="select * from speciality_db";
$result = $conn->query($sql);
$specialitycount = mysqli_num_rows( $result );
?>

<div class="container dashboard">
    <button class="btn appointment" onClick="document.location.href='patientrequest.php'">
        <span class="heading"><i>Total Appointments</i> </span><br>

        <span class="number"><?php echo $appointmentcount; ?></span>
    </button>
    <button class="btn verified" onClick="document.location.href='patientrequest.php'">
        <span class="heading"><i>Verified Appointments</i></span><br>
    <span class="number"><?php echo $verifiedcount; ?></span>
    </button>
    <button class="btn pending" onClick="document.location.href='patientrequest.php'">
        <span class="heading"><i>Pending Appointments</i></span><br>
    <span class="number"><?php echo $pendingcount; ?></span>
    </button>
    <button class="btn missed" onClick="document.location.href='patientrequest.php'">
        <span class="heading"><i>Missed Appointments</i></span><br>
    <span class="number"><?php echo $missedcount; ?></span>
    </button>
    <br>
    <button class="btn doctors" onClick="document.location.href='doctors.php'">
        <span class="heading"><i>Total Doctors</i></span><br>
    <span class="number"><?php echo $doctorscount; ?> </span>
    </button>
    <button class="btn speciality" onClick="document.location.href='speciality.php'">
        <span class="heading"><i>Total Speciality</i></span><br>
    <span class="number"><?php echo $specialitycount; ?></span>
    </button>
    <button class="btn users" onClick="document.location.href='users.php'">
        <span class="heading"><i>Total Users</i></span><br>
    <span class="number"><?php echo $userscount; ?> </span>
    </button>
    
   
    
</div>

<style>
    .appointment, 
    .pending, 
    .verified, 
    .missed, 
    .doctors, 
    .users, 
    .speciality{
        background-color: #fdfdfd;
        border-radius:1px;
        height:90px;
        width:178px;
        margin:15px 35px;
        box-shadow: 2px 2px 2px 2px #d9d9d9;
        text-align:left !important;
        vertical-align: none;
    }

    .dashboard{
        margin-top: 48px;
    }

    .appointment{ border-left: solid 4px #1a1aff;}
    .pending{ border-left: solid 4px #ff1aff}
    .verified{ border-left: solid 4px #33ff33;}
    .missed{ border-left: solid 4px  #ff4d4d;}
    .doctors{ border-left: solid 4px  #737373;}
    .users{ border-left: solid 4px #737373;}
    .speciality{ border-left: solid 4px #737373;}
    
    .heading{
        font-size: 13px;
        /* font-weight: italic; */
    }

    .number{
        font-size:30px;
        color:#7a7a52;
        margin-left:2px
    }

</style>
<?php
 include('includes/footer.php');
?>