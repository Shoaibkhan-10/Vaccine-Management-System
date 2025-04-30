<?php
include("db.php");
include("header.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $v_name = $_POST['name'];
    $category_id = $_POST['type']; // Selected category ID
    $v_number_of_doses = $_POST['doses'];
    $hospital_id = $_POST['hospital']; // Hospital ID from the form
    $v_availability = $_POST['availability'];

    // Insert into vaccines table
    $sql = "INSERT INTO `vaccines`(`vaccine_name`, `category_id`, `number_of_doses`, `hospital_id`, `availability`) 
            VALUES ('$v_name','$category_id','$v_number_of_doses','$hospital_id','$v_availability')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Vaccine added successfully!'); window.location.href = 'view_vaccine.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>

<!-- Form Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-secondary rounded h-100 p-4">
                <h3 class="mb-4">Add Vaccine</h3>
                <form action="#" method="post">
                    <div class="mb-3">
                        <label class="form-label">Vaccine Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Vaccine Category</label>
                        <select name="type" class="form-control" style="background-color: black; color: white;" required>
                            <option value="">Select Category</option>
                            <?php
                                // Fetch categories
                                $query = "SELECT category_id, category_name FROM categories";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <option value="<?= $row['category_id'] ?>" style="background-color: black; color: white;"><?= $row['category_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Number Of Doses</label>
                        <input type="number" name="doses" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Hospitals</label>
                        <select name="hospital" class="form-control" style="background-color: black; color: white;" required>
                            <option value="">Select Hospitals</option>
                            <?php
                                $query = "SELECT hospital_id, hospital_name FROM hospitals";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <option value="<?= $row['hospital_id'] ?>" style="background-color: black; color: white;"><?= $row['hospital_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Availability</label>
                        <select name="availability" class="form-control" style="background-color: black; color: white;" required>
                            <option value="" style="background-color: black; color: white;">Select Availability</option>     
                            <option value="Available" style="background-color: black; color: white;">Available</option>
                            <option value="Unavailable" style="background-color: black; color: white;">Unavailable</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Vaccine</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Form End -->

<?php include("footer.php"); ?>
