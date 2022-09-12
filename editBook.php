<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
</head>
<body>
   <?php 
   $titleErr = $authorErr = $published_dateErr = $book_idErr = "";
   $title = $author = $published_date = $book_id = "";

   if ($_SERVER['REQUEST_METHOD'] == "POST") {


    if (empty($_POST['book_id'])) {
        $book_idErr = "ID buku gagal diterima";
    } else {
        $book_id = test_input($_POST["book_id"]);
    }
    
    if (empty($_POST['title'])) {
        $titleErr = "judul buku harus diisi!";
    } else {
        $title = test_input($_POST["title"]);
    }

    if (empty($_POST['author'])) {
        $authorErr = "Nama penulis harus diisi";
    } else {
        $author = test_input($_POST["author"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $author)) {
            $authorErr = "Nama penulis tidak boleh mengandung angka atau simbol!";
        }
    }


    if (empty($_POST['published_date'])) {
        $published_dateErr = "Tanggal terbit harus diisi!";
    } else {
        $published_date = test_input($_POST["published_date"]);
        $parsed_date = date_parse($published_date);
        if (!checkdate($parsed_date['month'], $parsed_date['day'], $parsed_date['year'])) {
            $published_dateErr = "Format tanggal terbit tidak valid!";
        }
    }
    
        if ($titleErr || $authorErr || $published_dateErr) {
            echo "<h2> Submisi buku gagal: </h2>";
            echo $titleErr;
            echo "<br>";
            echo $authorErr;
            echo "<br>";
            echo $published_dateErr;
            echo "<br>";
        } else {
            $servername = "localhost";
            $username = "guest";
            $password = "12345678";
            $dbname = "library_db";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: ". $conn->connect_erro);
            }

            $sql = "UPDATE book SET
            title = '".$title."',
            author = '".$author."',
            published_date = '".$published_date."'
            WHERE book_id = ".$book_id;

            if ($conn->query($sql)) {
                echo "New record created succesfully";
            } else {
                echo "Error: ". $sql. "<br>". $conn->error;
            }

            $conn->close();
            
            echo "<h2>Data buku berhasil diupdate: </h2>";
            echo $title;
            echo "<br>";
            echo $author;
            echo "<br>";
            echo $published_date;
            echo "<br>";

            header("Location: readBooks.php");
        }

   } else {
    echo "Silakan masukan data melalui form";
   }

   function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
   }
   ?>
</body>
</html>