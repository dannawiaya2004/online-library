<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookId = intval($_POST['book_id']); 
    $title = mysqli_real_escape_string($conn, trim($_POST['title']));
    $author = mysqli_real_escape_string($conn, trim($_POST['author']));
    $genre = mysqli_real_escape_string($conn, trim($_POST['genre']));
    $summary = mysqli_real_escape_string($conn, trim($_POST['summary']));

    if (empty($title) || empty($author) || empty($genre) || empty($summary)) {
        echo "All fields are required.";
        exit;
    }

    $update_sql = "UPDATE books SET title = '$title', author = '$author', genre = '$genre', summary = '$summary' WHERE id = $bookId";

    if ($conn->query($update_sql) === TRUE) {
        header("Location: edit-book.php?book_id=$bookId");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}


$bookDetails = null;
if (isset($_GET['book_id'])) {
    $bookId = intval($_GET['book_id']); 
    $sql = "SELECT id, title, author, genre, summary FROM books WHERE id = $bookId";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $bookDetails = $result->fetch_assoc();
    } else {
        echo "Book not found.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin-top: 50px;
        }
        h2 {
            font-weight: bold;
            color: #343a40;
            margin-bottom: 30px;
        }
        .form-group label {
            font-weight: bold;
            color: #495057;
        }
        .btn-primary {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Edit Book</h2>

        <form action="" method="POST">
            <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($bookDetails['id'] ?? ''); ?>">

            <div class="form-group">
                <label for="bookTitle">Book Title</label>
                <input type="text" class="form-control" id="bookTitle" name="title" value="<?php echo htmlspecialchars($bookDetails['title'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="bookAuthor">Author</label>
                <input type="text" class="form-control" id="bookAuthor" name="author" value="<?php echo htmlspecialchars($bookDetails['author'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="bookGenre">Genre</label>
                <input type="text" class="form-control" id="bookGenre" name="genre" value="<?php echo htmlspecialchars($bookDetails['genre'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="bookSummary">Summary</label>
                <textarea class="form-control" id="bookSummary" name="summary" rows="4" required><?php echo htmlspecialchars($bookDetails['summary'] ?? ''); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Book</button>
        </form>

        <br>
        <a href="editbook.php" class="btn btn-danger btn-block" onclick="location.href='editbook.php'">Back</a>
    </div>
</body>
</html>
