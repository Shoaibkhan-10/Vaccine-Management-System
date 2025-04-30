<?php 
include("header.php");
include('../admin/db.php');


if($_GET['id']){
    $id = $_GET['id'];
    $sql = "SELECT * FROM hospitals WHERE hospital_id = $id";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0){
        
        while($row = mysqli_fetch_assoc($res)){
            $name = htmlspecialchars($row["hospital_name"]);
            $location = htmlspecialchars($row["location"]);
            $des = $row["details"];
            $image = !empty($row["image"]) ? "../admin/uploads-images/" . htmlspecialchars($row["image"]) : "default_hospital.png";
            
            ?>

            <main>
                <section class="doctors section light-background p-0">
                    <div class="banner_img" style="background-image: url('<?php echo $image; ?>')"></div>

                    <div class="container-fluid p-5">
                        <div class="mt-5 ms-5">
                            <h1><?php echo $name; ?></h1>
                            <h3 class="mt-4"><?php echo $location; ?></h3>
                            <p class="mt-4" style="font-size: 1.3rem; text-align: justify;"><?php echo $des; ?></p>

                            <div class="mt-3">
                                <div class="text-center">
                                    <a href="appointment.php"><button  type="submit"  class="my_btn">Make an Appointment</button></a>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                </section>
            </main>

            <?php

        }

    } else {
        echo "<script>window.location.assign('index.php#hospital_section');</script>";
    }
}else{
    echo "<script>window.location.assign('index.php#hospital_section');</script>";
}


?>

<?php include("footer.php")?>