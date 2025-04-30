<?php
include("db.php");
include("header.php");

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];


    $sql = "SELECT * FROM categories WHERE category_id = $category_id";
    
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
    } else {
        echo "Category ID not found.";
        exit; 
    }
}

if (isset($_POST["category_id"])) {
    $category_id = $_POST["category_id"];
    $category_name = $_POST["name"];
    $category_description = $_POST["desc"];

   

    // Correct the update query
    $sql_update = "UPDATE `categories` SET 
    `category_name`='$category_name' ,`category_description`='$category_description'
    WHERE `category_id` = $category_id";

    if (mysqli_query($conn, $sql_update)) {
        echo "<script>alert('Category updated Sucessfully✔')</script>";
    } else {
        echo "Category update failed.";
    }
}
?>

<!-- Form Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Edit Category</h6>
                <form action="#" method="post">
                    <input type="hidden" name="category_id" value="<?php echo $category_id; ?>" />
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Category Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $row['category_name']; ?>" id="categoryName">
                    </div>
                    <div class="mb-3">
                        <label for="categorydescription" class="form-label">Category Name</label>
                        <input type="text" name="desc" class="form-control" value="<?php echo $row['category_description']; ?>" id="category_description">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1" >Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Category</button>
                    <a href="view_category.php">Back to Categories</a>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Form End -->

<?php
include("footer.php");
?>
