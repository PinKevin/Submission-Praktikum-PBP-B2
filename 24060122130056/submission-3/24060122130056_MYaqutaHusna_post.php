<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user-form-post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<div class="container-lg">
<div class="card">
      <div class="card-header">Form Mahasiswa</div>
      <div class="card-body">  
<form action="" method="post"> <!-- Mengubah metode menjadi POST -->

    <div class="form-group">
        <label for="NIS">NIS:</label>
        <input type="text" class="form-control" id="NIS" name="NIS" maxlength="10">
    </div>

    <div class="form-group">
        <label for="Nama">Nama:</label>
        <input type="text" class="form-control" id="Nama" name="Nama">
    </div>

    <div class="form-group">
        <label for="kota">Kota/Kabupaten:</label>
        <select id="kota" name="kota" class="form-control">
            <option value="semarang">Semarang</option>
            <option value="yogyakarta">Yogyakarta</option>
            <option value="bandung">Bandung</option>
            <option value="surabaya">Surabaya</option>
        </select>
    </div>

    <div class="row mb-3">
        <label>Jenis Kelamin:</label>
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="jenis_kelamin" value="pria">Pria
        </label>
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="jenis_kelamin" value="wanita">Wanita
        </label>
    </div>

    <div class="form-group">
        <label for="kelas">Kelas</label>
        <select id="kelas" name="kelas" class="form-select" onchange="toggleEkstrakurikuler()">
          <option value="">Pilih Kelas</option>
          <option value="X">X</option>
          <option value="XI">XI</option>
          <option value="XII">XII</option>
        </select>
    </div>

    <div id="ekstrakurikuler" style="display:none;">
        <label>Ekstrakurikuler:</label>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="ekstra[]" value="pramuka">Pramuka<br>
            <input type="checkbox" class="form-check-input" name="ekstra[]" value="seni tari">Seni Tari<br>
            <input type="checkbox" class="form-check-input" name="ekstra[]" value="sinematografi">Sinematografi<br>
            <input type="checkbox" class="form-check-input" name="ekstra[]" value="basket">Basket<br>
        </div>
    </div>

    <br>
    <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
    <button type="reset" class="btn btn-danger">Reset</button>
</form>
</div>

<?php
if (isset($_POST["submit"])) {  // Mengubah GET menjadi POST
    $nis = $_POST['NIS'];
    $nama = $_POST['Nama'];
    $kelas = $_POST['kelas'];
    $ekstra = isset($_POST['ekstra']) ? $_POST['ekstra'] : [];

    // Validasi NIS
    if (empty($nis)) {
        echo 'NIS harus diisi!<br>';
    } elseif (!preg_match("/^[0-9]{10}$/", $nis)) {
        echo 'NIS harus 10 angka!<br>';
    }

    // Validasi Nama
    if (empty($nama)) {
        echo 'Nama harus diisi!<br>';
    }

    // Validasi Jenis Kelamin
    if (!isset($_POST['jenis_kelamin'])) {
        echo 'Jenis kelamin harus diisi!<br>';
    }

    // Validasi Kelas
    if (empty($kelas)) {
        echo 'Kelas harus diisi!<br>';
    }

    // Validasi Ekstrakurikuler jika kelas X atau XI
    if ($kelas == "X" || $kelas == "XI") {
        if (empty($ekstra)) {
            echo 'Ekstrakurikuler harus dipilih (minimal 1, maksimal 3)!<br>';
        } elseif (count($ekstra) > 3) {
            echo 'Maksimal hanya boleh memilih 3 ekstrakurikuler!<br>';
        }
    }

    // Jika semua validasi berhasil
    if (!empty($nis) && preg_match("/^[0-9]{10}$/", $nis) && !empty($nama) && isset($_POST['jenis_kelamin']) && !empty($kelas)) {
        echo "<h3>Your Input:</h3>";
        echo 'NIS = ' . htmlspecialchars($nis) . '<br>';
        echo 'Nama = ' . htmlspecialchars($nama) . '<br>';
        echo 'Kota = ' . htmlspecialchars($_POST['kota']) . '<br>';
        echo 'Jenis Kelamin = ' . htmlspecialchars($_POST['jenis_kelamin']) . '<br>';
        echo 'Kelas = ' . htmlspecialchars($kelas) . '<br>';
        if (!empty($ekstra)) {
            echo 'Ekstrakurikuler = ' . htmlspecialchars(implode(', ', $ekstra)) . '<br>';
        } else {
            echo 'Tidak ada Ekstrakurikuler.<br>';
        }
    }
}
?>

</div>

<script>
function toggleEkstrakurikuler() {
    var kelas = document.getElementById('kelas').value;
    var ekskul = document.getElementById('ekstrakurikuler');
    if (kelas == 'X' || kelas == 'XI') {
        ekskul.style.display = 'block';
    } else {
        ekskul.style.display = 'none';
    }
}
</script>
</body>
</html>
