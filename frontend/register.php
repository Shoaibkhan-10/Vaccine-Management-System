<?php
session_start();
include '../admin/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_id = 3; // Assuming default role is Admin

    // Check if role_id exists in the roles table
    $check_role_query = "SELECT * FROM roles WHERE role_id = '$role_id'";
    $role_result = mysqli_query($conn, $check_role_query);
    if (mysqli_num_rows($role_result) == 0) {
        echo "<script>alert('Invalid role. Please contact the admin.'); window.location.href='register.php';</script>";
        exit();
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Handle Profile Picture Upload
    $file_name = $_FILES['profile_picture']['name'];
    $file_tmp = $_FILES['profile_picture']['tmp_name'];
    $file_type = $_FILES['profile_picture']['type'];
    $file_size = $_FILES['profile_picture']['size'];
    $upload_dir = "../admin/uploads-images/";

    if (!empty($file_name)) {
        if ($file_type == "image/png" || $file_type == "image/jpg" || $file_type == "image/jpeg") {
            // Check file size (limit to 5MB)
            if ($file_size <= 5242880) {
                if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
                    $profile_picture = $file_name;
                } else {
                    echo "<script>alert('Error uploading image. Please try again.'); window.location.href='register.php';</script>";
                    exit();
                }
            } else {
                echo "<script>alert('File size exceeds the limit of 5MB.'); window.location.href='register.php';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Invalid image format. Only PNG, JPG, and JPEG are allowed.'); window.location.href='register.php';</script>";
            exit();
        }
    } else {
        $profile_picture = ""; // No profile picture uploaded
    }

    // Prepare the SQL statement
    $sql = "INSERT INTO users (name, email, password, profile_picture, role_id) 
            VALUES ('$name', '$email', '$hashed_password', '$profile_picture', '$role_id')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Successfully Registerd! Please log in.'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location.href='register.php';</script>";
    }
}
?>

<!-- HTML Sign Up Form -->

<!-- Favicons -->
<link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <style>
    /* Signup Page Styling */
body {
    background: linear-gradient(to right, white, #3fbbc0);
    font-family: 'Poppins', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

/* Signup Box */
.signup-container {
    width: 100%;
    max-width: 400px;
}

.signup-box {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    text-align: center;
}

.signup-title {
    font-size: 24px;
    color: #333;
    margin-bottom: 20px;
}

.input-group {
    text-align: left;
    margin-bottom: 15px;
}

.input-group label {
    font-weight: 500;
    color: #333;
}

.input-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    transition: all 0.3s;
}

.input-group input:focus {
    border-color: #3fbbc0;
    box-shadow: 0 0 5px rgba(37, 117, 252, 0.5);
    outline: none;
}

.signup-btn {
    width: 100%;
    background: #3fbbc0;
    color: white;
    border: none;
    padding: 12px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s;
}

.signup-btn:hover {
    color: white;
    background:rgb(7, 61, 63);
}

.signin-link {
    margin-top: 15px;
    font-size: 14px;
}

.signin-link a {
    color: #3fbbc0;
    text-decoration: none;
    font-weight: bold;
}

.signin-link a:hover {
    text-decoration: underline;
}

  </style>
  

    <!-- Sign Up Start -->
    <div class="signup-container">
    <div class="signup-box">
        <h2 class="signup-title"><i class="fas fa-user-plus"></i>Register</h2>
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your full name" required>
            </div>

            <div class="input-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Create a password" required>
            </div>

            <div class="input-group">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" id="profile_picture" name="profile_picture">
            </div>

            <button type="submit" class="signup-btn">Register</button>
        </form>

        <p class="signin-link">Already have an account? <a href="login.php">Log In</a></p>
    </div>
</div>
    <!-- Sign Up End -->



<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Main JS File -->
<script src="assets/js/main.js"></script>
