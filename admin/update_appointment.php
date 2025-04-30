<?php
include('db.php');

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = intval($_GET['id']);
    $status = $_GET['status'];

    $sql = "UPDATE appointment SET status = ? WHERE appointment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Appointment updated successfully!'); window.location='hospital_appointments.php';</script>";
    } else {
        echo "<script>alert('Error updating appointment.'); window.location='hospital_appointments.php';</script>";
    }
}
?>
