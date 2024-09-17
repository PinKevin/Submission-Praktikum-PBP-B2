<!DOCTYPE html>
<html lang="en">

<head>
    <title>Form Input Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <?php
        $error_nis = $error_nama = $error_jenis_kelamin = $error_kelas = $error_ekstra = '';
        $nis = $nama = $kelas = $jenis_kelamin = '';
        $ekstra = array();

        if (isset($_POST['submit'])) {

            // validasi NIS terdiri atas 10 karakter dan hanya boleh berisi angka 0..9.
            $nis = test_input($_POST['nis']);
            if (empty($nis)) {
                $error_nis = "NIS harus diisi";
            } elseif (!preg_match("/^[0-9]{10}$/", $nis)) {
                $error_nis = 'NIS harus terdiri dari 10 digit angka';
            }
            // validasi nama: tidak boleh kosong, hanya dapat berisi huruf dan spasi
            $nama = test_input($_POST['nama']);
            if (empty($nama)) {
                $error_nama = "Nama harus diisi";
            } elseif (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
                $error_nama = "Nama hanya boleh berisi huruf dan spasi";
            }

            // validasi jenis kelamin: tidak boleh kosong
            if (empty($_POST['jenis_kelamin'])) {
                $error_jenis_kelamin = "Jenis kelamin harus diisi";
            } else {
                $jenis_kelamin = $_POST['jenis_kelamin'];
            }
            // validasi kelas: tidak boleh kosong
            $kelas = test_input($_POST["kelas"]);
            if (empty($_POST["kelas"]) || $_POST["kelas"] == "-") {
                $error_kelas = "Kelas harus dipilih";
            }

            // Validasi Ekstrakurikuler jika kelas X atau XI
            if ($kelas == "x" || $kelas == "xi") {
                if (empty($_POST["ekstra"])) {
                    $error_ekstra = "Minimal pilih 1 ekstrakurikuler";
                } elseif (count($_POST["ekstra"]) > 3) {
                    $error_ekstra = "Maksimal hanya boleh memilih 3 ekstrakurikuler";
                } else {
                    $ekstra = $_POST["ekstra"];
                }
            } elseif ($kelas == "xii" && !empty($ekstra)) {
                $error_ekstra = "Siswa kelas XII tidak boleh memilih ekstrakurikuler";
            }

            // Jika tidak ada error, proses data
            if (empty($error_nis) && empty($error_nama) && empty($error_kelas) && empty($error_jenis_kelamin) && empty($error_ekstra)) {
                echo "<div class='alert alert-success'>Form berhasil di-submit!</div>";
            }
        }

        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>
    </div>
    <div class="container mt-5 border rounded p-0">
        <div class="bg-secondary rounded-top p-2 text-white text-center">Form Input Siswa</div>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group m-2">
                <label for="nis">NIS:</label><br />
                <input type="text" class="form-control" id="nis" name="nis" value="<?php echo $nis; ?>">
                <div class="error text-danger"><?php if (isset($error_nis)) echo $error_nis; ?></div>
            </div>
            <div class="form-group m-2">
                <label for="nama" class="label">Nama:</label><br />
                <input type="nama" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>">
                <div class="error text-danger"><?php if (isset($error_nama)) echo $error_nama; ?></div>
            </div>
            <label class="check m-2">Jenis kelamin:</label><br />
            <div class="form-check m-2">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="jenis_kelamin" value="pria" <?php if ($jenis_kelamin == "pria") echo "checked"; ?>>
                    Pria
                </label>
            </div>
            <div class="form-check m-2">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="jenis_kelamin" value="wanita" <?php if ($jenis_kelamin == "wanita") echo "checked"; ?>>
                    Wanita
                </label>
            </div>
            <div class="error text-danger"><?php if (isset($error_jenis_kelamin)) echo $error_jenis_kelamin; ?></div>
            <br />
            <div class="form-group m-2">
                <label class="label" for="kelas">Kelas:</label><br />
                <select name="kelas" id="kelas" class="form-control" onchange="toggleEkstra()">
                    <option value="-" selected disable>-- Pilih Kelas --</option>
                    <option value="x" <?php echo ($kelas == "x") ? "selected" : ""; ?>>X</option>
                    <option value="xi" <?php echo ($kelas == "xi") ? "selected" : ""; ?>>XI</option>
                    <option value="xii" <?php echo ($kelas == "xii") ? "selected" : ""; ?>>XII</option>
                </select>
                <div class="error text-danger"><?php if (isset($error_kelas)) echo $error_kelas; ?></div>
            </div>

            <div id="ekstraField" style="display:none;">
                <label class="check m-2">Ekstrakurikuler:</label><br />
                <div class="form-check m-2">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="ekstra[]" value="pramuka">Pramuka
                    </label>
                </div>
                <div class="form-check m-2">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="ekstra[]" value="seni_tari">Seni Tari
                    </label>
                </div>
                <div class="form-check m-2">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="ekstra[]" value="sinematografi">Sinematografi
                    </label>
                </div>
                <div class="form-check m-2">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="ekstra[]" value="basket">Basket
                    </label>
                </div>
                <div class="error text-danger"><?php if (isset($error_ekstra)) echo $error_ekstra; ?></div>
            </div>
            <!-- submit, reset dan button -->
            <div class="m-2 align-start justify-start">
                <button type="submit" class="   btn btn-primary" name="submit">Submit</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </div>
        </form>
    </div>

    <script>
        function toggleEkstra() {
            var kelas = document.getElementById('kelas').value;
            var ekstraField = document.getElementById('ekstraField');

            if (kelas === 'x' || kelas === 'xi') {
                ekstraField.style.display = 'block';
            } else {
                ekstraField.style.display = 'none';
            }
        }
        toggleEkstra();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>