<?php

include("db.php");

if (isset($_GET['hospital_id'])) {
    $hospital_id = $_GET['hospital_id'];

    // Update SQL query to work with 'hospitals' instead of 'childrens'
    $sql = "DELETE FROM hospitals WHERE hospital_id = $hospital_id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Hospital deleted successfully✔');
                window.location.href='view_hospital.php';
              </script>";
    } else {
        echo "Hospital not found.";
    }
}
?>
