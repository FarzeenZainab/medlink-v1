<?php
    session_start();
    require('../../db_Conn.php');   

    if(!isset($_SESSION['user_id'])){
        header('Location:../login.php');
    }

    $user_id = $_SESSION['user_id'];
    date_default_timezone_set('Asia/Karachi');

    mysqli_report(MYSQLI_REPORT_ERROR || MYSQLI_REPORT_STRICT);

    if(isset($_POST['delete-medicine'])){
        $dose_id = $_POST['doseId'];
        $user_id = $_SESSION['user_id'];

        $delete_med_query = "call delete_medicine($dose_id, $user_id)";
        $delete_med = mysqli_query($con, $delete_med_query);

        if($delete_med){
            header('Location:../');
        }else{
            echo "
                <script>
                    alert('Error! Please try again later');
                </script>
            ";
        }
    }
?>