<?php

include 'db.php';
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_id = $_POST['role_id'];

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $file_name = $_FILES['profile_picture']['name'];
    $file_tmp = $_FILES['profile_picture']['tmp_name'];
    $file_type = $_FILES['profile_picture']['type'];
    $file_size = $_FILES['profile_picture']['size'];
    $upload_dir = "uploads-images/";

    if (!empty($file_name)) {
        if ($file_type == "image/png" || $file_type == "image/jpg" || $file_type == "image/jpeg") {
            if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
                $profile_picture = $file_name;
            } else {
                echo "<script>alert('Error uploading image'); window.location.href='add_user.php';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Invalid image format'); window.location.href='add_user.php';</script>";
            exit();
        }
    } else {
        $profile_picture = ""; 
    }

    $sql = "INSERT INTO users (name, email, password, profile_picture, role_id) VALUES ('$name', '$email', '$hashed_password', '$profile_picture', '$role_id')";
   
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('sucessfully Addedd'); window.location.href='view_user.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!-- Form Start -->
<div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                <h3>Add User</h3>
                <form action="add_user.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label">Role</label>
                        <select class="form-control" name="role_id" style="background-color: black; color: white;" required>
                            <?php
                            $role_sql = "SELECT * FROM roles";
                            $role_result = mysqli_query($conn, $role_sql);
                            while ($role_row = mysqli_fetch_assoc($role_result)) {
                                echo "<option value='" . $role_row['role_id'] . "'>" . $role_row['role_name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="profile_picture">Profile Picture:</label>
                        <input type="file" class="form-control" name="profile_picture" style="background-color: black; color: white;" >
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Form End -->

<?php include 'footer.php'; ?>
