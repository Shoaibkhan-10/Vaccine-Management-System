<?php
include 'header.php';
include 'db.php';

// Check if vaccine_id is passed
if (isset($_GET['vaccine_id'])) {
    $vaccine_id = $_GET['vaccine_id'];
// Fetch vaccine and category details
$sql = "SELECT v.*, c.category_name FROM vaccines v
        JOIN categories c ON v.category_id = c.category_id
        WHERE v.vaccine_id = '$vaccine_id'";
$result = mysqli_query($conn, $sql);
$vaccine = mysqli_fetch_assoc($result);

if (!$vaccine) {
    echo "<script>alert('Vaccine not found'); window.location.href = 'view_vaccine.php';</script>";
    exit();
}
} else {
    echo "<script>alert('Invalid request'); window.location.href = 'view_vaccine.php';</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $v_name = $_POST['name'];
    $v_type = $_POST['type'];
    $v_number_of_doses = $_POST['doses'];
    $v_availability = $_POST['availability'];

    // Update vaccine details
    $update_sql = "UPDATE vaccines SET vaccine_name = '$v_name', vaccine_type = '$v_type', 
                   number_of_doses = '$v_number_of_doses', availability = '$v_availability' 
                   WHERE vaccine_id = '$vaccine_id'";

    if (mysqli_query($conn, $update_sql)) {
        echo "<script>alert('Vaccine updated successfully'); window.location.href = 'view_vaccine.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<style>
    /* Select elements ka text color black karne ke liye */
    select.form-control {
        color: black;
    }
</style>

<!-- Form Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-secondary rounded h-100 p-4">
                <h3 class="mb-4">Edit Vaccine</h3>
                <form action="#" method="post">
                    <div class="mb-3">
                        <label class="form-label">Vaccine Name</label>
                        <input type="text" name="name" class="form-control" value="<?= $vaccine['vaccine_name'] ?>" required>
                    </div>

                    <select name="type" class="form-control" required>
    <?php
    // Fetch all categories
    $category_sql = "SELECT * FROM categories";
    $category_result = mysqli_query($conn, $category_sql);
    
    while ($category = mysqli_fetch_assoc($category_result)) {
        echo "<option value='{$category['category_id']}' " . 
             ($vaccine['category_id'] == $category['category_id'] ? 'selected' : '') . ">" .
             $category['category_name'] . "</option>";
    }
    ?>
</select>


                    <div class="mb-3">
                        <label class="form-label">Number of Doses</label>
                        <input type="number" name="doses" class="form-control" value="<?= $vaccine['number_of_doses'] ?>" required>
                    </div>
                    <select name="type" class="form-control" required>
    <?php
    // Fetch all categories
    $hospital_sql = "SELECT * FROM hospitals";
    $hospital_result = mysqli_query($conn, $hospital_sql);
    
    while ($hospital = mysqli_fetch_assoc($hospital_result)) {
        echo "<option value='{$hospital['hospital_id']}' " . 
             ($vaccine['hospital_id'] == $hospital['hospital_id'] ? 'selected' : '') . ">" .
             $hospital['hospital_name'] . "</option>";
    }
    ?>
</select>

                    <div class="mb-3">
                        <label class="form-label">Availability</label>
                        <select name="availability" class="form-control" style="background-color: black; color: white;" required>
                            <option value="Available" style="background-color: black; color: white;" <?= $vaccine['availability'] == 'Available' ? 'selected' : ''; ?>>Available</option>
                            <option value="Unavailable"style="background-color: black; color: white;" <?= $vaccine['availability'] == 'Unavailable' ? 'selected' : ''; ?>>Unavailable</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Vaccine</button>
                    <a href="view_vaccine.php">Back to Vaccine</a>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Form End -->


<?php include 'footer.php'; ?>
