<?php
include 'db.php';

$sql = "SELECT  DISTINCT  year FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<option value=""> year </option>';
    while($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['year'] . '">' . $row['year'] . '</option>';
    }
} else {
    echo "No year options found.";
}

$conn->close();
?>