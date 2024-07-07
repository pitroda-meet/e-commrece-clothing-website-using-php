<?php
// Include database connection file
include('../includes/connect.php');
?>
<?php


// Start the session before any output
session_start();

// Check if the connection is successful
if ($con) {
    // Check if user ID is provided
    if(isset($_GET['id'])) {
        $user_id = $_GET['id'];
        
        // Fetch user details based on the provided ID
        $sql = "SELECT * FROM registration WHERE user_id = '$user_id'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        
        // Check if user exists
        if($row) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Retrieve form data
                $user_image=$_POST['user_image'];
                $name = $_POST["name"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $phone=$_POST["phone"];
                
                // Check if a new image is uploaded
                if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    // Process the uploaded image
                    $image_tmp = $_FILES['image']['tmp_name'];
                    $image_name = $_FILES['image']['name'];
                    $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
                    $image = uniqid() . '.' . $image_extension;
                    $upload_path = '../userimage/' . $image;
                    move_uploaded_file($image_tmp, $upload_path);
                    
                    // Update user details with the new image
                    $update_query = "UPDATE registration SET user_image='$image', name='$name', email='$email', password='$password' WHERE user_id='$user_id'";
                } else {
                    // Update user details without changing the image
                    $update_query = "UPDATE registration SET name='$name', email='$email', password='$password' WHERE user_id='$user_id'";
                }
                
                $update_result = mysqli_query($con, $update_query);
                
                // Redirect to user list page
                header("Location: delete_user.php");
                exit();
            }
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Edit User Profile</title>
    <!-- Bootstrap CSS -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet'>
</head>
<body>
    <div class='container mt-4'>
        <h2 class='mb-4'>Edit User Profile</h2>
        <form method='post' enctype='multipart/form-data'>
            <div class='mb-3'>
                <label for='image' class='form-label'>Image</label>
                <img src="../userimage/<?php echo $row['user_image'] ?>" width="70" height="70"  alt="Profile Photo" style="max-width: 100%;">

                <input type='file' class='form-control' id='image' name='image'>
            </div>
            <div class='mb-3'>
                <label for='name' class='form-label'>Name</label>
                <input type='text' class='form-control' id='name' name='name' value='<?php echo $row["name"]; ?>' required>
            </div>
            <div class='mb-3'>
                <label for='email' class='form-label'>Email</label>
                <input type='email' class='form-control' id='email' name='email' value='<?php echo $row["email"]; ?>' required>
            </div>
            <div class='mb-3'>
                <label for='name' class='form-label'>phone</label>
                <input type='text' class='form-control' id='phone' name='phone' value='<?php echo $row["phone"]; ?>' required>
            </div>
            <div class='mb-3'>
                <label for='password' class='form-label'>Password</label>
                <input type='password' class='form-control' id='password' name='password' value='<?php echo $row["password"]; ?>' required>
            </div>
            <button type='submit' class='btn btn-primary'>Update</button>
        </form>
    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
</body>
</html>
<?php
        } else {
            echo "<div class='container mt-4'><p class='text-center'>User not found!</p></div>";
         }
    // } else {
    //     echo "<div class='container mt-4'><p class='text-center'>User ID not provided!</p></div>";
     }
} else {
    echo "<div class='container mt-4'><p class='text-center'>Failed to connect to the database.</p></div>";
}
?>
