<?php
include("db.php");
include("header.php");



if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $cat_name = $_POST["name"];
    $cat_desc = $_POST["desc"];

    $sql = "INSERT INTO `categories`(`category_name` , `category_description`) VALUES ('$cat_name') , ('$cat_desc')";

    
    if(mysqli_query($conn , $sql))
    {
        echo "<script>alert(' Added Category Sucessfully'); window.location.href='view_category.php';</script>";
    }
    else{
        echo "<script>alert('Category Not Found😈')</script>";
    }
}
?>




<!-- Form Start -->
<div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h3 class="mb-4">Add Categories</h3>
                            <form action="#" method="post">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Category Name</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Category Description</label>
                                    <input type="text" name="desc" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                </div>
                                
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Category</button>
                            </form>
                        </div>
                    </div>
                  
                </div>
            </div>
            <!-- Form End -->



<?php

include("footer.php");
?>