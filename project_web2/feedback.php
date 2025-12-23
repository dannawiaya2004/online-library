<?php
session_start();
include 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userid = $_SESSION['userid']; 
    $message = trim($_POST['message']);

    if (empty($message)) {
        $error_message = "Please enter a feedback message.";
    } else {
        $query = "INSERT INTO feedback (userid, message) VALUES ('$userid', '$message')";

        if ($conn->query($query) === TRUE) {
            $success_message = "Feedback submitted successfully!";
        } else {
            $error_message = "Error submitting feedback: " . $conn->error;
        }
    }
}

$sql = "SELECT id, userid, message, date FROM feedback ORDER BY date DESC";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        h2 {
            font-weight: bold;
            color: #343a40;
            margin-top: 20px;
        }
        .feedback-card {
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin-bottom: 20px;
        }
        .feedback-card .feedback-message {
            color: #6c757d;
            margin-top: 10px;
        }
        .feedback-card .feedback-date {
            font-size: 0.8em;
            color: #868e96;
            margin-top: 10px;
        }
        .container {
            max-width: 800px;
            margin-top: 50px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <a class="navbar-brand" href="index.php">Library</a>
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


    <div class="container">
        <h2 class="text-center">Feedback Page</h2>

        <?php if (isset($success_message)) { ?>
            <div class="alert alert-success text-center"><?php echo $success_message; ?></div>
        <?php } ?>
        <?php if (isset($error_message)) { ?>
            <div class="alert alert-danger text-center"><?php echo $error_message; ?></div>
        <?php } ?>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Submit Your Feedback</h5>
                <form method="POST">
                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit Feedback</button>
                </form>
            </div>
        </div>

       
    </div>
</body>
</html>
