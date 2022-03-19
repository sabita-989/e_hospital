<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE ?></title>
     <!-- Bootstrap css -->
     <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- font awesome css -->
    <link rel="stylesheet" href="../css/all.min.css">    

    <!-- custom css -->
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark fixed-top bg-danger flex-md-nowrap p-0 shadow"><a class="navbar-brand col-sm-3 col-md-2 mr-0" href="dashboard.php">BirSewa</a></nav>
<!-- start container -->
<div class="conatiner-fluid" style="margin-top:40px;">
    <!-- start row -->
    <div class="row">
        <!-- side bar 1st column-->
        <nav class="col-sm-2 bg-light sidebar py-5">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link <?php if(PAGE == 'dashboard') {echo 'active';} ?>" href="dashboard.php"><i class="fas fa-notes-medical"></i> Dashboard</a></li></ul>  
                <li class="nav-item"><a class="nav-link <?php if(PAGE == 'patientrequest') {echo 'active';} ?>" href="patientrequest.php"><i class="fas fa-chalkboard-teacher"></i> Patient Requests</a></li></ul>  
                <li class="nav-item"><a class="nav-link <?php if(PAGE == 'speciality') {echo 'active';} ?>" href="speciality.php"><i class="fas fa-user-md"></i> Speciality</a></li></ul>              
                <li class="nav-item"><a class="nav-link <?php if(PAGE == 'doctors') {echo 'active';} ?>" href="doctors.php"><i class="fas fa-user-md"></i> Doctors</a></li></ul>
                <li class="nav-item"><a class="nav-link <?php if(PAGE == 'users') {echo 'active';} ?>" href="users.php"><i class="fas fa-user"></i> Users</a></li></ul>
                <li class="nav-item"><a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li></ul>
            </div>       
        </nav>
        <!-- end sidebar 1st column-->
        <style>
            .active{
                background-color:#d9d9d9;
            }
        </style>