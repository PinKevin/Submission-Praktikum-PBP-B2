<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Input Siswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
    body {
        background-color: #f4f6f9;
        margin: 0;
        padding: 0;
    }

    .form-container {
        margin: auto;
        width: 50%;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 12px;
    }

    .form-header {
        text-align: center;
        margin-bottom: 20px;
        font-size: 1.8em;
        font-weight: bold;
        color: #333;

    }

    .btn-group {
        display: flex;
        justify-content: space-between;
    }

    .card {
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .error {
        font-size: 0.9em;
        color: red;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }
    </style>
</head>

<body>
    <?php
  $error_nis = $error_nama = $error_jenis_kelamin = $error_kelas = $error_ekstrakurikuler = '';

  if (isset($_POST['submit'])) {
    // Validasi NIS
    $nis = test_input($_POST['nis']);
    if (empty($nis)) {
      $error_nis = "NIS harus diisi";
    } elseif (!preg_match("/^[0-9]{10}$/", $nis)) {
      $error_nis = "NIS harus terdiri dari 10 angka";
    }

    // Validasi Nama
    $nama = test_input($_POST['nama']);
    if (empty($nama)) {
      $error_nama = "Nama harus diisi";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
      $error_nama = "Nama hanya dapat berisi huruf dan spasi";
    }

    // Validasi jenis kelamin
    if (!isset($_POST['jenis_kelamin'])) {
      $error_jenis_kelamin = "Jenis kelamin harus diisi";
    }

    // Validasi kelas
    $kelas = isset($_POST['kelas']) ? $_POST['kelas'] : '';
    if (empty($kelas)) {
      $error_kelas = "Kelas harus diisi";
    }

    // Validasi ekstrakurikuler jika kelas X atau XI
    if ($kelas == 'X' || $kelas == 'XI') {
      if (!isset($_POST['ekstrakurikuler'])) {
        $error_ekstrakurikuler = "Ekstrakurikuler harus dipilih (minimal 1, maksimal 3)";
      } else {
        $ekstrakurikuler = $_POST['ekstrakurikuler'];
        if (count($ekstrakurikuler) < 1 || count($ekstrakurikuler) > 3) {
          $error_ekstrakurikuler = "Ekstrakurikuler minimal 1 dan maksimal 3";
        }
      }
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

    <div class="container form-container">
        <h2 class="alert alert-primary form-header">FORM INPUT SISWA</h2>
        <div class="card">
            <div class="card-body">
                <form method="POST" autocomplete="on" action="">
                    <!-- NIS Field -->
                    <div class="form-group">
                        <label for="NIS">NIS:</label>
                        <input type="text" class="form-control" id="nis" name="nis" maxlength="10" value="<?php if (isset($_POST['nis']))
                echo $_POST['nis'] ?>">
                        <div class="error"><?php if (isset($error_nis))
                echo $error_nis; ?></div>
                    </div>

                    <!-- Nama Field -->
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" maxlength="50" value="<?php if (isset($_POST['nama']))
                echo $_POST['nama'] ?>">
                        <div class="error"><?php if (isset($error_nama))
                echo $error_nama; ?></div>
                    </div>

                    <!-- Jenis Kelamin -->
                    <label>Jenis Kelamin:</label>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="jenis_kelamin" value="pria" <?php if (isset($_POST['jenis_kelamin']) && $_POST['jenis_kelamin'] == 'pria')
              echo 'checked' ?>>
                        <label class="form-check-label">Pria</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="jenis_kelamin" value="wanita" <?php if (isset($_POST['jenis_kelamin']) && $_POST['jenis_kelamin'] == 'wanita')
              echo 'checked' ?>>
                        <label class="form-check-label">Wanita</label>
                    </div>
                    <div class="error"><?php if (isset($error_jenis_kelamin))
              echo $error_jenis_kelamin; ?></div>

                    <!-- Kelas Field -->
                    <div class="form-group mt-3">
                        <label for="kelas">Kelas:</label>
                        <select id="kelas" name="kelas" class="form-control"
                            onchange="toggleEkstrakurikuler(this.value)">
                            <option value="" selected disabled>-- Pilih Kelas --</option>
                            <option value="X" <?php if (isset($_POST['kelas']) && $_POST['kelas'] == 'X')
                echo 'selected' ?>>X</option>
                            <option value="XI" <?php if (isset($_POST['kelas']) && $_POST['kelas'] == 'XI')
                echo 'selected' ?>>XI
                            </option>
                            <option value="XII" <?php if (isset($_POST['kelas']) && $_POST['kelas'] == 'XII')
                echo 'selected' ?>>XII
                            </option>
                        </select>
                        <div class="error"><?php if (isset($error_kelas))
                echo $error_kelas; ?></div>
                    </div>

                    <!-- Ekstrakurikuler -->
                    <div id="ekstrakurikuler-group" style="display: none;">
                        <label>Ekstrakurikuler:</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="ekstrakurikuler[]" value="Pramuka" <?php if (isset($_POST['ekstrakurikuler']) && in_array('Pramuka', $_POST['ekstrakurikuler']))
                echo 'checked' ?>>
                            <label class="form-check-label">Pramuka</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="ekstrakurikuler[]" value="Seni Tari" <?php if (isset($_POST['ekstrakurikuler']) && in_array('Seni Tari', $_POST['ekstrakurikuler']))
                echo 'checked' ?>>
                            <label class="form-check-label">Seni Tari</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="ekstrakurikuler[]"
                                value="Sinematografi" <?php if (isset($_POST['ekstrakurikuler']) && in_array('Sinematografi', $_POST['ekstrakurikuler']))
                echo 'checked' ?>>
                            <label class="form-check-label">Sinematografi</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="ekstrakurikuler[]" value="Basket" <?php if (isset($_POST['ekstrakurikuler']) && in_array('Basket', $_POST['ekstrakurikuler']))
                echo 'checked' ?>>
                            <label class="form-check-label">Basket</label>
                        </div>
                        <div class="error"><?php if (isset($error_ekstrakurikuler))
                echo $error_ekstrakurikuler; ?></div>
                    </div>

                    <!-- Buttons -->
                    <div class="btn-group mt-4">
                        <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </form>

                <?php
        if (isset($_POST["submit"]) && empty($error_nis) && empty($error_nama) && empty($error_jenis_kelamin) && empty($error_kelas) && empty($error_ekstrakurikuler)) {
          echo "<h3 class='mt-4'>Your Input:</h3>";
          echo 'NIS = ' . $_POST['nis'] . '<br />';
          echo 'Nama = ' . $_POST['nama'] . '<br />';
          echo 'Jenis Kelamin = ' . $_POST['jenis_kelamin'] . '<br />';
          echo 'Kelas = ' . $_POST['kelas'] . '<br />';

          if ($kelas == 'X' || $kelas == 'XI') {
            $ekstrakurikuler = $_POST['ekstrakurikuler'];
            if (!empty($ekstrakurikuler)) {
              echo 'Ekstrakurikuler yang dipilih: ';
              foreach ($ekstrakurikuler as $ekstra) {
                echo '<br />' . $ekstra;
              }
            }
          } else {
            echo 'Siswa kelas XII tidak mengikuti ekstrakurikuler.';
          }
        }
        ?>

                <script>
                function toggleEkstrakurikuler(kelas) {
                    var ekstrakurikulerGroup = document.getElementById('ekstrakurikuler-group');
                    if (kelas === 'X' || kelas === 'XI') {
                        ekstrakurikulerGroup.style.display = 'block';
                    } else {
                        ekstrakurikulerGroup.style.display = 'none';
                    }
                }


                window.onload = function() {
                    var kelas = document.getElementById('kelas').value;
                    toggleEkstrakurikuler(kelas);
                };
                </script>
            </div>
        </div>
    </div>
</body>

</html>