<?php include('dbconnection.php'); ?>
<div class="row">
            <div class="col-md-12">
                <label for="inputDate">Assign Date</label> </br>
                <select class="form-select" aria-label="Default" id="inputdate"  name="inputdate">
                <option selected>Select Date</option>
                <?php
                $st_date = new DateTime('now');
                $start_date = $st_date->format('D,Y-m-d');
                list( $day, $starting_date) = explode(',', $start_date);
                $date_array[0]= $start_date;
                for($k=1;$k<7;$k=$k+1){  
                    $ie_date = $st_date->add(new DateInterval('P1D'));
                    $date_array[$k]= $ie_date->format('D,Y-m-d');
                    $st_date = new DateTime($date_array[$k]);
                } 
                for($l=0;$l<$k;$l=$l+1){
                    list( $whichday, $star_date) = explode(',', $date_array[$l]);
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
                <div id="time_radio"></div>
            </div>
        <?php 
  
     $sql ="SELECT d_shift, d_eshift, d_interval FROM doctor_db WHERE doctor_id='63'";
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
                $passing_time_array[$j]=(date("g:ia", strtotime($time1))." "."-"." ".date("g:ia", strtotime($time2)));
                // echo '</option>';
                // echo("<br>");
                 }
                 else{break;}
            }
            // list($da1, $en) = explode(' ', $end_time); 
            // $endingg_time= date("g:ia", strtotime($en));
            // array_push($passing_time_array,$endingg_time);
        } }

  $sql ="SELECT shift,inputdate,a_status,hit_miss FROM appointment_db WHERE doctor_id='63'";
  $result = $conn->query($sql);
  $i=0;
  $whichday1="day";
  if($result->num_rows > 0){
     while($row=$result-> fetch_assoc()){
        $db_date[$i] = $row['inputdate'];
        list( $whichday1, $star_date1) = explode('_', $db_date[$i]);
        $passing_date[$i]= $whichday1."_".$star_date1;
        $passing_status[$i]=$row['a_status'];
        $passing_shift[$i]=$row['shift'];
        $i=$i+1;
    }}
?>
<script src="js/jquery-3.3.1.slim.min.js"></script>

<script>
//passed time array to display time range
var passedTime= <?php echo json_encode($passing_time_array); ?>;

//passed date and status to check if time range is locked(status=1) on that day or not

var passedDate= <?php
if(isset($passing_date)){
    echo json_encode($passing_date);
}else{
    echo '1';
}
 ?>;
var passedStatus= <?php 
if(isset($passing_status)){
    echo json_encode($passing_status); 
}else{
    echo '1';
}
?>;
var passedShift= <?php 
if(isset($passing_shift)){
    echo json_encode($passing_shift); 
}else{
    echo '1';
}
?>;

// to display block of code
$('#inputdate').on('change',function(){
    selected_date=this.value;
    console.log(selected_date);
    console.log(typeof(selected_date));

    var a="Tue_2022-02-08";  var b= "10:15am - 11:15am"; var c= "1";
    console.log(passedDate[0]);
    if(selected_date==a){console.log("hey");} 
    
    if(selected_date== "Select Date"){
        var createRadio = "";
    }else{
    var createRadio = "";
    for(var i = 0; i <passedTime.length; i++){
        var comparingDbrow= 
        Array.prototype.concat(selected_date,passedTime[i],"1");
        // console.log(comparingDbrow);
        for(var j=0;j<passedDate.length; j++){
            var passedDbrow= 
            Array.prototype.concat(passedDate[j],passedShift[j],passedStatus[j]);
                // console.log(passedDbrow);
            if(JSON.stringify(comparingDbrow)==JSON.stringify(passedDbrow)){
                i=i+1;
            }
        }
        createRadio += `<input type='radio' id='shift_time' value='${passedTime[i]}' name='shift'>`;
        createRadio += `<label for='shift'>${passedTime[i]}</label>`; 
        createRadio +="<br>"; 
    } 
    }
document.getElementById("time_radio").innerHTML=createRadio;
});


for(var j = 0; j <passedDate.length; j++){
    document.write("<br>");
    document.write(passedDate[j].toString());
    document.write("&nbsp |");
    document.write(typeof(passedDate[j]));
    document.write("&nbsp |");
    document.write(passedShift[j].toString());document.write("&nbsp |");
    document.write(typeof(passedShift[j]));
    document.write("&nbsp |");
    document.write(passedStatus[j].toString());document.write("&nbsp |");
    document.write(typeof(passedStatus[j]));
    document.write("<br>");

}


</script>