<?php

include("db.php");

if(isset($_GET['user_id']))
{
    $user_id = $_GET['user_id'];

    $sql = "Delete from users
    where user_id = $user_id";

    if(mysqli_query($conn, $sql))
    {
        echo "<script>alert('User Deleted Successfully!'); window.location.href = 'view_user.php';</script>";
    }
    else{
        echo "User Not Found ";
    }
}
?>