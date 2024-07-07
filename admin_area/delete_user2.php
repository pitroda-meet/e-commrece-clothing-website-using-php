
<?php
// Include database connection file
include('../includes/connect.php');

// Check if the connection is successful
if ($con) {
    // Check if user ID is provided
    if(isset($_GET['id'])) {
        $user_id = $_GET['id'];
        
        // Delete user based on the provided ID
        $delete_query = "DELETE FROM registration WHERE user_id = '$user_id'";
        $delete_result = mysqli_query($con, $delete_query);
        
        // Check if deletion was successful
        if($delete_result) {
            // Redirect to user list page
            header("Location: delete_user.php");
            exit();
        } else {    
            // Display error message if deletion fails
            echo "<div class='container mt-4'><p class='text-center'>Failed to delete user!</p></div>";
        }
    } else {
        // Display error message if user ID is not provided
        echo "<div class='container mt-4'><p class='text-center'>User ID not provided!</p></div>";
    }
} else {
    // Display error message if database connection fails
    echo "<div class='container mt-4'><p class='text-center'>Failed to connect to the database.</p></div>";
}
?>
