<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="style/style.css">
    </head>
    <body>
        <div class="container">
            <div class="box form-box">
<?php
session_start();

include("php/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            header("Location: home.php");
            exit;
        } else {
            echo "<div class='message'>
                    <p>Wrong Username or Password</p>
                  </div> <br>";
            echo "<a href='login.php'><button class='btn'>Go Back</button>";
        }
    } else {
        echo "<div class='message'>
                <p>Account Not Found</p>
              </div> <br>";
        echo "<a href='register.php'><button class='btn'>Sign Up</button>";
    }
} else {
    ?>

                <header>Login</header>
                <form action="" method="post">
                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" required>
                    </div>

                    <div class="field input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required>
                    </div>

                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Login" required>
                    </div>
                    <div class="link">
                        Don't have an account? <a href="register.php">Sign Up</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
    </html>
    <?php
}
?>
