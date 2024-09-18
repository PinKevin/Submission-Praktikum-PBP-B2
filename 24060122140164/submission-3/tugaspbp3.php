<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        *{
            font-family: Arial, sans-serif;
        }
        .hidden {
            display: none;
        }
    </style>
    <title>Form Siswa</title>
    <script>
        function checkKelas() {
            var kelas = document.getElementById('kelas').value;
            var ekskulSection = document.getElementById('ekskul-section');
            
            if (kelas === 'XII') {
                ekskulSection.classList.add('hidden');
            } else {
                ekskulSection.classList.remove('hidden');
            }
        }

        function validateForm() {
            var nis = document.getElementById('nis').value;
            var kelas = document.getElementById('kelas').value;
            var checkboxes = document.querySelectorAll('input[name="ekskul[]"]:checked');
            var errorNis = document.getElementById('error_nis');
            var errorEkskul = document.getElementById('error_ekskul');
            
            errorNis.textContent = ""; 
            errorEkskul.textContent = ""; 

            if (nis.length !== 10 || isNaN(nis)) {
                errorNis.textContent = "NIS harus terdiri dari 10 angka.";
                return false;
            }

            if (kelas !== 'XII') {
                if (checkboxes.length < 1 || checkboxes.length > 3) {
                    errorEkskul.textContent = "Ekstrakurikuler harus diisi (Min 1 & Max 3)";
                    return false;
                }
            }

            return true;  
        }

        function resetForm() {
            document.getElementById('formSiswa').reset();
            document.getElementById('ekskul-section').classList.remove('hidden');
            document.getElementById('error_nis').textContent = "";
            document.getElementById('error_ekskul').textContent = "";
        }
    </script>
</head>
<body>

<?php
    if (isset($_POST['submit'])) {
        $nis = test_input($_POST['nis']);
        if (empty($nis)) {
            $error_nis = "NIS harus diisi";
        } elseif (!preg_match("/^[0-9]{10}$/", $nis)) {
            $error_nis = "NIS harus berisi 10 angka";
        }
        
        $nama = test_input($_POST['nama']);
        if (empty($nama)) {
            $error_nama = "Nama harus diisi";
        } elseif (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
            $error_nama = "Nama hanya dapat berisi huruf dan spasi";
        }
        
        if (!isset($_POST['jenis_kelamin'])) {
            $error_jenis_kelamin = "Jenis kelamin harus diisi";
        }
        
        if (!isset($_POST['kelas'])) {
            $error_kelas = "Kelas harus diisi";
        }
        
        $ekskul = isset($_POST['ekskul']) ? $_POST['ekskul'] : array();
        $kelas = $_POST['kelas'];
        
        if ($kelas !== 'XII' && (count($ekskul) < 1 || count($ekskul) > 3)) {
            $error_ekskul = "Isi ekstrakurikuler Min 1 & Max 3!";
        }
    }

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
?>

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6 m-auto">
                <div class="card">
                <div class="card-header">Form Siswa</div>
                    <div class="card-body">
                        <form id="formSiswa" method="post" autocomplete="on" action="" onsubmit="return validateForm()">
                        <div class="form-group">
                            <label for="nis">NIS:</label>
                            <input type="text" class="form-control" id="nis" name="nis" maxlength="10" value="">
                            <div class="error text-danger" id="error_nis"><?php if (isset($error_nis)) echo $error_nis; ?></div>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" class="form-control" id="nama" name="nama" maxlength="100" value="">
                            <div class="error text-danger"><?php if (isset($error_nama)) echo $error_nama; ?></div>
                        </div>
                        <label>Jenis Kelamin:</label>
                        <div class="form-check">
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="jenis_kelamin" value="pria">Pria
                            </label>
                            <div class="error text-danger"><?php if (isset($error_jenis_kelamin)) echo $error_jenis_kelamin; ?></div>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="jenis_kelamin" value="wanita">Wanita
                            </label>
                            <div class="error text-danger"><?php if (isset($error_jenis_kelamin)) echo $error_jenis_kelamin; ?></div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="kelas">Kelas:</label>
                            <select id="kelas" name="kelas" class="form-control" onchange="checkKelas()">
                            <option value="" selected disabled>-- Pilih Kelas --</option>
                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                            </select>
                            <div class="error text-danger"><?php if (isset($error_kelas)) echo $error_kelas; ?></div>
                        </div>
                        <div id="ekskul-section">
                                <label>Ekstrakurikuler:</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="ekskul[]" value="pramuka">Pramuka
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="ekskul[]" value="seni_tari">Seni Tari
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="ekskul[]" value="sinematografi">Sinematografi
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="ekskul[]" value="basket">Basket
                                    </label>
                                </div>
                                <div class="error text-danger" id="error_ekskul"><?php if (isset($error_ekskul)) echo $error_ekskul; ?></div>
                        </div>

                        <br>
                            <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                            <button type="button" class="btn btn-danger" onclick="resetForm()">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

    <?php
      if (isset($_POST["submit"]) && isset($_POST["nis"]) && isset($_POST["nama"]) && isset($_POST["jenis_kelamin"]) && isset($_POST["kelas"])) {
        echo "<h3>Your Input:</h3>";
        echo 'NIS = ' . $_POST['nis'] . '<br />';
        echo 'Nama = ' . $_POST['nama'] . '<br />';
        echo 'Jenis Kelamin = ' . $_POST['jenis_kelamin'] . '<br />';
        echo 'Kelas = ' . $_POST['kelas'] . '<br />';

        $ekskul = isset($_POST['ekskul']) ? $_POST['ekskul'] : array();
        if (!empty($ekskul)) {
          echo 'Ekstrakurikuler yang dipilih: ';
          foreach ($ekskul as $ekskul_item) {
            echo '<br />' . $ekskul_item;
          }
        }
      }
    ?>
</body>
</html>
