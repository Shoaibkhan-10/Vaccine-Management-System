<?php

include("db.php");

if(isset($_GET['category_id']))
{
    $category_id = $_GET['category_id'];

    $sql = "Delete from categories
    where category_id = $category_id";

    if(mysqli_query($conn, $sql))
    {
        echo "<script>alert('Category Deleted successfully!'); window.location.href = 'view_category.php';</script>";
    }
    else{
        echo "Category Not found ";
    }
}
?>