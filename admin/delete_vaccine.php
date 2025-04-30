<?php
include 'header.php';
include 'db.php';

// Check if vaccine_id is passed
if (isset($_GET['vaccine_id'])) {
    $vaccine_id = $_GET['vaccine_id'];

    // Delete vaccine from the database
    $delete_sql = "DELETE FROM vaccines WHERE vaccine_id = '$vaccine_id'";

    if (mysqli_query($conn, $delete_sql)) {
        echo "<script>alert('Vaccine deleted successfully'); window.location.href = 'view_vaccine.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "<script>alert('Invalid request'); window.location.href = 'view_vaccine.php';</script>";
}

include 'footer.php';
?>
