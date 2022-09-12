<?php
    if (isset($_GET['member_id'])) {
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

    $sql = "DELETE FROM member WHERE member_id = ".$_GET['member_id'];

    if ($conn->query($sql) === TRUE) {
    echo "New record deleted successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

    header("Location: readMembers.php");
    }
?>