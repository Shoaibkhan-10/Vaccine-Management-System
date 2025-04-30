<?php
include('db.php'); 
include('header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $child_name = $_POST['child_name'];
    $age = $_POST['age'];

    $sql = "INSERT INTO child_details (child_name, age) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $child_name, $age);

    if ($stmt->execute()) {
        echo "<script>
                alert('Child detail added successfully✔');
                window.location.href = 'view_child_detail.php';
              </script>";
    } else {
        echo "<script>alert('Child detail not added. Please try again!😈')</script>";
    }

    $stmt->close();
}
?>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-secondary rounded h-100 p-4">
                <h3 class="mb-4">Add Child Detail</h3>
                <form action="#" method="post">
                    <div class="mb-3">
                        <label for="child_name" class="form-label">Name</label>
                        <input type="text" name="child_name" class="form-control" id="child_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" name="age" class="form-control" id="age" required>
                    </div>  
                    <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                    <button type="submit" class="btn btn-primary">Add Detail</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>
