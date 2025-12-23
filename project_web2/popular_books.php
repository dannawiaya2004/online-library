<?php
include 'db.php';

$genre = isset($_GET['genre']) ? $_GET['genre'] : '';  
$author = isset($_GET['author']) ? $_GET['author'] : '';
$language = isset($_GET['language']) ? $_GET['language'] : '';
$year = isset($_GET['year']) ? $_GET['year'] : '';

$query = "SELECT * FROM books WHERE 1=1"; 
if (!empty($genre)) {
    $query .= " AND genre = '$genre'";  
}

if (!empty($author)) {
    $query .= " AND author = '$author'";  
}

if (!empty($language)) {
    $query .= " AND lang = '$language'";  
}

if (!empty($year)) {
    $query .= " AND year = '$year'";  
}

$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popular Books</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    

    <style>
        /* Custom Styling */
        .filter-section {
            background-color: #f8f9fa;
            padding: 20px 0;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-custom {
            transition: transform 0.2s ease-in-out;
        }

        .card-custom:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .card-body {
            padding: 15px;
        }

        .filter-section select,
        .filter-section button {
            width: 100%;
            margin-bottom: 10px;
        }

        .book-title {
            color: #333;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .header {
            margin-bottom: 30px;
            text-align: center;
            font-weight: 600;
            color: #495057;
        }
    </style>
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
            <li class="nav-item"><a class="nav-link" href="home.php">home</a></li>
                <li class="nav-item"><a class="nav-link" href="popular_books.php">Popular Books</a></li>
                <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="feedback.php">feedback</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="aboutus.php">aboutus</a>
                </li>
            </ul>
        </div>
        
    </nav>
    

     <section class="mt-4">
          
          
          <br>
          <div class="container">
          <h2 class="text-center">Books</h2>
          <div class="row">
    

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-3">';
        echo '<div class="card card-custom mb-4">';
        ?>
                <img width=250 height=350 src="./image/<?php echo $row['coverimage']; ?>"> 
        <?php
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row['title'] . '</h5>';
        echo '<p class="card-text">' . $row['author'] . '</p>';
        echo '<a href="book-details.php?id=' . $row['id'] . '" class="btn btn-outline-primary btn-block">View Details</a>';
        echo '</div></div></div>';
    }
} else {
    echo '<div class="col-12 text-center">No books found matching your criteria.</div>';
}
?>
        </div>
    </div>
        </section>
        
</body>
</html>
