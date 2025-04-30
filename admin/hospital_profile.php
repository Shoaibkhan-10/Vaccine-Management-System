<?php
session_start();
include 'db.php'; 

if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 2) {
    header("Location: hospital_profile.php");
    exit();
}

$admin_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE user_id = '$admin_id'";
$result = mysqli_query($conn, $sql);
$admin = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Handle Image Upload
    if (!empty($_FILES["profile_picture"]["name"])) {
        $target_dir = "uploads-images/";
        $image_name = time() . "_" . basename($_FILES["profile_picture"]["name"]);
        $target_file = $target_dir . $image_name;
        
        // Check image type
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = array("jpg", "jpeg", "png", "gif");

        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                $image_sql = ", profile_picture='$image_name'";
            } else {
                echo "<script>alert('Error uploading image');</script>";
            }
        } else {
            echo "<script>alert('Only JPG, JPEG, PNG & GIF files are allowed');</script>";
        }
    } else {
        $image_sql = "";
    }

    // Update User Details
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $update_sql = "UPDATE users SET name='$name', email='$email', password='$password' $image_sql WHERE user_id='$admin_id'";
    } else {
        $update_sql = "UPDATE users SET name='$name', email='$email' $image_sql WHERE user_id='$admin_id'";
    }

    if (mysqli_query($conn, $update_sql)) {
        $_SESSION['name'] = $name;
        echo "<script>alert('Profile updated successfully!'); window.location.href='my_profile.php';</script>";
    } else {
        echo "<script>alert('Error updating profile');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>

    <!-- DarkPan CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body class="bg-dark">

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-6">
            <div class="card bg-secondary text-white p-4">
                <h3 class="mb-4 text-center">My Profile</h3>
                
                <!-- Profile Image -->
                <div class="text-center mb-3">
                    <img src="uploads-images/<?php echo !empty($admin['profile_picture']) ? $admin['profile_picture'] : 'default.png'; ?>" 
                        alt="Profile Image" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                </div>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control bg-dark text-white" value="<?php echo $admin['name']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control bg-dark text-white" value="<?php echo $admin['email']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Password (Optional)</label>
                        <input type="password" name="password" class="form-control bg-dark text-white">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Profile Picture</label>
                        <input type="file" name="profile_picture" class="form-control bg-dark text-white">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Update Profile</button>
                    <div class="text-center mt-3">
                        <a href="hospital_dashboard.php" class="text-white">Back to Dashboard</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
