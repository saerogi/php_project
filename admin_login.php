<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login Page</title>
<style>
    
    body {
        background-color: #ffc107; 
        color: #fff; 
        font-family: 'Poppins', sans-serif; 
        margin: 0;
        height: 100vh; 
        display: flex;
        flex-direction: column;
        justify-content: center; 
        align-items: center;
    }

    .login-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        width: 300px;
    }

    h2 {
        text-align: center;
        color: #000; 
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        color: #000; 
    }

    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #000;
        border-radius: 3px;
    }

    button {
        width: 100%;
        padding: 10px;
        background-color: #ffc107; /* Background color set to #ffc107 */
        color: #fff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    button:hover {
        background-color: #fcd357; /* Hover background color set to #fcd357 */
    }
</style>
</head>
<body>

<div class="login-container">
    <h2>Admin Login</h2>
    <form action="add_product.php" method="POST">
        <div class="form-group">
            <label for="admin_email">Email:</label>
            <input type="email" id="admin_email" name="admin_email" required>
        </div>
        <div class="form-group">
            <label for="admin_password">Password:</label>
            <input type="password" id="admin_password" name="admin_password" required>
        </div>
        <button type="submit" name="admin_login">Login</button>
    </form>
</div>
<?php
// Database connection
$servername = "localhost";
$username = "root"; // Change this to your database username
$db_password = ""; // Change this to your database password
$dbname = "php_project"; // Change this to your database name

$conn = new mysqli($servername, $username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get admin input
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    
    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM admin WHERE admin_email = ? AND admin_password = ?");
    $stmt->bind_param("ss", $admin_email, $admin_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Redirect to newlog.php upon successful authentication
        header("Location: add_product.php");
        exit(); 
    } else {
        echo "<p>Invalid email or password.</p>";
    }

    $stmt->close();
    $conn->close();
}
?>


</body>
</html>