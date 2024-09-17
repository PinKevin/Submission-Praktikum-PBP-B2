<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Siswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h2>Form Input Siswa</h2>

        <?php
        $error_nis = $error_nama = $error_jenis_kelamin = $error_kelas = $error_ekskul = "";
        $nis = $nama = $jenis_kelamin = $kelas = "";
        $ekskul = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validate NIS
            if (empty($_POST["nis"])) {
                $error_nis = "NIS harus diisi";
            } elseif (!preg_match("/^[0-9]{10}$/", $_POST["nis"])) {
                $error_nis = "NIS harus terdiri atas 10 karakter angka";
            } else {
                $nis = test_input($_POST["nis"]);
            }

            // Validate Nama
            if (empty($_POST["nama"])) {
                $error_nama = "Nama harus diisi";
            } else {
                $nama = test_input($_POST["nama"]);
            }

            // Validate Jenis Kelamin
            if (empty($_POST["jenis_kelamin"])) {
                $error_jenis_kelamin = "Jenis kelamin harus dipilih";
            } else {
                $jenis_kelamin = test_input($_POST["jenis_kelamin"]);
            }

            // Validate Kelas
            if (empty($_POST["kelas"])) {
                $error_kelas = "Kelas harus dipilih";
            } else {
                $kelas = test_input($_POST["kelas"]);
                // Validate Ekskul if class is X or XI
                if (($kelas == "X" || $kelas == "XI") && empty($_POST["ekskul"])) {
                    $error_ekskul = "Pilih minimal 1 kegiatan ekstrakurikuler";
                } else {
                    $ekskul = isset($_POST['ekskul']) ? $_POST['ekskul'] : [];
                }
            }

            // If no errors, display the data
            if (empty($error_nis) && empty($error_nama) && empty($error_jenis_kelamin) && empty($error_kelas) && empty($error_ekskul)) {
                echo "<h3>Data Siswa:</h3>";
                echo "NIS: " . $nis . "<br>";
                echo "Nama: " . $nama . "<br>";
                echo "Jenis Kelamin: " . $jenis_kelamin . "<br>";
                echo "Kelas: " . $kelas . "<br>";
                if (!empty($ekskul)) {
                    echo "Ekstrakurikuler: " . implode(", ", $ekskul) . "<br>";
                }
            }
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="nis">NIS:</label>
                <input type="text" class="form-control" id="nis" name="nis" maxlength="10"
                    value="<?php echo isset($_POST['nis']) ? $_POST['nis'] : ''; ?>">
                <div class="text-danger"><?php echo $error_nis; ?></div>
            </div>

            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama"
                    value="<?php echo isset($_POST['nama']) ? $_POST['nama'] : ''; ?>">
                <div class="text-danger"><?php echo $error_nama; ?></div>
            </div>

            <label>Jenis Kelamin:</label>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="jenis_kelamin" value="Pria"
                    <?php if (isset($_POST['jenis_kelamin']) && $_POST['jenis_kelamin'] == 'Pria') echo 'checked'; ?>>
                <label class="form-check-label">Pria</label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="jenis_kelamin" value="Wanita"
                    <?php if (isset($_POST['jenis_kelamin']) && $_POST['jenis_kelamin'] == 'Wanita') echo 'checked'; ?>>
                <label class="form-check-label">Wanita</label>
            </div>
            <div class="text-danger"><?php echo $error_jenis_kelamin; ?></div>

            <div class="form-group">
                <label for="kelas">Kelas:</label>
                <select class="form-control" id="kelas" name="kelas">
                    <option value="">-- Pilih Kelas --</option>
                    <option value="X" <?php echo isset($_POST['kelas']) && $_POST['kelas'] == 'X' ? 'selected' : ''; ?>>X
                    </option>
                    <option value="XI" <?php echo isset($_POST['kelas']) && $_POST['kelas'] == 'XI' ? 'selected' : ''; ?>>XI
                    </option>
                    <option value="XII" <?php echo isset($_POST['kelas']) && $_POST['kelas'] == 'XII' ? 'selected' : ''; ?>>XII
                    </option>
                </select>
                <div class="text-danger"><?php echo $error_kelas; ?></div>
            </div>

            <?php if (isset($_POST['kelas']) && ($_POST['kelas'] == 'X' || $_POST['kelas'] == 'XI')) : ?>
            <label>Ekstrakurikuler:</label>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="ekskul[]" value="Paskibra"
                    <?php if (isset($ekskul) && in_array('Paskibra', $ekskul)) echo 'checked'; ?>>
                <label class="form-check-label">Paskibra</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="ekskul[]" value="Seni Tari"
                    <?php if (isset($ekskul) && in_array('Seni Tari', $ekskul)) echo 'checked'; ?>>
                <label class="form-check-label">Seni Tari</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="ekskul[]" value="Marching Band"
                    <?php if (isset($ekskul) && in_array('Marching Band', $ekskul)) echo 'checked'; ?>>
                <label class="form-check-label">Marching Band</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="ekskul[]" value="Basket"
                    <?php if (isset($ekskul) && in_array('Basket', $ekskul)) echo 'checked'; ?>>
                <label class="form-check-label">Basket</label>
            </div>
            <div class="text-danger"><?php echo $error_ekskul; ?></div>
            <?php endif; ?>

            <br>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            <button type="reset" class="btn btn-danger" name="reset">Reset</button>
        </form>
    </div>

</body>

</html>
