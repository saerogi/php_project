<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Page</title>
<style>
   
    body {
        background-color: #ffc107; 
        color: #fff; 
        font-family: 'Poppins', sans-serif; 
        margin: 0;
        height: 100vh; 
        display: flex;
        flex-direction: column; 
        justify-content: flex-start; 
        align-items: center; 
        padding-top: 20px; 
    }

    .header {
        width: 100%;
        background-color: #ffc107; 
        padding: 20px 0; 
        box-sizing: border-box;
        display: flex;
        justify-content: space-between;
        align-items: center; }

    .logo {
        font-size: 24px;
        font-weight: bold;
        margin-left: 20px; 
    }

    .nav-links {
        list-style: none;
        display: flex;
        margin-right: 20px; /* Add right margin to the nav links */
    }

    .nav-links li {
        margin-left: 20px;
    }

    .nav-links a {
        text-decoration: none;
        color: #fff;
        font-weight: bold;
        transition: color 0.3s ease;
    }

    .nav-links a:hover {
        color: #fcd357;
    }

    /* Additional custom styles */
    .login-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        width: 300px;
    }

    h2 {
        text-align: center;
        color: #000; /* Set h2 text color to black */
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
        background-color: #ffc107; 
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
<header class="header">
    <div class="logo">
        <h1><b>Welcome to Edible Era</b></h1>
    </div>
    
</header>

<div class="login-container">
    <h2>Login</h2>
    <form action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" name="login">Login</button>
    </form>
    <p>If not registered, <a href="finalregister.php">Click here to register</a>.</p>
</div>

<?php
// Database connection
$servername = "localhost";
$username = "root"; 
$db_password = ""; 
$dbname = "php_project"; 

$conn = new mysqli($servername, $username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $email = $_POST['email'];
    $user_password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE user_email = '$email' AND user_password = '$user_password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      
        header("Location: index.php");
        exit(); 
    } else {
       
        echo "<p>Invalid email or password.</p>";
    }

    $conn->close();
}
?>

</body>
</html>
