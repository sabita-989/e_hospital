
<?php
 define('TITLE', 'Submit Request');
 define('PAGE', 'SubmitRequest');

 include('includes/header.php');
 include('../dbconnection.php');
 session_start();
 if($_SESSION['is_login']){
     $rEmail= $_SESSION['rEmail'];
 }
 else{
     echo "<script> location.href='requesterLogin.php'</script>";
 }

// echo isset($_POST['submit_req']);
 if(isset($_REQUEST['submit_req'])){

    $data = [];
    $flag = true;
    $errors = [];   
    
    if(empty($errors)){
         //checking for empty fields
    if(($_REQUEST['illness']=="") || ($_REQUEST['name']=="") || ($_REQUEST['speciality']=="") || ($_REQUEST['shift']=="") ||
        ($_REQUEST['gender']=="") || ($_REQUEST['age']=="") || ($_REQUEST['phone']=="") || 
        ($_REQUEST['address']=="") || ($_REQUEST['date']=="")){
        $msg = "<div class='alert alert-warning col-sm-6 ml-5 mt-2'> All fields are Required </div>";} 
       
        else{
            $rillness = $_REQUEST['illness'];
            $rspeciality  = $_REQUEST['speciality'];
            $rshift = $_REQUEST['shift'];
            $rname    = $_REQUEST['name'];
            $rgender  = $_REQUEST['gender'];        
            $rage     = $_REQUEST['age'];
            $rphone   = $_REQUEST['phone'];
            $raddress = $_REQUEST['address'];
            $rdate  = $_REQUEST['date'];

            
        $sql = "INSERT INTO submitrequest_db(r_illness, r_speciality,r_shift, r_name, r_gender, r_age, r_phone, r_add, r_date)
                    VALUES('$rillness','$rspeciality ','$rshift', '$rname', '$rgender','$rage', '$rphone', ' $raddress', 
                    '$rdate')";
        if($conn-> query($sql) == TRUE ){
        $genid= mysqli_insert_id($conn);
        $msg = "<div class='alert alert-success col-sm-6 ml-5 mt-2'>Request Submitted Successfully</div>";
        $_SESSION['myid']= $genid;
        echo "<script> location.href='subreqsuccess.php'</script>";
        } else{
            $msg =  "<div class='alert alert-success col-sm-6 ml-5 mt-2'>Unable to Submit Request</div>";
            }
        }
    } //for empty 

        if(isset($_REQUEST['age'])){
                if(!empty($_REQUEST['age'])){
                    if($_REQUEST['age'] <= 0 ) {
                        $errors['age'] = "Age must be greater than 0";
                    }
                    else{

                    }
                }
        }

        if(isset($_REQUEST['phone'])){
           if(!empty($_REQUEST['phone'])){
                 if(!preg_match("/^[0-9]{10}$/", $_REQUEST['phone'])){
                     $errors['phone']="Phone number must be equal to 10 numbers";
                 }
             }else{
                
             }
         }
         //////age and phone number validation
 }

    $sqlS ="SELECT * FROM speciality_db";
    $query = $conn->query($sqlS);
    $data=array();
        while($rows = $query-> fetch_assoc()){
            array_push($data,$rows);
        }
    
?>

<div class ="col-sm-9 col-md-10 mt-5">  <!--Start Submit Request form 2nd column-->
<form class="mx-5" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <?php 
        if(isset($msg)){echo $msg;}
    ?>
    <div class="row">
        <div class="form-group col-md-11">
            <label for="Illness">Disease</label>
            <input type="text" class="form-control" id="Illness" placeholder="Write about patient's suffering" name="illness">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
		<label for="speciality">Doctor Speciality</label>
		<select name="speciality" id="speciality">
        <option>Select Speciality</option>
                <?php foreach($data as $value){ ?>
                <option value="<?php echo $value['speciality_id'] ?>"><?php echo $value['speciality_name'] ?></option>
                <?php } ?>
            </select>
		</div>    
    </div>

    <div class="form-group">
	    <label for="shift">Select Shift:</label>
		<input type="radio" name="shift" value="10am-1pm" id="shift">10am-1pm
		<input type="radio" name="shift" value= "3pm-5pm" id="shift1">3pm-5pm
	</div>
   
    <div class="row">
        <div class="form-group col-md-11">
            <label for="Name">Patient's Name</label>
            <input type="text" class="form-control" id="Name" placeholder="Patient's Name" name="name">
        </div>
    </div>
    

    <div class="form-group">
	    <label for="gender">Gender</label>
		<input type="radio" name="gender" value="Male" id="gender">Male
		<input type="radio" name="gender" value= "Female" id="gender1">Female
	</div>
   

    <div class="row">
        <div class="form-group col-md-4">
            <label for="Age">Patient's Age</label>
            <input type="number" class="form-control" id="Age" name="age">
            <?php echo (isset($errors['age'])) ? '<p class="alert alert-danger mt-2">' . $errors['age'] . '</p>' : null; ?>
        </div>
        <div class="form-group col-md-7">
            <label for="Phone">Phone</label>
            <input type="number" class="form-control" id="Phone" name="phone">
            <?php echo (isset($errors['phone'])) ? '<p class="alert alert-danger mt-2">' . $errors['phone'] . '</p>' : ''; ?>
        </div>        
    </div>

    <div class="row">
        <div class="form-group col-md-4">
            <label for="Address">Permanent Address</label>
            <input type="text" class="form-control" id="Address" placeholder="Write Permanent Address" name="address">
        </div>
        

        <div class="col-md-7">
            <label for="Date">Date</label>
            <input type="date" class="form-control" id="Date" name="date">
            <small class="form-text">Note:- We are not available on Saturday and Holidays</small>
        </div>
    </div>

    <div class="mb-5">      
        <button type="submit" class="btn btn-danger" name="submit_req">Submit</button>  
        <button type="reset" class="btn btn-primary" name="reset">Reset</button> 
    </div>   
</form>


</div> <!--End Submit Request form 2nd column-->

<?php
 include('includes/footer.php');
?>
