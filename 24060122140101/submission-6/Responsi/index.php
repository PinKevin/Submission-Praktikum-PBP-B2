<?php 
session_start(); // Memastikan session dimulai
include('header.php') 
?>

<div class="container mt-4 mb-4">
    <div class="card">
        <div class="card-header">
            Form Pembelian Mobil Baru
        </div>
        <div class="card-body">
            <!-- Tampilkan pesan sukses atau error -->
            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['success_message']; ?>
                    <?php unset($_SESSION['success_message']); // Hapus pesan setelah ditampilkan ?>
                </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['error_message'])): ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error_message']; ?>
                    <?php unset($_SESSION['error_message']); // Hapus pesan setelah ditampilkan ?>
                </div>
            <?php endif; ?>

            <!-- Method diubah menjadi POST -->
            <form action="./utils/add_order.php" method="POST" onsubmit="return validateForm();">
                <div class="row align-items-start">
                    <div class="col">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Pembeli</label>
                            <input type="text" class="form-control" id="name" name="name">
                            <!-- Error validasi nama -->
                            <div id="error_name" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Nomor Telepon Pembeli</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" oninput="checkPhone()">
                            <!-- Error validasi nomor telepon -->
                            <div id="error_phone_number" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat Pembeli</label>
                            <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                            <!-- Error validasi alamat -->
                            <div id="error_address" class="text-danger"></div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="mb-3">
                            <label for="brand" class="form-label">Merek Mobil</label>
                            <select name="brand" class="form-select" onchange="getModel(this.value)" id="brand">
                                <option value="" selected>-- Pilih merek --</option>
                                <?php require_once('./utils/get_brand.php') ?>
                            </select>
                            <!-- Error validasi merek -->
                            <div id="error_brand" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label for="model" class="form-label">Model Mobil</label>
                            <select name="model" class="form-select" id="model">
                                <option value="" selected>-- Pilih model --</option>
                            </select>
                            <!-- Error validasi model -->
                            <div id="error_model" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label for="color" class="form-label">Warna Mobil</label>
                            <div class="row align-items-start g-0">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="color" id="black" value="Black">
                                        <label class="form-check-label" for="black">Black</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="color" id="white" value="White">
                                        <label class="form-check-label" for="white">White</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="color" id="gray" value="Gray">
                                        <label class="form-check-label" for="gray">Gray</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="color" id="silver" value="Silver">
                                        <label class="form-check-label" for="silver">Silver</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="color" id="navy_blue" value="Navy Blue">
                                        <label class="form-check-label" for="navy_blue">Navy Blue</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="color" id="military_green" value="Military Green">
                                        <label class="form-check-label" for="military_green">Military Green</label>
                                    </div>
                                </div>
                            </div>
                            <!-- Error validasi warna -->
                            <div id="error_color" class="text-danger"></div>
                        </div>
                    </div>
                </div>

                <button type="submit" id="submit" value="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php') ?>
