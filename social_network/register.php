<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<div class="container">
    <div class="box form-box">
<?php
include("php/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);


    $sql = "SELECT * FROM Users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='message'>
                <p>This email is used, Try another again</p>
              </div> <br>";
        echo "<a href='register.php'><button class='btn'>Go Back</button>";
    } else {

        $sql = "INSERT INTO Users (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo "<div class='message'>
                    <p>Registrated Successfully</p>
                  </div> <br>";
            echo "<a href='login.php'><button class='btn'>Login</button>";
        }
    }
}       else {
         
?>
        <header>Sign Up</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                
                    <input type="submit" class="btn" name="submit" value="Sign Up" required>
                </div>
                <div class="link">
                    Already have an account? <a href="login.php">Login</a>
                </div>
            </form>
    </div>
    <?php } ?>
</div>
</body>
</html>
