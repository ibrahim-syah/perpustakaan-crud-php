<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit member</title>
</head>
<body>
    
<?php
// define variables and set to empty values
$first_nameErr = $last_nameErr = $emailErr = $member_id = "";
$first_name = $last_name = $emailErr = $member_idErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  
    if (empty($_POST['member_id'])) {
        $member_idErr = "ID member gagal diterima";
    } else {
        $member_id = test_input($_POST['member_id']);
    }

  if (empty($_POST["first_name"])) {
    $first_nameErr = "Nama depan harus diisi!";
  } else {
    $first_name = test_input($_POST["first_name"]);
    // check if first_name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$first_name)) {
      $first_nameErr = "Nama tidak boleh mengandung angka dan simbol!";
    }
  }


  if (empty($_POST["last_name"])) {
    $last_nameErr = "Nama belakang harus diisi!";
  } else {
    $last_name = test_input($_POST["last_name"]);
    // check if last_name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$last_name)) {
      $last_nameErr = "Nama belakang tidak boleh mengandung angka dan simbol!";
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email harus diisi";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Format email tidak valid!";
    }
  }

    if ($first_nameErr || $last_nameErr || $emailErr ) {
        echo "<h2>Submisi member gagal:</h2>";
        echo "<br>";
        echo $first_nameErr;
        echo "<br>";
        echo $last_nameErr;
        echo "<br>";
        echo $emailErr;
        echo "<br>";
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

    $sql = "UPDATE member SET
    first_name = '".$first_name."',
    last_name = '".$last_name."',
    email = '".$email."'
    WHERE member_id = ".$member_id;

    if ($conn->query($sql) === TRUE) {
    echo "New record updated successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

    echo "<h2>Data member berhasil diupdate:</h2>";
    echo $first_name;
    echo "<br>";
    echo $last_name;
    echo "<br>";
    echo $email;
    echo "<br>";
    header("Location: readMembers.php");
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