<!DOCTYPE html>
<html lang="en">
<!-- Basic -->
<?php
include('php/connection.php');
session_start();
$_SESSION['passError']='';
if (!isset($_SESSION['standard'])) {
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

    [if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]

</head>

<body id="home" data-spy="scroll" data-target="#navbar-wd" data-offset="98">

    <!-- LOADER -->
    <div id="preloader">
        <div class="loader">
            <img src="images/loader.gif" alt="#" />
        </div>
    </div>
    <!-- end  --><!-- loader
    <!-- END LOADER -->

    <!-- Start header -->
    <header class="top-header">
        <div class="header_top">
            
            <div class="container">
                <div class="row">
                    <div class="logo_section">
                        <a class="navbar-brand" href="#"><img src="images/logo.png" alt="image"></a>
                        <h3 class="navbar brand">welcome <?php echo $_SESSION['standard']; ?></h3>
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
                        <li><a class="nav-link active" href="#">Account</a></li>
                        <li><a class="nav-link" href="standardExchange.php">Exchange</a></li>
                        <li><a class="nav-link" href="#contact">Contact</a></li>
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
    <?php

    if (isset($_POST['resetPass'])) {
        $accountnumber=$_POST['accountnumber'];
        $currentPassword=$_POST['currentPassword'];
        $newPassword=$_POST['newPassword'];
        $comfirmPassword=$_POST['comfirmPassword'];
    $select=mysqli_query($connection,"SELECT * FROM clientaccounts WHERE accountnumber='$accountnumber'");
        
        if (mysqli_num_rows($select)!=0) {
            $res=mysqli_fetch_array($select);
            $currencyPass=$res['currencypass'];
            if($currentPassword!=$currencyPass){
                $_SESSION['passError']="Current password is incorrect doesn't match!";
            }
            elseif($newPassword!=$comfirmPassword){
                $_SESSION['passError']="New passwords doesn't match!";
                
            }
            else{
                $p=$comfirmPassword;
              $qry=mysqli_query($connection,"UPDATE clientaccounts SET currencypass='$p' WHERE accountnumber='$accountnumber'") or die("Updates failed".mysqli_error($connection));  
              echo "<script> alert('Password Updated');</script>";
            }
        }
        else{
            $_SESSION['passError']="Account Not Found";   
        }
    }
    ?>
    <div class="section layout_padding about_bg">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="full paddding_left_15">
                        <div class="heading_main text_align_left">
                            <h4>Reset your Currency Password: </h4>  
                            <h3><?php echo $_SESSION['passError'];?></h3>  
                        </div>
                    </div>
                    <div class="full paddding_left_15">
                        <form action="standardAccount.php" method='post' name="myForm">
                            <div class="form-group row">
                                <label for="accountnumber" class="col-sm-5 col-form-label">Account Number</label>                                
                                <div class="col-sm-10">
                                    <input type="text" name="accountnumber" class="form-control" name="accountnumber" Required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="current" class="col-sm-5 col-form-label">Current Password</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="currentPassword" placeholder="Enter your Current Password" Required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="newpassword" class="col-sm-5 col-form-label">New Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="newPassword" placeholder="Enter the new password" Required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="comfirmpassword" class="col-sm-5 col-form-label">Comfirm Password</label>
                                <div class="col-sm-10">
                                    <input type="Password" class="form-control" name="comfirmPassword" placeholder="Comfirm your new Password" Required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary" name="resetPass">Change Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>      
                <div class="col-md-6">
                    <div class="full paddding_left_15">
                        
                        <div class="full paddding_left_15">
                        <!-- <form action="" method='post' name="myForm">
                            <div class="form-group row">
                                <label for="accountnumber" class="col-sm-5 col-form-label">Account Number</label>                                
                                <div class="col-sm-10">
                                    <input type="text" name="accountnumber" class="form-control" name="accountnumber" Required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="current" class="col-sm-5 col-form-label">Current Password</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="currentPassword" placeholder="Enter your Current Password" Required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="newpassword" class="col-sm-5 col-form-label">New Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="newPassword" placeholder="Enter the new password" Required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="comfirmpassword" class="col-sm-5 col-form-label">Comfirm Password</label>
                                <div class="col-sm-10">
                                    <input type="Password" class="form-control" name="comfirmPassword" placeholder="Comfirm your new Password" Required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary" name="resetPass">Change Password</button>
                                </div>
                            </div>
                        </form> -->
                    </div>
                        <div class="full paddding_left_15">
                            <a class="main_bt" href="standardExchange.php">Exchange Currency ></a>
                        </div>   
                    </div>   
                </div>
            </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="full paddding_left_10">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                            <h3 class="card-title">Transactions you Performed</h3>
                            </div>
                            <div class=" card-body ">
                                <div class="container-fluid">
                                    <div class="container-fluid ">
                                        <table class="table table-hover table-striped overflow-auto">
                                            <colgroup>
                                                <col width="10%">
                                                <col width="10%">
                                                <col width="20%">
                                                <col width="20%">
                                                <col width="15%">
                                                <col width="15%">
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
                                                    $qry = mysqli_query($connection,"SELECT * FROM clientaccounts");
                                                    
                                                    while($result = mysqli_fetch_array($qry)):
                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $result['accountnumber']; ?></td>
                                                        <td class="text-center"><?php echo $result['fname']; ?></td>
                                                        <td class="text-center"><?php echo $result['lname']; ?></td>
                                                        <td class="text-center"><?php echo $result['dob']; ?></td>
                                                        <td class="text-center"><?php echo $result['email']; ?></td>
                                                        <td class="text-center"><?php echo $result['address']; ?></td>
                                                        <td class="text-center"><?php echo $result['dateReg']; ?></td>
                                                        <td align="center">
                                                            <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                                    Action
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <div class="dropdown-menu" role="menu">
                                                                <a class="dropdown-item" target='_blank' href="editaccount.php?accnumber=<?php echo $result['accountnumber']; ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item" href="deleteaccount.php?accnumber=<?php echo $result['accountnumber'] ; ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div id="contact" class="section layout_padding padding_top_0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="full">
                        <div class="heading_main text_align_center">
                           <h2><span class="theme_color"></span>Contact</h2>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end section -->
    <!-- contact_form -->
    <div class="section contact_form">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12 offset-lg-3">
                    <div class="full">
                    <?php
                    include_once('php/feedback.php');
                    
                    ?>
                        <form class="contact_form_inner" action="#" method="post" id="contact">
                            <fieldset>
                                <div class="field">
                                    <input type="text" name="name" placeholder="Your name" required/>
                                </div>
                                <div class="field">
                                    <input type="email" name="email" placeholder="Email" required/>
                                </div>
                                <div class="field">
                                    <input type="text" name="phone_no" placeholder="Phone number" required/>
                                </div>
                                <div class="field">
                                    <textarea placeholder="Message" name="message" required></textarea>
                                </div>
                                <div class="field center">
                                    <button name="feedback">SEND</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end contact_form -->
    <!-- end section -->
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
                </div>
            </div>
        </div>
    </div>

    <a href="#" id="scroll-to-top" class="hvr-radial-out"><i class="fa fa-angle-up"></i></a>

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
	<script>
	/* counter js */

(function ($) {
	$.fn.countTo = function (options) {
		options = options || {};
		
		return $(this).each(function () {
			// set options for current element
			var settings = $.extend({}, $.fn.countTo.defaults, {
				from:            $(this).data('from'),
				to:              $(this).data('to'),
				speed:           $(this).data('speed'),
				refreshInterval: $(this).data('refresh-interval'),
				decimals:        $(this).data('decimals')
			}, options);
			
			// how many times to update the value, and how much to increment the value on each update
			var loops = Math.ceil(settings.speed / settings.refreshInterval),
				increment = (settings.to - settings.from) / loops;
			
			// references & variables that will change with each update
			var self = this,
				$self = $(this),
				loopCount = 0,
				value = settings.from,
				data = $self.data('countTo') || {};
			
			$self.data('countTo', data);
			
			// if an existing interval can be found, clear it first
			if (data.interval) {
				clearInterval(data.interval);
			}
			data.interval = setInterval(updateTimer, settings.refreshInterval);
			
			// initialize the element with the starting value
			render(value);
			
			function updateTimer() {
				value += increment;
				loopCount++;
				
				render(value);
				
				if (typeof(settings.onUpdate) == 'function') {
					settings.onUpdate.call(self, value);
				}
				
				if (loopCount >= loops) {
					// remove the interval
					$self.removeData('countTo');
					clearInterval(data.interval);
					value = settings.to;
					
					if (typeof(settings.onComplete) == 'function') {
						settings.onComplete.call(self, value);
					}
				}
			}
			
			function render(value) {
				var formattedValue = settings.formatter.call(self, value, settings);
				$self.html(formattedValue);
			}
		});
	};
	
	$.fn.countTo.defaults = {
		from: 0,               // the number the element should start at
		to: 0,                 // the number the element should end at
		speed: 1000,           // how long it should take to count between the target numbers
		refreshInterval: 100,  // how often the element should be updated
		decimals: 0,           // the number of decimal places to show
		formatter: formatter,  // handler for formatting the value before rendering
		onUpdate: null,        // callback method for every time the element is updated
		onComplete: null       // callback method for when the element finishes updating
	};
	
	function formatter(value, settings) {
		return value.toFixed(settings.decimals);
	}
}(jQuery));

jQuery(function ($) {
  // custom formatting example
  $('.count-number').data('countToOptions', {
	formatter: function (value, options) {
	  return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
	}
  });
  
  // start all the timers
  $('.timer').each(count);  
  
  function count(options) {
	var $this = $(this);
	options = $.extend({}, options || {}, $this.data('countToOptions') || {});
	$this.countTo(options);
  }
});
	</script>
</body>

</html>