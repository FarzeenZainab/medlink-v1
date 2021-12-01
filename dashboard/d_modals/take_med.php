<?php
    session_start();

    require_once('../../db_Conn.php');

    if(!isset($_SESSION['user_id'])){
        header("Location:index.php");
    }

    $dose = $_GET['d'];
    $user_id = $_SESSION['user_id'];

    $mark_taken_query = "call take_medicine($dose, $user_id);";
    $mark_take_query = mysqli_query($con, $mark_taken_query);

    if($mark_take_query){
        echo '1';
    } else{
        echo "0";
    }
?>
