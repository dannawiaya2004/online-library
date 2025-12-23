<?php
include 'db.php';

$sql = "SELECT id, title FROM books"; 
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Book to Edit</title>
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
        <h2 class="text-center">Select Book to Edit</h2>

        <form method="GET" action="edit-book.php">
            <div class="form-group">
                <label for="bookSelect">Select Book to Edit</label>
                <select class="form-control" id="bookSelect" name="book_id">
                    <option value="">Select a Book</option>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['title']) . '</option>';
                        }
                    } else {
                        echo '<option value="">No books found</option>';
                    }
                    $conn->close();
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Edit Book</button>
            </form>
            <br>
            <button class="btn btn-danger btn-block" onclick="location.href='admin.php'">Back</button>
      
    </div>
</body>
</html>
