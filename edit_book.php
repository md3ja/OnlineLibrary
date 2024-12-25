<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_db";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];
    $published_date = $_POST['published_date'];
    $quantity = $_POST['quantity'];

    $sql = "UPDATE books SET title='$title', author='$author', isbn='$isbn', published_date='$published_date', quantity='$quantity' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record updated successfully'); window.location.href='view_books.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}


$row = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM books WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<p>No book found with ID " . $id . "</p>";
    }
} else {
    echo "<p>No ID parameter provided.</p>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2>Edit Book</h2>

<?php if ($row): ?>
<form method="POST" action="edit_book.php">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <label for="title">Title:</label>
    <input type="text" name="title" value="<?php echo $row['title']; ?>" required>

    <label for="author">Author:</label>
    <input type="text" name="author" value="<?php echo $row['author']; ?>" required>

    <label for="isbn">ISBN:</label>
    <input type="text" name="isbn" value="<?php echo $row['isbn']; ?>" required>

    <label for="published_date">Published Date:</label>
    <input type="date" name="published_date" value="<?php echo $row['published_date']; ?>" required>

    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" required>

    <input type="submit" name="update" value="Update">
</form>
<?php else: ?>
<p>No book selected or book not found.</p>
<?php endif; ?>

</body>
</html>
