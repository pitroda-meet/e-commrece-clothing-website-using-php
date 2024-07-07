<?php
include('includes/connect.php');
include('common_function.php');
session_start();

// Function to get discount amount for a given coupon code
function getCouponDiscount($coupon_code) {
    global $con;
    $coupon_code = mysqli_real_escape_string($con, $coupon_code);
    $query = "SELECT discount_amount FROM coupons WHERE coupon_code = '$coupon_code'";
    $result = mysqli_query($con, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        return $row['discount_amount'];
    }
    return 0; // Return 0 if coupon code not found
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Checkout Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

        <link rel="stylesheet" href="css.css">


    <style>
        .error {
            color: red;
        }

        /* Custom styles for form elements */
        label {
            font-weight: bold;
            color: #333;
        }

        select {
            appearance: none; /* Remove default arrow icon in select */
            background-repeat: no-repeat;
            background-position-x: 98%;
            background-position-y: center;
        }

        button[type="submit"] {
            padding: 12px 24px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        .list-group-item {
            border: none;
        }

        .badge {
            font-size: 14px;
            background-color: #007bff;
            border-radius: 50%;
            padding: 6px 8px;
        }
    </style>
</head>

<body>
    <?php
  include('navbar.php');
  ?>
       <div class="">
        <div class="" style="min-height: 1024px;">
            <div class="container mt-3">
                <div class="row">
                    <div class="col-md-9">
                        <h2 class="text-center">Basic Details</h2>
                        <form id="checkoutForm" method="post" action="">
                            <div class="mb-3">
                                <label for="name" class="form-label"> Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                <p id="nameError" style="color: red;"></p>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address" required></textarea>
                                <p id="addressError" style="color: red;"></p>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                                <p id="phoneError" style="color: red;"></p>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <p id="emailError" style="color: red;"></p>
                            </div>
                            <div class="mb-3">
                                <label for="note" class="form-label">Note</label>
                                <input type="text" class="form-control" id="note" name="note" required>
                                <p id="noteError" style="color: red;"></p>
                            </div>
                            <!-- Razorpay payment button -->
                            <div class="mb-3">
                                <button type="button" class="btn btn-primary" id="PayNow">Proceed to Payment</button>
                            </div>
                       
                        </form>
                    </div>
                   
                    <div class="col-md-3">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-primary">Order detail</span>
                            <span class="badge bg-primary rounded-pill">3</span>
                        </h4>
                        <div class="card">
                            <div class="card-body">
                                <?php
                                $user_id = $_SESSION['user_id'];
                                $cart_query = mysqli_query($con, "SELECT * FROM `cart_details` WHERE user_id = $user_id");
                                $grand_total = 0; // Initialize grand_total variable
                                if (mysqli_num_rows($cart_query) > 0) {
                                    while ($fetch_cart = mysqli_fetch_assoc($cart_query)) {
                                        $sub_total = $fetch_cart['price'] * $fetch_cart['quantity'];
                                ?>
                                <div class="card mb-3" style="max-width: 540px;">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="./admin_area/product_images/<?php echo $fetch_cart['image']; ?>" class="img-fluid rounded-start" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $fetch_cart['name']; ?></h5>
                                                <p class="card-text">Price: $<?php echo $fetch_cart['price'] * $fetch_cart['quantity']; ?>/-</p>
                                                <p >Quantity: <?php echo $sub_total; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $grand_total += $sub_total;
                                // Check if coupon code is submitted


                                    }
                                } else {
                                    echo '<div class="card-body">No items added</div>';
                                }
                                ?>
                                <ul class="list-group mb-3">
                                <form action="" method="post" action="">
                                    <div class="mb-3 input-group">
                                        <label for="coupon" class="input-group-text"> Coupon</label>
                                        <input type="text" class="form-control"  id="coupon" name="coupon" >
                                        <button class="btn btn-outline-secondary" type="submit" id="couponApplyButton">Apply</button>
                                                                      
                                        </div>
                                        <?php 
                                         if(isset($_POST['coupon'])) {
                                            $coupon_code = $_POST['coupon'];
                                            $discount_amount = getCouponDiscount($coupon_code);
                                            if($discount_amount > 0) {
                                                // Coupon applied successfully
                                                // Update the grand total with the discount
                                                $grand_total -= $discount_amount; 
                                                // Set a session variable to store the applied coupon
                                                $_SESSION['applied_coupon'] = $coupon_code;
                                                echo '<p id="couponMessage" style="color: green;">Coupon applied successfully!</p>';
                                            } else {
                                                // Coupon code not found or invalid
                                                echo '<p id="couponMessage" style="color: red;">Invalid coupon code!</p>';
                                            }
                                        } 
                                        ?>    
                                    </form>
                                   
                                   
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Total (Rupee)</span>
                                       
                                        <strong><?php echo $grand_total; ?>/-</strong>
                                        <input type="hidden" id="amount" name="total_price" value="<?php echo $grand_total; ?>"/>

                                    </li>
                                   

                                    
                                </ul>
                                <!-- Add this HTML code inside your form -->


                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script src="https://kit.fontawesome.com/d2aa397344.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- Razorpay script -->

</body>
<?php
include('footer.php');
?>

</html>
<script>
    // Update total price when applying coupon
document.getElementById("couponApplyButton").addEventListener("click", function() {
    var couponCode = document.getElementById("coupon").value;
    // AJAX request to apply coupon code and update total price
    // You need to implement this part
});

</script>
<script>
    $(document).ready(function () {
        $('#checkoutForm').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2,
                    lettersonly: true // Custom validation for alphabets only
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true,
                    minlength: 10,
                    digits: true // Validation for digits only
                },
                amount: {
                    required: true,
                    number: true,
                    min: 1 // Ensure amount is greater than zero
                },
                address: {
                    required: true
                },
                note: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Please enter your name",
                    minlength: "Name must be at least 2 characters",
                    lettersonly: "Please enter only alphabet characters"
                },
                email: {
                    required: "Please enter your email address",
                    email: "Please enter a valid email address"
                },
                phone: {
                    required: "Please enter your phone number",
                    minlength: "Phone number must be at least 10 digits",
                    digits: "Please enter only digits"
                },
                amount: {
                    required: "Please enter the amount",
                    number: "Please enter a valid number",
                    min: "Amount must be greater than zero"
                },
                address: "Please enter your address",
                note: "Please enter a note"
            },
            errorPlacement: function (error, element) {
                var errorId = element.attr('id') + "Error";
                error.appendTo($("#" + errorId));
            }
        });

        // Custom method for alphabets only validation
        $.validator.addMethod("lettersonly", function (value, element) {
            return this.optional(element) || /^[a-zA-Z\s]+$/i.test(value);
        }, "Please enter only alphabetic characters");

        $('#PayNow').click(function (e) {
            e.preventDefault();

            // Validate the form
            if ($('#checkoutForm').valid()) {
                var billing_name = $('#name').val();
                var billing_mobile = $('#phone').val();
                var billing_email = $('#email').val();
                var shipping_name = $('#name').val();
                var shipping_mobile = $('#phone').val();
                var shipping_email = $('#email').val();
                var paymentOption = "netbanking";
                var payAmount = $('#amount').val();
                var address = $('#address').val();
                var note = $('#note').val();

                var request_url = "submitpayment.php";
                var formData = {
                    billing_name: billing_name,
                    billing_mobile: billing_mobile,
                    billing_email: billing_email,
                    shipping_name: shipping_name,
                    shipping_mobile: shipping_mobile,
                    shipping_email: shipping_email,
                    paymentOption: paymentOption,
                    payAmount: payAmount,
                    address: address,
                    note: note,
                    action: 'payOrder'
                }

                $.ajax({
                    type: 'POST',
                    url: request_url,
                    data: formData,
                    dataType: 'json',
                    encode: true,
                }).done(function (data) {
                    if (data.res == 'success') {
                        var orderID = data.order_number;
                        var options = {
                            "key": data.razorpay_key,
                            "amount": data.userData.amount,
                            "currency": "INR",
                            "name": "fasion",
                            "description": data.userData.description,
                            "image": "image.png",
                            "order_id": data.userData.rpay_order_id,
                            "handler":
                             function (response) {
                                window.location.replace("payment-success.php?oid=" + orderID + "&rp_payment_id=" + response.razorpay_payment_id + "&rp_signature=" + response.razorpay_signature);
                            },
                            
                            "prefill": {
                                "name": data.userData.name,
                                "email": data.userData.email,
                                "contact": data.userData.mobile
                            },
                            "notes": {
                                "address": address,
                                "note": note
                            },
                            "config": {
                                "display": {
                                    "blocks": {
                                        "banks": {
                                            "name": 'Pay using ' + paymentOption,
                                            "instruments": [
                                                {
                                                    "method": paymentOption
                                                },
                                            ],
                                        },
                                    },
                                    "sequence": ['block.banks'],
                                    "preferences": {
                                        "show_default_blocks": true,
                                    },
                                },
                            },
                            "theme": {
                                "color": "#3399cc"
                            }
                        };
                        var rzp1 = new Razorpay(options);
                        rzp1.on('payment.failed', function (response) {
                            window.location.replace("payment-failed.php?oid=" + orderID + "&reason=" + response.error.description + "&paymentid=" + response.error.metadata.payment_id);
                        });
                        rzp1.open();
                    }

                    

                });
            }
        });
       

    });
</script>
