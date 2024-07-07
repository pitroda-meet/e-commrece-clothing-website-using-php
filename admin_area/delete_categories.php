<?php
// Include database connection file
include('../includes/connect.php');

// Check if the connection is successful
if ($con) {
    // Check if a delete request is made
    if(isset($_GET['id'])) {
        $category_id = $_GET['id'];
        
        // Delete category
        $delete_query = "DELETE FROM categories WHERE category_id = '$category_id'";
        $delete_result = mysqli_query($con, $delete_query);
        
        if($delete_result) {
            echo "<script>alert('Category deleted successfully!');</script>";
            // Redirect to refresh the page after deletion
            echo "<script>window.location.href='update_categories.php'</script>";
            exit(); // To prevent further execution of the script after redirection
        } else {
            echo "<script>alert('Failed to delete category.');</script>";
            // Redirect to refresh the page after deletion
            echo "<script>window.location.href=''</script>";
            exit(); // To prevent further execution of the script after redirection
        }
    } else {
        echo "<script>alert('Invalid request.');</script>";
        // Redirect to refresh the page after deletion
        echo "<script>window.location.href=''</script>";
        exit(); // To prevent further execution of the script after redirection
    }
} else {
    echo "<div class='container mt-4'><p class='text-center'>Failed to connect to the database.</p></div>";
}
?>
