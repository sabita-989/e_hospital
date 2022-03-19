<?php 
    define('TITLE', 'Requester Login');
    define('PAGE', 'requesterLogin');

    include('../dbconnection.php');
    session_start();
        if(!isset($_SESSION['is_login'])){      
            if(isset($_POST['submit'])){
            $rEmail = mysqli_real_escape_string($conn,$_REQUEST['rEmail']);
            $rPassword =mysqli_real_escape_string($conn,$_REQUEST['rPassword']);
            $hPassword= password_hash($rPassword,PASSWORD_BCRYPT);
            $sql="SELECT * FROM requesterlogin_db WHERE r_email='$rEmail' ";
            $result =$conn->query($sql);
            $count = mysqli_num_rows($result);
            print($count);
           
                if($count == 1){
                    while($row=mysqli_fetch_assoc($result)){
                        if(password_verify($rPassword, $row['r_password'])){
                            $login=true;
                            // session_start();
                            $_SESSION['is_login'] = true;
                            $_SESSION['rEmail']=$rEmail;
                            $_SESSION['u_id']=$row['r_login_id'];
                            echo "<script> location.href='requesterProfile.php';</script>";
                        }  
                        else{
                            $msg='<div class="alert alert-warning mt-2">Enter Valid Email and Password</div>';
                        }
                    } 
                }
            } 
        } else{
         echo "<script> location.href='requesterProfile.php';</script>";
        }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0"> 
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Bootstrap css -->
        <link rel="stylesheet" href="../css/bootstrap.min.css">

        <!-- font awesome css -->
        <link rel="stylesheet" href="../css/all.min.css">    
        
        <title>Login</title>

    </head>
    <body>
        <div class="mb-3 mt-5 text-center" style="font-size : 30px;">
           <i class="fas fa-stethoscope"></i>
            <span>Online User Service</span>
        </div>

        <p class="text-center" style="font-size: 20px;"><i class="fas fa-hospital-user text-danger"></i>Requester Area</p>
        <div class="container-fluid">
            <div class="row justify-content-center mt-5">
                <div class="col-sm-6 col-md-4">
                    <!-- login form starts -->
                    <form action="" class="shadow-lg p-4" method="POST">
                   
                        <div class="form-group">
                            <i class="fas fa-user"></i> <label for="email" class="font-weight-bold pl-2">Email</label> 
                            <input type="email" class="form-control" placeholder="Email" value="<?php if(isset($_SESSION['rEmail'])){echo $_SESSION['rEmail'];}else{echo "";} ?>" name="rEmail">
                            <small class="form-text">Your email won't be shared to anyone.</small>
                        </div>

                        <div class="form-group">
                            <i class="fas fa-key"></i><label for="pass" class="font-weight-bold pl-2">Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="rPassword">
                        </div>
                        <?php 
                        if(isset($msg)){

                            {echo $msg;}
                        }
                    ?>

                        <button type="submit" name="submit" class="btn btn-outline-danger mt-3 font-weight-bold btn-block shadow-sm" >Login</button>
                    
                    </form>
                    <!-- login form ends -->
                    <!-- back to home icon -->
                    <div class="text-center"><a href="../index.php" class="btn btn-info mt-3 font-weight-bold shadow-sm">Back to Home</a></div>

               
                 </div>
            </div>
        </div>
        
        <!-- javasScript files -->
        <script src="../js/jquery-3.3.1.slim.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/all.min.js"></script>
    </body>

</html>

<?php
 include('includes/footer.php');
?>