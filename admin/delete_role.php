<?php

include("db.php");

if(isset($_GET['role_id']))
{
    $role_id = $_GET['role_id'];

    $sql = "Delete from roles
    where role_id = $role_id";

    if(mysqli_query($conn, $sql))
    {
        echo "<script>alert('Role Deleted successfully!'); window.location.href = 'view_role.php';</script>";
    }
    else{
        echo "Role Not found ";
    }
}
?>