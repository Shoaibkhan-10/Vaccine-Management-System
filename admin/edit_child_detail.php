<?php
include("db.php");
include("header.php");

if (isset($_GET['child_id'])) {
    $child_id = $_GET['child_id'];

    $sql = "SELECT * FROM child_details WHERE child_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $child_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>
                alert('Child detail ID not found.');
                window.location.href='view_child_detail.php';
              </script>";
        exit;
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $child_id = $_POST['child_id'];
    $child_name = $_POST['child_name'];
    $age = $_POST['age'];

    $sql_update = "UPDATE child_details SET child_name = ?, age = ? WHERE child_id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("sii", $child_name, $age, $child_id);

    if ($stmt_update->execute()) {
        echo "<script>
                alert('Child details updated successfully✔');
                window.location.href='view_child_detail.php';
              </script>";
    } else {
        echo "<script>alert('Failed to update child details.');</script>";
    }
    $stmt_update->close();
}
?>

<!-- Form Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-secondary rounded h-100 p-4">
                <h3 class="mb-4">Edit Child Detail</h3>
                <form action="" method="post">
                    <input type="hidden" name="child_id" value="<?php echo $child_id; ?>" />
                    <div class="mb-3">
                        <label for="ChildName" class="form-label">Child Name</label>
                        <input type="text" name="child_name" class="form-control" value="<?php echo htmlspecialchars($row['child_name']); ?>" id="ChildName" required>
                    </div>
                    <div class="mb-3">
                        <label for="Age" class="form-label">Age</label>
                        <input type="number" name="age" class="form-control" value="<?php echo htmlspecialchars($row['age']); ?>" id="Age" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Child Detail</button>
                    <a href="view_child_detail.php">Back To Details</a>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Form End -->

<?php
include("footer.php");
?>
