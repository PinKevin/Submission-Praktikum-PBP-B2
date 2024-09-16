<!-- Nama: Keisya Intan Nabila
    NIM: 24060122130063
    Tanggal: Senin, 16 September 2024
    Deskripsi: Pemrosesan Form -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tugas Praktikum ke-3</title>
    <!-- Untuk menghubungkan file CSS Bootstrap dari CDN untuk gaya tampilan yang responsif -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script>
        // Untuk menampilkan atau menyembunyikan bagian eskul berdasarkan pilihan kelas x, xi, xii
        function pilihanKelas() {
            var kelas = document.getElementById("kelas").value;
            var eskulpil = document.getElementById("eskul_Pil");

            if (kelas === "X (Kelas 10)" || kelas === "XI (Kelas 11)") {
                eskulpil.style.display = "block";
            } else {
                eskulpil.style.display = "none";
            }
        }
        // UNtuk memeriksa batasan jumlah eskul yang dipilih dan menampilkan pesan eror
        function checkEskulLimit() {
            var kelas = document.getElementById("kelas").value;
            var checkboxes = document.querySelectorAll('input[name="ekstrakurikuler[]"]');
            var checkedCount = 0;

            checkboxes.forEach(function (checkbox) {
                if (checkbox.checked) {
                    checkedCount++;
                }
            });

            if (kelas === "X (Kelas 10)" || kelas === "XI (Kelas 11)") {
                if (checkedCount > 3) {
                    errorEskul.textContent = "Anda hanya bisa memilih maksimal 3 ekstrakurikuler.";
                    return false;
                }
                else if (checkedCount < 1) {
                    errorEskul.textContent = "Anda harus memilih minimal 1 ekstrakurikuler.";
                    return false;
                }
                else{
                    errorEskul.textContent = "";
                }
            }
        }

        // Mengatur event listener untuk checkbox eskul dan tombol reset, untuk
        // mengatur visibilitas eskul dan menghapus eror saat tombol reset diklik
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('input[name="ekstrakurikuler[]"]').forEach(function (checkbox) {
                checkbox.addEventListener('change', checkEskulLimit);
            });

            document.querySelector('button[type="reset"]').addEventListener('click', function () {
                document.getElementById("kelas").selectedIndex = 0;
                document.getElementById("eskul_Pil").style.display = "none";
                document.querySelectorAll('input[name="ekstrakurikuler[]"]').forEach(function (checkbox) {
                    checkbox.checked = false;
                });
                document.getElementById('error_eskul').textContent = ""; //Clear error message ketika reset
            });
        });
    </script>
</head>
<body>
    <?php
        $error_nis = $error_nama = $error_jenis_kelamin = $error_kelas = $error_eskul = "";
        $isValid = true;
        $data_siswa = [];

        if (isset($_POST['submit'])) {
            // Validasi NIS. Memastikan NIS tidak kososng dan terdiri dari 10 angka
            $NIS = test_input($_POST['NIS']);
            if (empty($NIS)) {
                $error_nis = "NIS tidak boleh kosong, harus diisi";
                $isValid = false;
            } elseif (!preg_match("/^[0-9]{10}$/", $NIS)) {
                $error_nis = "NIS hanya dapat diisi oleh 10 karakter, yaitu angka 0..9";
                $isValid = false;
            }

            //Validasi Nama. Tidak boleh kosong
            $nama = test_input($_POST['nama']);
            if (empty($nama)) {
                $error_nama = "Nama tidak boleh kosong, harus diisi";
                $isValid = false;
            } elseif (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
                $error_nama = "Nama hanya dapat berisi huruf dan spasi";
                $isValid = false;
            }

            //Validasi jenis kelamin. Tidak boleh kosong
            if (!isset($_POST['jenis_kelamin'])) {
                $error_jenis_kelamin = "Jenis kelamin harus diisi";
                $isValid = false;
            }

            //Validasi kelas. Tidak boleh kosong
            if (!isset($_POST['kelas'])) {
                $error_kelas = "Kelas tidak boleh kosong, harus diisi";
                $isValid = false;
            }

            //Validasi eskul. Eskul harus diisi minimal 1 dan maksimal 3
            if (isset($_POST['kelas']) && ($_POST['kelas'] == "X (Kelas 10)" || $_POST['kelas'] == "XI (Kelas 11)")) {
                if (!isset($_POST['ekstrakurikuler']) || count($_POST['ekstrakurikuler']) < 1) {
                    $error_eskul = "Ekstrakurikuler harus diisi";
                    $isValid = false;
                } elseif (count($_POST['ekstrakurikuler']) > 3) {
                    $error_eskul = "Anda hanya bisa memilih maksimal 3 ekstrakurikuler.";
                    $isValid = false;
                }
            }

            //Untuk menampilkan rincian isian data siswa
            if ($isValid) {
                $data_siswa['NIS'] = $_POST['NIS'];
                $data_siswa['Nama'] = $_POST['nama'];
                $data_siswa['Jenis Kelamin'] = $_POST['jenis_kelamin'];
                $data_siswa['Kelas'] = $_POST['kelas'];
                if ($_POST['kelas'] == "X (Kelas 10)" || $_POST['kelas'] == "XI (Kelas 11)") {
                    $data_siswa['Ekstrakurikuler'] = isset($_POST['ekstrakurikuler']) ? $_POST['ekstrakurikuler'] : 'Ekstrakurikuler tidak dipilih';
                } else {
                    $data_siswa['Ekstrakurikuler'] = 'Ekstrakurikuler tidak dapat dipilih untuk Kelas XII';
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
    <div class="container"><br/>
        <div class="card">
            <div class="card-header">Form Input Siswa</div>
            <div class="card-body">
                <form method="POST" autocomplete="on" action="">
                    <div class="form-group">
                        <label for="NIS">NIS:</label>
                        <input type="text" class="form-control" id="NIS" name="NIS" maxlength="10" value="<?php if (isset($_POST['NIS'])) echo $_POST['NIS'] ?>">
                        <div class="error text-danger"><?php echo $error_nis; ?></div>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php if (isset($_POST['nama'])) echo $_POST['nama'] ?>">
                        <div class="error text-danger"><?php echo $error_nama; ?></div>
                    </div>
                    <label>Jenis Kelamin:</label>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" <?php if (isset($_POST['jenis_kelamin']) && $_POST['jenis_kelamin'] == 'pria') echo 'checked' ?> name="jenis_kelamin" value="pria">Pria
                        </label>
                        <div class="error text-danger"><?php echo $error_jenis_kelamin; ?></div>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" <?php if (isset($_POST['jenis_kelamin']) && $_POST['jenis_kelamin'] == 'wanita') echo 'checked' ?> name="jenis_kelamin" value="wanita">Wanita
                        </label>
                        <div class="error text-danger"><?php echo $error_jenis_kelamin; ?></div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="kelas">Kelas:</label>
                        <select id="kelas" name="kelas" class="form-control" onchange="pilihanKelas()">
                            <option value="" selected disabled>-- Pilih Kelas --</option>
                            <option value="X (Kelas 10)" <?php if (isset($_POST['kelas']) && $_POST['kelas'] == "X (Kelas 10)") echo 'selected' ?>>X (Kelas 10)</option>
                            <option value="XI (Kelas 11)" <?php if (isset($_POST['kelas']) && $_POST['kelas'] == "XI (Kelas 11)") echo 'selected' ?>>XI (Kelas 11)</option>
                            <option value="XII (Kelas 12)" <?php if (isset($_POST['kelas']) && $_POST['kelas'] == "XII (Kelas 12)") echo 'selected' ?>>XII (Kelas 12)</option>
                        </select>
                        <div class="error text-danger"><?php echo $error_kelas; ?></div>
                    </div>

                    <div id="eskul_Pil" style="display: <?php if (isset($_POST['kelas']) && $_POST['kelas'] == "XII (Kelas 12)") {echo 'none';} else{echo 'block';} ?>;">
                        <label>Ekstrakurikuler:</label>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="ekstrakurikuler[]" value="Pramuka" <?php if (isset($_POST['ekstrakurikuler']) && in_array('Pramuka', $_POST['ekstrakurikuler'])) echo 'checked' ?>>Pramuka
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="ekstrakurikuler[]" value="Seni Tari" <?php if (isset($_POST['ekstrakurikuler']) && in_array('Seni Tari', $_POST['ekstrakurikuler'])) echo 'checked' ?>>Seni Tari
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="ekstrakurikuler[]" value="Sinematografi" <?php if (isset($_POST['ekstrakurikuler']) && in_array('Sinematografi', $_POST['ekstrakurikuler'])) echo 'checked' ?>>Sinematografi
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="ekstrakurikuler[]" value="Basket" <?php if (isset($_POST['ekstrakurikuler']) && in_array('Basket', $_POST['ekstrakurikuler'])) echo 'checked' ?>>Basket
                            </label>
                        </div>
                        <div class="error text-danger"><?php echo $error_eskul; ?></div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                    <button type="reset" class="btn btn-danger" value="Reset">Reset</button>
                </form>
            </div>
        </div>
        
        <?php
            if ($isValid && isset($data_siswa) && !empty($data_siswa)) {
                echo "<br/><h3>Data Siswa:</h3>";
                foreach ($data_siswa as $key => $value) {
                    if (is_array($value)) {
                        echo $key . ":<br>";
                        foreach ($value as $item) {
                            echo '- ' . htmlspecialchars($item) . '<br>';
                        }
                    } else {
                        echo $key . " = " . htmlspecialchars($value) . '<br>';
                    }
                }
            }
        ?>
    </div>
</body>
</html>
