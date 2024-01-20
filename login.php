<?php

session_start();
include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // SQL query to check if the username and password match a record in the database
    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Valid user, set session and redirect to a welcome page
        $_SESSION["username"] = $username;
        header("Location: index.php");
        exit();
    } else {
        // Invalid credentials, display an error message
        $error = "Invalid username or password";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liverpool Shop</title>
    <link rel="icon" href="image/Liverpool_FC.png" type="image/png">
    <link rel="stylesheet" href="styles.css">
</head>
<body style="background: url('image/anfield.jpg') center/cover no-repeat;">
    <center>
    <div class="container">
        <div class="card">
            <div class="card-title text-center">
				<h1>Login</h1><br>
			</div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="username">Username:</label>
                <input type="text" name="username" required>
                <br><br>
                <label for="password">Password:</label>
                <input type="password" name="password" required>
                <br><br>
                <button type="submit">Login</button>
            </form>
            <?php
            if (isset($error)) {
                echo "<p class='error'>$error</p>";
            }?>
        </div>
    </div>
    </center>
</body>
</html>