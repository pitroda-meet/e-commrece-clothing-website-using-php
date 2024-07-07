<?php
// Include database connection file
include('../includes/connect.php');

// Check if the connection is successful
if ($con) {
    // Check if a delete request is made
    if(isset($_GET['id'])) {
        $men_id = $_GET['id'];
        
        // Delete slider image
        $delete_query = "DELETE FROM menslider WHERE men_id = '$men_id'";
        $delete_result = mysqli_query($con, $delete_query);
        
        if($delete_result) {
            echo "<script>alert('Slider image deleted successfully!');</script>";
            // Redirect to refresh the page after deletion
            echo "<script>window.location.href='updatemenslider.php'</script>";
            exit(); // To prevent further execution of the script after redirection
        } else {
            echo "<script>alert('Failed to delete slider image.');</script>";
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
