<?php
define('TITLE','Doctors');
define('PAGE','doctors');
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
<div class="col-sm-8 col-md-10 mt-5 text-center">
<p class="bg-dark text-white p-2">List of Docotrs</p>
<?php 
    $sql ="SELECT * FROM doctor_db";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        echo '<table class="table">';
            echo '<thead>';
                echo '<tr>';
                    echo '<th scope="col">Doctor ID</th>';
                    echo '<th scope="col">Doctor Name</th>';
                    echo '<th scope="col">Speciality</th>';
                    echo '<th scope="col">Shift Start</th>';
                    echo '<th scope="col">Shift End</th>';
                    echo '<th scope="col">Shift Interval</th>';
                    echo '<th scope="col">Phone</th>';
                    echo '<th scope="col">NMC Number</th>';
                    echo '<th scope="col">Action</th>';
                echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
                while($row=$result-> fetch_assoc()){
                    $speciality_id = $row['speciality_id'];
                    $sqlS = "SELECT speciality_name FROM speciality_db WHERE speciality_id = $speciality_id";
                    $query = mysqli_query($conn, $sqlS);
                    $speciality_name_array = mysqli_fetch_assoc($query);
                    $speciality_name = $speciality_name_array['speciality_name'];
                    echo '<tr>';
                        echo '<td>'.$row["doctor_id"].'</td>';
                        echo '<td>'.$row["d_name"].'</td>';
                        echo '<td>'.$speciality_name.'</td>';
                        echo '<td>'.$row["d_shift"].'</td>';
                        echo '<td>'.$row["d_eshift"].'</td>';
                        echo '<td>'.$row["d_interval"].'</td>';
                        echo '<td>'.$row["d_phone"].'</td>';
                        echo '<td>'.$row["nmc_no"].'</td>';
                        echo '<td>';
                            echo '<form action="editDoctor.php" class="d-inline" method="POST">';
                                echo '<input type="hidden" name="id" value='.$row["doctor_id"].'><button type="submit" class="btn btn-info mr-3" name="edit" value="Edit"><i class="fas fa-pen"></i></button>';
                            echo '</form>';

                            echo '<form action="" class="d-inline" method="POST">';
                                echo '<input type="hidden" name="id" value='.$row["doctor_id"].'><button type="submit" class="btn btn-secondary mr-3" name="delete" value="Delete"><i class="fas fa-trash"></i></button>';
                            echo '</form>';
                        echo '</td>';
                    echo '</tr>';
                }
            echo '</tbody>';
        echo '</table>';
    }else{
        echo '0 Result';
    }
?>
</div>
<?php
if (isset($_REQUEST['delete'])){
    $sql="DELETE FROM doctor_db WHERE doctor_id={$_REQUEST['id']}";
    if($conn-> query($sql)==TRUE){
        echo '<meta http-equiv="refresh" content="0;URL=?deleted" />';
    }else{
        echo 'Unable to Delete';
    }
}
?>
<!-- end 2nd column -->

</div><!-- end row -->
<div class="float-right"><a href="insertDoct.php" class="btn btn-danger"><i class="fas fa-plus"></i></a></div>
<!-- end 2nd column -->
</div> <!-- end container -->
        
        <!-- Bootstrap Javascript -->
        <script src="../js/jquery-3.3.1.slim.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/all.min.js"></script>
    </body>
</html>



