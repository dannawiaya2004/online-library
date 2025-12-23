<?php
include 'db.php';

$sql = "SELECT  DISTINCT  lang FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<option value=""> lang </option>';
    while($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['lang'] . '">' . $row['lang'] . '</option>';
    }
} else {
    echo "No year options found.";
}

$conn->close();
?>