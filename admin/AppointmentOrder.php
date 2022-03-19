<?php
define('TITLE','Appointment Chart');
define('PAGE','appointmentorder');
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
<div class="col-sm-9 col-md-10 mt-5">
    <?php 
        $sql="SELECT * FROM appointment_db";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            echo '<table class="table">';
                echo '<thead>';
                    echo '<tr>';
                        echo '<th scope="col">Patient ID</th>';
                        echo '<th scope="col">Name</th>';
                        echo '<th scope="col">Gender</th>';
                        echo '<th scope="col">Age</th>';
                        echo '<th scope="col">Disease</th>';
                        // echo '<th scope="col">Action</th>';
                    echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                  while ($row= $result->fetch_assoc()){
                      echo '<tr>';
                        echo '<td>'.$row['appointment_id'].'</td>';
                        echo '<td>'.$row['p_name'].'</td>';
                        echo '<td>'.$row['gender'].'</td>';
                        echo '<td>'.$row['age'].'</td>';
                        echo '<td>'.$row['problem'].'</td>';
                        // echo '<td>';
                        //     echo '<form action="viewWork.php" method="POST" class="d-inline mr-2">';
                        //         echo '<input type="hidden" name="id" value='.$row['r_id'].'><button class="btn btn-warning" name="view" value="View" type="submit"><i class="far fa-eye"></i></i></button>';
                        //     echo '</form>';

                        //     echo '<form action="" method="POST" class="d-inline">';
                        //         echo '<input type="hidden" name="id" value='.$row['r_id'].'><button class="btn btn-secondary" name="delete" value="Delete" type="submit"><i class="far fa-trash-alt"></i></button>';
                        //     echo '</form>';

                        // echo '</td>';
                      echo '</tr>';
                  }
                echo '</tbody>';
            echo '</table>';
        }else{
            echo '0 Result';
        }
        if(isset($_REQUEST['delete'])){
            $sql = "DELETE FROM submitrequest_db WHERE r_id={$_REQUEST['id']}";
            if($conn->query($sql)==TRUE){
                echo '<meta http-equiv="refresh" content="0;URL=?deleted"/>';
            }else{
                echo "Unable to Delete Data";
            }
        }
    ?>
</div>
<!-- end 2nd column -->


<?php
 include('includes/footer.php');
?>