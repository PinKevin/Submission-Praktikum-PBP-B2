<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertemuan 3</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f5f5f5;
        }
        .card {
            margin-top: 50px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px;
            border-radius: 5px 5px 0 0;
        }
        .card-body {
            padding: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .error {
            color: #dc3545;
        }
    </style>
</head>

<body>
    <?php
    $error_nis = $error_nama = $error_jenis_kelamin = $error_extrakulikuler = '';
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (isset($_GET["submit"])) {
        // Validation for NIS
        $nis = test_input($_GET['nis']);
        if (empty($nis)) {
            $error_nis = "NIS harus diisi";
        } elseif (!preg_match("/^[0-9]{10}$/", $nis)) {
            $error_nis = "NIS hanya berisi 10 digit angka";
        }

        // Validation for Nama
        $nama = test_input($_GET['nama']);
        if (empty($nama)) {
            $error_nama = "Nama harus diisi";
        }

        // Validation for Kelas
        $error_kelas = '';
        if (isset($_GET['kelas']) && !empty($_GET['kelas'])) {
            $kelas = $_GET['kelas'];
        } else {
            $error_kelas = "Kelas harus diisi";
        }

        // Validation for Jenis Kelamin
        if (isset($_GET['jenis_kelamin'])) {
            $jenis_kelamin = $_GET['jenis_kelamin'];
        } else {
            $error_jenis_kelamin = "Jenis Kelamin harus diisi";
        }

        // Validation for Ekstrakulikuler
        if (isset($_GET['kelas'])) {
            $kelas = $_GET['kelas'];
            if ($kelas == 'X' || $kelas == 'XI') {
                if (isset($_GET['extrakulikuler'])) {
                    $extrakulikuler = $_GET['extrakulikuler'];
                    if (
                        count($extrakulikuler) < 1
                    ) {
                        $error_extrakulikuler = "Minimal memilih 1 ekstrakulikuler";
                    } elseif (count($extrakulikuler) > 3) {
                        $error_extrakulikuler = "Maksimal memilih 3 ekstrakulikuler";
                    }
                } else {
                    $error_extrakulikuler = "Minimal memilih 1 ekstrakulikuler";
                }
            } elseif ($kelas == 'XII') {
                if (isset($_GET['extrakulikuler'])) {
                    $extrakulikuler = $_GET['extrakulikuler'];
                    if (
                        count($extrakulikuler) > 0
                    ) {
                        $error_extrakulikuler = "Tidak boleh memilih ekstrakulikuler";
                    }
                }
            }
        } else {
            $error_extrakulikuler = "Kelas harus diisi";
        }
    }
    ?>
    <div class="container"> <br>
        <div class="card">
            <div class="card-header">Form Input Siswa</div>
            <div class="card-body">
                <form action="" method="get" autocomplete="on">
                    <div class="form-group">
                        <label for="nis">NIS:</label>
                        <input type="text" class="form-control" id="nis" name="nis" maxlength="10" value="<?php if (isset($nis)) {
                                                                                                                echo $nis;
                                                                                                            } ?>">
                        <div class="error">
                            <?php if (isset($error_nis)) echo $error_nis; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php if (isset($nama)) {
                                                                                                    echo $nama;
                                                                                                } ?>">
                        <div class="error">
                            <?php if (isset($error_nama)) echo $error_nama; ?>
                        </div>
                    </div>

                    <label>Jenis Kelamin :</label>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="jenis_kelamin" value="pria" <?php if (isset($jenis_kelamin) && $jenis_kelamin == 'pria') echo 'checked'; ?>>Pria
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="jenis_kelamin" value="wanita" <?php if (isset($jenis_kelamin) && $jenis_kelamin == 'wanita') echo 'checked'; ?>>Wanita
                        </label>
                    </div>
                    <div class="error">
                        <?php if (isset($error_jenis_kelamin)) echo $error_jenis_kelamin; ?>
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="kelas">Kelas:</label>
                        <select id="kelas" name="kelas" class="form-control">
                            <option value="">(pilih kelas)</option>
                            <option value="X" <?php if (isset($kelas) && $kelas == 'X') echo 'selected'; ?>>X</option>
                            <option value="XI" <?php if (isset($kelas) && $kelas == 'XI') echo 'selected'; ?>>XI</option>
                            <option value="XII" <?php if (isset($kelas) && $kelas == 'XII') echo 'selected'; ?>>XII</option>
                        </select>
                        <div class="error">
                            <?php if (isset($error_kelas)) echo $error_kelas; ?>
                        </div>
                    </div>
                    <label>Ekstrakulikuler:</label>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="extrakulikuler[]" value="Pramuka" <?php if (isset($extrakulikuler) && in_array('Pramuka', $extrakulikuler)) echo 'checked'; ?>>Pramuka
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="extrakulikuler[]" value="Seni Tari" <?php if (isset($extrakulikuler) && in_array('Seni Tari', $extrakulikuler)) echo 'checked'; ?>>Seni Tari
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="extrakulikuler[]" value="Sinematografi" <?php if (isset($extrakulikuler) && in_array('Sinematografi', $extrakulikuler)) echo 'checked'; ?>>Sinematografi
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="extrakulikuler[]" value="Basket" <?php if (isset($extrakulikuler) && in_array('Basket', $extrakulikuler)) echo 'checked'; ?>>Basket
                        </label>
                    </div>
                    <div class="error">
                        <?php if (isset($error_extrakulikuler)) echo $error_extrakulikuler; ?>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </form>
                <br>
                <?php
                // Display input values if no errors
                if (empty($error_nis) && empty($error_nama) && empty($error_jenis_kelamin) && empty($error_kelas) && empty($error_extrakulikuler)) {
                    echo "<h3>Your Input:</h3>";
                    echo 'NIS = ' . $_GET['nis'] . '<br />';
                    echo 'Nama = ' . $_GET['nama'] . '<br />';
                    echo 'Jenis Kelamin = ' . $_GET['jenis_kelamin'] . '<br />';
                    echo 'Kelas = ' . $_GET['kelas'] . '<br />';
                    if ($_GET['kelas'] == 'XII') {
                        echo 'Ekstrakulikuler = None<br />';
                    } else {
                        echo 'Ekstrakulikuler = ' . implode(', ', $_GET['extrakulikuler']) . '<br />';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>