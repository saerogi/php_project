<?php
session_start();
include("server/connection.php");

// Function to remove item from cart by product_id
function removeItem($product_id) {
    if(isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}

if(isset($_POST['remove_from_cart'])) {
    if(isset($_POST['product_id'])) {
        removeItem($_POST['product_id']);
    }
}

// Handle "Buy now" button
if(isset($_POST['buy_now'])) {
    // Redirect to order page
    header("Location: order.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    /* Body Styles */
body {
    font-family: 'Montserrat', sans-serif;
    background-color: #f8f9f9;
    line-height: 1.6;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    
}

.container {
    flex-grow: 1;
}

.header {
    width:100%;
    background-color: #ffc107;
    color: #fff;
    padding: 15px 0;
    margin:20px;
    box-shadow: 0 2px 4px rgba(208, 243, 133, 0.1);
}

.header .container {
    display: flex;
    width:160%;
    justify-content:left;
    align-items:start;
    /* margin: -20px; */
}

.logo h1 {
    color: #fff;
    font-size: 1.8rem;
}

.nav-links {
    list-style: none;
    display: flex;
}

.nav-links li {
    margin: 0 15px;
}

.nav-links a {
    text-decoration: none;
    color: #fff;
    font-weight: bold;
    transition: color 0.3s ease;
}

.nav-links a:hover {
    color: #ffc107;
}

/* Footer Styles */
.footer {
    background-color: #ffc107;
    color: #fff;
    padding: 40px 0;
    margin-top: auto;
    width:1500px;
}

.footer .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.footer-col-1 h3,
.footer-col-2 p,
.footer-col-3 h3,
.footer-col-4 h3 {
    font-size: 1.2rem;
    margin-bottom: 20px;
}

.footer-col-2 img {
    width: 100px;
    margin-right: 10px;
}

.footer-col-3 ul,
.footer-col-4 ul {
    list-style: none;
}

.footer-col-3 ul li,
.footer-col-4 ul li {
    margin-bottom: 10px;
}

/* Cart Page Styles */
.container {
    text-align: center;
}

.table {
    margin-top: 30px;
}

.table th,
.table td {
    text-align: center;
}

.btn-primary {
    margin-top: 20px;
}

.footer {
    margin-top: 50px;
}

    </style>
</head>

<body>
    <div class="container mt-5">
        <header class="header">
            <div class="container">
                <div class="logo">
                    <h1><b>EDIBLE ERA</b></h1>
                </div>
                <nav>
                    <ul class="nav-links">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="cart1.php">Cart</a></li>
                        <li><a href="my_orders.php">My products</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <h2>Order</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Order Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    foreach($_SESSION['cart'] as $product_id => $product) {
                        echo "<tr>";
                        echo "<td><img src='{$product['product_image']}' alt='Product Image' style='max-width: 100px;'></td>";
                        echo "<td>{$product['product_name']}</td>";
                        echo "<td>{$product['product_price']}</td>";
                       
                        $order_date = date('Y-m-d H:i:s');
                        echo "<td>{$order_date}</td>";
                        echo "</tr>";

                        $sql_insert_order = "INSERT INTO orders (user_id, product_id, product_name, product_image, product_price, order_date) 
                                            VALUES ('1', '{$product_id}', '{$product['product_name']}', '{$product['product_image']}', '{$product['product_price']}', '{$order_date}')";
                        if ($conn->query($sql_insert_order) !== TRUE) {
                            echo "Error: " . $sql_insert_order . "<br>" . $conn->error;
                        }
                    }
                    
                    $_SESSION['cart'] = array();
                } else {
                    echo "<tr><td colspan='4'>Your cart is empty</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="footer">
    <div class="container">
        <div class="row">
            <div class="footer-col-1">
                <h3>Download our app</h3>
                <p>Top G5  Enabled Prodcuts with good support</p>
                <div class="app-logo">
                   
                </div>
            </div>
            <div class="footer-col-2">
                <img src="images" alt="">
                <p>Best technology enabled product?</p>
            </div>
            <div class="footer-col-3">
                <h3>Useful Links</h3>
                <ul>
                    <li>Coupons</li>
                    <li>Blog Post</li>
                    <li>Return Policy</li>
                    <li>Join Affiliate</li>
                </ul>
            </div>
            <div class="footer-col-4">
                <h3>Follow Us</h3>
                <ul>
                    <li>Facebook</li>
                    <li>Twitter</li>
                    <li>Instagram</li>
                    <li>YouTube</li>
                </ul>
            </div>
        </div>
        <hr>
        <p class="copyright">Copyright 2021 Sarthak</p>
    </div>
</div>
</body>

</html>
