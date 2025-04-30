<?php
include 'header.php';
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role_name = $_POST['rolename'];
 
    $role_id = 1; 

     $sql = "INSERT INTO `roles`( `role_name`) 
     VALUES ('$role_name')"; 

     if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Successfully role Added '); window.location.href='view_role.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    }
?>
               <!-- Table Start -->
             <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h3 class="mb-4">View Roles</h3>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col"  style="background: black; color: white">Role Id</th>
                                        <th scope="col"  style="background: black; color: white">Role Type</th>
                                        <th scope="col"  style="background: black; color: white">Action</th>
                                    </tr>
                                </thead>
                                <?php 
                    
                    $sql = "SELECT * FROM roles";
                    
                    $result = mysqli_query($conn, $sql);
                    
                    if(mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                <tr>
                    <td><?php echo $row['role_id']; ?></td>
                    <td><?php echo $row['role_name']; ?></td>
                    
                    <td>
                        <a href="edit_role.php?role_id=<?php echo $row['role_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_role.php?role_id=<?php echo $row['role_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this role?');">Delete</a>
                    </td>
                </tr>

                 <?php
                    }
                    }
                    else
                    {
                    
                    echo "<tr><td colspan='4'>No roles  found</td></tr>";
                    }
                    ?>
              </tbody>
           </table>
        </div>
     </div>
  </div>
</div>





         <!-- Form Start -->
        

        <?php
        include 'footer.php';
        ?>