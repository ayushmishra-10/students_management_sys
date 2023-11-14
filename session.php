<?php
include('init.php');
ob_start();
session_start();
$db = mysqli_select_db($conn, 'srms');

// Check if the session variable 'login' is set and not null
if (isset($_SESSION['login'])) {
    $user_check = $_SESSION['login'];

    $ses_sql = mysqli_query($conn, "select user_id from user where user_id = '$user_check'");
    $row = mysqli_fetch_array($ses_sql);

  
    if (isset($row['user_id'])) {
        $login_session = $row['user_id'];
    
   }
}   
else {
    
    header("Location: login.php");
}
ob_end_flush()
?>