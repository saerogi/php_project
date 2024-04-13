<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        /* CSS for header */
        body {
            background-color: #ffc107;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            padding-top: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .nav-links {
            list-style: none;
            display: flex;
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

        /* CSS for registration form */
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 2px solid #ffc107;
            border-radius: 5px;
            background-color: #fff;
        }

        label {
            color: #000;
            font-weight: bold;
        }

        input[type=text],
        input[type=email],
        input[type=tel],
        input[type=password] {
            width: 100%;
            padding: 12px;
            margin: 6px 0;
            box-sizing: border-box;
            border: 1px solid #000;
        }

        input[type=submit] {
            background-color: #ffc107;
            color: black;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .error {
            color: red;
            font-size: 0.6em;
            display: block;
            width: 100%;
            text-align: right;
            height: 1.2em;
        }

        .required::before {
            content: "*";
            color: red;
            margin-right: 3px;
        }

        .container-fluid {
            padding: 0;
        }

        .oxyy-login-register {
            height: 100vh;
        }

        .custom-box {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
        }

        /* Additional style for the welcome text */
        .welcome-text {
            font-size: 24px;
            font-weight: bold;
            color: #ffc107;
        }
    </style>
</head>

<body>

    <header class="header">
        <div class="container">
            <div class="logo">
                <h1><b>Welcome to Edible Era</b></h1>
            </div>
            
        </div>
    </header>

    <!-- Registration Form -->
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="fullname">Full Name:</label><br>
        <input type="text" id="fullname" name="fullname" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="phone">Phone Number:</label><br>
        <input type="text" id="phone" name="phone" required><br>
        <label for="address">Address:</label><br>
        <input type="text" id="address" name="address"><br> <!-- New address field -->
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Register" id="register-btn">
    </form>

    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = isset($_POST['address']) ? $_POST['address'] : ''; // New address field
        $password = $_POST['password'];

        // Database connection
        $servername = "localhost";
        $username = "root";
        $password_db = "";
        $dbname = "php_project";

        $conn = new mysqli($servername, $username, $password_db, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query to insert data into "users" table with plain text password
        $sql = "INSERT INTO users (user_name, user_email, user_phno, user_address, user_password)
            VALUES ('$fullname', '$email', '$phone', '$address', '$password')";

        if ($conn->query($sql) === TRUE) {
            // JavaScript for popup message
            echo "<script>alert('Welcome to Edible Era, you are registered!');</script>";
            header("Location: newlog.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>

</body>

</html>
