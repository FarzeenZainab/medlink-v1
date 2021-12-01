<?php
    
    if(!isset($_SESSION['user_id'])){
        header('Location:../login.php');
    }

    $user_id = $_SESSION['user_id'];

    $get_stats = function($query, $assoc_name){
        include("../db_Conn.php");

        $execute = mysqli_query($con, $query);
        $fetch_result = mysqli_fetch_assoc($execute);
        $result = $fetch_result["$assoc_name"];
        
        mysqli_free_result($execute);
        mysqli_next_result($con);

        $con->close();

        return $result;
    };

    // weekly total doses
    $query_total_weekly = "call doses_this_week($user_id)";
    $total_doses_weekly = $get_stats($query_total_weekly, 'doses');

    // weekly taken
    $query_taken_weekly = "call taken_this_week($user_id)";
    $taken_weekly = $get_stats($query_taken_weekly, 'doses taken');

    // weekly skipped 
    $query_skipped_weekly = "call skipped_this_week($user_id)";
    $skipped_weekly = $get_stats($query_skipped_weekly, 'doses skipped');
?>