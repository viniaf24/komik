<?php
                                                    // index.php
                                                    include 'koneksi.php';

                                                    // Fungsi untuk menambahkan data komik
                                                    if (isset($_POST['add_comic'])) {
                                                        $title = $_POST['title'];
                                                        $author = $_POST['author'];
                                                        $genre = $_POST['genre'];

                                                        $sql = "INSERT INTO comics (title, author, genre) VALUES ('$title', '$author', '$genre')";
                                                        if ($conn->query($sql) === TRUE) {
                                                            header('Location: index.php');
                                                        } else {
                                                            echo "Error: " . $sql . "<br>" . $conn->error;
                                                        }
                                                    }

                                                    // Fungsi untuk menghapus data komik
                                                    if (isset($_GET['delete'])) {
                                                        $id = $_GET['delete'];

                                                        $sql = "DELETE FROM comics WHERE id=$id";
                                                        if ($conn->query($sql) === TRUE) {
                                                            header('Location: index.php');
                                                        } else {
                                                            echo "Error: " . $sql . "<br>" . $conn->error;
                                                        }
                                                    }

                                                    // Fungsi untuk memperbarui data komik
                                                    if (isset($_POST['update_comic'])) {
                                                        $id = $_POST['id'];
                                                        $title = $_POST['title'];
                                                        $author = $_POST['author'];
                                                        $genre = $_POST['genre'];

                                                        $sql = "UPDATE comics SET title='$title', author='$author', genre='$genre' WHERE id=$id";
                                                        if ($conn->query($sql) === TRUE) {
                                                            header('Location: index.php');
                                                        } else {
                                                            echo "Error: " . $sql . "<br>" . $conn->error;
                                                        }
                                                    }
                                                    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komik CRUD</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        form {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h1>Daftar Komik</h1>

    <!-- Form Tambah Komik -->
    <form method="POST" action="">
        <input type="text" name="title" placeholder="Judul Komik" required>
        <input type="text" name="author" placeholder="Pengarang" required>
        <input type="text" name="genre" placeholder="Genre" required>
        <button type="submit" name="add_comic">Tambah Komik</button>
    </form>

    <!-- Tabel Daftar Komik -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Pengarang</th>
                <th>Genre</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM comics";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['author'] . "</td>";
                    echo "<td>" . $row['genre'] . "</td>";
                    echo "<td>
                        <a href='edit.php?id=" . $row['id'] .
                        "'>Edit</a> |
                         <a href='index.php?delete=" . $row['id'] . "' onclick=\"return confirm('Yakin ingin menghapus?')\">Hapus</a>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>