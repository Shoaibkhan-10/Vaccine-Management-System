<?php
include("db.php");
include("header.php");

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    $sql = "SELECT * FROM users WHERE user_id = $user_id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
    } else {
        echo "User ID not found.";
        exit; 
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u_id = $_POST['user_id'];
    $u_name = $_POST["uname"];
    $u_email = $_POST["uemail"];
    $u_password = $_POST["upassword"];
    $role_id = $_POST["role_id"];  // ✅ Now fetching role_id from form input

    // ✅ Correct the update query
    $sql_update = "UPDATE `users` 
    SET `name`='$u_name', `email`='$u_email', `password`='$u_password', `role_id`='$role_id' 
    WHERE `user_id` = '$u_id'";

    if (mysqli_query($conn, $sql_update)) {
        echo "<script>alert('User updated successfully✔'); window.location.href = 'view_user.php';</script>";
    } else {
        echo "User update failed.";
    }
}
?>

<!-- Form Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Update User</h6>
                <form action="#" method="post">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($row['user_id']); ?>">

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="uname" value="<?php echo htmlspecialchars($row['name']); ?>" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" name="uemail" value="<?php echo htmlspecialchars($row['email']); ?>" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="text" name="upassword" value="<?php echo htmlspecialchars($row['password']); ?>" class="form-control">
                    </div>

                    <!-- Role Selection -->
                    <div class="form-group">
                        <label class="form-label">Role</label>
                        <select class="form-control" name="role_id" style="background-color: black; color: white;" required>
                            <?php
                            $role_sql = "SELECT * FROM roles";
                            $role_result = mysqli_query($conn, $role_sql);
                            while ($role_row = mysqli_fetch_assoc($role_result)) {
                                $selected = ($role_row['role_id'] == $row['role_id']) ? "selected" : "";
                                echo "<option value='" . $role_row['role_id'] . "' $selected>" . $role_row['role_name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <br>
                    <button type="submit" class="btn btn-primary">Update User</button>
                    <a href="view_user.php">Back to User</a>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Form End -->

<?php
include("footer.php");
?>
