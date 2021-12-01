<?php
    session_start();

    require_once('../../db_Conn.php');

    if(!isset($_SESSION['user_id'])){
        header("Location:index.php");
    }

    $user_id = $_SESSION['user_id'];
    $doseId = $_GET['q'];
?>

<?php 
    // Selecting data to populate it on edit dose modal
    $today_meds_query = "select * from med_details where user_id = $user_id and dose_id = $doseId";
    $get_meds_today = mysqli_query($con, $today_meds_query);

    while($meds_today = mysqli_fetch_assoc($get_meds_today))
    {
    ?> 

    <h2 class="modal-title text-center m-0 p-0">
        <span id="dose-name"><?php echo ucwords($meds_today['Medicine']); ?></span>
    </h2>

    <p class="m-0 p-0 text-center">
        Scheduled for
            <span id="dose-time">
                <?php echo ucwords($meds_today['time_to_take_at']); ?>
            </span>,
            <span id="dose-date">
                <?php 
                    echo $meds_today['date']; 
                ?>
            </span>
        <br>

        <span id="dose-strength">
            <?php echo $meds_today['strength']; ?>
        </span>,
        
        <span id="dose-quant">
            <?php echo $meds_today['dose_quantity']; ?>
        </span> Dose
    </p>
<?php } ?>