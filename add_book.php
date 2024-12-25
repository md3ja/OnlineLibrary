<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];
    $published_date = $_POST['published_date'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO books (title, author, isbn, published_date, quantity) VALUES ('$title', '$author', '$isbn', '$published_date', '$quantity')";

    if ($conn->query($sql) === TRUE) {
        echo "<div id='customAlert' style='
                position: fixed; 
                top: 0; 
                left: 0; 
                width: 100%; 
                height: 100%; 
                background-color: rgba(0, 0, 0, 0.5); 
                display: flex; 
                justify-content: center; 
                align-items: center;'>
                <div style='
                    background-color: white; 
                    padding: 20px; 
                    border-radius: 10px; 
                    text-align: center;'>
                    <p>Store says: New book added successfully!</p>
                    <button style='
                        background-color: #4CAF50; 
                        color: white; 
                        padding: 10px 20px; 
                        border: none; 
                        border-radius: 5px; 
                        cursor: pointer;' 
                        onclick='window.location.href=\"add_book.html\"'>OK</button>
                </div>
              </div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
