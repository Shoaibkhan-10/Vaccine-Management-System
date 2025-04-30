<?php
include 'header.php';
include 'db.php';

// Fetch vaccines and their categories
$sql = "SELECT v.vaccine_id, v.vaccine_name, v.vaccine_type, v.number_of_doses, v.availability, c.category_name, h.hospital_name
        FROM vaccines v
        JOIN categories c ON v.category_id = c.category_id
        JOIN hospitals h ON v.hospital_id = h.hospital_id"; // Assuming there's a hospital_id in vaccines table


$result = mysqli_query($conn, $sql);

?>

<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-12">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h3 class="mb-4">View Vaccine</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" style="background: black; color: white">Vaccine Id</th>
                            <th scope="col" style="background: black; color: white">Vaccine Name</th>
                            <th scope="col" style="background: black; color: white">Vaccine Category</th>
                            <th scope="col" style="background: black; color: white">Number Of Doses</th>
                            <th scope="col" style="background: black; color: white">Hospitals</th>
                            <th scope="col" style="background: black; color: white">Availability</th>
                            <th scope="col" style="background: black; color: white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                        <tr>
                            <td><?php echo $row['vaccine_id']; ?></td>
                            <td><?php echo $row['vaccine_name']; ?></td>
                            <td><?php echo $row['category_name']; ?></td> <!-- Displaying category name -->
                            <td><?php echo $row['number_of_doses']; ?></td>
                            <td><?php echo $row['hospital_name']; ?></td>
                            <td><?php echo $row['availability']; ?></td>
                            <td>
                                <a href="edit_vaccine.php?vaccine_id=<?php echo $row['vaccine_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete_vaccine.php?vaccine_id=<?php echo $row['vaccine_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this vaccine?');">Delete</a>
                            </td>
                        </tr>

                         <?php
                            }
                        }
                        else {
                            echo "<tr><td colspan='7'>No vaccines found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Table End -->

<?php include 'footer.php'; ?>
