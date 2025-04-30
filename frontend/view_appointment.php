<?php

include('../admin/db.php');
include('header.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Agar login nahi hai toh redirect karo
    exit();
}

$user_id = $_SESSION['user_id']; // Logged-in user ka ID

$sql = "SELECT a.appointment_id, u.name AS parent_name, c.child_name, h.hospital_name, v.vaccine_name, a.date, a.time, a.status
        FROM appointment a
        JOIN users u ON a.user_id = u.user_id
        JOIN child_details c ON a.child_id = c.child_id
        JOIN hospitals h ON a.hospital_id = h.hospital_id
        JOIN vaccines v ON a.vaccine_id = v.vaccine_id
        WHERE a.user_id = '$user_id'  -- **Filter: Sirf Logged-in User ki Appointments**
        ORDER BY a.date DESC";

$result = mysqli_query($conn, $sql);
?>

<style>
     /* General container styling */
.container-fluid {
    padding-top: 40px;
    padding-bottom: 40px;
}

/* Table Styling */
.table {
    width: 100%;
    margin-top: 20px;
    background-color: #fff;
    border-radius: 10px;
    border-collapse: collapse;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

.table th, .table td {
    padding: 12px 20px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.table thead {
    background-color: #343a40;
    color: #fff;
}

.table th {
    font-size: 16px;
    font-weight: 600;
}

.table tbody tr {
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.table tbody tr:hover {
    background-color: #e3f2fd;
    transform: scale(1.02);
}


.table td {
    font-size: 14px;
}

/* Section styling */
.bg-light {
    background-color: #f9f9f9 !important;
}

.h-100 {
    height: 100%;
}

.p-4 {
    padding: 25px;
}

/* Title styling */
h3 {
    font-size: 24px;
    font-weight: 700;
    color: #333;
    margin-bottom: 20px;
}

/* Responsive Table Styling */
@media (max-width: 768px) {
    .table th, .table td {
        font-size: 12px;
        padding: 8px 10px;
    }

    h3 {
        font-size: 20px;
    }
}

</style>

<div class="container-fluid pt-4 px-4">
<div class="row g-12">
<div class="col-sm-12 col-xl-12">
<div class="bg-light rounded h-100 p-4">
    <h3>Appointments</h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col" style="background: black; color: white">Parent</th>
                <th scope="col" style="background: black; color: white">Child</th>
                <th scope="col" style="background: black; color: white">Hospital</th>
                <th scope="col" style="background: black; color: white">Vaccine</th>
                <th scope="col" style="background: black; color: white">Date</th>
                <th scope="col" style="background: black; color: white">Time</th>
                <th scope="col" style="background: black; color: white">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['parent_name']; ?></td>
                    <td><?php echo $row['child_name']; ?></td>
                    <td><?php echo $row['hospital_name']; ?></td>
                    <td><?php echo $row['vaccine_name']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['time']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>
</div>
</div>

<?php
include 'footer.php';
?>
