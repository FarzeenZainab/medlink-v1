<?php
    session_start();

    require_once('../../db_Conn.php');

    if(!isset($_SESSION['user_id'])){
        header("Location:index.php");
    }

    if(isset($_POST['skip-medicine'])){
        $dose = $_POST['doseId'];
        $user_id = $_SESSION['user_id'];
    
        $mark_taken_query = "call skip_medicine($dose, $user_id);";
        $mark_take_query = mysqli_query($con, $mark_taken_query);
        
        if($mark_take_query){
            header('Location: ../index.php');
        }
        else{
            echo "
                <script>alert('something went wrong');</script>
            ";
        }
    }  
?>