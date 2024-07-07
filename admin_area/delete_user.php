<?php
// Include database connection file
include('../includes/connect.php');

// Check if the connection is successful
if ($con) {
    // Step 2: Execute a SELECT query to retrieve all user details
    $sql = "SELECT * FROM registration";
    $result = mysqli_query($con, $sql);

    // Step 3: Fetch the results and display them in a tabular format
    if ($result && mysqli_num_rows($result) > 0) {
        echo "<!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>User List</title>
                    <!-- Bootstrap CSS -->
                    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet'>
                    <style>
                        /* Custom styles */
                        .table-responsive {
                            overflow-x: auto;
                        }
                        /* Style for image column */
                        .image-column img {
                            max-width: 80px;
                            height: auto;
                        }
                    </style>
                </head>
                <body>
                    <div class='container mt-4'>
                        <h2 class='mb-4'>User List</h2>
                        <div class='table-responsive'>
                            <table class='table table-striped table-bordered'>
                                <thead>
                                    <tr class='text-center'>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>Phone</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>";

        while ($row = mysqli_fetch_assoc($result)) {
            $image = $row["user_image"];
            $password = $row["password"];
            echo "<tr class='text-center'>
                    <td class='image-column'><img src='./userimage/$image' class='card-img-top' alt='User Image'></td>
                    <td>" . $row["name"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>$password</td>
                    <td>" . $row["phone"] . "</td>
                    <td>
                        <a href='update_user.php?id=" . $row["user_id"] . "' class='btn btn-primary btn-sm'>Update</a>
                    </td>
                    <td>
                        <a href='delete_user2.php?id=" . $row["user_id"] . "' class='btn btn-danger btn-sm'>Delete</a>
                    </td>
                  </tr>";
        }

        echo "</tbody></table>
            </div>
        </div>
        <!-- Bootstrap Bundle with Popper -->
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
    </body>
    </html>";
    } else {
        echo "<div class='container mt-4'><p class='text-center'>No users found!</p></div>";
    }
} else {
    echo "<div class='container mt-4'><p class='text-center'>Failed to connect to the database.</p></div>";
}
?>

