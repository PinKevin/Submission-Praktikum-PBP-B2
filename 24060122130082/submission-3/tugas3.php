<!-- Nama: Fathia Rahma
     NIM: 24060122130082
     Lab: PBP B2
     Tanggal: Senin, 16 September 2024
     Deskripsi: Pemrosesan Form -->

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>user_form_siswa</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
  <?php
  if (isset($_POST['submit'])) {
    //validasi nis
    $nis = test_input($_POST['nis']);
    if (empty($nis)) {
      $error_nis = "NIS harus diisi";
    } elseif (!preg_match("/^[0-9]{10}$/", $nis)) {
      $error_nis = "NIS hanya berisi 10 karakter dengan angka dari 0-9";
    }
    
    //validasi nama: tidak boleh kosong, hanya dapat berisi huruf dan spasi 
    $nama = test_input($_POST['nama']);
    if (empty($nama)) {
      $error_nama = "Nama harus diisi";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
      $error_nama = "Nama hanya dapat berisi huruf dan spasi";
    }

    //validasi jenis kelamin: tidak boleh kosong
    if (!isset($_POST['jenis_kelamin'])) {
      $error_jenis_kelamin = "Jenis kelamin harus diisi";
    }

    // Validasi Kelas
    $kelas = test_input($_POST['kelas']);
    if (empty($kelas)) {
      $error_kelas = "Kelas harus dipilih";
    }

     // Validasi Ekstrakurikuler
    if (isset($_POST['kelas']) && ($_POST['kelas'] == 'X' || $_POST['kelas'] == 'XI')) {
      if (!isset($_POST['ekstrakurikuler'])) {
        $error_ekstrakurikuler = "Ekstrakurikuler harus diisi minimal 1 dan maksimal 3";
      } else {
        $ekstrakurikuler = $_POST['ekstrakurikuler'];
        if (count($ekstrakurikuler) < 1 || count($ekstrakurikuler) > 3) {
          $error_ekstrakurikuler = "Pilih minimal 1 dan maksimal 3 ekstrakurikuler";
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
  <div class="container"><br/>
    <div class="card">
      <div class="card-header">Form Input Siswa</div>
      <div class="card-body">
        <form method="POST" autocomplete="on" action="">
          <div class="form-group">
            <label for="nis">NIS:</label>
            <input type="number" class="form-control" id="nis" name="nis" maxlength="10" value="<?php if (isset($_POST['nis'])) echo $_POST['nis'] ?>">
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
              <input type="radio" class="form-check-input" name="jenis_kelamin" value="wanita" <?php if (isset($_POST['jenis_kelamin']) && $_POST['jenis_kelamin'] == 'wanita') echo 'checked' ?> name="jenis_kelamin" value="pria">Wanita
            </label>
            <div class="error text-danger"><?php if (isset($error_jenis_kelamin)) echo $error_jenis_kelamin; ?></div>
          </div>
          <br>

          <div class="form-group">
          <label for="kelas">Kelas:</label>
          <select class="form-control" id="kelas" name="kelas">
            <option value="X" <?php if (isset($_POST['kelas']) && $_POST['kelas'] == 'X') echo 'selected'; ?>>X</option>
            <option value="XI" <?php if (isset($_POST['kelas']) && $_POST['kelas'] == 'XI') echo 'selected'; ?>>XI</option>
            <option value="XII" <?php if (isset($_POST['kelas']) && $_POST['kelas'] == 'XII') echo 'selected'; ?>>XII</option>
          </select>
          <div class="error text-danger"><?php if (isset($error_kelas)) echo $error_kelas; ?></div>
          </div>

          <div id="ekstrakurikuler-group" style="display:none;">
          <label>Ekstrakurikuler:</label>
          <div class="form-check">
            <label class="form-check-label">
              <input <?php if (isset($_POST['ekstrakurikuler']) && in_array('Pramuka', $_POST['ekstrakurikuler'])) echo 'checked' ?> type="checkbox" class="form-check-input" name="ekstrakurikuler[]" value="Pramuka" >Pramuka
            </label>
            <div class="error text-danger"><?php if (isset($error_ekstrakurikuler)) echo $error_ekstrakurikuler; ?></div>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input <?php if (isset($_POST['ekstrakurikuler']) && in_array('seni_tari', $_POST['ekstrakurikuler'])) echo 'checked' ?> type="checkbox" class="form-check-input" name="ekstrakurikuler[]" value="Seni tari">Seni Tari
            </label>
            <div class="error text-danger"><?php if (isset($error_ekstrakurikuler)) echo $error_ekstrakurikuler; ?></div>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input <?php if (isset($_POST['ekstrakurikuler']) && in_array('sinematografi', $_POST['ekstrakurikuler'])) echo 'checked' ?> type="checkbox" class="form-check-input" name="ekstrakurikuler[]" value="sinematografi">Sinematrogafi
            </label>
            <div class="error text-danger"><?php if (isset($error_ekstrakurikuler)) echo $error_ekstrakurikuler; ?></div>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input <?php if (isset($_POST['ekstrakurikuler']) && in_array('sinematografi', $_POST['ekstrakurikuler'])) echo 'checked' ?> type="checkbox" class="form-check-input" name="ekstrakurikuler[]" value="basket">Basket
            </label>
            <div class="error text-danger"><?php if (isset($error_ekstrakurikuler)) echo $error_ekstrakurikuler; ?></div>
          </div>
          <br>
          </div>

          <button type="submit" class="btn btn-primary" name="submit" value="submit">submit
          </button>
          <button type="reset" class="btn btn-danger">Reset</button>
        </form>
      </div>

      <script>
        document.addEventListener("DOMContentLoaded", function() {
          // Ambil elemen dropdown kelas dan grup ekstrakurikuler
          var kelasSelect = document.getElementById('kelas');
          var ekstrakurikulerGroup = document.getElementById('ekstrakurikuler-group');
        
          // Fungsi untuk mengatur visibilitas ekstrakurikuler
          function displayEkskul() {
            var selectedKelas = kelasSelect.value;
            if (selectedKelas === 'X' || selectedKelas === 'XI') {
              ekstrakurikulerGroup.style.display = 'block'; // Tampilkan jika kelas X atau XI
            } else {
              ekstrakurikulerGroup.style.display = 'none'; // Sembunyikan jika kelas XII
            }
          }
        
          displayEkskul();
          kelasSelect.addEventListener('change', displayEkskul);
        });
      </script>


      <?php
      if (isset($_POST["submit"]) && isset($_POST["nis"]) && isset($_POST["nama"]) && isset($_POST["jenis_kelamin"]) && isset($_POST["kelas"]) && isset($_POST["ekstrakurikuler"])) {
        echo "<h3>Data Siswa:</h3>";
        echo 'NIS = ' . $_POST['nis'] . '<br />';
        echo 'Nama = ' . $_POST['nama'] . '<br />';
        echo 'Jenis Kelamin = ' . $_POST['jenis_kelamin'] . '<br />';
        echo 'Kelas = ' . $_POST['kelas'] . '<br />';

        $ekstrakurikuler = $_POST['ekstrakurikuler'];
        if ($_POST['kelas'] == "X" || $_POST['kelas'] == "XI") {
          echo 'Ekskul yang dipilih: ';
          foreach ($ekstrakurikuler as $ekstrakurikuler_item) {
            echo '<br />' . $ekstrakurikuler_item;
          }
        }
        else{
          echo 'Ekstrakurikuler tidak dapat dipilih untuk Kelas XII';
        }
      }
      ?>

</body>

</html>