<?php
ob_start();
?>


<?php
session_start();
include '../admin/db.php'; // Database connection include

// Agar user logged in hai, to uska profile picture fetch karein
$profile_picture = null;
if (isset($_SESSION['user_id'])) { 
    $user_id = $_SESSION['user_id'];

    // Secure Query (Prepared Statement)
    $stmt = $conn->prepare("SELECT profile_picture FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($profile_picture);
    $stmt->fetch();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - Medicio Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

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


</head>

<body class="index-page">


<header id="header" class="header sticky-top">
    <div class="branding d-flex align-items-center">
        <div class="container position-relative d-flex align-items-center justify-content-end">
            <a href="index.php" class="logo d-flex align-items-center me-auto">
                <img src="../admin/uploads-images/Vaccine Management.png" alt="">
                <h1 class="sitename">VMS</h1> 
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li class="dropdown"><a href="#vaccines"><span>Vaccines</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                <li><a href="#vaccines">Novavax</a></li>
                <li><a href="#vaccines">Coronavac</a></li>
                <li><a href="#vaccines">Pfizer</a></li>
                <li><a href="#vaccines">Varivax</a></li>
                <li><a href="#vaccines">Dengvaxia</a></li>
                <li><a href="#vaccines">Fluzone</a></li>
                <li><a href="#vaccines">Havrix</a></li>
                <li><a href="#vaccines">Engerix-B</a></li>
                <li><a href="#vaccines">Ipol</a></li>
                
              </ul>
                    <li class="dropdown"><a href="#category"><span>Category</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                <li><a href="#category">Chickenpox</a></li>
                <li><a href="#category">Dengue</a></li>
                <li><a href="#category">FLu</a></li>
                <li><a href="#category">Hepatitis A</a></li>
                <li><a href="#category">Hepatitis B</a></li>
                <li><a href="#category">Polio</a></li>
                
              </ul>
            </li>
                    <li class="dropdown"><a href="#hospital"><span>Hospitals</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                <li><a href="#hospital">Liaquat National Hospital</a></li>
                <li><a href="#hospital">Aga Khan University Hospital</a></li>
                <li><a href="#hospital">Saifee Hospital</a></li>
                <li><a href="#hospital">Patel Hospital</a></li>
                <li><a href="#hospital">Ziauddin Hospital</a></li>
                <li><a href="#hospital">Indus Hospital</a></li>
                <li><a href="#hospital">Civil Hospital</a></li>
                <li><a href="#hospital">Dow University Hospital</a></li>
                
              </ul>
            </li>
            <li class="dropdown"><a href=""><span>Appointment</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                <li><a href="appointment.php">Make An Appointment</a></li>
                <li><a href="view_appointment.php">View Appointment</a></li>

                
              </ul>
            </li>
                    <li><a href="#contact">Contact</a></li>
                    
                    <?php 
                    if 
                    (isset($_SESSION['user_id'])) { 
                        // Agar user logged in hai, uska profile pic aur naam show karein
                        $user_id = $_SESSION['user_id'];
                        $sql = "SELECT profile_picture FROM users WHERE user_id = $user_id";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $profile_picture = $row['profile_picture'] ?? null;
                    ?>
                        <li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <?php if (!empty($profile_picture)) { ?>
                                    <img src="../admin/uploads-images/<?php echo htmlspecialchars($profile_picture); ?>" 
                                    alt="Profile Picture" style="width: 40px; height: 40px; border-radius: 50%;">
                                <?php } ?>
                                <span><?php echo htmlspecialchars($_SESSION['name']); ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end border-0 rounded-0 rounded-bottom m-0">
                            <a href="add_child.php" class="dropdown-item">Add Child Details</a>
                                <a href="profile.php" class="dropdown-item">My Profile</a>
                                <a href="logout.php" class="dropdown-item">Log Out</a>
                            </div>
                        </li>
                    <?php } else { ?>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                    <?php } ?>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </div>
</header>
