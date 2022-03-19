<?php
define('TITLE','Speciality');
define('PAGE','speciality');
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
<p class="bg-dark text-white p-2">List of Speciality</p>
<?php 
    $sql ="SELECT * FROM speciality_db";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        echo '<table class="table">';
            echo '<thead>';
                echo '<tr>';
                    echo '<th scope="col">Speciality ID</th>';
                    echo '<th scope="col">Speciality</th>';
                    echo '<th scope="col">Action</th>';
                echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
                while($row=$result-> fetch_assoc()){
                    echo '<tr>';
                        echo '<td>'.$row["speciality_id"].'</td>';
                        echo '<td>'.$row["speciality_name"].'</td>';
                        echo '<td>';
                            echo '<form action="editSpeciality.php" class="d-inline" method="POST">';
                                echo '<input type="hidden" name="id" value='.$row["speciality_id"].'><button type="submit" class="btn btn-info mr-3" name="edit" value="Edit"><i class="fas fa-pen"></i></button>';
                            echo '</form>';

                            echo '<form action="" class="d-inline" method="POST">';
                                echo '<input type="hidden" name="id" value='.$row["speciality_id"].'><button type="submit" class="btn btn-secondary mr-3" name="delete" value="Delete"><i class="fas fa-trash"></i></button>';
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
    $sql="DELETE FROM speciality_db WHERE speciality_id={$_REQUEST['id']}";
    if($conn-> query($sql)==TRUE){
        echo '<meta http-equiv="refresh" content="0;URL=?deleted" />';
    }else{
        echo 'Unable to Delete';
    }
}
?>
<!-- end 2nd column -->

</div><!-- end row -->
<div class="float-right"><a href="insertSpeciality.php" class="btn btn-danger"><i class="fas fa-plus"></i></a></div>
<!-- end 2nd column -->
</div> <!-- end container -->
        
        <!-- Bootstrap Javascript -->
        <script src="../js/jquery-3.3.1.slim.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/all.min.js"></script>
    </body>
</html>



