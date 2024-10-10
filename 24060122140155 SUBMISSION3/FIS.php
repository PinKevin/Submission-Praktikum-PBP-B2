<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Form Input Siswa</title>
    </head>
    <body>
        <h1>Form Input Siswa</h1>
        <form action="" method="GET">
            <div>
                <label>NIS</label> <br>
                <input type="text" name="nis" placeholder="Masukan NIS">
            </div>
            <div style="margin-top: 0.5rem">
                <label>Nama</label> <br>
                <input type="text" name="nama" placeholder="Masukan Nama Anda">
            </div>
            <label>Jenis Kelamin</label>
            <div style="margin-top: 0.5rem">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="jenis_kelamin" value="pria">Pria
                    </label>
                </div>
            </div>
            <div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="jenis_kelamin" value="wanita">Wanita
                    </label>
                </div>
            </div>
            <div>
                <label>Kelas</label>
                <div style="margin-top:0.5rem">
                    <label class="form-check-label">
                        <select name="kelas">
                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                        </select>
                    </label>
                </div>
            </div>
            <label>Ekstrakurikuler</label> <br>
            <div style="margin-top:0.5rem">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="minat[]" value="Pramuka">Pramuka <br>
                    <input type="checkbox" class="form-check-input" name="minat[]" value="Sinematografi">Sinematografi <br>
                    <input type="checkbox" class="form-check-input" name="minat[]" value="Basket">Basket <br>
                    <input type="checkbox" class="form-check-input" name="minat[]" value="Seni Tari">Seni Tari <br>
                </label>
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </form>
    </body>
    <?php
    function text_input($data) {
        $data = trim($data); 
        $data = stripslashes($data); 
        $data = htmlspecialchars($data); 
        return $data;
    }
    
    if (isset($_GET["submit"])) {
        $nis = isset($_GET['nis']) ? text_input($_GET['nis']) : '';
        $nama = isset($_GET['nama']) ? text_input($_GET['nama']) : '';
        $kelas = isset($_GET['kelas']) ? text_input($_GET['kelas']) : '';
        $jeniskelamin=isset($_GET['jeniskelamin']) ? text_input($_GET['jeniskelamin']):'';
        $ekstrakulikuler = isset($_GET['ekstrakulikuler']) ? array_map('text_input', $_GET['ekstrakulikuler']) : [];
    
        if (!preg_match("/^[0-9]{10}$/", $nis)) {
            echo "<p style='color: red;'>NIS harus berupa angka dan terdiri dari 10 digit.</p>";
        }
    
        
        if ($kelas === 'X' || $kelas === 'XI') {
            
            if (count($ekstrakulikuler) < 1 || count($ekstrakulikuler) > 3) {
                echo "<p style='color: red;'>Siswa kelas X atau XI harus memilih minimal 1 dan maksimal 3 kegiatan ekstrakurikuler.</p>";
            } else {
                echo "<p>Ekstrakurikuler yang dipilih: " . implode(", ", $ekstrakulikuler) . "</p>";
            }
        } elseif ($kelas === 'XII') {
            if (!empty($ekstrakulikuler)) {
                echo "kelas XII tidak boleh memilih kegiatan ekstrakurikuler.</p>";
            } else {
                echo "Tidak ada kegiatan ekstrakurikuler yang dipilih untuk kelas XII";
            }
        }
    }
    ?>
</html>
