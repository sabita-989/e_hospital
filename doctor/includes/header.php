<!DOCTYPE html>
<htm lang="en">
    <head>
        <meta charset="UTF-8"> 
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <!-- bootstrap css -->
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/all.min.css">
        <link rel="stylesheet" href="../css/custom.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        <title><?php echo TITLE ?></title>
    </head>
    <body>
        <!-- top nav bar -->
        <nav class="navbar navbar-dark fixed-top bg-danger flex-md-nowrap p-0 shadow"><a class="navbar-brand col-sm-3 col-md-2 mr-0" href="requesterProfile.php">BirSewa</a></nav>

       <!-- start container -->
        <div class="conatiner-fluid" style="margin-top:40px;">
            <!-- start row -->
            <div class="row">
                 <!-- side bar 1st column-->
                <nav class="col-sm-2 bg-light sidebar py-5 d-print-none">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link <?php if(PAGE == 'docprofile') {echo 'active';} ?>" href="doc_profile.php"><i class="fas fa-user"></i>&nbsp;Profile</a></li></ul>
                        <li class="nav-item"><a class="nav-link <?php if(PAGE == 'Myappointment') {echo 'active';} ?>" href="doc_appointment.php"><i class="fa fa-address-card"></i>&nbsp;My Appointment</a></li></ul>
                        <!-- <li class="nav-item"><a class="nav-link" href="SubmitRequest.php"><i class="fab fa-accessible-icon"></i>Submit Request</a></li></ul> -->
                        <li class="nav-item"><a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a></li></ul>
                    </div>       
                </nav>
                <!-- end sidebar 1st column-->
                
                <style>
            .active{
                background-color:#d9d9d9;
            }
        </style>