<?php
session_start();
include 'db.php';

$sql = "SELECT feedback.date, feedback.message, user.name FROM feedback, user WHERE feedback.userid = user.id";
$result = $conn->query($sql);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   
</head>
<body>
    <div class="container mt-5">
        <div class="card p-4 shadow-lg">
            <h2>Admin Dashboard</h2>
            <p><strong>Name:</strong> Aya Dannawi</p>
            <p><strong>Email:</strong> admin@gmail.com</p>
            <hr>
            <h4>Manage Library</h4>
            <div class="btn-group mt-3">
                <button class="btn btn-outline-primary" onclick="location.href='addbook.php'">Add Book</button>
                <button class="btn btn-outline-warning" onclick="location.href='editbook.php'">Edit Book</button>
                <button class="btn btn-outline-danger" onclick="location.href='deletebook.php'">Remove Book</button>
            </div>

            
            <hr>
 
    <div class="container">
        <h2 class="text-center mt-5">Feedback Dashboard</h2>

       
        <div class="table-responsive mt-4">
            <table class="table table-hover" id="feedback-table">
                <thead class="thead-dark">
                    <tr>
                        <th>Date</th>
                        <th>Feedback</th>
                        <th>user</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['date']); ?></td>
                            <td><?php echo htmlspecialchars($row['message']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                        </tr>
                    <?php endwhile; ?>

                </tbody>
            </table>
        </div>
    </div>
    </div>
    <button class="btn btn-danger btn-block" onclick="location.href='index.php'">Back</button>

    </div>

   
</body>
</html>
