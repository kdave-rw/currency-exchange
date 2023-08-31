<!DOCTYPE html>
<html lang="en">
<!-- Basic -->
<?php
include('php/connection.php');

session_start();
$_SESSION['accerror']='';
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

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
                        <li><a class="nav-link" href="standardAccount.php">Account</a></li>
                        <li><a class="nav-link active" href="#">Exchange</a></li>
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
    <!-- End header -->
    <div class=" container">
        <div class="pt-5 mt-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="container mx-auto">
                        <div class="row">
                            <?php
                                $sender['email']=" no Email found";
                                $receiver['email']=" no Email found";
                                $senderAcc='';
                                $receiverAcc='';
                                if (isset($_POST['findAcc'])) {
                                    $_SESSION['senderAcc']=$senderAcc=$_POST['senderAcc'];
                                    $_SESSION['receiverAcc']=$receiverAcc=$_POST['receiverAcc'];
                                    

                                    $qry=mysqli_query($connection,"SELECT * FROM clientaccounts WHERE accountnumber = '$senderAcc'");
                                    if (mysqli_num_rows($qry)!= 0) {
                                        $sender = mysqli_fetch_array($qry);
                                        $qry1=mysqli_query($connection,"SELECT * FROM clientaccounts WHERE accountnumber = '$receiverAcc'");
                                        if (mysqli_num_rows($qry1)!=0) { 
                                        $receiver = mysqli_fetch_array($qry1);
                                        }else{
                                             $_SESSION['accerror']="Receiver not Found!";
                                        }
                                    } 
                                    else{
                                        $_SESSION['accerror']="Sender not Found!";
                                    }
                                
                                }
                                if (isset($_POST['activateSend'])) {
                                $sendAmount=$_POST['sendAmount'];
                                $passPhase=$_POST['sendPasssword'];
                                
                                $qry=mysqli_query($connection,"SELECT * FROM clientaccounts WHERE accountnumber='{$_SESSION['senderAcc']}'")or die("account not found");
                                    if (mysqli_num_rows($qry)!=0) {
                                        $row=mysqli_fetch_array($qry);
                                        $pass=$row['currencypass'];
                                        if ($passPhase==$pass) {
                                            $select=mysqli_query($connection,"SELECT * FROM balance WHERE accountnumber='{$_SESSION['receiverAcc']}'")or die("Something is wrong".mysqli_error($connection));
                                            if (mysqli_num_rows($select)==0) {
                                                $new=mysqli_query($connection,"INSERT INTO balance(accountnumber, Received, Total_Balance) VALUES ('{$_SESSION['receiverAcc']}','$sendAmount','$sendAmount')")or die("Something is wrong".mysqli_error($connection));
                                            }elseif(mysqli_num_rows($select)!=0){
                                                $row=mysqli_fetch_array($select);
                                                $currentBalance=$row['Received']+ $sendAmount;
                                                $currentTotal=$currentBalance;
                                                $qry2=mysqli_query($connection,"UPDATE balance SET Received='$currentBalance', Total_Balance='$currentTotal' WHERE accountnumber='{$_SESSION['receiverAcc']}'")or die("Something is wrong".mysqli_error($connection)); 
                                            }
                                            else{}
                                        }else{
                                            echo "Password not Matching";
                                        }

                                    }

                                } 
                                ?>
                            <form action="" method='post' name="myForm">
                                <div class="form-group row">
                                  <h4><?php  echo $_SESSION['accerror']; ?></h4>
                                </div>
                                <div class="form-group row">
                                  <label for="fname" class="col-sm-5 col-form-label">Enter the Account</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" name="senderAcc" placeholder="Sender Account" autocomplete="off" required>
                                </div>
                                </div>
                                <div class="form-group row">
                              <label for="lname" class="col-sm-5 col-form-label">Your Email</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="SenderEmail" value="<?php echo   $sender['email']; ?>" readonly>
                              </div>
                              </div>
                              <div class="form-group row">
                                  <label for="fname" class="col-sm-5 col-form-label">Enter the Account</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" name="receiverAcc" placeholder="Receiver Account" autocomplete="off" required>
                                </div>
                                </div>
                                <div class="form-group row">
                              <label for="lname" class="col-sm-5 col-form-label">Receiver's Email</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="receiverEmail" value="<?php echo $receiver['email']; ?>" readonly>
                              </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-10">
                                  <button type="submit" class="btn btn-primary" name="findAcc">Find Account</button>
                                </div>
                              </div>
                            </form>     
                        </div>
                    </div>
                </div> 
                <div class="col-md-6">
                    <div class="container mx-auto">
                        <div class="row">
                            <?php
                               
                                ?>
                            <form action="" method='post' name="payform">
                                <div class="form-group row">
                                  <label for="amount" class="col-sm-5 col-form-label">Amount to send</label>
                                <div class="col-sm-10">
                                <input type="number" class="form-control" name="sendAmount" placeholder="Enter the amount to send.." autocomplete="off" required>
                                </div>
                                </div>
                                <div class="form-group row">
                              <label for="lname" class="col-sm-5 col-form-label">Password</label>
                              <div class="col-sm-10">
                                <input type="password" class="form-control" name="sendPasssword" required>
                              </div>
                              </div>
                              
                              <div class="form-group row">
                                <div class="col-sm-10">
                                  <button type="submit" class="btn btn-primary" name="activateSend">Send</button>
                                </div>
                              </div>
                            </form>     
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