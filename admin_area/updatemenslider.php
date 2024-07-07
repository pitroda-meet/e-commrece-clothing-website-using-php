<?php
// Include database connection file
include('../includes/connect.php');

// Check if the connection is successful
if ($con) {
    // Check if a delete request is made
    if(isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['men_id'])) {
        $men_id = $_GET['men_id'];
        
        // Delete slider image
        $delete_query = "DELETE FROM menslider WHERE men_id = '$men_id'";
        $delete_result = mysqli_query($con, $delete_query);
        
        if($delete_result) {
            echo "<script>alert('Slider image deleted successfully!');</script>";
        } else {
            echo "<script>alert('Failed to delete slider image.');</script>";
        }
    }
    
    // Check if update form is submitted
    if(isset($_POST['update_slider'])) {
        $men_id = $_POST['men_id'];
        $slider_title = $_POST['slider_title'];

        // Check if a new image is uploaded
        if(isset($_FILES['slider_image']) && $_FILES['slider_image']['error'] === UPLOAD_ERR_OK) {
            $slider_image = $_FILES['slider_image']['name'];
            $temp_image = $_FILES['slider_image']['tmp_name'];

            // Move the uploaded file to the destination directory
            move_uploaded_file($temp_image, "./slider_image/$slider_image");

            // Update slider title and image
            $update_query = "UPDATE menslider SET slider_title = '$slider_title', slider_image = '$slider_image' WHERE men_id = '$men_id'";
            $update_result = mysqli_query($con, $update_query);

            if($update_result) {
                echo "<script>alert('Slider image updated successfully!');</script>";
            } else {
                echo "<script>alert('Failed to update slider image.');</script>";
            }
        } else {
            // Update slider title only (without changing the image)
            $update_query = "UPDATE menslider SET slider_title = '$slider_title' WHERE men_id = '$men_id'";
            $update_result = mysqli_query($con, $update_query);

            if($update_result) {
                echo "<script>alert('Slider title updated successfully!');</script>";
            } else {
                echo "<script>alert('Failed to update slider title.');</script>";
            }
        }
    }

    // Step 2: Execute a SELECT query to retrieve all slider images
    $sql = "SELECT * FROM menslider";
    $result = mysqli_query($con, $sql);

    // Check if there are any slider images
    if ($result && mysqli_num_rows($result) > 0) {
        echo "<!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Slider Images</title>
                    <!-- Bootstrap CSS -->
                    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet'>
                </head>
                <body>
                    <div class='container mt-4'>
                        <h2 class='mb-4'>Slider Images</h2>
                        <div class='table-responsive'>
                            <table class='table table-striped'>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>";

        while ($row = mysqli_fetch_assoc($result)) {
            $men_id = $row["men_id"];
            $slider_title = $row["slider_title"];
            $slider_image = $row["slider_image"];

            echo "<tr>
                    <td>$men_id</td>
                    <td>
                        <form method='post' enctype='multipart/form-data'>
                            <input type='hidden' name='men_id' value='$men_id'>
                            <input type='text' name='slider_title' value='$slider_title' required>
                            <input type='file' name='slider_image'>
                            <button type='submit' name='update_slider' class='btn btn-primary btn-sm'>Update</button>
                        </form>
                    </td>
                    <td><img src='./slider_image/$slider_image' alt='Slider Image' style='max-width: 100px;'></td>
                    <td>
                        <a href='deletemenslider.php?id=$men_id' class='btn btn-danger btn-sm'>Delete</a>
                    </td>
                </tr>";
        }

        echo "</tbody></table>
            </div>
        </div>
        <!-- Bootstrap Bundle with Popper -->
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js'></script>
    </body>
    </html>";
    } else {
        echo "<div class='container mt-4'><p class='text-center'>No slider images found!</p></div>";
    }
} else {
    echo "<div class='container mt-4'><p class='text-center'>Failed to connect to the database.</p></div>";
}
?>
