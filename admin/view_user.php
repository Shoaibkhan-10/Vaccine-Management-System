<?php

include 'db.php';
include 'header.php';

?>

<!-- Users Table -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h3 class="mb-4"> View Users</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="background: black; color: white">User ID</th>
                            <th style="background: black; color: white">Name</th>
                            <th style="background: black; color: white">Email</th>
                            <th style="background: black; color: white">Role</th>
                            <th style="background: black; color: white">Profile</th>
                            <th style="background: black; color: white">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $sql = "SELECT 
                                    users.user_id, 
                                    users.name, 
                                    users.email, 
                                    users.profile_picture, 
                                    roles.role_name 
                                FROM 
                                    users
                                JOIN 
                                    roles 
                                ON 
                                    users.role_id = roles.role_id";
                        
                        $result = mysqli_query($conn, $sql);
                        
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['user_id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['role_name']; ?></td>
                            <td>
                                <!-- Corrected Profile Image Handling -->
                                <?php
                                $profileImage = !empty($row['profile_picture']) && file_exists("uploads-images/" . $row['profile_picture']) 
                                    ? $row['profile_picture'] 
                                    : 'default.jpg';
                                ?>
                                <img src="uploads-images/<?php echo $profileImage; ?>" alt="profile" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                            </td>
                            <td>
                                <a href="edit_user.php?user_id=<?php echo $row['user_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete_user.php?user_id=<?php echo $row['user_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                            </td>
                        </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>No users found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
