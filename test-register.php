<?php
    session_start(); 
    require('db_Conn.php');
?>
                <form action="test-register.php" method="POST" class="col-sm-12 col-lg-8 pb-0 pt-5 px-4" id="register-form" data-parsley-priority-enabled = "false">
                    <h3 class="h2 h-register color font-weight-normal font-display border-bottom pb-4 mb-4">Registration Form</h3>
                    <div class="m-0 p-0 successfull display-none">
                        <p class="text-primary text-center">Registration Successfull! Redirecting you to Dashboard</p>
                    </div>
                    <div class="failed">
                        <p class="text-danger  display-none"></p>
                    </div>
                    <div class="form-active">
                        <div class="form-input-div">
                            <div class="col-6 form-group">
                                <label for="firstname">First Name <small>*</small></label>
                                <input type="text" id="firstname" name="first_name" class="form-control" placeholder="ex: Christopher" required pattern="^[\w$]+" minlength="3" maxlength="50" data-parsley-error-message="Please enter a valid name, whitespaces are not allowed"/>
                                
                            </div>

                            <div class="col-6 form-group">
                                <label for="lastname">Last Name <small>*</small></label>
                                <input type="text" id="lastname" name="last_name" class="form-control" placeholder="ex: Robin" required pattern="^[\w$]+" minlength="3" maxlength="50" data-parsley-error-message="Please enter a valid name, whitespaces are not allowed"/>
                            </div>
                        </div>
                        
                        <div class="form-input-div mt-3">
                            <div class="col-6 form-group">
                                <label for="email">Email <small>*</small></label>
                                <input type="email" id="email" name="email" class="form-control"  placeholder="ex: example@gmail.com" required data-parsley-error-message="Please enter a valid email address. We only accept gmail, hotmail, yahoo, bing and outlook accounts" pattern="^[a-zA-Z0-9]+[0-9]*\S*@(gmail|hotmail|yahoo|bing|outlook)\.com$" maxlength="100"/>
                            </div>

                            <div class="col-6 form-group">
                                <label for="phone">Contact Number <small>*</small></label>
                                <input type="text" id="phone" name="number" class="form-control" placeholder="ex: +921234567891" data-parsley-pattern="^\+92\d{10}$" data-parsley-error-message="Invalid contact number, please enter phone number in this format +92XXXXXXXXXX" required/>
                            </div>
                        </div>

                        <div class="form-input-div mt-3">
                            <div class="col-6 form-group">
                                <label for="password">Password <small>*</small></label>
                                <input type="password" id="password" name="password" class="form-control" required pattern="^[(a-zA-Z0-9\S+)]([a-zA-Z0-9\S]+){10,}$"  minlength="10" maxlength="50" data-parsley-error-message="Password must contain atleast 10 characters, uppercase and lowercase characters, numbers from 0-9 and special characters" />
                            </div>

                            <div class="col-6 form-group">
                                <label for="cpass">Confirm Password<small>*</small></label>
                                <input type="password" id="cpass" name="c_password" class="form-control" required data-parsley-equalto="#password" pattern="^[(a-zA-Z0-9\S+)]([a-zA-Z0-9\S]+){10,}$"  minlength="10" maxlength="50" data-parsley-error-message="Password should match">
                            </div>

                        </div>

                        <div class="form-input-div mt-3">
                            <div class="col-6 form-group">
                                <label for="age">Age<small>*</small></label>
                                <input type="number" id="age" min="1" max="100" name="age" class="form-control" data-parsley-error-message="Please enter correct age" required/>
                            </div>

                            <div class="col-6 form-group">
                                <label for="dob">Date Of Birth<small>*</small></label>
                                <input type="date" id="dob" name="dob" min="1940-12-31" max="2018-12-31" class="form-control" data-parsley-error-message="Please select correct Date of Birth" required/>
                            </div>
                        </div>

                        <div class="form-input-div mt-3 d-flex justify-content-left">
                            <div class="form-input-div">
                                <div class="col-6 form-group">
                                    <label>Gender<small>*</small></label>
                                    <div class="d-flex">
                                        <div class="form-check">
                                            <label for="male-option" class="form-check-label">
                                                <input type="radio" id="male-option" class="form-check-input" value="male" name="gender" required />Male
                                            </label>
                                        </div>

                                        <div class="form-check ml-5">
                                            <label class="form-check-label" for="female-option">
                                                <input type="radio" value="female" id="female-option" class="form-check-input" name="gender" required />Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="register">
                            <div class="d-flex justify-content-center pb-4">
                                <input type="submit" name="register_user" value="Register" class="button rounded ls0 font-weight-medium my-0 m-0 d-sm-flex" />
                            </div>
                        </div>
                    </div>
                </form>


        <?php
        
            if(isset($_POST['register_user'])){
                require('db_Conn.php');
    
                $firstName = $_POST['first_name'];
                $lastName = $_POST['last_name'];
                $email = $_POST['email'];
                $age = $_POST['age'];
                $contact = $_POST['number'];
                $dateOfBirth = $_POST['dob'];
                $gender = $_POST['gender'];

                $password = $_POST['password'];
                $cpass = $_POST['c_password'];
                
                $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            
                //Enable mysql error reporting
                mysqli_report(MYSQLI_REPORT_ERROR || MYSQLI_REPORT_STRICT);
    
                //Check if email is already taken
                $check_email_query = "call check_user_email('$email')";
                $check_email = mysqli_query($con, $check_email_query);
                $result = mysqli_num_rows($check_email);
    
                //If email not present in database then push data to database
                if(!$result >= 1){
    
                    //clearing result set and executing next query
                    mysqli_free_result($check_email);
                    mysqli_next_result($con);
    
                    //Insert User
                    $insert_proc = "call register_new_user('$firstName', '$lastName', $age, '$dateOfBirth', '$email', '$password_hash', '$contact', '$gender')";
                    $insert = mysqli_query($con, $insert_proc);

                    if($insert){

                        // get user id 
                        $get_user_query = "call get_user_id('$email')";
                        $run = mysqli_query($con, $get_user_query);

                        $user_id = mysqli_fetch_assoc($run);
                        $user_id = $user_id['user_id'];
                        // Initiate Session and set email and user_id on session
                        $_SESSION['email'] = $email; 
                        $_SESSION['user_id'] = $user_id; 
                        
                        // Show success message
                        echo "
                            <script>
                                const success = document.querySelector('.successfull');
                                success.classList.remove('display-none');
                               
                                //redirect to dashboard

                                setInterval(
                                function redirectToDashboard(){
                                    window.location.href= 'http://medlink/dashboard/index.php';
                                }, 3000);

                            </script>
                        ";

                        echo $con->error;
                    }
                    else{
                        echo "
                            <script>
                                const fail = document.querySelector('.failed p');
                                fail.classList.remove('display-none');
                                
                                fail.textContent = 'Something went wrong, please try again later.';
                            </script>
                        ";
                    }
    
                }
    
                //Else report error -> email already been taken
                else{
                    echo "
                        <script>
                            const fail = document.querySelector('.failed p');
                            fail.classList.remove('display-none');

                            fail.textContent = `This email address has already been taken.`;
                        </script>
                    ";
                }
            }
        ?>
