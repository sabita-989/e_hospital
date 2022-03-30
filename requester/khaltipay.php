<?php 
include('../dbconnection.php');
  session_start();
  if($_SESSION['is_login']){
      $rEmail= $_SESSION['rEmail'];
  }
  else{
      echo "<script> location.href='requesterLogin.php'</script>";
  }
     $user_id= $_SESSION['u_id'];
  $appoint_shift= $_SESSION['appointment_shift'];
  $appoint_doctor= $_SESSION['appointment_doctorid'];
  $appoint_time= $_SESSION['appointment_time'];
  $name=$_SESSION['patient_name'];
  $gender = $_SESSION['gender'];
  $problem = $_SESSION['problem'];
  $age = $_SESSION['age'];
  $phone = $_SESSION['phone'];
  $address = $_SESSION['address'];
  $inputdate = $_SESSION['inputdate'];
  $status = $_SESSION['status'];
  $appointmentid=0000; #dummy

//   echo $name."<br>".$age."<br>".$gender."<br>".$phone."<br>".$user_id."<br>".$appoint_shift."<br>".$appoint_doctor."<br>".$appoint_time."<br>".$problem."<br>".$address.
//   "<br>".$inputdate."<br>".$status."<br>".$appointmentid;

//   $sql ="select appointment_id from appointment_db where shift ='$appoint_shift' AND appointment_time='$appoint_time'  AND doctor_id='$appoint_doctor'";
// $result = $conn->query($sql);
// $row=mysqli_fetch_assoc($result);
// $appointmentid=$row['appointment_id'];
// echo $appointmentid;
// echo "<br>";
?>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Place this where you need payment button -->
    <!-- <button id="payment-button">Pay with Khalti</button> -->
    <!-- Place this where you need payment button -->
    <!-- Paste this code anywhere in you body tag -->
    <div id="msg"></div>
  
    <script>
        var config = {
            // replace the publicKey with yours
            "publicKey": "test_public_key_f1865a63763747dcadb0cf63ed96f750",
            "productIdentity": "111",
            "productName":"Registration",
            "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
            "paymentPreference": [
                "KHALTI",
                "EBANKING",
                "MOBILE_BANKING",
                "CONNECT_IPS",
                "SCT",
            ],
            "eventHandler": {
                onSuccess(payload) {
                    // hit merchant api for initiating verfication
                    $.ajax({
                        type: "POST",
                        url: 'verification.php',
                        data: {
                            token: payload.token,
                            amount: payload.amount,
                        },
                        success: function(response) {
                            var jsonData = JSON.parse(response);
                            if (jsonData) {
                                <?php
                                  $sql = "INSERT INTO appointment_db(p_name,gender,problem,shift,age,phone,p_address,inputdate,appointment_time,a_status,r_login_id,doctor_id) VALUES 
                                  ('$name','$gender','$problem','$appoint_shift','$age','$phone','$address','$inputdate','$appoint_time','$status','$user_id','$appoint_doctor')";
                                 if($conn-> query($sql) == TRUE){ 
                                     
                                    $sql ="select appointment_id from appointment_db where shift ='$appoint_shift' AND appointment_time='$appoint_time'  AND doctor_id='$appoint_doctor'";
                                    $result = $conn->query($sql);
                                    $row=mysqli_fetch_assoc($result);
                                    $appointmentid=$row['appointment_id'];
                                $sql = "INSERT INTO payment_db(patient_name,ammount,payment_status,appointment_id) VALUES 
                                ('$name','100','Full','$appointmentid')";
                               if($conn-> query($sql) == TRUE){    
                                ?>
                                confirm('Amount Rs.' + jsonData.amount / 100 + ' With Rs.' + jsonData.cashback + ' Cashback and transaction fee Rs. ' + jsonData.fee_amount / 100 + ' was Paid via ' + jsonData.type.name + ' of ' + jsonData.user.name);
                                window.location.href='http://localhost/e_hospital/requester/notification.php';
                            <?php } }else{ echo $sql."<br>".mysqli_error($conn); } ?>
                                // let data = document.createElement('div')
                                // data.setAttribute('class', 'alert alert-success')
                                // data.setAttribute('role', 'alert')
                                // data.textContent = 'Amount Rs.' + jsonData.amount / 100 + ' With Rs.' + jsonData.cashback + ' Cashback and transaction fee Rs. ' + jsonData.fee_amount / 100 + ' was Paid via ' + jsonData.type.name + ' of ' + jsonData.user.name
                                // document.getElementById('msg').appendChild(data)
                                console.log(jsonData)
                            } else {
                                alert('NOT PAID!');
                            }
                        },
                    });
                     console.log(payload);
                },
                onError(error) {
                    console.log(error);
                },
                onClose() {
                    console.log('sorry');
                }
            }
        };

        var checkout = new KhaltiCheckout(config);
    
        // var btn = document.getElementById("payment-button");
        // btn.onclick = function()
        $( document ).ready(function() {
            // minimum transaction amount must be 10, i.e 1000 in paisa.
            checkout.show({
                amount: 100*100
            });
        });
     
    </script>
    <!-- Paste this code anywhere in you body tag -->
</body>

</html>