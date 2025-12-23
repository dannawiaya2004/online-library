<?php
session_start();
include('db.php'); // Ensure db.php has the correct connection setup

if (isset($_POST['enter'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $date = mysqli_real_escape_string($conn, $_POST['pub_date']);
    $sum = mysqli_real_escape_string($conn, $_POST['Summary']);
    $lang = mysqli_real_escape_string($conn, $_POST['lang']);

    $filename = $_FILES["cover_image"]["name"];
    $tempname = $_FILES["cover_image"]["tmp_name"];
    $folder = "image/" . $filename; 
    $query = "INSERT INTO books (title, author, genre, year, Summary, coverimage,lang) 
              VALUES ('$title', '$author', '$genre', '$date' , '$sum', '$filename','$lang')";

    if (mysqli_query($conn, $query)) {
        if (move_uploaded_file($tempname, $folder)) {
            header("location:addbook.php");
            exit();
        } else {
            echo "<h3>Failed to upload image!</h3>";
        }
    } else {
        echo "<h3>Error: " . mysqli_error($conn) . "</h3>";
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add Book</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            margin-top: 50px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        h2 {
            font-weight: bold;
            color: #343a40;
        }
        .form-group label {
            font-weight: bold;
            color: #495057;
        }
        .btn-primary {
            background-color: #343a40;
            border: none;
        }
        .btn-primary:hover {
            background-color: #495057;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card mx-auto" style="max-width: 600px;">
            <h2 class="text-center">Add New Book</h2>
            <form action="" method="POST" enctype="multipart/form-data" class="mt-3">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="title">language:</label>
                    <input type="text" class="form-control" id="lang" name="lang" required>
                </div>
                <div class="form-group">
                    <label for="author">Author:</label>
                    <input type="text" class="form-control" id="author" name="author" required>
                </div>
                <div class="form-group">
                    <label for="genre">Genre:</label>
                    <input type="text" class="form-control" id="genre" name="genre" required>
                </div>
                <div class="form-group">
                    <label for="pub_date">Publication Date:</label>
                    <input type="number" class="form-control" id="pub_date" name="pub_date" required>
                </div>
            
                <div class="form-group">
                    <label for="cover_image">Cover Image:</label>
                    <input type="file" class="form-control-file" id="cover_image" name="cover_image" value="">
                </div>
                <div class="form-group">
                    <label >Summary:</label>
                    <textarea class="form-control" id="Summary" name="Summary" required></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary btn-block" name="enter">Add Book</button>
            </form>
            <br>
            <button class="btn btn-danger btn-block" onclick="location.href='admin.php'">Back</button>
        </div>
    </div>
</body>
</html>
