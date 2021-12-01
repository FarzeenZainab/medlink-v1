<?php
    session_start();

    if(!isset($_SESSION['user_id'])){
        header("Location: ../login.php");
    }
    else{
        require_once('../db_Conn.php');
        require_once('../username.php');

        $user_id = $_SESSION['user_id'];

        date_default_timezone_set('Asia/Karachi');
        mysqli_report(MYSQLI_REPORT_ERROR || MYSQLI_REPORT_STRICT);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Profile</title>

        <link href="d_custom/css/profile.css" rel="stylesheet" type="text/css">    
        <?php require('structure/d_header-links.php') ?>
    </head>
    <body class="stretched side-header open-header push-wrapper side-header-open">
        <div id="wrapper" class="clearfix h-100">
            <?php require('structure/d_header.php') ?>
    
            <!-- Content -->
            <div class="row h-100">
                <?php 
                    $sql = "SELECT * FROM users WHERE user_id='$user_id'";
                    $result = mysqli_query($con, $sql);
                                
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                ?>

                <div class="col-lg-4">
                    <div class="mt-5 mx-0 p-4">
                        <h3 class="h2 color font-weight-normal font-display border-bottom pb-4 mb-4 "><?php echo $row['first_name']; ?> <?php echo $row['last_name']; ?></h3>
                        <p>
                        Email Address: <?php echo $row['email']; ?>
                        <br>
                        Date of Birth: <?php echo $row['date_of_birth']; ?>
                        <br>
                        Contact Number: <?php echo $row['contact_number']; ?></p>
                    </div>
                </div>

                <div class="col-sm-12 col-md-8 col-lg-8 border-left h-100">
                    <div class="mt-5 mx-0 p-4">
                        <h3 class="h2 color font-weight-normal font-display border-bottom pb-4 mb-4 ">Edit Profile</h3>

                        <form action="update.php" method="POST">
                            <div class="form-input-div mt-3">
                                <div class="col-8 form-group">
                                    <label for="user-email">First Name<small>*</small></label>
                                    <input type="text" id="first_name" name="First_name" class="form-control" placeholder="First Name" value="<?php echo $row['first_name']; ?>" required>
                                </div>
                            </div>

                            <div class="form-input-div mt-3">
                                <div class="col-8 form-group">
                                    <label for="user-email">Last Name<small>*</small></label>
                                    <input type="text" id="Last_name" name="Last_name" placeholder="Last Name" class="form-control"  value="<?php echo $row['last_name']; ?>" required>
                                </div>
                            </div>

                            <div class="form-input-div mt-3">
                                <div class="col-8 form-group">
                                    <label for="user-email">Date of Birth<small>*</small></label>
                                    <input type="date" id="date_of_birth" name="date_of_birth" placeholder="date_of_birth" class="form-control" value="<?php echo $row['date_of_birth']; ?>" min="1940-12-31" max="2018-12-31" required>
                                </div>
                            </div>

                            <div class="form-input-div mt-3">
                                <div class="col-8 form-group">
                                    <label for="user-email">Contact Number<small>*</small></label>
                                    <input type="text" id="contact_number" name="contactNumber" placeholder="Contact_number" class="form-control" value="<?php echo $row['contact_number']; ?>" required>
                                </div>
                            </div>

                            <div class="form-input-div mt-3">
                                <br>
                                <div class="col-8 form-group">
                                <input type="submit" name="submit" class="btn-block button rounded m-0" value="Save Changes">
                                </div>
                            </div>
                        </form>
                        <br>
                        <?php }} ?>
                    </div>
                </div>
            </div>
        </div>
        <?php require('structure/d_footer-links.php'); ?>
    </body>
</html>

