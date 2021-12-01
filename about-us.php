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
    <title>About Us</title>
    <?php require('header-links.php') ?>
</head>
<body class="stretched">
    <!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">
    <?php 
      if(isset($_SESSION['email'])){
        require('header-for-loggedin-users.php');
      }
      else{
        require('header.php');
      }
    ?>

        <!-- About Us Section-->
        <div id="slider" class="slider-element dark py-0" style="
          background-size: cover;
          background-image: url('images/about.jpg');
          background-position: center center;
          background-repeat: no-repeat;
        ">
        <div class="container">
          <div class="
              row
              text-center
              py-5
              min-vh-md-75
              justify-content-center
              align-items-center
            ">
            <div class="col-lg-6">
              <h5 class="mb-1 text-uppercase ls3 text-white-50 font-body">
                About Us
              </h5>
              <h2 class="display-3 font-weight-bolder ls3 font-display mb-5">
                Right Choice<br>of Careness
              </h2>
              <a href="register.php" class="
                  button button-large
                  rounded-pill
                  bg-color-2
                  button-light
                  text-dark
                  ls0
                  font-weight-medium
                  m-0
                ">Register Now</a>
            </div>
          </div>
        </div>
      </div>
		<div class="container py-5">
            <!-- Tab
					============================================= -->
            <div class="row justify-content-between py-5">
              <div class="col-lg-6 col-md-6 mb-5 mb-md-0">
                <div class="nav flex-column nav-pills" id="canvas-tabs-tab" role="tablist" aria-orientation="vertical">
                  <img src="images/founder-story.jpg" alt="">
                </div>
              </div>
              <div class="col-md-6 py-5">
                <div class="tab-content" id="canvas-tabContent">
                  <div class="tab-pane show active text-center" id="canvas-tabs-1" role="tabpanel" aria-labelledby="canvas-tabs-1-tab">
                    <div class="clear"></div> 
                    <div class="d-block text-left mt-5 mw-xs">
                     <h1 class="" id="canvas-tabs-1-tab" data-toggle="pill" href="#canvas-tabs-1"   role="tab">
                       WHY WE DO WHAT WE DO
                      </h1>
                      <p class="mb-0">
                      In 2012, Omri and Rotem Shor’s father accidentally took an extra dose of insulin. It was a simple mistake, but it put his life in grave danger.

                      After going through this experience as a family, the brothers created Medisafe to help patients like you stay safe while taking their medications.
                      </p>

                      <h3 class="mt-3">
                        Our mission is to use technology to take the stress and confusion out of managing complex prescriptions, so that you can get back to living your life.
                      </h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="text-center mt-5">
               <img src="images/about-us-01.svg" alt="Image" height="350">
               <h3 class="mt-3">
                  To Know Us More
                </h3>
                <a href="contact-us.php" class="button rounded-pill ">Contact Us</a>
            </div>
          </div>       
		

        <!-- End section -->

        <?php require('footer.php')?>
    </div>
    <?php require('footer-links.php')?>
</body>
</html>