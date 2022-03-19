
<form action="test.php" method="POST">
<h2> Start Time: </h2>
<input type="time" id="time" name="time">
<h2> Interval Time: </h2>
<input type="text" id="interval_time" name="interval_time">
<h2> End Time: </h2>
<input type="time" id="end_time" name="end_time">
<input type="submit" name="submit"><br>
</form>

<?php
echo "For time stamp creation in appointment";
echo "<br>";
date_default_timezone_set('Asia/Kathmandu');
$dating = date('h:i:s a', time());
echo $dating;

echo "<br>";
// $date_string= date('m/d/y');
// echo $date_string;
// echo('<br>');
echo "skip";
echo "<br>";
$st_date = new DateTime('now');
$start_date = $st_date->format('D, Y-m-d');
list( $day, $starting_date) = explode(' ', $start_date);
// $e_date   = $st_date->add(new DateInterval('P10D'));
// $en_date = $e_date->format('D, Y-m-d');
// list( $oday, $ending_date) = explode(' ', $en_date);
// echo $start_date;
// echo '<br>';
// echo $starting_date;
// echo '<br>';
// echo $en_date;
// echo '<br>';
// echo $ending_date;
// echo '<br>';
// $interval = DateInterval::createFromDateString('1 day');
// $daterange = new DatePeriod($st_date, $interval ,$e_date);
// foreach($daterange as $date1){
//    echo $date1->format('D, Y-m-d').'<br>';
// }
$date_array[0]= $start_date;

for($k=1;$k<7;$k=$k+1){  
    $ie_date = $st_date->add(new DateInterval('P1D'));
    $date_array[$k]= $ie_date->format('D, Y-m-d ');
    $st_date = new DateTime($date_array[$k]);
} 
for($l=0;$l<$k;$l=$l+1){

    list( $whichday, $star_date) = explode(', ', $date_array[$l]);
    if($whichday=='Sat'){
        echo "saturday skipped";
        echo "<br>";
        $l=$l+1;
    }
    echo $date_array[$l]; 
    echo "<br>";

}

echo "skip";
echo "<br>";

if(isset($_POST['submit'])){
$start_time = $_POST['time'];
$end_time = $_POST['end_time'];
$int= $_POST['interval_time'];
$date_string= date('m/d/y');
// echo($start_time);
// echo("\n");
// echo($interval);
// echo("\n");
// echo($end_time);
// $dp = new DateTime($start_time);
// $hour = $dp->format('h');
// $min = $dp->format('i');
// echo($dp);
$end_time = "$date_string"." "."$end_time"; 
$interval = $int; 
$time_array[0]="$date_string"." "."$start_time"; 
$datestring = "$date_string"." "."$start_time"; 


for($i=1;strtotime($start_time)<strtotime($end_time);$i=$i+1){  
$datestring = $start_time;
//list($hours, $minutes) = explode(':', $interval); 
$date = new DateTime($datestring);    
$date->add(new DateInterval('PT'.$interval.'M'));
$time_array[$i] = $date->format('m/d/y H:i');
// $date_array[$i] = $date->format('m/d');
$start_time= $time_array[$i];

if($time_array[$i]>$end_time){
    $i=$i-1;
break;
}
}
// $j=0;
// while($j<$i){
//     echo($time_array[$j]);
//     echo("-");
//     $j= $j+1;
//     echo($time_array[$j]);
//     echo("<br>");
    
// }
for($j=0;$j<$i;$j=$j+1){ 
    if($time_array[$j]!=$end_time){
    $time_array[$j]="1"." ".$time_array[$j];
    list($flag, $date, $time) = explode(' ', $time_array[$j]);
    echo ($flag." " .$date." ".$time);
   
    echo("-");
    list($date, $time) = explode(' ', $time_array[$j+1]);
    echo ($time);
    echo("<br>");
    }else{break;}
  
}

// $datte = new DateTime($time_array[5]);    
// $datte = $datte->format(' H:i');
}
?>