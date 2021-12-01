<style>
    .display-none{display: none;}
</style>

<!-- Add Medicines -->
<link href="dashboard/d_custom/css/add_med.css" rel="stylesheet" type="text/css"/>
<form action="test-2.php" method="POST" id="add-new-med-form">
<div class="modal fade" id="add-med" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="modal">
            <div class="modal-content px-3 pt-3 mb-0">
                <button type="button" class="close text-right" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>

                <div classs="modal-header">
                    <h3 class="modal-title font-display text-center">Add New Medicine</h3>
                </div>
                <div class="modal-body p-0 mt-4">
                    <div class="errors">
                        <span class="text-danger display-none invalid-date">Please select a valid date</span>
                        <span class="text-danger display-none error-add-new-med">Something went wrong, please try later!</span>
                    </div>
                   
                    <div id="step-1" class="form-active">
                        <div class="form-group">
                            <label class="form-label" for="med-name-input">Medicine Name</label>
                            <input type="text" class="form-control" name="med-name" id="med-name-input">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="med-type-list">Medicine Type</label>
                            <div class="input-group" id="med-type-list">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="med-type-dropdown">Options</label>
                                </div>
                                <select name="med-type" id="med-type-dropdown" class="custom-select">
                                    <option value="1">pill</option>
                                    <option value="2">capsule</option>
                                    <option value="3">liquid</option>
                                    <option value="4">drops</option>
                                    <option value="5">inhaler</option>
                                    <option value="6">injection</option>
                                    <option value="7">tablet</option>
                                </select>
                            </div>
                        </div>
                                
                        <div class="form-group">
                            <label class="form-label" for="strength">Strength</label>
                            <h6 class=" m-0 p-0">Ex: 10mg<h6>
                            <div class="d-flex">
                                <input type="number" name="quantity" id="strength" min="1" max="99999" class="form-control">
                                <select name="unit" id="" class="custom-select">
                                    <option>Choose Unit</option>
                                    <option value="mg" selected>mg</option>
                                    <option value="ml">ml</option>
                                    <option value="g">g</option>
                                    <option value="mcg or μg">mcg or μg</option>
                                </select>
                            </div>
                        </div>
                                
                                
                        <div class="daily-frequency">
                            <h5>How Often Do you Take This Medicine Daily</h5>
                            <div class="form-check">
                                <input type="radio" id="once-daily" class="form-check-input" value="1" name="med-frequency-daily">
                                <label class="form-check-label" for="once-daily">Once daily</label>
                            </div>
                                
                            <div class="form-check">
                                <input type="radio" id="twice-daily" class="form-check-input" value="2" name="med-frequency-daily">
                                <label  class="form-check-label" for="twice-daily">Twice daily</label>
                            </div>
                                
                            <div class="form-check">
                                <input type="radio" id="thrice-daily" class="form-check-input" value="3" name="med-frequency-daily">
                                <label  class="form-check-label" for="thrice-daily">Thrice daily</label>
                            </div>
                        </div>

                        <div class="form-group mt-4 text-center">
                            <a href="#" class="btn-next-daily text-right button rounded font-weight-medium">Continue</a>
                            <button class="button rounded bg-color-2 button-light ls0 font-weight-medium" type="button" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>

                    <div class="time-freq-div form-hidden form-group">
                        <div class="time-daily-frequency"></div>
                        <div class="no-of-days-to-reminder">
                            <div class="form-group">
                                <label for="reminder-dates">Set A Remind till</label>
                                <input type="date" name="reminder-dates" id="reminder-dates" class="form-control" min="<?php echo date('Y-m-d') ?>" max="<?php echo date('Y-m-d', strtotime('+20 days'))  ?>">
                            </div>
                        </div>

                        <div class="dose-quantity">
                            <div class="form-group">
                                <label for="dose-quantity">Dose quantity you take at each frequency</label>
                                <br>
                                <small>Ex: 1 Dose</small>
                                <input type="number" min="1" max="10000" name="dose-quantity" id="dose-quantity" class="form-control">
                            </div>
                        </div>
                    </div>        
                </div>

                <div class="form-hidden add-med-footer">
                    <div class="modal-footer px-0">
                        <div class="buttons-footer d-flex justify-content-between my-3 mx-0 w-100">
                        <div class="btn-div-time text-center">
                            <a href="#" class="btn btn-back-time button rounded bg-color-2 button-light ls0 font-weight-medium m-0">Back</a>
                            <button class="button rounded bg-color-2 button-light ls0 font-weight-medium m-0" type="button" data-dismiss="modal">Cancel</button>
                        </div>

                        <input type="submit" class="button rounded ls0 font-weight-medium m-0 d-sm-flex" name="add-new-med" value="Add Medicine">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

    <script src="dashboard/d_js/add_med.js"></script>

    <?php
        require_once('db_Conn.php');    

        mysqli_report(MYSQLI_REPORT_ERROR || MYSQLI_REPORT_STRICT);

        if(isset($_POST['add-new-med'])){
            $medicine_name = $_POST['med-name'];
            $med_type = $_POST['med-type'];
            $strength = $_POST['quantity'] . ' ' . $_POST['unit'];
            $freq = $_POST['med-frequency-daily'];
            $setReminder = $_POST['reminder-dates'];
            $dose_quantity = $_POST['dose-quantity'];
            $time1 = $_POST['freq--1'];
            $today = date('Y-m-d');

            // add Medicine
            $medId = addMedicine($con, $medicine_name, $strength, $med_type);
            if($medId != NULL || $medId <= 0){
                // get the number of days to set a reminder for
                $days = get_diff($today, $setReminder);
                if($days <= -1){
                    echo "<script>
                        const dateError = document.querySelector('.invalid-date');
                        dateError.classList.remove('display-none');
                    </script>";
                }
                // If days difference is valid -> +ve number
                else{
                    $query;
                    for($i = 0; $i <= $days; $i++){
                        $reminderDate = date('Y-m-d', strtotime("$i days"));

                        if($freq == 1){
                            $add_dose_query = "call medlink.add_med_doses($dose_quantity, $medId, $user_id, '$reminderDate', '$time1', 1);";
                            $query = mysqli_query($con, $add_dose_query);
                        }
                        else{
                            $time2 = $_POST['freq--2'];
                            if($freq == 2){
                                $times = [$time1, $time2];
                                
                                for($j = 0; $j < sizeof($times) ; $j++){
                                    $frequencyValue = $j+1;
                                    $add_dose_query = "call medlink.add_med_doses($dose_quantity, $medId, $user_id, '$reminderDate', '$times[$j]', $frequencyValue);";
                                    $query = mysqli_query($con, $add_dose_query);
                                }

                            }
                            else if ($freq == 3){
                                $time3 = $_POST['freq--3'];
                                $times = [$time1, $time2, $time3];
                                for($j = 0; $j < sizeof($times) ; $j++){
                                    $frequencyValue = $j+1;
                                    $add_dose_query = "call medlink.add_med_doses($dose_quantity, $medId, $user_id, '$reminderDate', '$times[$j]', $frequencyValue);";
                                    $query = mysqli_query($con, $add_dose_query);
                                }
                            }
                            else{
                                echo "<script>
                                     const Error = document.querySelector('.error-add-new-med');
                                    Error.classList.remove('display-none');
                                </script>";
                                break;
                            }
                        }
                    }

                    // Show Success message on successfull addition of doses
                    if($query){
                        echo "<script>
                            alert('Doses Added Successfully!');
                            window.location.href = 'http://localhost:80/medlink/dashboard';
                        </script>";
                    }
                    else{
                        echo "<script>
                            alert('Something went wrong, doses not added!');
                            window.location.href = 'http://localhost:80/medlink/dashboard';
                        </script>"; 
                    }
                    
                }
            }
            else{
                echo "
                    <script>
                        const medError = document.querySelector('.error-add-new-med');
                        medError.classList.remove('display-none');
                    </script>
                "; 
            }    
        }

        function get_diff($date1, $date2){
            //convert string date to object date using date_create() function in order to work with date_diff() function
            // specify the format for days otherwise exception is thrown
            $date1 = date_create(date('Y-m-d'));
            $date2 = date_create($date2);
            $days = date_diff($date1, $date2);
            $days = $days->format('%R%a');
            return $days;
        }

        function addMedicine($con, $p_med_name, $p_strength, $p_type){
            $add_med_query = "call medlink.add_med('$p_med_name', '$p_strength', $p_type);";
            $add_med = mysqli_query($con, $add_med_query);
            $medicine = mysqli_fetch_assoc($add_med);
            $med_id = $medicine['medicine_id'];
            mysqli_free_result($add_med);
            mysqli_next_result($con);
            return $med_id;
        }
    ?>

<!-- <style>
    .display-none{
        display: none;
    }
</style>

<?php
// session_start(); 
// require('db_Conn.php');

//     if(isset($_SESSION['user_id'])){
//        header("Location:index.php");
//     }

?>

<form action="test.php" method="post" class="col-sm-12 col-lg-8 pb-0 pt-5 px-4" id="form">
                    <h3 class="h2 h-register color font-weight-normal font-display border-bottom pb-4 mb-4">Registration Form</h3>
                    <div class="m-0 p-0 successfull display-none">
                        <p class="text-primary text-center ">Registration Successfull! Redirecting you to Dashboard</p>
                    </div>
                    <div class="failed">
                        <p class="text-danger display-none"></p>
                    </div>
                    <div class="form-active">
                        <div class="form-input-div">
                            <div class="col-6 form-group">
                                <label for="firstname">First Name <small>*</small></label>
                                <input type="text" id="firstname" name="first_name" class="form-control" placeholder="ex: Christopher " required/>
                                
                            </div>

                            <div class="col-6 form-group">
                                <label for="lastname">Last Name <small>*</small></label>
                                <input type="text" id="lastname" name="last_name" class="form-control" placeholder="ex: Robin" required/>
                            </div>
                        </div>
                        
                        <div class="form-input-div mt-3">
                            <div class="col-6 form-group">
                                <label for="email">Email <small>*</small></label>
                                <input type="email" id="email" name="email" class="form-control"  placeholder="ex: example@gmail.com" required/>
                            </div>

                            <div class="col-6 form-group">
                                <label for="phone">Contact Number <small>*</small></label>
                                <input type="number" id="phone" name="number" class="form-control" placeholder="ex: +921234567891" required/>
                            </div>
                        </div>

                        <div class="form-input-div mt-3">
                            <div class="col-6 form-group">
                                <label for="password">Password <small>*</small></label>
                                <input type="password" id="password" name="password" class="form-control"required />
                            </div>

                            <div class="col-6 form-group">
                                <label for="cpass">Confirm Password<small>*</small></label>
                                <input type="password" id="cpass" name="c_password" class="form-control" required/>
                            </div>

                        </div>

                        <div class="form-input-div mt-3">
                            <div class="col-6 form-group">
                                <label for="age">Age<small>*</small></label>
                                <input type="number" id="age" min="1" max="100" name="age" class="form-control" required/>
                            </div>

                            <div class="col-6 form-group">
                                <label for="dob">Date Of Birth<small>*</small></label>
                                <input type="date" id="dob" name="dob" min="1940-12-31" max="2018-12-31" class="form-control" required/>
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
        // try{
        //     if(isset($_POST['register_user'])){
        //         require('db_Conn.php');
    
        //         $firstName = $_POST['first_name'];
        //         $lastName = $_POST['last_name'];
        //         $email = $_POST['email'];
        //         $age = $_POST['age'];
        //         $contact = $_POST['number'];
        //         $dateOfBirth = $_POST['dob'];
        //         $gender = $_POST['gender'];

        //         $password = $_POST['password'];
        //         $cpass = $_POST['c_password'];
                
        //         $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            
        //         //Enable mysql error reporting
        //         mysqli_report(MYSQLI_REPORT_ERROR || MYSQLI_REPORT_STRICT);
    
        //         //Check if email is already taken
        //         $check_email_query = "call check_user_email('$email')";
        //         $check_email = mysqli_query($con, $check_email_query);
        //         $result = mysqli_num_rows($check_email);
    
        //         //If email not present in database then push data to database
        //         if(!$result >= 1){
    
        //             //clearing result set and executing next query
        //             mysqli_free_result($check_email);
        //             mysqli_next_result($con);
    
        //             //Insert User
        //             $insert_proc = "call register_new_user('$firstName', '$lastName', $age, '$dateOfBirth', '$email', '$password_hash', '$contact', '$gender')";
        //             $insert = mysqli_query($con, $insert_proc);

        //             if($insert){

        //                 // get user id 
        //                 $get_user_query = "call get_user_id('$email')";
        //                 $run = mysqli_query($con, $get_user_query);

        //                 $user_id = mysqli_fetch_assoc($run);
        //                 $user_id = $user_id['user_id'];
        //                 // Initiate Session and set email and user_id on session
        //                 $_SESSION['email'] = $email; 
        //                 $_SESSION['user_id'] = $user_id; 
                        
        //                 // Show success message
        //                 echo "
        //                     <script>
        //                         const success = document.querySelector('.successfull');
        //                         success.classList.remove('display-none');
                               
        //                         //redirect to dashboard

        //                         setInterval(
        //                         function redirectToDashboard(){
        //                             window.location.href= 'http://localhost:80/medlink/dashboard';
        //                         }, 3000);

        //                     </script>
        //                 ";
        //             }
        //             else{
        //                 echo "
        //                     <script>
        //                         const fail = document.querySelector('.failed p');
        //                         fail.classList.remove('display-none');
                                
        //                         fail.textContent = 'Something went wrong, please try again later.';
        //                     </script>
        //                 ";
        //             }
    
        //         }
    
        //         //Else report error -> email already been taken
        //         else{
        //             echo "
        //                 <script>
        //                     const fail = document.querySelector('.failed p');
        //                     fail.classList.remove('display-none');

        //                     fail.textContent = `This email address has already been taken.`;
        //                 </script>
        //             ";
        //         }
        //     }
        // }
        // catch(Exception $e){
        //     echo 'Error Message: ' .$e -> getMessage();
        // }
        
    ?> -->



<!-- Username
<?php
//    session_start();
//    function username(){
//     require ('db_Conn.php');
//     $user_id = $_SESSION['user_id'];

//     // get username
//     $get_name_query = "call get_full_name('$user_id')";
//     $get_name = mysqli_query($con, $get_name_query);
 
//     if($get_name){
//         $username = mysqli_fetch_assoc($get_name);
//         $username = $username["Full Name"];
//     }
//     else{
//         echo 'error fetching name';
//     }

//     return $username;
//    }
//   echo username();
?> -->

<!-- Password hashing test -->

<!-- <h1>Password Hashing</h1>

<?php
    // $user_password = "my_name";
    // $md5 = md5($user_password);
    
    // $hash= password_hash($user_password, PASSWORD_DEFAULT);

    // echo "previous: 2b30c506010831078dfd8c5cfe1a87d4";
    // echo "<br/>";
    // echo "md generates:   $md5";

    // echo "<br/>";

    // echo "previous: $2y$10$7UtSJOem7GTKjl4A3bUqzuoq7SCXcZTxPul8.U7U1dWEMlabZ3ztC";
    // echo "<br/>";
    // echo "password_hash generates:  $hash";

   
?> -->


<!-- Login Form -->
<!-- <form action="test.php" method="POST" class="form-active">
    <div class="form-input-div mt-3">
        <div class="col-12 form-group">
            <label for="user-email">Email Address<small>*</small></label>
            <input type="email" id="user-email" name="user-email" class="form-control"  required/>
        </div>
    </div>

    <div class="form-input-div mt-3">
        <div class="col-12 form-group">
            <label for="user-password">Password <small>*</small></label>
            <input type="password" id="user-password" name="user-pass" class="form-control"  required/>
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

<?php 
        // require('db_Conn.php');


        // if(isset($_POST['login'])){
        //     // Set variables
        //     $email = $_POST['user-email'];
        //     $pass = $_POST['user-pass'];
            
        //     //check email
        //     $check_email_query = "call check_user_email('$email')";
        //     $execute = mysqli_query($con, $check_email_query);

        //     $rows = mysqli_num_rows($execute);

        //     if($rows === 1){
        //         //Free memory result set and proceed to next query
        //         mysqli_free_result($execute);
        //         mysqli_next_result($con); 

        //         //Get password
        //         $password_query = "call get_user_password('$email')";
        //         $execute = mysqli_query($con, $password_query);

        //         $password = mysqli_fetch_assoc($execute);

        //         // varify if the password is same
        //         // this function only accepts strings as parameters so we need to convert array to string using implode() function

        //         $verify = password_verify($pass, implode($password)); 
        //             // if true redirect to dashboard
        //             if($verify){
        //                 echo "<script>alert('login Successfull! Redirecting to dashboard...')</script>"; 
        //             }
        //             // else incorrect password
        //             else{
        //                 echo "<script>alert('Incorrect username or password')</script>"; 
        //             }
        //     }

        //     else{
        //         // incorrect username or password
        //         echo "<script>alert('Incorrect username or password')</script>";
        //     }
        // }
    ?> -->


            <!-- Register -->
    <!-- <form action="test.php" method="post" onsubmit="return validateForm();" class="col-sm-12 col-lg-8 pb-0 pt-5 px-4" id="form">
                    <h3 class="h2 h-register color font-weight-normal font-display border-bottom pb-4 mb-4">Registration Form</h3>
                    <div class="m-0 p-0 successfull display-none">
                        <p class="text-primary text-center">Registration Successfull! Redirecting you to Dashboard</p>
                    </div>
                    
                    <div class="form-active">
                        <div class="form-input-div">
                            <div class="col-6 form-group">
                                <label for="firstname">First Name <small>*</small></label>
                                <input type="text" id="firstname" name="first_name" class="form-control" placeholder="ex: Christopher " required/>
                                
                            </div>

                            <div class="col-6 form-group">
                                <label for="lastname">Last Name <small>*</small></label>
                                <input type="text" id="lastname" name="last_name" class="form-control" placeholder="ex: Robin" required/>
                            </div>
                        </div>
                        
                        <div class="form-input-div mt-3">
                            <div class="col-6 form-group">
                                <label for="email">Email <small>*</small></label>
                                <input type="email" id="email" name="email" class="form-control"  placeholder="ex: example@gmail.com" required/>
                            </div>

                            <div class="col-6 form-group">
                                <label for="phone">Contact Number <small>*</small></label>
                                <input type="number" id="phone" name="number" class="form-control" placeholder="ex: +921234567891" required/>
                            </div>
                        </div>

                        <div class="form-input-div mt-3">
                            <div class="col-6 form-group">
                                <label for="password">Password <small>*</small></label>
                                <input type="password" id="password" name="password" class="form-control"required />
                            </div>

                            <div class="col-6 form-group">
                                <label for="cpass">Confirm Password<small>*</small></label>
                                <input type="password" id="cpass" name="c_password" class="form-control" required/>
                            </div>

                        </div>

                        <div class="form-input-div mt-3">
                            <div class="col-6 form-group">
                                <label for="age">Age<small>*</small></label>
                                <input type="number" id="age" min="1" max="100" name="age" class="form-control" required/>
                            </div>

                            <div class="col-6 form-group">
                                <label for="dob">Date Of Birth<small>*</small></label>
                                <input type="date" id="dob" name="dob" min="1940-12-31" max="2018-12-31" class="form-control" required/>
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
        // try{
        //     if(isset($_POST['register_user'])){
        //         require('db_Conn.php');
    
        //         $firstName = $_POST['first_name'];
        //         $lastName = $_POST['last_name'];
        //         $email = $_POST['email'];
        //         $age = $_POST['age'];
        //         $contact = $_POST['number'];
        //         $dateOfBirth = $_POST['dob'];
        //         $gender = $_POST['gender'];

        //         $password = $_POST['password'];
        //         $cpass = $_POST['c_password'];
                
        //         $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            
        //         //Enable mysql error reporting
        //         mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    
        //         //Check if email is already taken
        //         $check_email_query = "call check_user_email('$email')";
        //         $check_email = mysqli_query($con, $check_email_query);
        //         $result = mysqli_num_rows($check_email);
    
        //         //If email not present in database then push data to database
        //         if(!$result >= 1){
    
        //             //clearing result set and executing next query
        //             mysqli_free_result($check_email);
        //             mysqli_next_result($con);
    
        //             //Insert User
        //             $insert_proc = "call register_new_user('$firstName', '$lastName', $age, '$dateOfBirth', '$email', '$password_hash', '$contact', '$gender')";
        //             $insert = mysqli_query($con, $insert_proc);

        //             if($insert){

        //                 // get user id 
        //                 $get_user_query = "call get_user_id('$email')";
        //                 $run = mysqli_query($con, $get_user_query);

        //                 $user_id = mysqli_fetch_assoc($run);

        //                 // Initiate Session and set email and user_id on session
        //                 $_SESSION['email'] = $email; 
        //                 $_SESSION['user_id'] = $user_id['user_id']; 
                        
        //                 //Show success message
        //                 echo "
        //                     <script>
        //                         const success = document.querySelector('.successfull');
        //                         success.classList.remove('display-none');

        //                         //redirect to dashboard

        //                         // setInterval(
        //                         // function redirectToDashboard(){
        //                         //     window.location.href= 'http://localhost:80/medlink/dashboard';
        //                         // }, 3000);

        //                     </script>
        //                 ";
        //             }
        //             else{
        //                 echo "
        //                     <script>
        //                         const fail = document.querySelector('.failed p');
        //                         fail.classList.remove('display-none');
                                
        //                         fail.textContent = 'Something went wrong, please try again later.';
        //                     </script>
        //                 ";
        //             }
    
        //         }
    
        //         //Else report error -> email already been taken
        //         else{
        //             echo "
        //                 <script>
        //                     const fail = document.querySelector('.failed p');
        //                     fail.classList.remove('display-none');

        //                     fail.textContent = `This email address has already been taken.`;
        //                 </script>
        //             ";
        //         }
        //     }
        // }
        // catch(Exception $e){
        //     echo 'Error Message: ' .$e -> getMessage();
        // } 
        
    ?>-->
<!-- 
<?php // session_start();
    // if(isset($_SESSION['user_id'])){
    //     var_dump($_SESSION);
    //     echo "
    //     <script>
    //         alert('working');
    //     </script>
    // "; 
    // }
    // else{
    //     $dump = var_dump($_SESSION);
    //     echo "
    //     <script>
    //         alert('not working');
    //         console.log($dump);
    //     </script>
    // "; 
    // }
?> -->



<!-- Login -->


<!-- <form action="test-2.php" method="POST" class="form-active">
    <div class="form-input-div mt-3">
        <div class="col-12 form-group">
            <label for="user-email">Email Address<small>*</small></label>
            <input type="email" id="user-email" name="user-email" class="form-control " required/>
        </div>
    </div>

    <div class="form-input-div mt-3">
        <div class="col-12 form-group">
            <label for="user-password">Password <small>*</small></label>
            <input type="password" id="user-password" name="user-pass" class="form-control " required/>
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
<a href="logout.php"> Logout </a>
<?php 

        // require('db_Conn.php');

        // if(isset($_POST['login'])){
        //     // Set variables
        //     $email = $_POST['user-email'];
        //     $pass = $_POST['user-pass'];
            
        //     //check email
        //     $check_email_query = "call check_user_email('$email')";
        //     $execute = mysqli_query($con, $check_email_query);

        //     $rows = mysqli_num_rows($execute);

        //     if($rows === 1){
        //         //Free memory result set and proceed to next query
        //         mysqli_free_result($execute);
        //         mysqli_next_result($con); 

        //         //Get password
        //         $password_query = "call get_user_password('$email')";
        //         $execute = mysqli_query($con, $password_query);

        //         $password = mysqli_fetch_assoc($execute);

        //         // varify if the password is same
        //         // this function only accepts strings as arguments so we need to convert array to string using implode() function

        //         $verify = password_verify($pass, implode($password));
                 
        //             // if true redirect to dashboard
        //             if($verify){
                        
        //                 // Free sql memory result set 
        //                 mysqli_free_result( $execute);
        //                 mysqli_next_result($con);

        //                 // get user id 
        //                 $get_user_query = "call get_user_id('$email')";
        //                 $run = mysqli_query($con, $get_user_query);
        //                 $user_id = mysqli_fetch_assoc($run);
        //                 $user_id = $user_id['user_id'];

        //                 $_SESSION['email'] = $email;  
        //                 $_SESSION['user_id'] = $user_id;  
                        
        //                 echo "
        //                     <script>
        //                         let message = document.querySelector('.message');
        //                         message.textContent = 'Login Successfull! Redirecting To Dashboard...';

        //                         // setInterval(function redirectToDashboard(){
        //                         //     window.location.href = 'http://localhost:80/medlink/dashboard';
        //                         // }, 2000);

        //                     </script>
        //                 "; 
        //             }
        //             // else incorrect password
        //             else{
        //                 echo "
        //                 <script>
        //                     let message = document.querySelector('.message');
        //                     message.classList.remove('text-primary');
        //                     message.classList.add('text-danger');
        //                     message.textContent = 'Incorrect email address or password';

        //                 </script>"; 
        //             }
        //     }

        //     else{
        //         // incorrect username or password
        //         echo "
        //             <script>
        //                 let message = document.querySelector('.message');
        //                 message.classList.remove('text-primary');
        //                 message.classList.add('text-danger');
        //                 message.textContent = 'Incorrect email address or password';

        //             </script>
        //         ";
        //     }
        // }
    ?>

<?php 
    // session_start();
    // require('db_Conn.php');
    // $user_id = $_SESSION['user_id'];
    // $today_meds_query = "call medlink.medicine_schedule_today('$user_id');";
    // $get_meds_today = mysqli_query($con, $today_meds_query);

    // while($meds_today = mysqli_fetch_assoc($get_meds_today)){
    //     echo $meds_today["Name"];
    //     echo $meds_today["Medicine"];
    //     echo $meds_today["amount"];
    //     echo $meds_today["strength"];
    //     echo $meds_today["time_to_take_at"];
    //     echo "<br>";
    // }
?>