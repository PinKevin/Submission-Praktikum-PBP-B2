<?php

require_once('lib/db_login.php');

if (isset($_POST['submit'])) {
    $is_valid = TRUE;

    // validasi terhadap isi form name
    $name = test_input($_POST['name']);
    if ($name == '') {
        $name_error = "Name field is required";
        $is_valid = FALSE;
    }

    // validasi terhadap isi form phone_number
    $phone_number = test_input($_POST['phone_number']);
    if ($phone_number == '') {
        $phone_number = "phone number field is required";
        $is_valid = FALSE;
    }

    // validasi terhadap isi form address
    $address = test_input($_POST['address']);
    if ($address == '') {
        $address_error = "Address field is required";
        $is_valid = FALSE;
    }


    // Jika valid maka masukkan ke database
    if ($is_valid) {
        // Escape inputs data
        $address = $db->real_escape_string($address);

        $query = "INSERT INTO orders (`name`, `phone_number`, `address`,) VALUES ('" . $name . "', '" . $phone_number . "', '" . $address . "')";

        // Execute the query
        $result = $db->query($query);
        if (!$result) {
            die("Could not query the database: <br />" . $db->error . "<br>Query: " . $query);
        } else {
            $db->close();
        }
    }
}

?>

<?php include('header.php') ?>

<div class="container mt-4 mb-4">
  <div class="card">
    <div class="card-header">
      Form Pembelian Mobil Baru
    </div>
    <div class="card-body">

      <!-- TODO: tambahkan method yang sesuai  -->
      <form action="index.php" method="" onsubmit="return addOrder();">
        <div class="row align-items-start">
          <div class="col">
            <div class="mb-3">
              <label for="name" class="form-label">Nama Pembeli</label>
              <input type="text" class="form-control" id="name" name="name"  value="<?php if (isset($name)) echo $name ?>">
              <!-- TODO: Tampilkan error saat validasi nama gagal di error_name  -->
              <div id="name_error">
                <p><?php if (isset($name_error)) echo $name_error ?></p>
              </div>
            </div>

            <div class="mb-3">
              <label for="phone_number" class="form-label">Nomor Telepon Pembeli</label>
              <input type="text" class="form-control" id="phone_number" name="phone_number" oninput="checkPhone()">
              <!-- TODO: Tampilkan error saat validasi nomor telepon gagal di error_phone_number -->
              <div id="error_phone_number" class="text-danger">
              </div>
            </div>

            <div class="mb-3">
              <label for="address" class="form-label">Alamat Pembeli</label>
              <textarea class="form-control" id="address" name="address" rows="3"></textarea>
              <!-- TODO: Tampilkan error saat validasi alamat gagal di error_address-->
              <div id="error_address">
              </div>
            </div>

          </div>
          <div class="col">
            <div class="mb-3">
              <label for="brand" class="form-label">Merek Mobil</label>
              <select name="brand" class="form-select" onchange="getModel(this.value)" id="brand">
                <option value="" selected>-- Pilih merek --</option>
                <?php require_once('./utils/get_brand.php') ?>
              </select>
              <!-- TODO: Tampilkan error saat validasi merek gagal  di error_brand-->
              <div id="error_brand">
              </div>
            </div>

            <div class="mb-3">
              <label for="model" class="form-label">Model Mobil</label>
              <select name="model" class="form-select" id="model">
                <option value="" selected>-- Pilih model --</option>
              </select>
              <!-- TODO: Tampilkan error saat validasi model gagal di error_model-->
              <div id="error_model">
              </div>
            </div>

            <div class="mb-3">
              <label for="color" class="form-label">Warna Mobil</label>
              <div class="row align-items-start g-0">

                <div class="col">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="color" id="black" value="Black">
                    <label class="form-check-label" for="black">
                      Black
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="color" id="white" value="White">
                    <label class="form-check-label" for="white">
                      White
                    </label>
                  </div>
                </div>

                <div class="col">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="color" id="Gray" value="Gray">
                    <label class="form-check-label" for="black">
                      Gray
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="color" id="Silver" value="Silver">
                    <label class="form-check-label" for="white">
                      Silver
                    </label>
                  </div>
                </div>

                <div class="col">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="color" id="Navy_Blue" value="Navy_Blue">
                    <label class="form-check-label" for="black">
                      Navy Blue
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="color" id="Military_Green" value="Military_Green">
                    <label class="form-check-label" for="white">
                      Military Green
                    </label>
                  </div>
                </div>

              </div>
              <!-- TODO: Tampilkan error saat validasi warna gagal di error_color-->
              <div id="error_color">
              </div>
            </div>
          </div>
        </div>

        <button type="submit" id="submit" value="submit" name="submit" class="btn btn-primary">Submit</button>

      </form>
    </div>
  </div>
</div>

<?php include('footer.php') ?>