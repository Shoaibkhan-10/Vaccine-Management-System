<?php
session_start();
include 'db.php';
if (!isset($_SESSION['name'])) {
    header("Location: signin.php");
    exit(); 

}
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
$sql = "SELECT a.appointment_id, u.name AS parent_name, c.child_name, h.hospital_name, v.vaccine_name, a.date, a.time, a.status
        FROM appointment a
        JOIN users u ON a.user_id = u.user_id
        JOIN child_details c ON a.child_id = c.child_id
        JOIN hospitals h ON a.hospital_id = h.hospital_id
        JOIN vaccines v ON a.vaccine_id = v.vaccine_id
        ORDER BY a.date DESC";

$result = mysqli_query($conn, $sql);
?>

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

        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="Hospital_dashboard.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Hospital</h3>
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
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-calendar"></i>Appointment</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="hospital_appointments.php" class="dropdown-item">View Appointment</a>
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
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
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

<div class="container-fluid pt-4 px-4">
<div class="row g-12">
<div class="col-sm-12 col-xl-12">
<div class="bg-secondary rounded h-100 p-4">
    <h3>Appointments</h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col" style="background: black; color: white">Parent</th>
                <th scope="col" style="background: black; color: white">Child</th>
                <th scope="col" style="background: black; color: white">Hospital</th>
                <th scope="col" style="background: black; color: white">Vaccine</th>
                <th scope="col" style="background: black; color: white">Date</th>
                <th scope="col" style="background: black; color: white">Time</th>
                <th scope="col" style="background: black; color: white">Status</th>
                <th scope="col" style="background: black; color: white">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['parent_name']; ?></td>
                    <td><?php echo $row['child_name']; ?></td>
                    <td><?php echo $row['hospital_name']; ?></td>
                    <td><?php echo $row['vaccine_name']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['time']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <a href="update_appointment.php?id=<?php echo $row['appointment_id']; ?>&status=Approved" class="btn btn-success">Approve</a>
                        <a href="update_appointment.php?id=<?php echo $row['appointment_id']; ?>&status=Rejected" class="btn btn-danger">Reject</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>
</div>
</div>

<?php include('footer.php'); ?>
