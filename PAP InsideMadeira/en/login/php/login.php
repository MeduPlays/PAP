<?php
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $user_password = $_POST['password']; // Change variable name to avoid conflict

    // Database connection
    $servername = "localhost";
    $username = "root";
    $db_password = ""; // Change variable name to avoid conflict
    $database = "insidemadeira";

    // Create connection
    $conn = new mysqli($servername, $username, $db_password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare a SQL statement to retrieve user data
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, verify password
        $row = $result->fetch_assoc();
        if (password_verify($user_password, $row['password'])) {
            // Authentication successful, store user info in session
            $_SESSION['email'] = $email;
            header('Location: ../../front_page_login/index.html'); // Redirect to restricted page
            exit();
        } else {
            // Invalid password, redirect back to login page
            header('Location: ../register_user.html?error=invalid_password');
            exit();
        }
    } else {
        // User not found, redirect back to login page
        header('Location: ../register_user.html?error=user_not_found');
        exit();
    }

    $conn->close();
}
?>


<html>
    <body>
        <h1>hello world</h1>
    </body>
</html>