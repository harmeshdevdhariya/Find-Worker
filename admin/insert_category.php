<?php
$con = mysqli_connect("localhost", "root", "", "findworker");

// Initialize variables
$showAlert = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $servicetype = $_POST["servicetype"];
    $description = $_POST["description"];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $target_dir = "uploads/";

    // Check whether this category already exists
    $existSql = "SELECT * FROM `categories` WHERE servicetype = '$servicetype'";
    $result = mysqli_query($con, $existSql);
    $numExistRows = mysqli_num_rows($result);

    if ($numExistRows > 0) {
        $showError = "Sorry, the service category already exists.";
    } else {
        // Insert the record into the database
        $query = "INSERT INTO categories (servicetype, description, image) VALUES ('$servicetype', '$description', '')";
        $res = mysqli_query($con, $query);

        if ($res) {
            $insertedId = mysqli_insert_id($con); // Get the ID of the inserted record

            // Rename and move the image file to the desired directory
            $new_image_name = $insertedId . "." . pathinfo($image, PATHINFO_EXTENSION);
            $target_file = $target_dir . $new_image_name;

            if (move_uploaded_file($image_tmp, $target_file)) {
                // Update the image field in the database with the new image name
                mysqli_query($con, "UPDATE categories SET image='$new_image_name' WHERE id='$insertedId'");

                $showAlert = true;
            } else {
                $showError = "Image upload failed.";
            }
        } else {
            $showError = "Failed to insert record.";
        }
    }
    
    if ($showAlert) {
        header("Location: addcategory.php?alert=success");
    } else {
        header("Location: addcategory.php?alert=error");
    }
    exit();
}
?>

<!-- Your HTML code for the form here -->

