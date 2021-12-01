<?php
    session_start();
    require_once('../../db_Conn.php');   

    if(!isset($_SESSION['user_id'])){
        header('Location:../login.php');
    }

    date_default_timezone_set('Asia/Karachi');
    mysqli_report(MYSQLI_REPORT_ERROR || MYSQLI_REPORT_STRICT);

    $user_id = $_SESSION['user_id'];

    if(isset($_POST['save_med_changes'])){
        $newTime = $_POST['dose_time_new'];
        $newDate = $_POST['dose_date_new'];
        $newQuant = $_POST['dose-quantity_new'];
        $doseid = $_POST['dose_id_edit_form'];

        $update_med_query = "call edit_med('$doseid', '$user_id', '$newTime', '$newDate', '$newQuant')";

        $update_med = mysqli_query($con, $update_med_query);

        if($update_med){
            echo "
                <script>
                    alert('Changes saved');
                </script>
            ";
            header('Location: ../');
        }
        else{
            echo "
            <script>
                alert('Changes failed, please try later!');
            </script>
            "; 
        }

    }
    else{
        echo "
            <script>
                alert('Changes failed, please try later!');
            </script>
        "; 
    }
?>