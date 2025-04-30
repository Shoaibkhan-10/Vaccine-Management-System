<?php
include 'header.php'
           
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
            include 'footer.php'
           
           ?>