<?php
    define('TITLE', 'Reschedule Appointment');
    include('includes/header.php');
    include('../dbconnection.php');
    define('PAGE', 'resetappointment');
    session_start();
    if($_SESSION['is_login']){
        $rEmail= $_SESSION['rEmail'];
    }
    else{
        echo "<script> location.href='requesterLogin.php'</script>";
    }
    if(isset($_POST['p_assign'])){
    $user_id= $_SESSION['u_id'];
    $id=$_GET['id'];
    $aid=$_GET['aid'];
   
    if(empty($errors)){
       if(!isset($_POST['inputdate'])|| !isset($_POST['shift'])){
            $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Fill All Fields</div>';
        }else{ 
            $shift =  $_POST['shift'];
            $inputdate = $_POST['inputdate'];
            $status="0";
            date_default_timezone_set('Asia/Kathmandu');
            $appointment_time = date('h:i:s a', time());
            $sql = "update appointment_db set shift='$shift', inputdate='$inputdate',hit_miss=NULL where appointment_id=$aid";
           if($conn-> query($sql) == TRUE){
            echo '<script>confirm("Appointment Re-scheduled.. Go to Next page?");</script>';
            echo '<script>window.location = "notification.php"</script>';

            }else{
             $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to Add</div>';
            }
     
        }
    }}


 
?>
<div class="container">
<!-- start 3rd requests order column-->
<!-- <div id="msg"></div> -->
<div class ="col-sm-5 mt-5 jumbotron">  
    <form action="" method="POST">
    <?php 
         if(isset($msg)){echo $msg;}
    ?>
        <h5 class="text-center">Appointment Details</h5>
        <div class="row">
            <div class="col-md-12">
                <label for="inputDate">Assign Date</label> </br>
                <select class="form-select" aria-label="Default" id="inputdate"  name="inputdate">
                <option selected>Select Date</option>
                <?php
                $st_date = new DateTime('now'); //dateobject
                $start_date = $st_date->format('D,Y-m-d'); //day year month day
                list( $day, $starting_date) = explode(',', $start_date); //, le explode
                $date_array[0]= $start_date;
                for($k=1;$k<7;$k=$k+1){  
                    $ie_date = $st_date->add(new DateInterval('P1D')); //1 din
                    $date_array[$k]= $ie_date->format('D,Y-m-d'); //day, year month day
                    $st_date = new DateTime($date_array[$k]); //object
                } 
                for($l=0;$l<$k;$l=$l+1){
                    list( $whichday, $star_date) = explode(',', $date_array[$l]); //loop ma , explode
                    $pass_date[$l]= $whichday."_".$star_date;
                    if($whichday=='Sat'){
                        $l=$l+1;
                        list( $whichday, $star_date) = explode(',', $date_array[$l]);
                        $pass_date[$l]= $whichday."_".$star_date;
                    }
                    if($l>=$k){break;}else{
                    ?><option value=<?php echo $pass_date[$l]; ?>>
                    <?php 
                 
                    echo $date_array[$l]; 
               
                    echo '</option>';
                }}
                ?>
              </select>
            </div>
        </div>
       
            <div class="row">
            <div class="col-md-12">
                <label for="inputDate">Select Time</label></br>
                <div id="time_radio" name="shift">
            </div>
            </div>
            <br>
        <?php 
      $id=$_GET['id'];
     $sql ="SELECT d_shift, d_eshift, d_interval FROM doctor_db WHERE doctor_id=$id";
     $result = $conn->query($sql);
     if($result->num_rows > 0){
        while($row=$result-> fetch_assoc()){
            $st=$row['d_shift']; //start time //string
            $et=$row['d_eshift'];// endtime
            $it=$row['d_interval'];// interval
            // //store input date ani 
            //algo_starts
            $starting_time = new DateTime($st); //time object
            $start_time= $starting_time->format('H:i'); //hour:minute
            $ending_time = new DateTime($et); //time object
            $end_time= $ending_time->format('H:i'); //hour:minute
            $int= $it;
            $date_string= date('D,m/d/y');  //date month/day/year current
            //init
            $end_time = "$date_string"." "."$end_time"; //m/d/y h:i
            $interval = $int; 
            $time_array[0]="$date_string"." "."$start_time"; // cuurent date fetched time //10;15 interval=5

            for($i=1;strtotime($start_time)<strtotime($end_time);$i=$i+1){  
                $datestring = $start_time; //m/d/y h:i string
                //list($hours, $minutes) = explode(':', $interval); 
                $date = new DateTime($datestring);    //obj
                $date->add(new DateInterval('PT'.$interval.'M')); //PT10M; PT10S; PT1H (starttime + interval)
                $time_array[$i] = $date->format('D,m/d/y H:i'); //m/d/y 10:20 10:25 (H:i 5:15pm = 17:15
                // $date_array[$i] = $date->format('m/d');
                $start_time=$time_array[$i]; //start time=10:20 ; 10:25
                if($time_array[$i]>$end_time){
                    $i=$i-1;
                    break;
                }
            }
            //for printing
            for($j=0;$j<$i;$j=$j+1){ 
                 if($time_array[$j]<$end_time){   
                $time_array[$j]=$time_array[$j]; // 1 date time 10:15
                list($date1, $time1) = explode(' ', $time_array[$j]); //10:15
                list($date2, $time2) = explode(' ', $time_array[$j+1]); //10:20
                $following_timeshift = $time1."-".$time2;
                // $passing_time_array[$j]=date("g:ia", strtotime($time1));
               // $passing_time_array[$j+1]=date("g:ia", strtotime($time2));
                // $following_date = 
            //   $sql ="SELECT shift, inputdate FROM appointment_date WHERE shift='$this_shift' ";
            //   if($conn->query($sql)==FALSE){
                // echo '<option>';
                // echo  $passing_time_array[$j];
                // echo "The following time".$following_timeshift;
                //ya yesari nai anding garne date sng ani db ma check gari heram..
                //echo garnu aghi tyo range xa ki nai check garna baki
                // echo (date("g:ia", strtotime($time1))." "."-"." ".date("g:ia", strtotime($time2)));
                $passing_time_array[$j]=(date("g:ia", strtotime($time1))." "."-"." ".date("g:ia", strtotime($time2)));//10:40am -11:50am
                // echo '</option>';
                // echo("<br>");
                 }
                 else{break;}
            }
            // list($da1, $en) = explode(' ', $end_time); 
            // $endingg_time= date("g:ia", strtotime($en));
            // array_push($passing_time_array,$endingg_time);
        } }
$id=$_GET['id'];
  $sqls ="SELECT shift,inputdate,a_status FROM appointment_db WHERE doctor_id=$id";
  $results = $conn->query($sqls);
  $z=0;
  $h=0;
  $whichday1="day";
  $star_date1=" ";
  if($results->num_rows > 0){
     while($rows=$results-> fetch_assoc()){
        $db[$z]=$rows['inputdate'];
        list($whichday12,$star_date1) = explode('_',$db[$z] );
        $passing_date[$z]= $whichday12."_".$star_date1;
        $passing_status[$z]=$rows['a_status'];
        $passing_shift[$z]=$rows['shift'];
        $z=$z+1;
    }}
?>
</div>
        
      
        <br>
        <hr>
        <p class="pay_option mb-4"> Reschedule Appointment : </p>
   
        <div class="float-left">   
            <button type="submit" class="btn btn-primary" name="p_assign">Schedule </button>  
            <button type="reset" class="btn btn-secondary">Reset</button> 
        </div> 
       
    </form>
 
    
</div> 
<!-- End 3rd requests order column-->
</div>
<style>
.pay_option{
    
    margin:3px;
}
</style>
<script src="js/jquery-3.3.1.slim.min.js"></script>

<script>
//passed time array to display time range
var passedTime= <?php echo json_encode($passing_time_array); ?>; //time array start-(interval)end

//passed date and status to check if time range is locked(status=1) on that day or not

var passedDate= <?php
if(isset($passing_date)){
    echo json_encode($passing_date); //particular kun kun date ma chai appointment
}else{
    echo '1';
}
 ?>;
var passedStatus= <?php 
if(isset($passing_status)){
    echo json_encode($passing_status); //particular kun kun status kk ma chai appointment
}else{
    echo '1';
}
?>;
var passedShift= <?php 
if(isset($passing_shift)){
    echo json_encode($passing_shift); //particular kun kun status kk ma chai appointment
}else{
    echo '1';
}
?>;

// to display block of code
$('#inputdate').on('change',function(){
    selected_date=this.value;
    console.log(selected_date);
    console.log(typeof(selected_date));

    
    if(selected_date== "Select Date"){
        var createRadio = "";
    }else{
    var createRadio = "";
    for(var i = 0; i <passedTime.length; i++){
        var comparingDbrow= 
        Array.prototype.concat(selected_date,passedTime[i],"1"); // jun select tyo date, entire time shift array, 1
         //console.log(comparingDbrow);
        for(var j=0;j<passedDate.length; j++){
            var passedDbrow= 
            Array.prototype.concat(passedDate[j],passedShift[j],passedStatus[j]);// doctor ko appointment date, entire time shift array, 1/0
                //console.log(passedDbrow);
            if(JSON.stringify(comparingDbrow)==JSON.stringify(passedDbrow)){
                i=i+1;
            }
        }
        if(i>passedTime.length-1){break;}
        createRadio += `<input type='radio' id='shift_time' value='${passedTime[i]}' name='shift'>`;
        createRadio += `<label for='shift_time'>${passedTime[i]}</label>`; 
        createRadio +="<br>"; 
    } 
    }

document.getElementById("time_radio").innerHTML=createRadio;

});



</script>
<?php
 include('includes/footer.php');
?>