<?php 
    session_start();

    if(!isset($_SESSION['user_id'])){
        header('Location:../login.php');
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
    <link href="d_custom/css/index.css" rel="stylesheet" type="text/css"/>
    <link href="d_custom/css/add_med.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="../js/components/datatables.min.css"/>
    <?php require('structure/d_header-links.php') ?>
    
    <?php
        require('stats.php');
        if(isset($_SESSION['user_id'])){
            
        }
     ?>

</head>
<body class="stretched side-header open-header push-wrapper side-header-open h-100">
    <div id="wrapper" class="clearfix h-100">
        <?php require('structure/d_header.php') ?>

        <!-- Content -->
        <div class="container main-dashboard h-100">
            <h3 class="font-display pt-5 heading">Dashboard</h3>

            <!-- Stats -->
            <div class="row inner">
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="stats">
                        <h1 class="stat-heading">
                            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#add-med">
                                <img src="d_images/icons/plus-symbol-button-01.svg" class="p-1 rounded" style="color:#ffffff;" width="30px"></button>
                        </h1>
                        <p class="stats-title">Add New Medicine</p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="stats">
                        <h1 class="stat-heading">
                            <span class="taken-total-weekly"><?php echo $taken_weekly ?></span>
                            <span class="total"> / <?php echo $total_doses_weekly ?> doses</span>
                        </h1>
                
                        <p class="stats-title">Taken This Week</p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="stats">
                        <h1 class="stat-heading">
                            <span><?php echo $skipped_weekly ?></span>
                            <span class="total"> / <?php echo $total_doses_weekly ?> doses</span>
                        </h1>
                        <p class="stats-title">Skipped This Week </p>
                    </div>
                </div>
            </div>
            <!-- Medicines -->
            <div class="row inner">
                <div class="col-12">
                    <div class="today-medicine">
                        <h3 class="font-display pt-5 heading">Today</h3>
                        <br>
                        <table id="meds-table" class="table meds-table" data-order='[[1, "desc"]]'>
                            <thead>
                                <th>Medicine</th>
                                <th>Time</th>
                                <th>Take Medicine</th>
                                <th>Actions</th>
                            </thead> 
                            
                            <tbody>
                            <?php 
                                $today_meds_query = "call medicine_schedule_today('$user_id');";
                                $get_meds_today = mysqli_query($con, $today_meds_query);

                                while($meds_today = mysqli_fetch_assoc($get_meds_today))
                                {
                                ?>
                                    <tr>
                                        <td class="dose"> 
                                            <h4 class="med-name"><?php echo ucwords($meds_today['Medicine']); ?></h4>
                                            <small style="font-weight:400;" class='badge badge-light'>  
                                                <?php echo $meds_today['amount']; ?>
                                            </small>
                                            <small class='badge badge-light'>
                                                <?php echo $meds_today['strength']; ?>
                                            </small>
                                        </td>

                                        <td>
                                            <?php echo $meds_today['time_to_take_at']; ?> 
                                        </td>

                                        <td>
                                            <button type="button" class='button action-buttons rounded take-btn' data-takeMed="<?php echo $meds_today['dose_id']; ?>" data-status = "<?php echo $meds_today['status']?>">Take</button>

                                            <button class='button action-buttons rounded skip-btn' data-toggle='modal' data-target='#skip-med' data-skipMed = "<?php echo $meds_today['dose_id']; ?>" data-status-skip = "<?php echo $meds_today['status']?>">Skip</button>
                                        </td>

                                        <td>
                                            <button class='border-0 bg-transparent edit-medicine' data-target="#edit-med-dose" data-toggle="modal" data-dose-edit = "<?php echo $meds_today['dose_id']; ?>" >
                                                <img src='d_images/icons/edit.svg' width='20px' alt='click here to edit this dose' />
                                            </button>

                                            <button class='border-0 bg-transparent delete-dose' data-toggle='modal' data-target='#delete-med' data-dose="<?php echo $meds_today['dose_id']; ?>">
                                                <img src='d_images/icons/delete.svg' width='24px' alt='click here to delete this dose'/>
                                            </button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Modals -->
    <?php 
        require('d_modals/add-medicine-form.php');
        require('d_modals/skip_med-form.php');
        require('d_modals/edit-med-form.php');
        require('d_modals/delete_med-form.php');
        require('structure/d_footer-links.php');
    ?>

    <script type="text/javascript" src="../js/components/datatables.min.js"></script>
    <script src="d_js/index.js"></script>
    <script src="d_js/add_med.js"></script>
    <script src="d_js/delete-med.js"></script>
    <script src="d_js/edit-med.js"></script>
    <script src="d_js/take-med.js"></script>
    <script src="d_js/skip-med.js"></script>

    <script>
        $(document).ready(function(){
            $('#meds-table').DataTable({
                scrollY: 400
            });
        });
    </script>
</body>
</html>
