<?php
define('TITLE','Users');
define('PAGE','users');
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
<p class="bg-dark text-white p-2">List of Users</p>
<?php 
    $sql ="SELECT * FROM requesterlogin_db";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        echo '<table class="table">';
            echo '<thead>';
                echo '<tr>';
                    echo '<th scope="col">User ID</th>';
                    echo '<th scope="col">Name</th>';
                    echo '<th scope="col">Email</th>';
                    echo '<th scope="col">Action</th>';

                echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
                while($row=$result-> fetch_assoc()){
                    echo '<tr>';
                        echo '<td>'.$row["r_login_id"].'</td>';
                        echo '<td>'.$row["r_name"].'</td>';
                        echo '<td>'.$row["r_email"].'</td>';

                        echo '<td>';
                            

                            echo '<form action="" class="d-inline" method="POST">';
                                echo '<input type="hidden" name="id" value='.$row["r_login_id"].'>';?>
                                <button type="submit" 
                                onclick="return confirm('Are you sure you want to delete this item?');"
                                class="btn btn-secondary mr-3" name="delete" value="Delete"><i class="fas fa-trash"></i></button>
<?php
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
    $sql="DELETE FROM requesterlogin_db WHERE r_login_id={$_REQUEST['id']}";
    if($conn-> query($sql)==TRUE){
        echo '<meta http-equiv="refresh" content="0;URL=?deleted" />';
    }else{
        echo '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to Delete</div>';
    }
}
?>
<!-- end 2nd column -->

</div><!-- end row -->

</div> <!-- end container -->
        
        <!-- Bootstrap Javascript -->
        <script src="../js/jquery-3.3.1.slim.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/all.min.js"></script>
    </body>
</html>



