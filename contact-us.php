<?php 
	session_start();
	
	if(isset($_SESSION['user_id'])){
		require('db_Conn.php');
	}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
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

        <!-- Contact Us Section-->
        <div id="wrapper" class="clearfix">
		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">
                    
					<div class="row">
                        <div class="col-lg-2"></div>
						
						<div class="col-lg-8">
							<!-- Contact Form
							============================================= -->
							<h3 class="text-center">Send us an Email</h3>

							<div class="form-widget">

								<div class="form-result"></div>

								<form class="mb-0" id="template-contactform" name="template-contactform" action="include/form.php" method="post" novalidate="novalidate">

									<div class="form-process">
										<div class="css3-spinner">
											<div class="css3-spinner-scaler"></div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6 form-group">
											<label for="template-contactform-name">Name <small>*</small></label>
											<input type="text" id="template-contactform-name" name="template-contactform-name" value="" class="sm-form-control required">
										</div>

										<div class="col-md-6 form-group">
											<label for="template-contactform-email">Email <small>*</small></label>
											<input type="email" id="template-contactform-email" name="template-contactform-email" value="" class="required email sm-form-control">
										</div>

										<div class="col-md-6 form-group">
											<label for="template-contactform-phone">Phone</label>
											<input type="number" id="template-contactform-phone" name="template-contactform-phone" value="" class="sm-form-control">
										</div>

										<div class="col-md-6 form-group">
											<label for="template-contactform-subject">Subject <small>*</small></label>
											<input type="text" id="template-contactform-subject" name="subject" value="" class="required sm-form-control">
										</div>

										<div class="w-100"></div>

										<div class="col-12 form-group">
											<label for="template-contactform-message">Message <small>*</small></label>
											<textarea class="required sm-form-control" id="template-contactform-message" name="template-contactform-message" rows="6" cols="30"></textarea>
										</div>

										<div class="col-12 form-group d-none">
											<input type="text" id="template-contactform-botcheck" name="template-contactform-botcheck" value="" class="sm-form-control">
										</div>

										<div class="col-12 form-group text-center">
											<button class="button button-3d m-0" type="submit" id="template-contactform-submit" name="template-contactform-submit" value="submit">Send Message</button>
										</div>
									</div>

									<input type="hidden" name="prefix" value="template-contactform-">

								</form>
							</div>

							<div class="line"></div>
                            <div class="col-lg-2"></div>
					    </div>
                    
				</div>
			</div>
		</section><!-- #content end -->

	</div>
        <!-- End section -->

        <?php require('footer.php')?>
    </div>
    <?php require('footer-links.php')?>
</body>
</html>