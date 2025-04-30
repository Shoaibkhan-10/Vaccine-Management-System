<?php
include("db.php");

if(isset($_GET["hospital_id"])){
    $id = intval($_GET["hospital_id"]);
    $sql = "SELECT * FROM hospitals WHERE hospital_id = $id";
    $res = mysqli_query($conn, $sql);

    if(mysqli_num_rows($res) > 0){
        $row = mysqli_fetch_assoc($res);
        $name = htmlspecialchars($row["hospital_name"]);
        $location = htmlspecialchars($row["location"]);
        $des = htmlspecialchars($row["details"]);
        $image = !empty($row["image"]) ? "uploads-images/" . htmlspecialchars($row["image"]) : "default_hospital.png";
    } else {
        header("Location: view_hospital.php");
        exit;
    }
} else {
    header("Location: view_hospital.php");
    exit;
}

include("header.php");
?>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-secondary rounded h-100 p-4">
                <h3 class="mb-4">Edit Hospital</h3> 
                <form action="main.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="hospital_id" value="<?php echo $id; ?>" /> 
                    <div class="mb-3">
                        <label for="hospitalName" class="form-label">Hospital Name</label>  
                        <input type="text" name="update_hospital_name" class="form-control" value="<?php echo $name; ?>" id="hospitalName" required>  
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>  
                        <input type="text" name="update_hospital_location" class="form-control" value="<?php echo $location; ?>" id="location" required>  
                    </div>
                    <!-- <div class="mb-3">
                        <label for="hospitalImage" class="form-label" style="color: black;">Hospital Image</label>
                        <input type="file" name="hospital_image" class="form-control" id="hospitalImage">
                        <img src="" alt="Current Image" class="img-thumbnail mt-2" width="150">
                    </div> -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>  
                        <input type="text" name="update_hospital_Description" class="form-control" value="" id="description" required>  
                    </div>
                    <button type="submit" class="btn btn-primary">Update Hospital</button> 
                    <a href="view_hospital.php" class="btn btn-warning">Back to Hospitals</a>  
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>
