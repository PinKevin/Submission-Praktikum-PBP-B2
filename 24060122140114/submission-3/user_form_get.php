<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Siswa</title>
    <link rel="stylesheet" href="form.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // Ambil data dari form
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $kelas = $_POST['kelas'];
    $ekstrakurikuler = isset($_POST['ekstrakurikuler']) ? $_POST['ekstrakurikuler'] : [];

    // Validasi NIS
    if (empty($nis)) {
        $errors[] = "NIS harus diisi.";
    } elseif (!preg_match("/^[0-9]{10}$/", $nis)) {
        $errors[] = "NIS harus terdiri dari 10 angka.";
    }

    // Validasi Nama
    if (empty($nama)) {
        $errors[] = "Nama harus diisi.";
    }

    // Validasi Jenis Kelamin
    if (empty($jenis_kelamin)) {
        $errors[] = "Jenis kelamin harus dipilih.";
    }

    // Validasi Kelas dan Ekstrakurikuler
    if (empty($kelas)) {
        $errors[] = "Kelas harus dipilih.";
    } else {
        if ($kelas == "X" || $kelas == "XI") {
            // Validasi Ekstrakurikuler untuk kelas X dan XI
            if (empty($ekstrakurikuler)) {
                $errors[] = "Minimal pilih 1 ekstrakurikuler.";
            } elseif (count($ekstrakurikuler) > 3) {
                $errors[] = "Maksimal pilih 3 ekstrakurikuler.";
            }
        } elseif ($kelas == "XII") {
            // Jika kelas XII, ekstrakurikuler tidak boleh dipilih
            if (!empty($ekstrakurikuler)) {
                $errors[] = "Siswa kelas XII tidak boleh memilih ekstrakurikuler.";
            }
        }
    }

    // Tampilkan error atau sukses
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    } else {
        echo "<p style='color:green;'>Form berhasil disubmit!</p>";
        // Lakukan pemrosesan data di sini (misalnya simpan ke database)
    }
}
?>
    <!-- Form -->
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <p>Form Input Siswa</p>
            </div>
            <div class="card-body">
                <form action="proses.php" method="POST">
                    <div class="form-group">
                        <label for="nis">NIS:</label>
                        <input type="text" class="form-control" id="nis" name="nis" placeholder="Masukkan NIS" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="pria" value="Pria"
                                required>
                            <label class="form-check-label" for="pria">Pria</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="wanita" value="Wanita"
                                required>
                            <label class="form-check-label" for="wanita">Wanita</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas:</label>
                        <select class="form-control" id="kelas" name="kelas" required>
                            <option value="">Pilih Kelas</option>
                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Ekstrakurikuler:</label><br>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ekstrakurikuler[]" value="Pramuka"
                                id="pramuka">
                            <label class="form-check-label" for="pramuka">Pramuka</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ekstrakurikuler[]" value="Seni Tari"
                                id="seni_tari">
                            <label class="form-check-label" for="seni_tari">Seni Tari</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ekstrakurikuler[]"
                                value="Sinematografi" id="sinematografi">
                            <label class="form-check-label" for="sinematografi">Sinematografi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ekstrakurikuler[]" value="Basket"
                                id="basket">
                            <label class="form-check-label" for="basket">Basket</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- Java script -->
    <script src="script_form.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>