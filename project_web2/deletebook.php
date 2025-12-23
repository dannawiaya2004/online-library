<?php
session_start();
include 'db.php'; 

if (isset($_GET['book_id'])) {
    $bookId = $_GET['book_id'];

    $query = "DELETE FROM books WHERE id = $bookId"; 

    if ($conn->query($query) === TRUE) {
        $success_message = "Book deleted successfully!";
    } else {
        $error_message = "Error deleting book: " . $conn->error;
    }
}

$sql = "SELECT id, title, author FROM books";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Book</title>
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
        .book-card {
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin-bottom: 20px;
            transition: transform 0.2s;
        }
        .book-card:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }
        .book-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .book-details {
            flex-grow: 1;
        }
        .book-title {
            font-size: 1.2em;
            font-weight: bold;
            color: #495057;
        }
        .book-author {
            color: #6c757d;
            font-size: 0.9em;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
            color: white;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .container {
            max-width: 800px;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Delete Book</h2>

        <?php if (isset($success_message)) { ?>
            <div class="alert alert-success text-center"><?php echo $success_message; ?></div>
        <?php } ?>
        <?php if (isset($error_message)) { ?>
            <div class="alert alert-danger text-center"><?php echo $error_message; ?></div>
        <?php } ?>


        <div id="bookList">
            <?php if ($result->num_rows > 0) : ?>
                <?php while ($book = $result->fetch_assoc()) : ?>
                    <div class="book-card">
                        <div class="book-info">
                            <div class="book-details">
                                <div class="book-title"><?php echo htmlspecialchars($book['title']); ?></div>
                                <div class="book-author">by <?php echo htmlspecialchars($book['author']); ?></div>
                            </div>
                            <a href="deletebook.php?book_id=<?php echo $book['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this book?')">Delete</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center">No books found.</p>
            <?php endif; ?>
        </div>

        <br>
        <button class="btn btn-danger btn-block" onclick="location.href='admin.php'">Back</button>
    </div>
</body>
</html>
