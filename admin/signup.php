<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_id = 2; // Assuming default role is Admin

    // Check if role_id exists in the roles table
    $check_role_query = "SELECT * FROM roles WHERE role_id = '$role_id'";
    $role_result = mysqli_query($conn, $check_role_query);
    if (mysqli_num_rows($role_result) == 0) {
        echo "<script>alert('Invalid role. Please contact the admin.'); window.location.href='signup.php';</script>";
        exit();
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Handle Profile Picture Upload
    $file_name = $_FILES['profile_picture']['name'];
    $file_tmp = $_FILES['profile_picture']['tmp_name'];
    $file_type = $_FILES['profile_picture']['type'];
    $file_size = $_FILES['profile_picture']['size'];
    $upload_dir = "uploads-images/";

    if (!empty($file_name)) {
        if ($file_type == "image/png" || $file_type == "image/jpg" || $file_type == "image/jpeg") {
            // Check file size (limit to 5MB)
            if ($file_size <= 5242880) {
                if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
                    $profile_picture = $file_name;
                } else {
                    echo "<script>alert('Error uploading image. Please try again.'); window.location.href='signup.php';</script>";
                    exit();
                }
            } else {
                echo "<script>alert('File size exceeds the limit of 5MB.'); window.location.href='signup.php';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Invalid image format. Only PNG, JPG, and JPEG are allowed.'); window.location.href='signup.php';</script>";
            exit();
        }
    } else {
        $profile_picture = ""; // No profile picture uploaded
    }

    // Prepare the SQL statement
    $sql = "INSERT INTO users (name, email, password, profile_picture, role_id) 
            VALUES ('$name', '$email', '$hashed_password', '$profile_picture', '$role_id')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Successfully signed up! Please log in.'); window.location.href='signin.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location.href='signup.php';</script>";
    }
}
?>

<!-- HTML Sign Up Form -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <!-- Add your stylesheets and other links here -->
    <link href="img/favicon.ico" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

    <!-- Sign Up Start -->
    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a href="signin.php" class="">
                            <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>SignUp</h3>
                        </a>
                    </div>
                    <form action="#" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="profile_picture">Profile Picture:</label>
                            <input type="file" class="form-control-file" id="profile_picture" name="profile_picture">
                        </div>
                        <button type="submit" class="btn btn-primary">Sign Up</button>
                    </form>
                    <p class="text-center mb-0">Already have an Account? <a href="signin.php">Sign In</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Sign Up End -->

    <!-- Add your JavaScript libraries and scripts here -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="js/main.js"></script>

</body>
</html>
