<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: signin.php");
    exit(); 

}

include 'db.php';
// Fetch profile picture
$user_id = $_SESSION['user_id']; // Assuming user_id is stored in the session
$sql = "SELECT profile_picture FROM users WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $profile_picture = $row['profile_picture'];
} else {
    $profile_picture = null;
}
?>
<?php
include 'db.php'; // Database connection

// Count Vaccines
$vaccine_sql = "SELECT COUNT(*) as total_vaccines FROM vaccines";
$vaccine_result = $conn->query($vaccine_sql);
$vaccine_count = $vaccine_result->fetch_assoc()['total_vaccines'];

// Count Hospitals
$hospital_sql = "SELECT COUNT(*) as total_hospitals FROM hospitals";
$hospital_result = $conn->query($hospital_sql);
$hospital_count = $hospital_result->fetch_assoc()['total_hospitals'];

// Count Vaccine Categories
$category_sql = "SELECT COUNT(*) as total_categories FROM categories";
$category_result = $conn->query($category_sql);
$category_count = $category_result->fetch_assoc()['total_categories'];

// Count appointment 
$appointment_sql = "SELECT COUNT(*) as total_appointment FROM appointment";
$appointment_result = $conn->query($appointment_sql);
$appointment_count = $appointment_result->fetch_assoc()['total_appointment'];

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>E-Project</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->
        


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="hospital_dashboard.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hospital me-2"></i>Hospital</h3>
                </a>
                <a href="hospital_dashboard.php" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary" 
    style="display: flex; align-items: center; font-size: 26px; font-family: 'Poppins', sans-serif;">
    
    <img src="../admin/uploads-images/Vaccine Management1.png" 
         alt="VMS Logo" 
         style="width: 55px; height: 55px; object-fit: cover; border-radius: 50%; 
                margin-right: 12px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);">
    
    <span style="color: red; text-transform: uppercase; letter-spacing: 3px;
                 text-shadow: 2px 2px 2px rgb(41, 41, 41);">VMS</span></h3>

                </a>
                <div class="navbar-nav w-100">
                    <a href="hospital_dashboard.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-person"></i>Appoinments</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="hospital_appointments.php" class="dropdown-item">Manage Appoinments</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="signin.php" class="dropdown-item">Sign In</a>
                            <a href="signup.php" class="dropdown-item">Sign Up</a>
                        </div>
                    </div>
                    
                 
                    
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="hospital_dashboard.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <?php if (!empty($profile_picture)) { ?>
            <img src="uploads-images/<?php echo htmlspecialchars($profile_picture); ?>" alt="Profile Picture" style="width: 50px; height: 50px; border-radius: 50%;">
        <?php } else { ?>
            <p>No profile picture available.</p>
        <?php } ?>
        <span class="d-none d-lg-inline-flex"><?php echo htmlspecialchars($_SESSION['name']); ?></span>
    </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="hospital_profile.php" class="dropdown-item">My Profile</a>
                            <a href="logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
<!-- Vaccine, Hospital & Category Count Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-lg-6 col-md-6 col-12">
            <div class="stat-box">
                <div class="icon-box">
                    <i class="fa fa-syringe icon"></i>
                </div>
                <div class="info">
                    <p>Total Vaccines</p>
                    <h3><?php echo $vaccine_count; ?></h3>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <div class="stat-box">
                <div class="icon-box">
                    <i class="fa fa-hospital icon"></i>
                </div>
                <div class="info">
                    <p>Total Hospitals</p>
                    <h3><?php echo $hospital_count; ?></h3>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <div class="stat-box">
                <div class="icon-box">
                    <i class="fa fa-calendar icon"></i>
                </div>
                <div class="info">
                    <p>Total Appointments</p>
                    <h3><?php echo $appointment_count; ?></h3>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <div class="stat-box">
                <div class="icon-box">
                    <i class="fa fa-list-alt icon"></i>
                </div>
                <div class="info">
                    <p>Total Categories</p>
                    <h3><?php echo $category_count; ?></h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Vaccine, Hospital & Category Count End -->


<?php
include 'footer.php';
?>