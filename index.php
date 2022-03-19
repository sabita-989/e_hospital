<!DOCTYPE html>
<html lang="em"> 
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,intial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <!--Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">

        <!-- Font Awesome CSS -->
        <link rel="stylesheet" href="css/all.min.css">
        
        <!-- Google font -->
        <link href=<link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">>

        <!-- Custom css -->
        <link rel="stylesheet" href="css/client.css">
        
        
        <title>e-Hospital</title>
    </head>

    <body>
        <!-- Start navigation -->
        <nav class="navbar navbar-expand-sm navbar-dark bg-danger pl-5 fixed-top">
        <a href="index.php" class="navbar-brand">BirSewa</a>
        <span class="navbar-text">Healing hands at your Service</span>    

        <button type="button" class="navbar-toggler"
         data-toggle="collapse" data-target="#myMenu">
         
         <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="myMenu">
            <ul class="navbar-nav pl-5 custom-nav">
                <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="#Services" class="nav-link">Services</a></li>
               
                <?php
                    session_start();
                    if(isset($_SESSION['is_login'])){
                        echo "<li class='nav-item'><a href='logout.php' class='nav-link'>Logout</a></li>";
                    }
                    else{
                        echo " <li class='nav-item'><a href='#Registration' class='nav-link'>Registration</a></li>";
                        echo "<li class='nav-item'><a href='requester/requesterLogin.php' class='nav-link'>Login</a></li>";      
                    }
                ?>
                <li class="nav-item"><a href="#Contact" class="nav-link">Contact</a></li>

            </ul>
        </div>
    </nav>  
        <!-- End navigation -->


        <!-- Start header Jumbotron -->
        <header class="jumbotron back-image" style="background-image: url(images/bir.jpeg);">
            <div class="myclass mainHeading">
            <h3 class="text-uppercase text-danger font-weight-bold">welcome to Bir hospital</h3>
            <p class="font-italic text-dark">Professional & Most Affordable Services!!</p>
            <a href="requester/requesterLogin.php" class="btn btn-success mr-4">Login</a>
            </div>
        </header>
        <!-- end header Jumbotron -->

        <!-- start introduction section container-->

        <div class="container">
            <div class="jumbotron">
                <h3 class="text-center">BirSewa</h3>
                <p>
                Bir Hospital (बीर अस्पताल) is the oldest and one of the busiest hospitals in Nepal. It is
              located at the center of Kathmandu city. The hospital is run by the National Academy of Medical Sciences, 
              a government agency since 2003.The hospital provides medical and surgical treatments. <br/>
              BirSewa is the fastest Service gateway from Bir Hospital where patients can choose certified medical personnel 
              and get additional health related services along with other information related to health online.
              BirSewa is also a virtual community where the patient can book appointments to their respective doctors 
              and here, hospital authority fixes a particular date for the respective patient in order to make things more convenient. 
              Our facilities help patients understand their health better by making better decisions related to their 
              health and find the best doctors and the best cure in lesser time.
                </p>
            </div>
        </div>
        <!-- end introduction section container-->

        <!-- start services section -->
        <div class="container text-center border-bottom" id="Services">
            <h2>Our Services</h2>
                <div class="row mt-4">
                    <div class="col-sm-4 mb-4">
                        <a href="#"><i class="fa fa-stethoscope fa-8x text-success">  </i></a>
                        <h4 class="mt-4">OPD</h4>
                    </div>
                      
                    <div class="col-sm-4 mb-4">
                        <a href="#"><i class="fa fa-wheelchair fa-8x text-danger"></i></a>
                        <h4 class="mt-4">Surgeries</h4>
                    </div> 
                        
                    <div class="col-sm-4 mb-4">
                        <a href="#"><i class="fa fa-user-md fa-8x text-primary"></i></a>
                        <h4 class="mt-4">Consultant</h4>
                    </div>
                </div>
        </div>
        <!-- End services section -->

        <!-- start registration form -->
           <?php include('UserRegistration.php') ?>
        <!-- end registration form -->

        <!-- start happy customer -->
            <div class="jumbotron bg-danger">
                <div class="container">
                    <h2 class="text-center text-light">Happy Customers</h2>
                    <div class="row mt-5">
                        <div class="col-lg-3 col-sm-6">
                            <div class="card shadow-lg mb-2">
                                <div class="card-body text-center">
                                    <img src="images/cus1.jpg" class="img-fluid" style="border-radius:100px;" alt="cus1">
                                    <h4 class="card-title">Ramesh yadav</h4>
                                    <p class="card-text">The kind of consultant and treatment I got from the hospital is very satisfiable</p>

                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-sm-6">
                            <div class="card shadow-lg mb-2">
                                <div class="card-body text-center">
                                    <img src="images/cus2.jpg" class="img-fluid" style="border-radius:100px;" alt="cus2">
                                    <h4 class="card-title">Sashi Regmi</h4>
                                    <p class="card-text">I'm a heart patient but I was able to give birth to a helathy baby, thanks to Bis Hospital</p>

                                </div>
                            </div>
                        </div>
                        <!-- end 1st column -->

                        <div class="col-lg-3 col-sm-6">
                            <div class="card shadow-lg mb-2">
                                <div class="card-body text-center">
                                    <img src="images/cus3.jpg" class="img-fluid" style="border-radius:100px;" alt="cus3">
                                    <h4 class="card-title">Bikash Shakya</h4>
                                    <p class="card-text">I got my throat surgery from this hopital. I dont have any complications till now.</p>

                                </div>
                            </div>
                        </div>
                        <!-- end 2nd column -->

                        <div class="col-lg-3 col-sm-6">
                            <div class="card shadow-lg mb-2">
                                <div class="card-body text-center">
                                    <img src="images/cus4.jpg" class="img-fluid" style="border-radius:100px;" alt="cus4">
                                    <h4 class="card-title">Vikky Kaushal</h4>
                                    <p class="card-text">My mother is a Kidney patient, she got her new Kidney.All thanks to Bir hospital. </p>

                                </div>
                            </div>
                        </div>
                        <!-- end 3rd column -->

                    </div>
                </div>
            </div>
            <!-- end 4th column -->
        
        <!-- end happy customer -->

        <!-- start contact us -->
        <div class="container" id="Contact">
            <h2 class="text-center mb-4">Contact Us</h2>
            <div class="row">
             
                    <!-- start 1st column -->
                    <?php include('contactform.php') ?>
                <!-- end 1st column -->
                
                <div class="col-md-4 text-center">
                    <strong>Bir Hospital</strong><br>
                    pvt LTD,<br>
                    Kanti Path Kathmandu <br>
                    Province no.3 <br>
                    Phone: 1234567 <br>
                    <a href="#" target="-blannk">www.birsewa.com</a><br>
                </div>
                <!-- end 2nd column -->
            </div>
        </div>
        <!-- end contact us -->

        <footer class="container-fluid bg-dark mt-5 text-white">
            <div class="container">
                <div class="row py-3">
                    <div class="col-md-6">
                        <!-- start 1st column -->
                        <span class="pr-2">Follow us:</span>
                        <a href="#" target="_blank" class="pr-2 fi-color"><i class="fab fa-facebook"></i></a>
                        <a href="#" target="_blank" class="pr-2 fi-color"><i class="fab fa-twitter"></i></a>
                        <a href="#" target="_blank" class="pr-2 fi-color"><i class="fab fa-youtube"></i></a>
                        <a href="#" target="_blank" class="pr-2 fi-color"><i class="fab fa-google"></i></a>
                        <a href="#" target="_blank" class="pr-2 fi-color"><i class="fas fa-rss"></i></a>
                    </div>
                    <!-- end 1st column -->
                    <div class=" col-md-6 text-right">
                        <small>Designed by Symbosis &copy; 2021</small>
                        <small class="ml-2"><a href="Admin/index.php">Admin Login</a></small>
                    </div>

                    <!-- <div class=" col-md-2 text-right">
                         
                    </div> -->
                    <!-- end2nd column -->
                </div>
            </div>

        </footer>

        <!-- Bootstrap Javascript -->
         <script src="js/jquery-3.3.1.slim.min.js"></script>
         <script src="js/popper.min.js"></script>
         <script src="js/bootstrap.min.js"></script>
         <script src="js/all.min.js"></script>
    </body>
 </html>