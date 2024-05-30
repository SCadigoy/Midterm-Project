<?php
session_start();
include("php/config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Details</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Home</a></p>
        </div>
        <div class="right-links">
            <a href="#">Change Details</a>
            <a href="logout.php"><button class="btn">Log Out</button></a>
        </div>
    </div>

    <div class="container">
        <div class="box form-box">
            <?php
                if(isset($_POST['submit'])){
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];

                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    $edit_query = mysqli_query($conn, "UPDATE users SET Username='$username', Email='$email', Password='$hashed_password' WHERE Id={$_SESSION['user_id']}") or die("Error Occured");

                    if($edit_query){
                        echo "<div class='message'>
                                     <p>Details Updated</p>
                              </div> <br>";
                        echo "<a href='home.php'><button class='btn'>Go Home</button>";
                    }
                }else{
                    $id = $_SESSION['user_id'];
                    $query = mysqli_query($conn,"SELECT * FROM users WHERE Id=$id");

                    while($result = mysqli_fetch_assoc($query)){
                        $res_Username = $result['username'];
                        $res_Email = $result['email'];
                        $res_Password= $result['password'];
                    }
            ?>
            <header>Change Details</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value=" <?php echo $res_Username; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value=" <?php echo $res_Email; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value=" <?php echo $res_Password; ?>" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Update" required>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>
