<?php session_start();
    if(isset($_SESSION['user_id'])){
       header("Location:Dashboard/index.php");
    }
    
?>
 
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="custom/css/login.css"/>
    <title>Login</title>
    <?php require('header-links.php') ?>
</head>
<body class="stretched">
    <!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">
        <?php require('header.php')?>

        <!-- Login Section-->
        <div class="container clearfix rounded-lg vh-100">
            <div class="row">
                <div class="col-sm-4"></div>

                <div class="col-sm-4">
                    <div class="row align-items-stretch mt-5 mx-0 shadow" style="background-color: #f5f5f5;border-radius: 10px !important;">
                        <div class="col-12 p-4">
                            <h3 class="h2 h-login color font-weight-normal font-display border-bottom pb-4 mb-4">Login</h3>
                            <div class="m-0 p-0 login-message">
                                <p class="text-primary text-center message"></p>
                            </div>
                            <form action="login.php" method="POST" class="form-active" id="login-form">
                                <div class="form-input-div mt-3">
                                    <div class="col-12 form-group">
                                        <label for="user-email">Email Address</label>
                                        <input type="email" id="user-email" name="user-email" class="form-control" pattern="^[a-zA-Z0-9]+[0-9]*\S*@(gmail|hotmail|yahoo|bing|outlook)\.com$"
                                        data-parsley-error-message="Please enter a valid email address" maxlength="100" required/>
                                    </div>
                                </div>

                                <div class="form-input-div mt-3">
                                    <div class="col-12 form-group">
                                        <label for="user-password">Password</label>
                                        <input type="password" id="user-password" name="user-pass" class="form-control" maxlength="50" data-parsley-error-message="Please enter your password" required/>
                                    </div>
                                </div>

                                <div class="form-input-div">
                                    <div class="col-12 form-group">
                                        <div class="login">
                                            <br class="breaks">
                                            <input type="Submit" id="submit-login" name="login" value="Login" class="button rounded btn-block m-0" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div>
                        <p class="text-center mt-4"><a href="index.php">Go back to homepage</a></p>
                    </div>
                </div>

                <div class="col-sm-4"></div>
            </div>
        </div>
        <!-- End section -->
        <br><br>
        <?php require('footer.php')?>
    </div>
    <?php require('footer-links.php')?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $("#login-form").parsley();
    </script>

    <?php 

        require('db_Conn.php');

        if(isset($_POST['login'])){
            // Set variables
            $email = $_POST['user-email'];
            $pass = $_POST['user-pass'];
            
            //check email
            $check_email_query = "call check_user_email('$email')";
            $execute = mysqli_query($con, $check_email_query);

            $rows = mysqli_num_rows($execute);

            if($rows === 1){
                //Free memory result set and proceed to next query
                mysqli_free_result($execute);
                mysqli_next_result($con); 

                //Get password
                $password_query = "call get_user_password('$email')";
                $execute = mysqli_query($con, $password_query);

                $password = mysqli_fetch_assoc($execute);

                // varify if the password is same
                // this function only accepts strings as arguments so we need to convert array to string using implode() function

                $verify = password_verify($pass, implode($password)); 
                    // if true redirect to dashboard
                    if($verify){
                        // Free sql memory result set 
                        mysqli_free_result( $execute);
                        mysqli_next_result($con);

                        // get user id 
                        $get_user_query = "call get_user_id('$email')";
                        $run = mysqli_query($con, $get_user_query);
                        $user_id = mysqli_fetch_assoc($run);
                        $user_id = $user_id['user_id'];

                        $_SESSION['email'] = $email;  
                        $_SESSION['user_id'] = $user_id;  
                        
                        
                        echo "
                            <script>
                                let message = document.querySelector('.message');
                                message.textContent = 'Login Successfull! Redirecting To Dashboard...';

                                setInterval(function redirectToDashboard(){
                                    window.location.href = 'http://localhost:80/medlink/dashboard';
                                }, 2000);
                            </script>
                        "; 
                    }
                    // else incorrect password
                    else{
                        echo "
                        <script>
                            let message = document.querySelector('.message');
                            message.classList.remove('text-primary');
                            message.classList.add('text-danger');
                            message.textContent = 'Incorrect email address or password';

                        </script>"; 
                    }
            }

            else{
                // incorrect username or password
                echo "
                    <script>
                        let message = document.querySelector('.message');
                        message.classList.remove('text-primary');
                        message.classList.add('text-danger');
                        message.textContent = 'Incorrect email address or password';

                    </script>
                ";
            }
        }
    ?>
</body>
</html>