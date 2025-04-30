<?php
include('header.php');
?>


<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-secondary rounded h-100 p-4">
                <h3 class="mb-4" >Add Hospital</h3>
                <form rm action="main.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label" >Hospital Name</label>
                        <input type="text" name="hospital_name" class="form-control" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label" >Location</label>
                        <input type="text" name="hospital_location" class="form-control" id="location" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label" >contact</label>
                        <input type="text" name="hospital_contact" class="form-control" id="contact" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label" >Hospital Image</label>
                        <input type="file" name="hospital_image" class="form-control" style="background-color: black; color: white;" id="image" required>
                    </div>
                    <div class="mb-3">
                        <label for="detail" class="form-label" >Hospital Details</label>
                        <textarea name="hospital_detail" class="form-control" id="detail" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Hospital</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
<?php if (isset($success)) echo "<p style='color: green;'>$success</p>"; ?>

<?php

include("footer.php");
?>