<?php
include("db.php");
include("header.php");

if (isset($_GET['role_id'])) {
    $role_id = $_GET['role_id'];

    $sql = "SELECT * FROM roles WHERE role_id = $role_id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
    } else {
        echo "Role ID not found.";
        exit; 
    }
}

if (isset($_POST["role_id"])) {
    $role_id = $_POST["role_id"];
    $role_name = $_POST["name"];
  

    $sql_update = "UPDATE `roles` SET 
    `role_name`='$role_name'
    WHERE `role_id` = $role_id";

    if (mysqli_query($conn, $sql_update)) {
        echo "<script>alert('Successfully role Added '); window.location.href='view_role.php';</script>";
    } else {
        echo "Role update failed.";
    }
}
?>

<!-- Form Start -->
<div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                <div class="col-sm-12 col-xl-6">
                <div class="bg-secondary rounded h-100 p-4">
                <h3 class="mb-4">Update Role</h3>
                <form action="#" method="post">
                    <input type="hidden" name="role_id" value="<?php echo htmlspecialchars($row['role_id']); ?>">

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Role name</label>
                        <input type="text" name="name" value="<?php echo htmlspecialchars($row['role_name']); ?>" class="form-control">
                    </div>

                    <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>

                    <BR>
                    <button type="submit" class="btn btn-primary">Update Role</button>
                    <a href="view_role.php">Back to Role</a>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Form End -->

<?php
include("footer.php");
?>
