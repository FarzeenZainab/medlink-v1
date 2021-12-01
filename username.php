<?php
    function username(){
        require ('db_Conn.php');
        $user_id = $_SESSION['user_id'];
    
        // get username
        $get_name_query = "call get_full_name('$user_id')";
        $get_name = mysqli_query($con, $get_name_query);
     
        if($get_name){
            $username = mysqli_fetch_assoc($get_name);
            $username = $username["Full Name"];
        }
        else{
            echo 'error fetching name';
        }
    
        return $username;
       }
?>

