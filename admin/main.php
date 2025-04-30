<?php

include('./db.php');

if(isset($_POST['children_name'])){
    $name = $_POST['children_name'];
    $age = $_POST['children_age'];

    $sql = "INSERT INTO `child_details`(`child_name`, `age`, `parent_id`) VALUES ('$name','$age', 1)";
    
    if(mysqli_query($conn, $sql)){
        header("Location: view_children.php");
    }

}

if(isset($_POST['update_children_name'])){
    $id = $_POST['child_id'];
    $name = $_POST['update_children_name'];
    $age = $_POST['update_children_age'];

    $sql = "UPDATE `child_details` SET `child_name`='$name',`age`='$age' WHERE child_id = $id";
    
    if(mysqli_query($conn, $sql)){
        header("Location: view_children.php");
    }

}

if(isset($_POST['hospital_name'])){
    $name = $_POST['hospital_name'];
    $location = $_POST['hospital_location'];
    $details = $_POST['hospital_detail'];
    $contact = $_POST['hospital_contact'];

    // Handle Image Upload
    if (isset($_FILES['hospital_image']) && $_FILES['hospital_image']['error'] == 0) {
        $image_name = $_FILES['hospital_image']['name'];
        $image_tmp = $_FILES['hospital_image']['tmp_name'];
       
        $image_size = $_FILES['hospital_image']['size'];
        $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png'];

        if (in_array($image_ext, $allowed_ext)) {
            $new_image_name = time() . "_" . uniqid() . "." . $image_ext;
            $upload_path = "uploads-images/" . $new_image_name;
            
            if (move_uploaded_file($image_tmp, $upload_path)) {
                $sql = "INSERT INTO `hospitals` (`hospital_name`, `location`, `image`, `details`, `contact`) 
                        VALUES ('$name', '$location', '$new_image_name', '$details', '$contact')";
                
                if (mysqli_query($conn, $sql)) {
                    header("Location: view_hospital.php");
                    exit();
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                echo "Failed to upload image.";
            }
        } else {
            echo "Invalid file format. Only JPG, JPEG, PNG, and GIF are allowed.";
        }
    } else {
        echo "Please upload a valid hospital image.";
    }

}

if(isset($_POST['update_hospital_name'])) {
    $id = intval($_POST['hospital_id']);
    $name = mysqli_real_escape_string($conn, $_POST['update_hospital_name']);
    $location = mysqli_real_escape_string($conn, $_POST['update_hospital_location']);
    // $description = mysqli_real_escape_string($conn, $_POST['update_hospital_Description']);
    // $imageName = "";
    // $updateImageSQL = "";

    // Handle File Upload
    // if(isset($_FILES['hospital_image']) && $_FILES['hospital_image']['error'] == 0) {
    //     $targetDir = "uploads-images/";
    //     $imageName = basename($_FILES["hospital_image"]["name"]);
    //     $targetFilePath = $targetDir . $imageName;
    //     $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    //     // Validate file type
    //     $allowedTypes = array("jpg", "jpeg", "png");
    //     if(in_array($imageFileType, $allowedTypes)) {
    //         if(move_uploaded_file($_FILES["hospital_image"]["tmp_name"], $targetFilePath)) {
    //             // Image uploaded successfully, update database
    //             $updateImageSQL = ", `image`='$imageName'";
    //         } else {
    //             $updateImageSQL = "";
    //         }
    //     } else {
    //         $updateImageSQL = "";
    //     }
    // } else {
    //     $updateImageSQL = "";
    // }

    // Update query with image if uploaded
    $sql = "UPDATE `hospitals` SET `hospital_name`='$name', `location`='$location' WHERE `hospital_id` = $id";

    if(mysqli_query($conn, $sql)) {
        header("Location: view_hospital.php?success=1");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}


if(isset($_POST['request_date'])){
    $request_id = $_POST['request_id'];
    $request = $_POST['request_date'];
    $status = $_POST['status'];

    $sql = "INSERT INTO `appointment_requests`(`parent_id`, `vaccine_id`, `request_date`, `status`) VALUES (1,1,'$request_date', '$status')";
    
    if(mysqli_query($conn, $sql)){
        header("Location: view_appointment.php");
    }

}

if(isset($_POST['update_appointment_name'])){
    $request_id = $_POST['request_id'];
    $request_date = $_POST['update_appointment_name'];
    $status = $_POST['update_appointment_location'];

    $sql = "UPDATE `appointment_requests` SET `request_date`='$request_data',`status`='$status' WHERE request_id=$id";
    
    if(mysqli_query($conn, $sql)){
        header("Location: view_appointment.php");
    }

}
?>