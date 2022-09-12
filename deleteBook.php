<?php
if (isset($_GET['book_id'])) {
    
    $servername = "localhost";
    $username = "guest";
    $password = "12345678";
    $dbname = "library_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: ". $conn->connect_erro);
    }

    $sql = "DELETE FROM book WHERE book_id = ".$_GET['book_id'];

    if ($conn->query($sql)) {
        echo "Row deleted succesfully";
    } else {
        echo "Error: ". $sql. "<br>". $conn->error;
    }

    $conn->close();
    
    header("Location: readBooks.php");
}
?>