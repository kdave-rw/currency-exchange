<!DOCTYPE html>
<html lang="en">
<!-- Basic -->
<?php
session_start();
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Site Metas -->
    <title>Exchange Currency</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="#" type="image/x-icon" />
    <link rel="apple-touch-icon" href="#" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Pogo Slider CSS -->
    <link rel="stylesheet" href="css/pogo-slider.min.css" />
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css" />

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php

$_SESSION['mssg']=" ";

include ('php/connection.php');

if (isset($_POST['signup'])) {

  $fname=$_REQUEST["fname"];
  $lname=$_REQUEST["lname"];
  $email=$_REQUEST["email"];
  $password=md5($_POST["password"]);
  $type=$_REQUEST["type"];  
 
  $create="INSERT INTO users values('','$fname','$lname','$email','$password','$type')";
  if (mysqli_query($connection, $create)) {
    $_SESSION['mssg']="Account succeful created, you can login now!";
    echo $_SESSION['mssg'];
    session_unset();
    header('location:login.php');
  }else {
    $_SESSION['mssg']="Something went wrong";
    echo $_SESSION['mssg'];
    session_unset();
  }

}
?>
</head>

<body id="home" data-spy="scroll" data-target="#navbar-wd" data-offset="98">

    <!-- LOADER -->
    <!-- <div id="preloader">
        <div class="loader">
            <img src="images/loader.gif" alt="#" />
        </div>
    </div> -->
    <!-- end loader -->
    <!-- END LOADER -->

    <!-- Start header -->
    <header class="top-header fixed">
        <div class="header_top">
            
            <div class="container">
                <div class="row">
                    <div class="logo_section">
                        <a class="navbar-brand" href="#"><img src="images/logo.png" alt="image"></a>
                    </div>
                    <div class="site_information">
                        <ul>
                            <li><a href="mailto:exchang@gmail.com"><img src="images/mail_icon.png" alt="#" />exchang@gmail.com</a></li>
                            <li><a href="tel:exchang@gmail.com"><img src="images/phone_icon.png" alt="#" />+0789999999</a></li>
                            <li><a class="join_bt" href="#">Join us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        
        </div>
        <div class="header_bottom">
          <div class="container">
            <div class="col-sm-12">
                <div class="menu_orange_section" style="background: #ff880e;">
                   <nav class="navbar header-nav navbar-expand-lg"> 
                     <div class="menu_section">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-wd" aria-controls="navbar-wd" aria-expanded="false" aria-label="Toggle navigation">
                    
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbar-wd">
                    <ul class="navbar-nav">
                        <li><a class="nav-link active" href="#">Signup</a></li>
                        <li><a class="nav-link" href="login.php">Login</a></li>
                
                    </ul>
                </div>
                     </div>
                 </nav>
                 
                </div>
            </div>
          </div>
        </div>
        
    </header>
    <!-- End header -->

    <!-- Start Banner -->
    
      <div class="container mx-auto">
            <div class="row">
            <form action="" method='post' name="myForm">
            <div class="form-group row">
              <label for="fname" class="col-sm-5 col-form-label">First name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="fname" placeholder="First name" Required>
              </div>
              </div>
              <div class="form-group row">
              <label for="lname" class="col-sm-5 col-form-label">Last name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="lname" placeholder="Last name" Required>
              </div>
              </div>
              <div class="form-group row">
              <label for="inputEmail" class="col-sm-5 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" name="email" placeholder="Email" Required>
              </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-5 col-form-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
              </div>
              <div class="form-group">
                <label for="accounttype">Select User Type</label>
                <select class="form-control" id="accounttype" name="type">
                  <option value='1'>Admin</option>
                  <option value='2'>Standard User</option>
                </select>
              </div>
              <div class="form-group row">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary" name="signup">Create account</button>
                </div>
              </div>
            </form>      
            </div>
      </div>
    <footer class="footer-box">
        <div class="container">
            <div class="row">
               <div class="col-md-12 white_fonts">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <div class="full">
                                <img class="img-responsive" src="images/footer_logo.png" alt="#" />
                            </div>
                        </div>
      
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <div class="full">
                                <div class="footer_blog  white_fonts">
                                  <h3>Contact us</h3>
                                  <ul class="full">
                                    <li><img src="images/i5.png"><span>Downtown 10-12<br>Kigali Rwanda</span></li>
                                    <li><img src="images/i6.png"><span>exchange@gmail.com</span></li>
                                    <li><img src="images/i7.png"><span>+0789999999</span></li>
                                  </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			      </div>
    </div>
    </footer>
    
    <!-- End Footer -->

    <div class="footer_bottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="crp">© Copyrights 2023 group work</p>
                    <a href="#" id="scroll-to-top" class="hvr-radial-out"><i class="fa fa-angle-up"></i></a>
                </div>
            </div>
        </div>
    </div>

  

    <!-- ALL JS FILES -->
    <script src="js/jquery.min.js"></script>
	  <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.pogo-slider.min.js"></script>
    <script src="js/slider-index.js"></script>
    <script src="js/smoothscroll.js"></script>
    <script src="js/form-validator.min.js"></script>
    <script src="js/contact-form-script.js"></script>
    <script src="js/isotope.min.js"></script>
    <script src="js/images-loded.min.js"></script>
    <script src="js/custom.js"></script>
	
</body>
</html>