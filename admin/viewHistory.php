<?php
define('TITLE','View History');
define('PAGE','viewHistory');
include('includes/header.php');
include('../dbconnection.php');
session_start();
if(isset($_SESSION['is_adminlogin'])){
    $aEmail = $_SESSION['aEmail'];
}else{
    echo "<script>location.href='index.php'</script>";
}
?>


<?php
 include('includes/footer.php');
?>