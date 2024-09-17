<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            Form Input Siswa
        </div>
        <div class="card-body">
            <form method="POST" action="" onsubmit="return validateForm()">
                <div class="mb-3">
                    <label for="nis" class="form-label">NIS:</label>
                    <input type="text" class="form-control" id="nis" name="nis">
                    <div class="text-danger" id="error-nis">
                        <?php if (isset($error_nis)) echo $error_nis; ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama">
                    <div class="text-danger" id="error-nama">
                        <?php if (isset($error_nama)) echo $error_nama; ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin:</label><br>
                    <input type="radio" id="pria" name="jenis_kelamin" value="Pria"> Pria<br>
                    <input type="radio" id="wanita" name="jenis_kelamin" value="Wanita"> Wanita
                    <div class="text-danger" id="error-jenis_kelamin">
                        <?php if (isset($error_jenis_kelamin)) echo $error_jenis_kelamin; ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="kelas" class="form-label">Kelas:</label>
                    <select class="form-select" id="kelas" name="kelas" onchange="toggleEkstrakurikuler()">
                        <option value="">Pilih Kelas</option>
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                    <div class="text-danger" id="error-kelas">
                        <?php if (isset($error_kelas)) echo $error_kelas; ?>
                    </div>
                </div>

                <div class="mb-3" id="ekstrakurikuler-section" style="display: none;">
                    <label class="form-label">Ekstrakurikuler:</label><br>
                    <input type="checkbox" name="ekstrakurikuler[]" value="Pramuka"> Pramuka<br>
                    <input type="checkbox" name="ekstrakurikuler[]" value="Seni Tari"> Seni Tari<br>
                    <input type="checkbox" name="ekstrakurikuler[]" value="Sinematografi"> Sinematografi<br>
                    <input type="checkbox" name="ekstrakurikuler[]" value="Basket"> Basket<br>
                    <div class="text-danger" id="error-ekstrakurikuler">
                        <?php if (isset($error_ekstrakurikuler)) echo $error_ekstrakurikuler; ?>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>

            <?php
            // Inisialisasi variabel kesalahan
            $error_nis = $error_nama = $error_jenis_kelamin = $error_kelas = $error_ekstrakurikuler = '';

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $nis = $_POST['nis'];
                $nama = $_POST['nama'];
                $jenis_kelamin = $_POST['jenis_kelamin'];
                $kelas = $_POST['kelas'];
                $ekstrakurikuler = isset($_POST['ekstrakurikuler']) ? $_POST['ekstrakurikuler'] : [];

                // Validasi NIS
                if (!preg_match('/^[0-9]{10}$/', $nis)) {
                    $error_nis = "NIS harus terdiri dari 10 karakter dan hanya boleh berisi angka.";
                }

                // Validasi Nama
                if (empty($nama)) {
                    $error_nama = "Nama wajib diisi.";
                }

                // Validasi Jenis Kelamin
                if (empty($jenis_kelamin)) {
                    $error_jenis_kelamin = "Jenis kelamin wajib dipilih.";
                }

                // Validasi Kelas
                if (empty($kelas)) {
                    $error_kelas = "Kelas wajib dipilih.";
                }

                // Validasi kelas X dan XI harus memilih ekstrakurikuler
                elseif (($kelas == 'X' || $kelas == 'XI') && (count($ekstrakurikuler) < 1 || count($ekstrakurikuler) > 3)) {
                    $error_ekstrakurikuler = "Siswa kelas X atau XI wajib memilih minimal 1 dan maksimal 3 ekstrakurikuler.";
                }

                // Validasi siswa kelas XII tidak boleh memilih ekstrakurikuler
                elseif ($kelas == 'XII' && !empty($ekstrakurikuler)) {
                    $error_ekstrakurikuler = "Siswa kelas XII tidak boleh mengikuti ekstrakurikuler.";
                }

                // Jika tidak ada error
                if (empty($error_nis) && empty($error_nama) && empty($error_jenis_kelamin) && empty($error_kelas) && empty($error_ekstrakurikuler)) {
                    echo '<div class="alert alert-success mt-3">Data berhasil disimpan.</div>';
                }
            }
            ?>
        </div>
    </div>
</div>

<script>
    function toggleEkstrakurikuler() {
        const kelas = document.getElementById('kelas').value;
        const ekstrakurikulerSection = document.getElementById('ekstrakurikuler-section');
        if (kelas === 'X' || kelas === 'XI') {
            ekstrakurikulerSection.style.display = 'block';
        } else {
            ekstrakurikulerSection.style.display = 'none';
        }
    }

    // Validasi frontend menggunakan JavaScript
    function validateForm() {
        let isValid = true;

        // Reset pesan error
        document.getElementById("error-nis").innerHTML = "";
        document.getElementById("error-nama").innerHTML = "";
        document.getElementById("error-jenis_kelamin").innerHTML = "";
        document.getElementById("error-kelas").innerHTML = "";
        document.getElementById("error-ekstrakurikuler").innerHTML = "";

        // Validasi NIS
        const nis = document.getElementById("nis").value;
        if (nis === "" || !/^[0-9]{10}$/.test(nis)) {
            document.getElementById("error-nis").innerHTML = "NIS harus terdiri dari 10 karakter angka.";
            isValid = false;
        }

        // Validasi Nama
        const nama = document.getElementById("nama").value;
        if (nama === "") {
            document.getElementById("error-nama").innerHTML = "Nama wajib diisi.";
            isValid = false;
        }

        // Validasi Jenis Kelamin
        const jenis_kelamin = document.querySelector('input[name="jenis_kelamin"]:checked');
        if (!jenis_kelamin) {
            document.getElementById("error-jenis_kelamin").innerHTML = "Jenis kelamin wajib dipilih.";
            isValid = false;
        }

        // Validasi Kelas
        const kelas = document.getElementById("kelas").value;
        if (kelas === "") {
            document.getElementById("error-kelas").innerHTML = "Kelas wajib dipilih.";
            isValid = false;
        }

        return isValid; // Hanya submit jika form valid
    }
</script>

</body>
</html>
