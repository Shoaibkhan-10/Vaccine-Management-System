<?php
session_start();
include '../admin/db.php';
if (!isset($_SESSION['name'])) {
    header("Location: login.php");
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
        $target_dir = "../admin/uploads-images/";
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
        echo "<script>alert('Profile updated successfully!'); window.location.href='profile.php';</script>";
    } else {
        echo "<script>alert('Error updating profile');</script>";
    }
}
?>



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
   body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to right, white, #3fbbc0);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.card {
    background: #ffffff !important; /* Form ka background white */
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    padding: 30px;
    max-width: 500px;
    width: 100%;
}

h3 {
    color:rgb(0, 0, 0);
    font-weight: 600;
    text-align: center;
    margin-bottom: 20px;
}

img {
    border-radius: 50%;
    width: 120px;
    height: 120px;
    object-fit: cover;
    border: 3px solid #3fbbc0;
}

.form-label {
    font-weight: 500;
    color: #333;
}

.form-control {
    background: #ffffff !important; /* Input fields ka background white */
    color: #000 !important; /* Text black */
    border-radius: 5px;
    border: 1px solid #ccc;
    padding: 10px;
    transition: 0.3s;
}

.form-control:focus {
    border-color: #3fbbc0;
    box-shadow: 0px 0px 5px rgba(58, 173, 202, 0.5);
}

.btn-primary {
    color: #000;
    background: #3fbbc0;
    border: none;
    padding: 10px;
    border-radius: 5px;
    font-weight: 500;
    transition: 0.3s;
    width: 100%;
}

.btn-primary:hover {
    background: rgb(7, 61, 63);
    color: #ffffff;
}

a {
    text-decoration: none;
    color: #007bff;
    font-weight: 500;
}

a:hover {
    text-decoration: underline;
}

.text-center {
    margin-top: 10px;
}

  </style>

<body class="bg-dark">

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-6">
        <div class="card p-4">
            <h3 class="mb-4 text-center">My Profile</h3>
            
            <div class="text-center mb-3">
                <img src="../admin/uploads-images/<?php echo !empty($admin['profile_picture']) ? $admin['profile_picture'] : 'default.png'; ?>" 
                    alt="Profile Image" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
            </div>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $admin['name']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $admin['email']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">New Password (Optional)</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Profile Picture</label>
                    <input type="file" name="profile_picture" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary w-100">Update Profile</button>
                <div class="text-center mt-3">
                    <a href="index.php" class="text-black">Back to Website</a>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Main JS File -->
<script src="assets/js/main.js"></script>