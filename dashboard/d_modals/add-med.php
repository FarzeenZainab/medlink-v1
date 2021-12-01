<?php
        session_start();
        require_once('../../db_Conn.php');   

        if(!isset($_SESSION['user_id'])){
            header('Location:../login.php');
        }
        $user_id = $_SESSION['user_id'];
        date_default_timezone_set('Asia/Karachi');
    
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
            $medId = addMedicine($con, $medicine_name, $strength, $med_type, $user_id);
            if($medId != NULL || $medId >= 1){
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
                            $add_dose_query = "call add_med_doses($dose_quantity, $medId, $user_id, '$reminderDate', '$time1', 1);";
                            $query = mysqli_query($con, $add_dose_query);
                        }
                        else{
                            $time2 = $_POST['freq--2'];
                            if($freq == 2){
                                $times = [$time1, $time2];
                                
                                for($j = 0; $j < sizeof($times) ; $j++){
                                    $frequencyValue = $j+1;
                                    $add_dose_query = "call add_med_doses($dose_quantity, $medId, $user_id, '$reminderDate', '$times[$j]', $frequencyValue);";
                                    $query = mysqli_query($con, $add_dose_query);
                                }

                            }
                            else if ($freq == 3){
                                $time3 = $_POST['freq--3'];
                                $times = [$time1, $time2, $time3];
                                for($j = 0; $j < sizeof($times) ; $j++){
                                    $frequencyValue = $j+1;
                                    $add_dose_query = "call add_med_doses($dose_quantity, $medId, $user_id, '$reminderDate', '$times[$j]', $frequencyValue);";
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
                            // window.location.href = 'http://localhost:80/medlink/dashboard';
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

        function addMedicine($con, $p_med_name, $p_strength, $p_type, $p_user_id){
            $add_med_query = "call add_med('$p_med_name', '$p_strength', $p_type, $p_user_id);";
            $add_med = mysqli_query($con, $add_med_query);
            $medicine = mysqli_fetch_assoc($add_med);
            $med_id = $medicine['medicine_id'];
            mysqli_free_result($add_med);
            mysqli_next_result($con);
            return $med_id;
        }
    ?>