<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "insidemadeira";

$conn = mysqli_connect($servername, $username, $password, $database);
if(!$conn){
die("Falha na conexao: " . mysqli_connect_error());
}else{
//echo "Conexao realizada com sucesso";
}


session_start();

// Simulated user database
$users = [
    'user1' => 'password1',
    'user2' => 'password2'
];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verify credentials
    if (isset($users[$username]) && $users[$username] === $password) {
        // Authentication successful, store user info in session
        $_SESSION['username'] = $username;
        header("Location: ../../front_page_login/index.html"); // Redirect to restricted page
        exit();
    } else {
        // Authentication failed, redirect back to login page
        header("Location: register_user.html");
        exit();
    }
}
?>
