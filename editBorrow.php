<?php
$book_idErr = $member_idErr = $borrow_idErr = "";
$book_id = $member_id  = $borrow_id = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['borrow_id'])) {
        $borrow_idErr = "Borrow ID gagal diambil";
    } else {
        $borrow_id = test_input($_POST['borrow_id']);
    }
    
    if (empty($_POST['book_id'])) {
        $book_idErr = "Buku harus diisi!";
    } else {
        $book_id = test_input($_POST['book_id']);
    }

    if (empty($_POST['member_id'])) {
        $member_idErr = "Peminjam Buku harus diisi";
    } else {
        $member_id = test_input($_POST['member_id']);
    }

    if ($book_idErr || $member_idErr) {
        echo "<h2> Submisi buku gagal";
        echo "<h2>".$book_id."</h2>";
        echo "<h2>".$member_id."</h2>";
    } else {
    $servername = "localhost";
    $username = "guest";
    $password = "12345678";
    $dbname = "library_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE borrow SET
    book_id = '".$book_id."',
    member_id = '".$member_id."'
    WHERE borrow_id = ". $borrow_id;

    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

    header("Location: readBorrow.php");
    }
} else {
    echo "<h2>Silakan masukan data melalui form</h2>";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>