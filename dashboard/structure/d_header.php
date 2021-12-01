<!-- close btn trigger temporarily removed due to response issues -->
<!-- <div id="header-trigger" class="d-none d-lg-block"><i class="icon-line-menu"></i><i class="icon-line-cross"></i></div> -->

<!-- Header
		============================================= -->
		<header id="header">
			<div id="header-wrap">
				<div class="container">
					<div class="header-row justify-content-lg-between">
						
						<div id="primary-menu-trigger">
							<svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
						</div>
						
						<div class="header-misc d-sm-block">
							<div class="d-flex">
								<div id="logo">
									<a href="../index.php" target="_blank" class="standard-logo w-50" data-mobile-logo="../images/logo.svg"><img draggable="false" src="../images/logo.svg" alt="logo"></a>
									<a href="../index.php" class="retina-logo w-50" data-dark-logo="../images/logo@2x.svg" data-mobile-logo="../images/logo@2x.svg"><img draggable="false" src="../images/logo@2x.svg" alt="Logo"></a>
								</div>
							</div>
						</div>

						<div class="user-section m-0 p-0">
						<div class="user m-0 p-0">
							<div class="profile text-center">
								<img class="profile-image" draggable="false" src="d_images/user.png" alt="user image">
								<h4 class="font-display username text-center"><?php echo username()?></h4>
							</div>
						</div>
						</div>
						
						<!-- Primary Navigation
						============================================= -->
						<nav class="primary-menu on-click">
							<ul class="menu-container">
								<li class="menu-item">
									<a class="menu-link" href="index.php">
										<img class="mr-1" src="d_images/icons/dashboard.svg" alt="dashboard icon" width="20px">
										Dashboard
									</a>
								</li>
								<li class="menu-item">
									<a class="menu-link" href="history.php">
										<img class="mr-1" src="d_images/icons/medical-history (1)-01.svg" alt="medical history icon" width="20px">
										History
									</a>
								</li>
								<li class="menu-item">
									<a class="menu-link" href="profile.php">
										<img class="mr-1" src="d_images/icons/user.svg" alt="profile icon" width="20px">
										Profile
									</a>
								</li>

								<li class="menu-item">
									<a class="menu-link" href="deleted-doses.php">
										<img class="mr-1" src="d_images/icons/delete.svg" alt="profile icon" width="20px">
										Archive
									</a>
								</li>

								<li class="menu-item">
									<a class="menu-link" href="../logout.php">
										<img class="mr-1" src="d_images/icons/logout.svg" alt="logout icon" width="20px">
										Logout
									</a>
								</li>
							</ul>

						</nav><!-- #primary-menu end -->

					</div>
				</div>
			</div>
			<div class="header-wrap-clone"></div>
		</header><!-- #header end -->