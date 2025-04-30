<?php
include('db.php');
include('header.php');

$sql = "SELECT a.appointment_id, u.name AS parent_name, c.child_name, h.hospital_name, v.vaccine_name, a.date, a.time, a.status
        FROM appointment a
        JOIN users u ON a.user_id = u.user_id
        JOIN child_details c ON a.child_id = c.child_id
        JOIN hospitals h ON a.hospital_id = h.hospital_id
        JOIN vaccines v ON a.vaccine_id = v.vaccine_id
        ORDER BY a.date DESC";

$result = mysqli_query($conn, $sql);
?>

<div class="container-fluid pt-4 px-4">
<div class="row g-12">
<div class="col-sm-12 col-xl-12">
<div class="bg-secondary rounded h-100 p-4">
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

<?php include('footer.php'); ?>
