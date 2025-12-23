<?php
include 'db.php';

$sql = "SELECT  DISTINCT  genre FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<option value=""> genre </option>';
    while($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['genre'] . '">' . $row['genre'] . '</option>';
    }
} else {
    echo "No genre options found.";
}

$conn->close();
?>