<?php
include("db.php");
include("header.php");

?>



 <!-- Table Start -->
 <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h3 class="mb-4">View Child Detail</h3>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" style="background: black; color: white">Child ID</th>
                                        <th scope="col" style="background: black; color: white">Child Name</th>
                                        <th scope="col" style="background: black; color: white">Age</th>
                                        <th scope="col" style="background: black; color: white">Action</th>
                                    </tr>
                                </thead>
                                <?php 
                    
                    $sql = "SELECT * FROM child_details";
                    
                    $result = mysqli_query($conn, $sql);
                    
                    if(mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                 <tr>
                    <td><?php echo $row['child_id']?></td>
                    <td><?php echo $row['child_name']?></td>
                    <td><?php echo $row['age']?></td>
                    <td>
                        <a href="edit_child_detail.php?child_id=<?php echo $row['child_id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="delete_child_detail.php?child_id=<?php echo $row['child_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this child detail?');">Delete</a>
                    </td>
                 </tr>
                 <?php
                    }
                    }
                    else
                    {
                    
                    echo "<tr><td colspan='4'>No Child detail found</td></tr>";
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