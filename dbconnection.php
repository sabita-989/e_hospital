<?php
$db_host ="localhost";
$db_user="root";
$db_password="";
$db_name="birsewa";
$db_port=3306;

// create connection
$conn= new mysqli($db_host, $db_user, $db_password, $db_name, $db_port);

if($conn->connect_error){
    die("Connection failed");
}
// else{
    // echo "Connect";
// }
?>