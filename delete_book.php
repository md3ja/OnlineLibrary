<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_db";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['id'])) {
    $delete_id = $_GET['id'];

   
    $sql_delete = "DELETE FROM books WHERE id='$delete_id'";

    if ($conn->query($sql_delete) === TRUE) {
        echo "<script>alert('Book deleted successfully!'); window.location.href='view_books.php';</script>";
    } else {
        echo "Error deleting book: " . $conn->error;
    }
} else {
    echo "No ID specified for deletion.";
}

$conn->close();
?>
