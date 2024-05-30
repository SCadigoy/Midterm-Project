<?php
session_start();

include("php/config.php");

// Handle post submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle post submission
    if (isset($_POST['content'])) {
        $content = $_POST["content"];
        // You may fetch user_id from the session if it's available
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

        $sql = "INSERT INTO posts (user_id, content, created_at) VALUES ('$user_id', '$content', NOW())";
        if ($conn->query($sql) === TRUE) {
            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['comment']) && isset($_POST['post_id'])) {
        $comment_content = $_POST['comment'];
        $post_id = $_POST['post_id'];
        // You may fetch user_id from the session if it's available
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

        $sql = "INSERT INTO comments (post_id, user_id, content, created_at) VALUES ('$post_id', '$user_id', '$comment_content', NOW())";
        if ($conn->query($sql) === TRUE) {
            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Invalid request.";
    }
}

// Retrieve posts from the database
$sql = "SELECT posts.*, users.username AS username FROM posts INNER JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Home</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p>Home</p>
        </div>
        <div class="right-links">
            <?php
            if(isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                $query = mysqli_query($conn, "SELECT * FROM users WHERE id = $user_id");

                if ($query) {
                    while ($row = mysqli_fetch_assoc($query)) {
                        $res_username = $row['username'];
                        $res_email = $row['email'];
                        $res_id = $row['id'];
                    }
                    echo "<a href='change.php?Id=$res_id'>Change Details</a>";
                }
            }
            ?>
            <a href="php/logout.php"><button class="btn">Log Out</button></a>
        </div>
    </div>
    <main class="flex-container">
        <div class="main-box top">
            <div class="top">
                <div class="box">
                    <p>Hello <b><?php echo $res_username ?></b>, Welcome</p>
                </div>
            </div>
        </div>
        <div class="main-box bottom">
        <div class="bottom">
        <div class="box">
            <h2>Create a new post</h2>
            <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <textarea name="content" rows="4" cols="50"></textarea><br>
                <input type="submit" class = "primary_btn" value="Create Post">
            </form>
            
            <br>
            <h3>Recent Posts</h3>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $post_id = $row["id"];
                    $post_content = $row["content"];
                    $post_date = $row["created_at"];
                    $username = $row["username"];

                    echo "<br>";
                    echo "<small>Posted by $username on $post_date</small>";
                    echo "<div class='post-content'>";
                    echo "<p> • $post_content</p>";
                    echo "</div>";

                    $sql_comments = "SELECT comments.*, users.username AS comment_username 
                                    FROM comments INNER JOIN users ON comments.user_id = users.id 
                                    WHERE comments.post_id = $post_id ORDER BY comments.created_at DESC";
                    $comments_result = $conn->query($sql_comments);

                    if ($comments_result->num_rows > 0) {
                        echo "<ul>";
                        while ($comment = $comments_result->fetch_assoc()) {
                            $comment_content = $comment["content"];
                            $comment_date = $comment["created_at"];
                            $comment_username = $comment["comment_username"];

                            echo "<div class='comment-content'>";
                            echo "<p> • $comment_content <small>Commented by $comment_username on $comment_date</small></p>";
                            echo "</div>";
                        }
                        echo "</ul>";
                    }

                    echo "<form method='POST' action='{$_SERVER["PHP_SELF"]}'>";
                    echo "<input type='hidden' name='post_id' value='$post_id'>";
                    echo "<input type='text' name='comment'>";
                    echo "<input type='submit' class = 'primary_btn' value='Add Comment'>";
                    echo "</form>";
                    echo "<hr>";
                }
            } else {
                echo "No posts found.";
            }
            ?>
            </div>
            </div>
        </div>
        </div>
    </main>
</body>
</html>
