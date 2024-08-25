<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, title, author, isbn, published_date, quantity FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"]. " - Title: " . $row["title"]. " - Author: " . $row["author"]. " - ISBN: " . $row["isbn"]. " - Published Date: " . $row["published_date"]. " - Quantity: " . $row["quantity"]. "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>