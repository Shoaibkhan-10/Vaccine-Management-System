<?php
include("db.php");

if (isset($_GET['child_id'])) {
    $child_id = $_GET['child_id'];

    $sql = "DELETE FROM child_details WHERE child_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $child_id);

    if ($stmt->execute()) {
        echo "<script>
                alert('Child detail deleted successfully✔');
                window.location.href = 'view_child_detail.php';
              </script>";
    } else {
        echo "<script>
                alert('Failed to delete child detail. Please try again!');
                window.location.href = 'view_child_detail.php';
              </script>";
    }
    $stmt->close();
} else {
    echo "<script>
            alert('Child ID not provided!');
            window.location.href = 'view_child_detail.php';
          </script>";
}

$conn->close();
?>
