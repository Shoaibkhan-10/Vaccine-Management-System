<?php
include("db.php");
include("header.php");
?>

<style>
    table td, table th {
        text-align: center;
        vertical-align: middle;
    }
    .hospital-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 5px;
    }
    .text_style{
        color: #fff !important;
    }
</style>

<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h3 class="mb-4">View Hospitals</h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col" style="background: black; color: white">ID</th>
                                <th scope="col" style="background: black; color: white">Image</th>
                                <th scope="col" style="background: black; color: white">Name</th>
                                <th scope="col" style="background: black; color: white">Location</th>
                                <th scope="col" style="background: black; color: white">Details</th>
                                <th scope="col" style="background: black; color: white">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $sql = "SELECT * FROM hospitals";
                            $res = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($res) > 0){
                                $index = 1;
                                while($row = mysqli_fetch_assoc($res)){
                                    $id = $row['hospital_id'];
                                    $name = htmlspecialchars($row["hospital_name"]);
                                    $location = htmlspecialchars($row["location"]);
                                    $details = htmlspecialchars($row["details"]);
                                    $image = !empty($row["image"]) ? "uploads-images/" . htmlspecialchars($row["image"]) : "default_hospital.png";
                                    
                                    echo "<tr>
                                            <td class='text_style'>$index</td>
                                            <td class='text_style'><img src='$image' class='hospital-image' alt='Hospital Image'></td>
                                            <td class='text_style'>$name</td>
                                            <td class='text_style'>$location</td>
                                            <td class='text_style'>$details</td>
                                            <td class='text_style'>
                                                <a href='edit_hospital.php?hospital_id=$id' class='btn btn-sm btn-warning'>Edit</a>
                                                <a href='delete_hospital.php?hospital_id=$id' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure you want to delete hospital: $name?');\">Delete</a>
                                            </td>
                                        </tr>";
                                    $index++;
                                }
                            }
                            else {
                                echo "<tr><td colspan='6' class='text-center'>No hospitals found.</td></tr>";
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>
