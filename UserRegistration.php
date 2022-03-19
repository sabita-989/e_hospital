<?php
include('dbconnection.php');
    $valid=true;
    $errorsa = array();
    $flag = true;
    $errors = [];
//     if($_SERVER['REQUEST_METHOD']=="POST"){
        
// if (isset($_POST['rName'], $_POST['rEmail'], $_POST['rPassword'])) {
//     if (empty($_POST['rName'])) {
//         $valid=false;
//         $errorsa['rName'] = "You must enter your name.";
//     }
//     if (empty($_POST['rEmail'])) {
//         $valid=false;
//         $errorsa['rEmail'] = "You must enter your email address.";
//     }
//     if (empty($_POST['rPassword'])) {
//         $valid=false;
//         $errorsa['rPassword'] = "You must enter a message.";

//     }
//         // if(empty($_POST['rName'])){
//         //     $rName_error="Please enter the username";
//         // } 
//         // if(empty($_POST['rEmail'])){
//         //     $rEmail_error="Please enter the email";
//         // }
//         // if(empty($_POST['rPassword'])){
//         //     $rPassword_error="Please enter the password";
//         //     echo a;
//         // }
//     }   
// }
if(isset($_REQUEST['rSignUp'])){
    $data = [];
   
   
    // if(strlen($_REQUEST['rPassword']) <= 6 ) {
    //     $flag=false;
    //     $errors['rPassword'] = "Your password must be greater than 6 characters";
    // } 

    $sql="SELECT r_email FROM requesterlogin_db WHERE r_email='".$_REQUEST['rEmail']."'";
        $result = $conn->query($sql);
        if($result->num_rows==1){
            $flag=false;
            $errors['rEmail'] = "Email ID Already Exists. ";
        }

    //checking empty fields
    if(count($errors) === 0) {
            //Assigned users values to variables

        $rName = mysqli_real_escape_string($conn,$_REQUEST['rName']);
        $rEmail = mysqli_real_escape_string($conn,$_REQUEST['rEmail']);
        $rPassword = mysqli_real_escape_string($conn,$_REQUEST['rPassword']);

        $rPass = password_hash($rPassword,PASSWORD_BCRYPT);
               
        $sql= "INSERT INTO requesterlogin_db(r_name, r_email, r_password) VALUES('$rName','$rEmail', '$rPass')";
        
        if($conn-> query($sql)==TRUE){
            // session_start();
            // $_SESSION['is_login'] = true;
            $_SESSION['rEmail']=$rEmail;
           
            echo "<script> window.location.href='requester/requesterLogin.php';</script>";
        }else{
            echo "<div class='alert alert-success mt-2' role='alert'>Account Creation Failed</div>";
        }
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BirSewa</title>
</head>
<body>
<div class="container pt-5" id="Registration">
    <h2 class="text-center">Create Account</h2>
    <div class="row mt-4 mb-4">
        <div class="col-md-6 offset-md-3">
            <form name="contactForm" action="" class="shadow-lg p-4" method="POST" onsubmit="return validateForm()"  id="regForm">
                 <?php if (!$valid): ?>
                    <div class="error">
                    <?php foreach($errorsa as $message ):?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($message); ?></div>
                <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <?php if (!$flag): ?>
                    <div class="error">
                    <?php foreach($errors as $message ):?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($message); ?></div>
                    <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <div id="errors">

                </div>
                <div class="form-group"> 
                    <i class="fas fa-user"></i>  
                    <label for="name" class="font-weight-bold pl-2">Full Name</label>
                    <input type="text" class= "form-control" placeholder="Enter you Name" name="rName" id="rName">
                </div>

                <div class="form-group"> 
                    <i class="far fa-envelope"></i>
                    <label for="email" class="font-weight-bold pl-2">Email</label>
                    <input type="email" class= "form-control" placeholder="Enter your email" name="rEmail" id="rEmail">
                </div>

                <div class="form-group"> 
                    <i class="fas fa-key"></i>  
                    <label for="password" class="font-weight-bold pl-2">Password</label>
                    <input type="password" class= "form-control" placeholder="Enter Password" name="rPassword" id="rPassword" maxlength="255">  
                </div>
                
                <button type="submit" class="btn btn-danger mt-5 btn-block
                shadow-sm font-weight-bold" name="rSignUp" value="Register">Sign Up</button>
                <em style="font-size:16px;">Note-By clicking Sign Up, you agree to our Terms,Data Policy and Cookie policy</em>    
                           
            </form>
        </div>
    </div>
</div>
<!--
     regex =
    /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/; 
    <script type="text/javascript" src="js/form.js"></script> -->
<script type="text/javascript">
function validateForm() {
    var rname = document.forms["contactForm"]["rName"].value;
    var remail = document.forms["contactForm"]["rEmail"].value;
    var rpassword = document.forms["contactForm"]["rPassword"].value;

    if(rname == "" && remail == "" && rpassword ==""){
        document.getElementById("errors").innerHTML = ("<p class='alert alert-danger'>Please fill all the field</p>");
        return false;
    } 
    if(rname == "" && remail == "" ){
        document.getElementById("errors").innerHTML = ("<p class='alert alert-danger'>Please fill name and email field</p>");
        return false;
    } 
    if( remail == "" && rpassword ==""){
        document.getElementById("errors").innerHTML = ("<p class='alert alert-danger'>Please fill email and password field field</p>");
        return false;
    } 
    if(rname == "" && rpassword ==""){
        document.getElementById("errors").innerHTML = ("<p class='alert alert-danger'>Please fill name and password field</p>");
        return false;
    } 
    if (rname == null || rname == "") {
        document.getElementById("errors").innerHTML = ("<p class='alert alert-danger'>Please fill the name</p>");
        return false;
    } else if (remail == null || remail == "") {
        document.getElementById("errors").innerHTML = ("<p class='alert alert-danger'>Please fill the email</p>");
        return false;
    } 
  else if (rpassword.length <= 6) {
       document.getElementById("errors").innerHTML = ("<p class='alert alert-danger'>Password must be greater than 6</p>");
        return false;
    }
}
</script>
</body>
</html>