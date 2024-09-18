<!-- Nama: Demina Ayunda Chesara
     NIM: 24060122140149
     Tanggal: 16 September 2024
Praktikum Pengembangan Berbasis Platform B2 --> 

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Input Siswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    
    <script>
        function checkClass() {
            var kelas = document.getElementById('kelas').value;  
            var eskulDiv = document.getElementById('eskulDiv');  
            
            if (kelas === 'X' || kelas === 'XI') {
                eskulDiv.style.display = 'block';  
            } else {
                eskulDiv.style.display = 'none';  
            }
        } 
        window.onload = function() {
            checkClass();  
        };
    </script>

</head>
<body>
    <?php
        $error_nis = $error_nama = $error_jenis_kelamin = $error_kelas = $error_eskul = "";
        $valid = true;

        if (isset($_POST['submit'])) {
            $nis = test_input($_POST['nis']);
            if (empty($nis)) {
                $error_nis = "NIS harus diisi";
                $valid = false;
            } elseif (!preg_match("/^[0-9]{10}$/", $nis)) {
                $error_nis = "NIS harus berisi 10 karakter angka";
                $valid = false;
            }

            $nama = test_input($_POST['nama']);
            if (empty($nama)) {
                $error_nama = "Nama harus diisi";
                $valid = false;
            } elseif (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
                $error_nama = "Nama hanya dapat berisi huruf dan spasi";
                $valid = false;
            }

            if (!isset($_POST['jenis_kelamin'])) {
                $error_jenis_kelamin = "Jenis kelamin harus diisi";
                $valid = false;
            }

            if (!isset($_POST['kelas'])) {
                $error_kelas = "Kelas harus diisi";
                $valid = false;
            }

            if (isset($_POST['kelas']) && ($_POST['kelas'] == 'X' || $_POST['kelas'] == 'XI')) {
                if (!isset($_POST['eskul']) || count($_POST['eskul']) < 1 || count($_POST['eskul']) > 3) {
                    $error_eskul = "Pilih minimal 1, maksimal 3 ekstrakurikuler";
                    $valid = false;
                }
            }
        }

        function test_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    
        if (isset($_POST['eskul'])) {
            $eskul = $_POST['eskul'];
        }
    ?>

    <div class="container"><br/>
        <div class="card">
            <div class="card-header">Form Input Siswa</div>
            <div class="card-body">
                <form method="POST" autocomplete="on" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="form-group">
                        <label for="nis">NIS:</label>
                        <input type="text" class="form-control" id="nis" name="nis" maxlength="10" value="<?php if (isset($_POST['nis'])) echo $_POST['nis'] ?>">
                        <div class="error text-danger"><?php if (isset($error_nis)) echo $error_nis; ?></div>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" maxlength="50" value="<?php if (isset($_POST['nama'])) echo $_POST['nama'] ?>">
                        <div class="error text-danger"><?php if (isset($error_nama)) echo $error_nama; ?></div>
                    </div>

                    <label>Jenis Kelamin:</label>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" <?php if (isset($_POST['jenis_kelamin']) && $_POST['jenis_kelamin'] == 'pria') echo 'checked' ?> name="jenis_kelamin" value="pria">Pria
                        </label>
                        <div class="error text-danger"><?php if (isset($error_jenis_kelamin)) echo $error_jenis_kelamin; ?></div>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="jenis_kelamin" value="wanita" <?php if (isset($_POST['jenis_kelamin']) && $_POST['jenis_kelamin'] == 'wanita') echo 'checked' ?>>Wanita
                        </label>
                        <div class="error text-danger"><?php if (isset($error_jenis_kelamin)) echo $error_jenis_kelamin; ?></div>
                    </div>

                    <div class="form-group">
                        <label for="kelas">Kelas:</label>
                        <select id="kelas" name="kelas" class="form-control" onchange="checkClass()">
                            <option value="" disabled <?php if (!isset($_POST['kelas']) || $_POST['kelas'] == "") echo 'selected'; ?>>-- Pilih Kelas --</option>
                            <option value="X" <?php if (isset($_POST['kelas']) && $_POST['kelas'] == 'X') echo 'selected'; ?>>X</option>
                            <option value="XI" <?php if (isset($_POST['kelas']) && $_POST['kelas'] == 'XI') echo 'selected'; ?>>XI</option>
                            <option value="XII" <?php if (isset($_POST['kelas']) && $_POST['kelas'] == 'XII') echo 'selected'; ?>>XII</option>
                        </select>
                        <div class="error text-danger"><?php if (isset($error_kelas)) echo $error_kelas; ?></div>
                    </div>

                    
                    <div id="eskulDiv" style="display:none;">
                        <label>Ekstrakurikuler:</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="eskul[]" value="Pramuka" <?php if (isset($_POST['eskul']) && in_array('Pramuka', $_POST['eskul'])) echo 'checked'; ?>>
                            <label class="form-check-label">Pramuka</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="eskul[]" value="Seni Tari" <?php if (isset($_POST['eskul']) && in_array('Seni Tari', $_POST['eskul'])) echo 'checked'; ?>>
                            <label class="form-check-label">Seni Tari</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="eskul[]" value="Sinematografi" <?php if (isset($_POST['eskul']) && in_array('Sinematografi', $_POST['eskul'])) echo 'checked'; ?>>
                            <label class="form-check-label">Sinematografi</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="eskul[]" value="Basket" <?php if (isset($_POST['eskul']) && in_array('Basket', $_POST['eskul'])) echo 'checked'; ?>>
                            <label class="form-check-label">Basket</label>
                        </div>
                        <div class="error text-danger"><?php if (!empty($error_eskul)) echo $error_eskul; ?></div>
                    </div>

                    <br>
                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                    <button type="reset" class="btn btn-danger" onclick="window.location.href='<?php echo $_SERVER['PHP_SELF']; ?>'">Reset</button>

                    <?php
                    if (isset($_POST["submit"]) && isset($_POST["nis"]) && isset($_POST["nama"]) && isset($_POST["kelas"]) && isset($_POST["jenis_kelamin"]) && $valid) {
                        echo "<h3>Your Input:</h3>";
                        echo 'NIS = ' . $_POST['nis'] . '<br />';
                        echo 'Nama = ' . $_POST['nama'] . '<br />';
                        echo 'Jenis Kelamin = ' . $_POST['jenis_kelamin'] . '<br />';
                        echo 'Kelas = ' . $_POST['kelas'] . '<br />';
                    
                        
                        if ($_POST['kelas'] != 'XII') {
                            if (isset($_POST['eskul']) && !empty($_POST['eskul'])) {
                                echo 'Ekstrakurikuler yang dipilih: ';
                                foreach ($_POST['eskul'] as $eskul_item) {
                                    echo $eskul_item . '<br />';
                                }
                            } else {
                                echo 'Ekstrakurikuler tidak dipilih';
                            }
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
