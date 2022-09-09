<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpustakaan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    
     <main>
        <div class="py-5 text-center">
            <h2>Data Buku</h2>
            <p class="lead">Halaman ini memuat seluruh buku yang ada di database</p>
            <a href="inputBook.php" class="btn btn-primary my-2">Tambah Buku</a>
        </div>

        <div class="row g-5">
            <div class="col-md-12 col-lg-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Judul</th>
                            <th scope="col">Penulis</th>
                            <th scope="col">Tanggal terbit</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $servername = "localhost";
                        $username = "guest";
                        $password = "12345678";
                        $dbname = "library_db";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        if ($conn->connect_error) {
                            die("Connection failed: ". $conn->connect_erro);
                        }

                        $sql = "SELECT book_id, title, author, published_date FROM book";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>". $row['title']. "</td>";
                                echo "<td>". $row['author']. "</td>";
                                echo "<td>". $row['published_date']. "</td>";
                                echo "<td>". "<a type='button' class='btn btn-primary' href='updateBook.php?book_id=".$row['book_id']."'>Update</a>"."</td>";
                                echo "<td>". "<a type='button' class='btn btn-danger' href='deleteBook.php?book_id=".$row['book_id']."'>Delete</a>"."</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "0 result";
                        }

                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
     </main> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
      <script src="form-validation.js"></script>
  </body>
</html>
