<!DOCTYPE html>
<html lang="en">
<!-- Basic -->
<?php
session_start();
if (!isset($_SESSION['name'])) {
    header('location: login.php');
}
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
    

</head>
<?php
include ('php/connection.php');
$anumber=$_GET['accnumber'];
// function createRandomAccountNumber() {
//     $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ023456789";
//     srand((double)microtime()*1000000);
//     $i = 0;
//     $pass = '' ;
//     while ($i <= 7) {

//         $num = rand() % 33;

//         $tmp = substr($chars, $num, 1);

//         $pass = $pass . $tmp;

//         $i++;

//     }
//     return $pass;
// }
// $accountNumber='ACC-'.createRandomAccountNumber();
//............................................................................
if (isset($_POST['update'])) {
    $accountnumber=$_REQUEST['accountnumber'];
    $faccountname=$_REQUEST['faccountname'];
    $laccountname=$_REQUEST['laccountname'];
    $dob=$_REQUEST['dob'];
    $email=$_REQUEST['email'];
    $address=$_REQUEST['address'];
    $date=$_REQUEST['date'];

    $query=mysqli_query($connection,"UPDATE clientaccounts SET
    fname='$faccountname', lname='$laccountname',dob='$dob',email='$email', address='$address',dateReg='$date' WHERE accountnumber='$anumber'");

    if ($query) {
        echo "<script> alert('Account Updated');</script>";
        echo "<script>window.close();</script>";

    }
    else {
        echo "<script> alert('failed');</script>";
    }
}

?>
<body id="inner_page" data-spy="scroll" data-target="#navbar-wd" data-offset="98">

    <!-- LOADER -->
    <div id="preloader">
        <div class="loader">
            <img src="images/loader.gif" alt="#" />
        </div>
    </div>
    <!-- end loader -->
    <!-- END LOADER -->

    <!-- Start header -->
    <header class="top-header">
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
                            <li><a class="join_bt" href="logout.php">Log out</a></li>
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
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbar-wd">
                    <ul class="navbar-nav">
                    
                        <li><a class="nav-link active" href="accounts.php">Accounts</a></li>
                        <li><a class="nav-link" href="exchange.php">Exchange</a></li>
                        <li><a class="nav-link" href="adminContacts.php">Contact</a></li>
                    </ul>
                </div>
                     </div>
                 </nav>
                 <div class="search-box">
                    <input type="text" class="search-txt" placeholder="Search">
                    <a class="search-btn">
                        <img src="images/search_icon.png" alt="#" />
                    </a>
                </div> 
                </div>
            </div>
          </div>
        </div>
        
    </header>
    <!-- End header -->

    <!-- Start Banner -->
    <div class="section inner_page_banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner_title">
                        <h3>Account Managment</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Banner -->
    
    <!-- section -->
   
    <div class="section layout_padding about_bg">
            <div class="row">
                <div class="col-lg-12">
                    <div class="full paddding_left_10">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                            <h3 class="card-title">Update Accounts</h3>
                            </div>
                            <div class=" card-body ">
                                <div class="container-flex overflow-auto">
                                    <div class="container-flex overflow-auto">
                                        <form action="" method="post">
                                        <table class="table table-hover table-striped">
                                            <colgroup>
                                                <col width="10%">
                                                <col width="10%">
                                                <col width="10%">
                                                <col width="10%">
                                                <col width="10%">
                                                <col width="10%">
                                                <col width="10%">
                                            </colgroup>
                                            <thead>
                                                <tr>
                                                    <th>Account Number</th>
                                                    <th>First name</th>
                                                    <th>Second name</th>
                                                    <th>Date of Birth</th>
                                                    <th>Email</th>
                                                    <th>Address</th>
                                                    <th>Regiser Data</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    include ('php/connection.php');
                                                    $qry = mysqli_query($connection,"SELECT * FROM clientaccounts WHERE accountnumber ='$anumber'");
                                                    
                                                    while($result = mysqli_fetch_array($qry)):
                                                ?>
                                                
                                                    <tr>
                                                        <td class="text-center"><input type="text" name="accountnumber" value="<?php echo $result['accountnumber']; ?>" readonly></td>
                                                        <td class="text-center"><input type="text" name="faccountname" value="<?php echo $result['fname']; ?>"></td>
                                                        <td class="text-center"><input type="text" name="laccountname" value="<?php echo $result['lname']; ?>"></td>
                                                        <td class="text-center"><input type="text" name="dob" value="<?php echo $result['dob']; ?>"></td>
                                                        <td class="text-center"><input type="text" name="email" value="<?php echo $result['email']; ?>"></td>
                                                        <td class="text-center"><input type="text" name="address" value="<?php echo $result['address']; ?>"></td>
                                                        <td class="text-center"><input type="text" name="date" value="<?php echo $result['dateReg']; ?>"></td>
                                                        <td align="center">
                                                            <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                                    Action
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <div class="dropdown-menu" role="menu">
                                                                <button type="submit" name="update" class="dropdown-item btn btn-light"><a><span class="fa fa-edit text-primary">Update</span></a></button>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item" href="accounts.php"><span class="fa fa-backward text-danger">Back</span> </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </form>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Footer -->
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
                                <div class="footer_blog full white_fonts">
                            <h3>Inform Us</h3>
                             <p>Leave your Email we will get back to you as soon as possible</p>
                             <div class="newsletter_form">
                                <form action="index.html">
                                   <input type="email" placeholder="Your Email" name="#" required="">
                                   <button>Submit</button>
                                </form>
                             </div>
                         </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <div class="full">
                                <div class="footer_blog full white_fonts">
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