<?php
ob_start();

?>

<?php
include('../admin/db.php');
include 'header.php';

if (!isset($_SESSION['name'])) {
  header("Location: login.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $hospital_id = mysqli_real_escape_string($conn, $_POST['hospital']);
    $vaccine_id = mysqli_real_escape_string($conn, $_POST['vaccine']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Get Child Data from Session
    $child_id = isset($_SESSION['child_id']) ? $_SESSION['child_id'] : '';
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

   if (!empty($user_id) && !empty($child_id)) {
    $appointment_id = uniqid();
    $stmt = $conn->prepare("INSERT INTO `appointment` ( `user_id`, `child_id`, `hospital_id`, `vaccine_id`, `date`, `time`) 
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissss", $user_id, $child_id, $hospital_id, $vaccine_id, $date, $time);
    $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Appointment Created Successfully!');</script>";
        } else {
            echo "Error: Could not create appointment.";
        }
    } else {
        echo "User or child information is missing.";
    }
}
?>

<!-- Appointment Section -->
<section id="appointment" class="appointment section light-background">

<p class="alert alert-warning text-center fw-bold">
    If you want to create an appointment, you must first add the child’s details.
</p>

<div class="text-center mt-3">
    <a href="add_child.php" class="btn btn-info text-white fw-bold">Add Child Details</a>
</div>
<br>
<hr>

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
    <h2>MAKE AN APPOINTMENT</h2>
    <p>The Importance of Scheduling Appointments for Timely Healthcare</p>
</div><!-- End Section Title -->

<div class="container" data-aos="fade-up" data-aos-delay="100">

<form action="appointment.php" method="post" role="form">
<div class="row">

    <div class="col-md-4 form-group">
        <input type="text" name="name" class="form-control" 
            value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?>" 
            readonly required>
    </div>
    <div class="col-md-4 form-group mt-3 mt-md-0">
        <input type="text" name="child_name" class="form-control" 
        value="<?php echo isset($_SESSION['child_name']) ? $_SESSION['child_name'] : ''; ?>" 
        readonly required>
    </div>
    <div class="col-md-4 form-group mt-3 mt-md-0">
        <input type="time" class="form-control" name="time" placeholder="Appointment Time" required="">
    </div>
</div>
<div class="row">
    <div class="col-md-4 form-group mt-3 mt-md-0">
        <input type="date" name="date" class="form-control" placeholder="Appointment Date" required="">
    </div>
    <div class="col-md-4 form-group mt-3 mt-md-0">
        <select class="form-control" id="hospital" name="hospital" required>
            <?php
                $sql = "SELECT hospital_id, hospital_name FROM hospitals";
                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['hospital_id'] . "'>" . $row['hospital_name'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hospitals available</option>";
                }
            ?>
        </select>
    </div>
    <div class="col-md-4 form-group mt-3 mt-md-0">
        <select class="form-control" id="vaccine" name="vaccine" required>
            <?php
                $sql = "SELECT vaccine_id, vaccine_name FROM vaccines";
                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['vaccine_id'] . "'>" . $row['vaccine_name'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No vaccine available</option>";
                }
            ?>
        </select>
    </div>
</div>

<div class="form-group mt-3">
    <textarea class="form-control" name="message" rows="5" placeholder="Message (Optional)"></textarea>
</div>
<div class="mt-3 text-center">
    <button type="submit" class="btn btn-primary" style="background-color: #3fbbc0;">Make an Appointment</button>
</div>
</form>

</div>

</section><!-- /Appointment Section -->

<?php
  include 'footer.php';
?>
