<?php
session_start();
include 'db.php';

$book_id = isset($_GET['id']) ? $_GET['id'] : 0;

$sql = "SELECT * FROM books WHERE id = $book_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $book = $result->fetch_assoc();
} else {
    echo "Book not found!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['rating'])) {
    $rating = (int)$_POST['rating']; 

    if ($rating < 1 || $rating > 5) {
        echo '<div class="alert alert-danger">Rating must be between 1 and 5.</div>';
    } else {
        $email = $_SESSION['email'];
        $user_query = "SELECT id FROM user WHERE email = '$email'";
        $user_result = $conn->query($user_query);

        if ($user_result && $user_result->num_rows > 0) {
            $user = $user_result->fetch_assoc();
            $user_id = $user['id'];

            // Insert rating into the ratings table
            $rating_query = "INSERT INTO rating (bookid, userid, value) VALUES ($book_id, $user_id, $rating)";
            if ($conn->query($rating_query) === TRUE) {
                echo '<div class="alert alert-success">Rating submitted successfully!</div>';
            } else {
                echo '<div class="alert alert-danger">Error submitting rating: ' . $conn->error . '</div>';
            }
        } else {
            echo '<div class="alert alert-danger">User not found!</div>';
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'])) {
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);  

    $email = $_SESSION['email'];
    $user_query = "SELECT id FROM user WHERE email = '$email'";
    $user_result = $conn->query($user_query);

    if ($user_result && $user_result->num_rows > 0) {
        $user = $user_result->fetch_assoc();
        $user_id = $user['id'];  

        // Insert comment into the comments table
        $comment_query = "INSERT INTO comment (bookid, userid, content) VALUES ($book_id, $user_id, '$comment')";
        if ($conn->query($comment_query) === TRUE) {
            echo '<div class="alert alert-success">Comment posted successfully!</div>';
        } else {
            echo '<div class="alert alert-danger">Error posting comment: ' . $conn->error . '</div>';
        }
    } else {
        echo '<div class="alert alert-danger">User not found!</div>';
    }
}


$comments_query = "SELECT content, userid FROM comment WHERE bookid = $book_id ORDER BY content DESC; ";
$comments_result = $conn->query($comments_query);


$rating_query = "SELECT AVG(value) AS average_rating FROM rating WHERE bookid = $book_id";
$rating_result = $conn->query($rating_query);
$average_rating = 0;
if ($rating_result && $rating_result->num_rows > 0) {
    $rating_data = $rating_result->fetch_assoc();
    $average_rating = round($rating_data['average_rating'], 1);  
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details - <?php echo htmlspecialchars($book['title']); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <a class="navbar-brand" href="index.php">
            <img src="logo.jfif" alt="Library Logo" style="width:40px; margin-right: 10px;" class="rounded-pill">
            Library</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="popular_books.php">Popular Books</a></li>
                <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="feedback.php">Feedback</a></li>
                <li class="nav-item"><a class="nav-link" href="aboutus.php">About Us</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img width=350 height=550 src="./image/<?php echo $book['coverimage']; ?>"> 
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="card-title"><?php echo htmlspecialchars($book['title']); ?></h3>
                        <p class="card-text"><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
                        <p class="card-text"><strong>Genre:</strong> <?php echo htmlspecialchars($book['genre']); ?></p>
                        <p class="card-text"><strong>Published:</strong> <?php echo htmlspecialchars($book['year']); ?></p>
                        <p class="card-text"><strong>Summary:</strong> <?php echo htmlspecialchars($book['summary']); ?></p>

                        <br>

             
                        <hr>
                        <h5>Average Rating: <?php echo $average_rating ? $average_rating : 'No ratings yet'; ?>/5</h5>
                    
                        <hr>

                     
                        <h5>Your Rating:</h5>
                        <form method="POST">
                            <input type="number" class="form-control rating-input" id="rating-input" name="rating" min="1" max="5" placeholder="1-5" required>
                            <button class="btn btn-primary mt-3" type="submit">Submit Rating</button>
                        </form>

                        <hr>

                    
                        <h5>Leave a Comment</h5>
                        <form method="POST">
                            <div class="form-group">
                                <label for="userComment">Your Comment</label>
                                <textarea class="form-control" id="userComment" name="comment" rows="3" placeholder="Write your comment here..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Post Comment</button>
                        </form>

                        <hr>
                        <h6>Comments:</h6>
                        <div class="list-group">
                            <?php
                            if ($comments_result && $comments_result->num_rows > 0) {
                               
                                while ($comment = $comments_result->fetch_assoc()) {
                                    $user_id = $comment['userid'];
                                    $comment_content = htmlspecialchars($comment['content']);  

                                    $user_query = "SELECT name FROM user WHERE id = $user_id";
                                    $user_result = $conn->query($user_query);

                                    if ($user_result && $user_result->num_rows > 0) {
                                        $user = $user_result->fetch_assoc();

                                        echo '<div class="card mb-3">';
                                        echo '<div class="card-body">';
                                        echo '<h6 class="card-title">' . htmlspecialchars($user['name']) . '</h6>';
                                        echo '<p class="card-text">' . $comment_content . '</p>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                }
                            } else {
                                echo '<div class="alert alert-warning">No comments available for this book.</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-danger btn-block" onclick="location.href='home.php'">Back</button>

    </div>
</body>
</html>
