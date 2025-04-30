<?php
include 'header.php';
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role_name = $_POST['rolename'];
 
    $role_id = 2; 

     $sql = "INSERT INTO `roles`( `role_name`) 
     VALUES ('$role_name')"; 

     if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Successfully role Added '); window.location.href='view_role.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    }
?>







         <!-- Form Start -->
         <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h3 class="mb-4">Add Roles</h3>
                            <form action="#" method="post">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label"> Add Roles</label>
                                    <input type="text" name="rolename" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                        
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Role</button>
                            </form>
                        </div>
                    </div>
                 
                </div>
            </div>
            <!-- Form End -->

        <?php
        include 'footer.php';
        ?>