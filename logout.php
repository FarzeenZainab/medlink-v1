<?php
    session_start();

    if(isset($_SESSION['user_id'])){
        session_destroy();
        session_unset();

        // Unset value that we set on session
        unset($_SESSION['email']);
        unset($_SESSION['user_id']);
    }

    // redirect to homepage
    header('Location:index.php');

?>