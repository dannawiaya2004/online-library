<?php
include 'db.php';

$sql = "SELECT  DISTINCT  author FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<option value=""> author </option>';
    while($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['author'] . '">' . $row['author'] . '</option>';
    }
} else {
    echo "No author options found.";
}

$conn->close();
?>
