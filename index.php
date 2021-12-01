<?php 
	session_start();
	
	if(isset($_SESSION['user_id'])){
		require('db_Conn.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Tracker</title>

    <?php require('header-links.php')?>
</head>
<body class="stretched">
    <!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">
	<?php 
		if(isset($_SESSION['user_id'])){
			require('header-for-loggedin-users.php');
		}
		else{
			require('header.php');
		}
	?>

        <!-- Slider / Hero
		============================================= -->
		<div id="slider" class="slider-element dark py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 py-5 my-3">
                        <h2 class="display-3 color font-weight-normal font-display">Manage your health, without the headache.</h2>
                        <p class="color">Medlink is an easy-to-use and trusted medication reminder app that ensures medicines are taken on time and the risk of adverse health events is reduced</p>
                        <a href="register.php" class="btn text-larger rounded-pill bg-color text-white px-4 py-2 h-op-09 op-ts">Register</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Content
		============================================= -->
		<section id="content pb-0">
			<div class="content-wrap pb-0">

				<div class="container pb-0">

					<!-- A new kind of care
					============================================= -->
					<div class="row justify-content-center mt-5">
						<div class="col-md-7 text-center">
							<h3 class="display-4 color font-weight-bold font-display">A New Kind Of Care</h3>
							<p class="lead" style="line-height: 1.5"> MedLink makes it easier for your parents or loved ones to take their medications in the right amount and at the right time. With visual, audio and phone alerts, you’ll never need to remind them when to take their meds again.</p>
						</div>
					</div>
                    
					<div class="row justify-content-center align-items-center gutter-50 col-mb-80 mt-5">
						<div class="col-xl-9 col-lg-11">
							<div class="row feature-box-border col-mb-30 justify-content-center align-items-center">
								<div class="col-md-6 feature-box fbox-color">
									<div class="fbox-icon">
										<a href="#"><i>1</i></a>
									</div>
									<div class="fbox-content">
										<h3 class="nott text-larger mb-2">Peace of Mind</h3>
										<p>With advanced locking functionality and custom alerts, your loved ones will always get the right medication at the right time. If not, you will be notified by email, text or phone.</p>
									</div>
								</div>
								<div class="col-md-4 text-center">
									<img src="images/icons/icons-01.svg" alt="Image" class="p-4" height="230">
								</div>

								<div class="clear"></div>

								<div class="col-md-6 feature-box fbox-border fbox-light fbox-effect">
									<div class="fbox-icon">
										<a href="#"><i>2</i></a>
									</div>
									<div class="fbox-content">
										<h3 class="nott text-larger mb-2">Simplicity</h3>
										<p>MedLink is designed to be extremely intuitive and easy to use. Register yourself, add your medications. We'll sort your medications and send you the notification when its time to take your meds.</p>
									</div>
								</div>
								<div class="col-md-4 text-center">
									<img src="images/icons/icons-02.svg" alt="Image" class="p-4" height="230">
								</div>

								<div class="clear"></div>

								<div class="col-md-6 feature-box fbox-border fbox-light fbox-effect">
									<div class="fbox-icon">
										<a href="#"><i>3</i></a>
									</div>
									<div class="fbox-content">
										<h3 class="nott text-larger mb-2">Timely Reminders</h3>
										<p>We will send you reminders through notifications, SMS, and emails so you never forget to take your medications</p>
									</div>
								</div>
								<div class="col-md-4 text-center">
									<img src="images/icons/icons-03.svg" alt="Image" class="p-4" height="230">
								</div>

								<div class="clear"></div>

								<div class="col-md-6 feature-box fbox-border fbox-light fbox-effect">
									<div class="fbox-icon">
										<a href="#"><i>4</i></a>
									</div>
									<div class="fbox-content">
										<h3 class="nott text-larger mb-2">Daily Report</h3>
										<p>You can view the report of medicines you take, missed and skipped daily, so can keep a track on your medications</p>
									</div>
								</div>
								<div class="col-md-4 text-center">
									<img src="images/icons/icons-04.svg" alt="Image" class="p-4" height="230">
								</div>

								<div class="clear"></div>

								<div class="col-md-6 feature-box fbox-border fbox-light fbox-effect noborder">
									<div class="fbox-icon">
										<a href="#"><i>5</i></a>
									</div>
									<div class="fbox-content">
										<h3 class="nott text-larger mb-2">Weekly Report</h3>
										<p>You can view the report of medicines you take, missed and skipped weekly, so can keep a track on your medications</p>
									</div>
								</div>
								<div class="col-md-4 text-center">
									<img src="images/icons/icons-05.svg" alt="Image" class="p-5" height="230">
								</div>

							</div>	
						</div>
					</div>

                    <!-- Featured Icons Area
                    ============================================= -->
                    <div class="container topmargin-lg clearfix">
                        <div class="pricing-box pricing-extended row align-items-stretch mt-6 mx-0 border-0 rounded-lg" style="background-color: #f5f5f5;">
                            <div class="pricing-desc col-lg-9 p-5">
                                <h3 class="h2 color font-weight-normal font-display border-bottom pb-4 mb-4">See What People Say About Us</h3>
                                <div class="pricing-features bg-transparent pt-3 pb-0">
                                    <div class="row">
										<div class="col-12">
											<p> This app has literally improved my quality of life. If you ever forget to take your meds, download this app now. You’ll be surprised by how efficient and helpful it is. </p>
											<h5>— Infj87, United States</h5>
										</div>
										
									</div>
                                </div>
                            </div>

                            <div class="pricing-action-area border-0 col-lg d-flex flex-column justify-content-center" style="background-color: #e3eaf6;">
                                
                            </div>
                        </div>

                    </div>

					
					
				</div>

				<!-- Download App Section
				============================================= -->
				<div class="section py-md-0 section-mobile bg-color-2" no-repeat center left / contain;">
					<div class="container">
						<div class="row align-items-center justify-content-between">

							<div class="col-lg-5 col-md-6 py-5 py-lg-0">
								<h3 class="display-3 color font-weight-normal font-display mb-5">Launching Soon on Mobile</h3>
								<p class="text-large color">Launching our mobile application soon, so can get timely notifications, alerts, reminders and more. Stay Tuned!</p>
								<div>
									<a href="#"><img src="images/appstore.png" alt="Image" height="54" class="mt-3"></a>
									<a href="#"><img src="images/googleplay.png" alt="Image"  class="ml-xl-3 ml-lg-1 mt-3 ml-0 " height="54"></a>
								</div>
							</div>

							<div class="col-lg-6 col-md-6 mt-5 mt-sm-0">
								<div class="d-none d-lg-flex">
									<img src="images/iphone-2.png" class="fast" alt="Image" style="height: 600px" data-animate="fadeInUp" data-delay="200">
									<img src="images/iphone-1.png" class="fast" alt="Image" style="height: 600px" data-animate="fadeInUp">
								</div>
								<img src="images/iphone.png" alt="Image" class="d-block d-lg-none px-5 px-sm-0 p-md-5">
							</div>

						</div>
					</div>
				</div>
			</div>
		</section><!-- #content end -->
       
        <?php require('footer.php')?>
    </div>
    <?php require('footer-links.php')?>
</body>
</html>