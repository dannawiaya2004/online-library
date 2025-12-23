<?php
include 'db.php'; 
$query = "SELECT * FROM books";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Book Library</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    
      
     
      

<div class="jumbotron text-center text-white mt-4" style="background-image: url('94a98af4e6d102c32034b46920d0317e.gif'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <h1><br><br>Welcome to the Online Library</h1>
    <p><br>Discover new books, search our collection, and enjoy the journey<br><br><br></p>
</div>

<div class="container mt-5">
    <div class="filter-section mb-5">
        <h2 class="header">Browse Books</h2>

        <form method="GET" action="popular_books.php">
            <div class="row">
                <div class="col-md-3">
                    <label for="genreSelect">Select Genre</label>
                    <select class="form-control" id="genreSelect" name="genre">
                        <!-- AJAX will load genre options here -->
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="authorSelect">Select Author</label>
                    <select class="form-control" id="authorSelect" name="author">
                        <!-- AJAX will load authors options here -->
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="langSelect">Select Language</label>
                    <select class="form-control" id="langSelect" name="language">
                        <!-- AJAX will load language options here -->
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="yearSelect">Select Year</label>
                    <select class="form-control" id="yearSelect" name="year">
                        <!-- AJAX will load year options here -->
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-custom mt-3">Apply Filters</button>
        </form>
    </div>
</div>

<section class="mt-4">
          
          
          <br>
          <div class="container">
          <h2 class="text-center">Books</h2>
          <div class="row">
     
         
      
<?php
$result = $conn->query($query);

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

$conn->close();
?>
       </div>
    </div>
        </section>
        <script>
          $(document).ready(function() {
            $.ajax({
                url: 'get_genre.php',
                method: 'GET',
                success: function(response) {
                    $('#genreSelect').html(response);
                }
            });
              $.ajax({
                url: 'get_author.php',
                method: 'GET',
                success: function(response) {
                    $('#authorSelect').html(response);
                }
            });

            $.ajax({
                url: 'get_lang.php',
                method: 'GET',
                success: function(response) {
                    $('#langSelect').html(response);
                }
            });
            $.ajax({
                url: 'get_year.php',
                method: 'GET',
                success: function(response) {
                    $('#yearSelect').html(response);
                }
            });

            
        });
    </script>

    </body>
    
</html>
