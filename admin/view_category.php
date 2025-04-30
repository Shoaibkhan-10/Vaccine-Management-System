<?php
include("db.php");
include("header.php");

?>



 <!-- Table Start -->
 <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h3 class="mb-4">View Category</h3>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" style="background: black; color: white;">Category ID</th>
                                        <th scope="col" style="background: black; color: white;">Category Name</th>
                                        <th scope="col" style="background: black; color: white;">Category Description</th>
                                        <th scope="col" style="background: black; color: white;">Action</th>
                                    </tr>
                                </thead>
                                <?php 
                    
                    $sql = "SELECT * FROM categories";
                    
                    $result = mysqli_query($conn, $sql);
                    
                    if(mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                 <tr>
                    <td><?php echo $row['category_id']?></td>
                    <td><?php echo $row['category_name']?></td>
                    <td><?php echo $row['category_description']?></td>
                    <td>
                    <a href="edit_category.php?category_id=<?php echo $row['category_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete_category.php?category_id=<?php echo $row['category_id'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?');">Delete</a>
                    </td>
                 </tr>
                 <?php
                    }
                    }
                    else
                    {
                    
                    echo "<tr><td colspan='4'>No categories found</td></tr>";
                    }
                    ?>
              </tbody>
           </table>
        </div>
     </div>
  </div>
</div>




<?php

include("footer.php");
?>