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
        <title>Medical History</title>
        <link href="d_custom/css/history.css" rel="stylesheet" type="text/css">    
        <?php require('structure/d_header-links.php') ?>
    </head>
    <body class="stretched side-header open-header push-wrapper side-header-open">
        <div id="wrapper" class="clearfix">
            <?php require('structure/d_header.php') ?>
            <div class="row">
                <div class="col-12 ml-3 mr-3 mt-5 p-3">
                    <h3 class="h2 color font-weight-normal font-display border-bottom pb-4 mb-4 ">Medical History</h3>
                </div>
            </div>
    
            <!-- Content -->
            <div class="row px-3 history-updates">
                <div class="col-6">
                    <?php 
                        $med_history_query = "call get_history('$user_id');";
                        $user_history = mysqli_query($con, $med_history_query);

                        while($history = mysqli_fetch_assoc($user_history))
                            {
                    ?>
                        <div class="border-bottom p-0">
                            <p class="m-0 py-3">
                                <span class="color font-weight-bold">
                                    <?php echo $history['action']; ?>:
                                </span>
                                <?php echo $history['medicine']; ?>
                                <small><b><?php echo $history['strength']; ?></b></small>
                                <br>
                                Dose: <?php echo $history['dose_quantity']; ?>
                                <br>
                                Dose's time: <?php echo $history['time_to_take_at']; ?>, 
                                Dose's date: <?php echo $history['date']; ?>
                                <br>
                                Status: <?php echo $history['status']; ?>
                                <br>
                                <small><b>Change Occurred At: <?php echo $history['change occurred at']; ?></b></small>
                                
                            </p>
                        </div>
                    <?php } 
                    
                        mysqli_free_result($user_history);
                        mysqli_next_result($con);
                    
                    ?>
                </div>
            </div>    
        </div>
        <?php require('structure/d_footer-links.php'); ?>
    </body>
</html>

