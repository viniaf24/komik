<?php
include 'koneksi.php';

// Cek apakah parameter ID ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data komik berdasarkan ID
    $sql = "SELECT * FROM comics WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $comic = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    echo "ID tidak diberikan.";
    exit;
}

// Proses update data jika form disubmit
if (isset($_POST['update_comic'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];

    $sql = "UPDATE comics SET title='$title', author='$author', genre='$genre' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
        exit;
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
    <title>Edit Komik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-5">
        <h1 class="text-center text-primary mb-4">Edit Komik</h1>

        <form method="POST" action="" class="row g-3">
            <div class="col-md-6">
                <label for="title" class="form-label">Judul Komik</label>
                <input type="text" name="title" id="title" class="form-control" value="<?php echo $comic['title']; ?>" required>
            </div>
            <div class="col-md-6">
                <label for="author" class="form-label">Pengarang</label>
                <input type="text" name="author" id="author" class="form-control" value="<?php echo $comic['author']; ?>" required>
            </div>
            <div class="col-md-12">
                <label for="genre" class="form-label">Genre</label>
                <input type="text" name="genre" id="genre" class="form-control" value="<?php echo $comic['genre']; ?>" required>
            </div>
            <div class="col-12 text-end">
                <button type="submit" name="update_comic" class="btn btn-primary">Simpan Perubahan</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>