<?php
    define('TITLE', 'Success');
    include('includes/header.php');
    include('../dbconnection.php');

    session_start();
    if($_SESSION['is_login']){
        $rEmail= $_SESSION['rEmail'];
    }
    else{
        echo "<script> location.href='requesterLogin.php'</script>";
    }

$sql ="SELECT * FROM submitrequest_db WHERE r_id = {$_SESSION['myid']}";
$result = $conn-> query($sql);
if($result->num_rows==1){
    $row = $result->fetch_assoc();
    echo "<div class='ml-5 mt-5'>
            <table class='table'>
            <tbody>
                <tr>
                    <th>ID</th>
                    <td>".$row['r_id']."</td>
                </tr>

                <tr>
                    <th>Patient's Name</th>
                    <td>".$row['r_name']."</td>
                </tr>            

                <tr>
                    <th>Gender</th>
                    <td>".$row['r_gender']."</td>
                </tr>                

                <tr>
                    <th>Age</th>
                    <td>".$row['r_age']."</td>
                </tr>
                
                <tr>
                    <th>Disease</th>
                    <td>".$row['r_illness']."</td>
                </tr>

                <tr>
                    <th>Doctor Depart</th>
                    <td>".$row['r_speciality']."</td>
                </tr>

                <tr>
                    <th>Shift</th>
                    <td>".$row['r_shift']."</td>
                </tr>                

                <tr>
                    <th>Date</th>
                    <td>".$row['r_date']."</td>
                </tr>

                <tr>
                     <td><form><input class='btn btn-danger d-print-none' type='submit' value='Print' onClick='window.print()'></form></td>
                </tr>
            </tbody>
        </table>

    </div>";
}else{
    echo "Failed";
}
?>

<?php
 include('includes/footer.php');
?>
