<?php
include "../admin/db.php";
include "header.php";

if (!isset($_SESSION['name'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $child_name = mysqli_real_escape_string($conn, $_POST['child_name']);
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $blood_group = $_POST['blood_group'];
    $birth_form = mysqli_real_escape_string($conn, $_POST['birth_form']);
    $birth_certificate = mysqli_real_escape_string($conn, $_POST['birth_certificate']);
    $user_id = $_SESSION['user_id'];

    $upload_dir = "../admin/uploads-images/";

    // File Upload Handling
    $child_image = null;
    if (!empty($_FILES['child_image']['name'])) {
        $file_name = basename($_FILES['child_image']['name']);
        $target_file = $upload_dir . time() . "_" . $file_name;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (in_array($file_type, ['jpg', 'jpeg', 'png'])) {
            if (move_uploaded_file($_FILES['child_image']['tmp_name'], $target_file)) {
                $child_image = $target_file;
            } else {
                die("Error uploading child image.");
            }
        } else {
            die("Invalid file format. Only JPG, JPEG, PNG allowed.");
        }
    }

    // Insert Child Details
    $sql = "INSERT INTO child_details (DOB, child_name, blood_group, gender, Birth_Form, birth_certificate, child_image, user_id) 
            VALUES ('$dob', '$child_name', '$blood_group', '$gender', '$birth_form', '$birth_certificate', '$child_image', '$user_id')";

    if (mysqli_query($conn, $sql)) {
        // Get last inserted child_id
        $child_id = mysqli_insert_id($conn);

        // Save child_id and child_name in SESSION for appointment
        $_SESSION['child_id'] = $child_id;
        $_SESSION['child_name'] = $child_name;



    }
}
?>



   <!-- child Section -->
   <section id="appointment" class="appointment section light-background">

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
  <h2>MAKE AN CHILD DETAILS</h2>
  <p>The Importance of Scheduling Child Details for Timely Healthcare</p>
</div><!-- End Section Title -->

<div class="container" data-aos="fade-up" data-aos-delay="100">

<form action="#" method="post" enctype="multipart/form-data" class="php-email-form">
    <div class="row">
    <div class="col-md-4 form-group">
            <input type="text" name="name" class="form-control" 
                value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?>" 
                readonly required>
        </div>
        <div class="col-md-4 form-group">
            <input type="text" name="child_name" class="form-control" placeholder="Child Name" required>
        </div>
        <div class="col-md-4 form-group mt-3 mt-md-0">
            <input type="date" name="dob" class="form-control" required>
        </div>
        <div class="col-md-4 form-group mt-3 mt-md-0">
            <select name="gender" class="form-select" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 form-group mt-3">
            <select name="blood_group" class="form-select" required>
                <option value="">Select Blood Group</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
            </select>
        </div>
        <div class="col-md-4 form-group mt-3">
            <input type="number" name="birth_form" class="form-control" placeholder="Enter Birth Number" required>

        </div>
        <div class="col-md-4 form-group mt-3">
            <input type="number" name="birth_certificate" class="form-control" placeholder="Enter Birth Certificate Number" required>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12 form-group mt-3">
            <input type="file" name="child_image" class="form-control"  required>
            <small class="text-muted">Upload Child Image (JPG, PNG)</small>
        </div>
    </div>

    <div class="form-group mt-3">
            <textarea class="form-control" name="message" rows="5" placeholder="Message (Optional)"></textarea>
          </div>
          <div class="mt-3">
      <div class="loading">Loading</div>
      <div class="error-message"></div>
      <div class="sent-message">Your appointment request has been sent successfully. Thank you!</div>
      <div class="text-center"><button type="submit">Submit</button></div>
    </div>
</form>


</div>

</section><!-- /child Section -->


<?php

   include 'footer.php'; 
?>