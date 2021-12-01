<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location:../login.php");
}
$user_id = $_SESSION["user_id"];
require('../db_Conn.php');

if (isset($_POST["submit"])) {
    $first_name = mysqli_real_escape_string($con, $_POST["First_name"]);
	$last_name = mysqli_real_escape_string($con, $_POST["Last_name"]);
	$date_of_birth = mysqli_real_escape_string($con,$_POST["date_of_birth"]);
	$contact_number = mysqli_real_escape_string($con,$_POST["contactNumber"]);

    $user_id = $_SESSION["user_id"];
	$sql = "UPDATE users SET first_name='$first_name', last_name='$last_name',date_of_birth='$date_of_birth', contact_number='$contact_number' WHERE user_id= $user_id ";
            $result = mysqli_query($con, $sql);
            if ($result) {
				header('Location:profile.php');
				
            } else {
                echo "<script>('Profile can not Updated.');</script>";
                echo  $conn->error;
            }
}

?>