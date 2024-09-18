<!-- Nama =  Zahra Nisaa' Fitria Nur'Afifah
     NIM  = 24060122140162
     Praktikum  = B2 -->
     
<!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>user_form_siswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    // Inisialisasi variabel form
    $nis = $nama = $kelas = $jenis_kelamin = "";
    $ekskul = [];  // Inisialisasi ekskul sebagai array kosong
    $error_nis = $error_nama = $error_kelas = $error_jenis_kelamin = $error_ekskul = "";

    if (isset($_POST['submit'])) {
        // Validasi NIS: tidak boleh kosong, harus 10 digit angka
        $nis = test_input($_POST['nis']);
        if (empty($nis)) {
            $error_nis = "NIS harus diisi";
        } elseif (!preg_match("/^[0-9]{10}$/", $nis)) {
            $error_nis = "NIS harus terdiri dari 10 angka";
        }

        // Validasi Nama: tidak boleh kosong
        $nama = test_input($_POST['nama']);
        if (empty($nama)) {
            $error_nama = "Nama harus diisi";
        }

        // Validasi Jenis Kelamin: tidak boleh kosong
        if (!isset($_POST['jenis_kelamin'])) {
            $error_jenis_kelamin = "Jenis kelamin harus diisi";
        } else {
            $jenis_kelamin = $_POST['jenis_kelamin'];
        }

        // Validasi Kelas: tidak boleh kosong
        $kelas = test_input($_POST['kelas']);
        if (empty($kelas)) {
            $error_kelas = "Kelas harus diisi";
        }

        // Validasi Ekstrakurikuler: hanya untuk kelas X atau XI
        if ($kelas == 'X' || $kelas == 'XI') {
            $ekskul = isset($_POST['ekskul']) ? $_POST['ekskul'] : [];
            if (count($ekskul) < 1) {
                $error_ekskul = "Pilih minimal 1 kegiatan ekstrakurikuler";
            } elseif (count($ekskul) > 3) {
                $error_ekskul = "Pilih maksimal 3 kegiatan ekstrakurikuler";
            }
        }

        // Tidak ada ekstrakurikuler untuk kelas XII
        if ($kelas == 'XII') {
            $ekskul = [];
        }
    }

    // Fungsi untuk membersihkan input
    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    <div class="container"><br/>
        <div class="card">
        <div class="card-header">Form Input Siswa</div>
            <div class="card-body">
                <form method="POST" autocomplete="on" action="">
                    <!-- Input NIS -->
                    <div class="form-group">
                        <label for="nis">NIS:</label>
                        <input type="text" class="form-control" id="nis" name="nis" maxlength="10" value="<?php echo $nis; ?>">
                        <small class="text-danger"><?php echo $error_nis; ?></small>
                    </div>

                    <!-- Input Nama -->
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" maxlength="50" value="<?php echo $nama; ?>">
                        <small class="text-danger"><?php echo $error_nama; ?></small>
                    </div>

                    <!-- Input Jenis Kelamin -->
                    <div class="form-group">
                        <label>Jenis Kelamin:</label><br>
                        <input type="radio" name="jenis_kelamin" value="Pria" <?php if (isset($jenis_kelamin) && $jenis_kelamin == "Pria") echo "checked"; ?>> Pria
                        <input type="radio" name="jenis_kelamin" value="Wanita" <?php if (isset($jenis_kelamin) && $jenis_kelamin == "Wanita") echo "checked"; ?>> Wanita
                        <br><small class="text-danger"><?php echo $error_jenis_kelamin; ?></small>
                    </div>

                    <!-- Input Kelas -->
                    <div class="form-group">
                        <label for="kelas">Kelas:</label>
                        <select id="kelas" name="kelas"  class="form-control"   onchange="toggleEkskul()">
                            <option value="" selected disabled>-- Pilih Kelas --</option>
                            <option value="X" <?php if ($kelas == "X") echo "selected"; ?>>X</option>
                            <option value="XI" <?php if ($kelas == "XI") echo "selected"; ?>>XI</option>
                            <option value="XII" <?php if ($kelas == "XII") echo "selected"; ?>>XII</option>
                        </select>
                        <small class="text-danger"><?php echo $error_kelas; ?></small>
                        
                    </div>

                    <!-- Input Ekstrakurikuler -->
                    <div id="ekskul-options">
                        <label>Ekstrakurikuler:</label><br>
                        <input type="checkbox" name="ekskul[]" value="Pramuka" <?php if (in_array("Pramuka", $ekskul)) echo "checked"; ?>> Pramuka<br>
                        <input type="checkbox" name="ekskul[]" value="Seni Tari" <?php if (in_array("Seni Tari", $ekskul)) echo "checked"; ?>> Seni Tari<br>
                        <input type="checkbox" name="ekskul[]" value="Sinematografi" <?php if (in_array("Sinematografi", $ekskul)) echo "checked"; ?>> Sinematografi<br>
                        <input type="checkbox" name="ekskul[]" value="Basket" <?php if (in_array("Basket", $ekskul)) echo "checked"; ?>> Basket<br>
                        <small class="text-danger"><?php echo $error_ekskul; ?></small>
                    </div>
                    <!-- Submit & Reset -->
                    <br>
                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit
                    </button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                    </form>
                </div>
                <!-- Tampilkan Hasil Inputan Jika Form Valid -->
                <?php
                if (
                    isset($_POST["submit"]) && !empty($_POST["nis"]) && !empty($_POST["nama"]) && !empty($_POST["jenis_kelamin"]) 
                    && !empty($_POST["kelas"])
                ) {
                    echo "<h3>Your Input:</h3>";
                    echo 'NIS = ' . $_POST['nis'] . '<br />';
                    echo 'Nama = ' . $_POST['nama'] . '<br />';
                    echo 'Jenis Kelamin = ' . $_POST['jenis_kelamin'] . '<br />';
                    echo 'Kelas = ' . $_POST['kelas'] . '<br />';

                    // Jika kelas adalah X atau XI, tampilkan ekstrakurikuler yang dipilih
                    if (isset($_POST["kelas"]) && ($_POST["kelas"] == "X" || $_POST["kelas"] == "XI")) {
                        if (isset($_POST['ekskul']) && !empty($_POST['ekskul'])) {
                            // Menggunakan implode untuk menampilkan daftar peminatan
                            echo 'Ekstrakurikuler = ' . implode(", ", $_POST['ekskul']);
                        } else {
                            echo 'Ekstrakurikuler belum dipilih.<br />';
                        }
                    } elseif (isset($_POST["kelas"]) && $_POST["kelas"] == "XII") {
                        echo 'Kelas XII siswa tidak boleh mengikuti kegiatan ekstrakurikuler.<br />';
                    }
                    
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        // Function untuk menampilkan/menghilangkan pilihan ekstrakurikuler
        function toggleEkskul() {
            var kelas = document.getElementById("kelas").value;
            var ekskulDiv = document.getElementById("ekskul-options");
            var checkboxes = ekskulDiv.querySelectorAll('input[type="checkbox"]');

            // Disable checkbox untuk kelas XII
            if (kelas === "XII") {
                checkboxes.forEach(function(checkbox) {
                    checkbox.disabled = true;
                    checkbox.checked = false; // Uncheck semua checkbox kalau kelas XII
                });
            } else {
                checkboxes.forEach(function(checkbox) {
                    checkbox.disabled = false;
                });
            }
        }
    </script>
</body>

</html>