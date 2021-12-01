<?php 
    $user_id = $_SESSION['user_id'];
    $today_meds_query = "call medlink.medicine_schedule_today('$user_id');";
    $get_meds_today = mysqli_query($con, $today_meds_query);

    while($meds_today = mysqli_fetch_assoc($get_meds_today)){
        echo $meds_today["Name"];
        echo $meds_today["Medicine"];
        echo $meds_today["amount"];
        echo $meds_today["strength"];
        echo $meds_today["time_to_take_at"];
        echo "<br>";
    }
?>

