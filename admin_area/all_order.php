<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Orders</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
  <h2>Orders</h2>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Order ID</th>
          <th>Billing Name</th>
          <th>Billing Mobile</th>
          <th>Billing Email</th>
          <th>Shipping Name</th>
          <th>Shipping Mobile</th>
          <th>Shipping Email</th>
          <th>Payment Option</th>
          <th>Pay Amount</th>
          <th>Address</th>
          <th>Note</th>
          <th>Created At</th>
          <th>RPay Order ID</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Database connection
        include('../includes/connect.php');
        
        // Check connection
   
        
        // Fetching data from the database
        $sql = "SELECT * FROM orders";
        $result = mysqli_query($con, $sql);
        
        // Displaying data
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>". $row['id'] ."</td>";
                echo "<td>". $row['order_id'] ."</td>";
                echo "<td>". $row['billing_name'] ."</td>";
                echo "<td>". $row['billing_mobile'] ."</td>";
                echo "<td>". $row['billing_email'] ."</td>";
                echo "<td>". $row['shipping_name'] ."</td>";
                echo "<td>". $row['shipping_mobile'] ."</td>";
                echo "<td>". $row['shipping_email'] ."</td>";
                echo "<td>". $row['payment_option'] ."</td>";
                echo "<td>". $row['pay_amount'] ."</td>";
                echo "<td>". $row['address'] ."</td>";
                echo "<td>". $row['note'] ."</td>";
                echo "<td>". $row['created_at'] ."</td>";
                echo "<td>". $row['rpay_order_id'] ."</td>";
                echo "</tr>";
            }
            // Free result set
            mysqli_free_result($result);
        } else{
            echo "No records found.";
        }
        
        // Close connection
        mysqli_close($con);
        ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
