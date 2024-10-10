function getXMLHttpRequest() {
  if (window.XMLHttpRequest) {
      return new XMLHttpRequest();
  } else {
      return new ActiveXObject('Microsoft.XMLHTTP');
  }
}

// Fungsi validasi sebelum form dikirim
function validateForm() {
  let name = document.getElementById('name').value;
  let phone_number = document.getElementById('phone_number').value;
  let address = document.getElementById('address').value;
  let brand = document.getElementById('brand').value;
  let model = document.getElementById('model').value;
  let colorRadio = document.getElementsByName('color');

  // Variabel untuk menampung pesan error
  let errorMessage = [];

  // Validasi Nama
  if (name == "") {
      errorMessage.push("Nama tidak boleh kosong");
  }

  // Validasi Nomor Telepon
  if (phone_number == "") {
      errorMessage.push("Nomor telepon tidak boleh kosong");
  }

  // Validasi Alamat
  if (address == "") {
      errorMessage.push("Alamat tidak boleh kosong");
  }

  // Validasi Merek Mobil
  if (brand == "") {
      errorMessage.push("Harus memilih merek mobil");
  }

  // Validasi Model Mobil
  if (model == "") {
      errorMessage.push("Harus memilih model mobil");
  }

  // Validasi Warna Mobil
  let colorSelected = false;
  for (let i = 0; i < colorRadio.length; i++) {
      if (colorRadio[i].checked) {
          colorSelected = true;
          break;
      }
  }
  if (!colorSelected) {
      errorMessage.push("Harus memilih warna mobil");
  }

  // Jika ada error, tampilkan pesan sekaligus dalam satu alert
  if (errorMessage.length > 0) {
      alert(errorMessage.join(", ")); 
      return false; // Mencegah form dikirim jika ada error
  }

  return true; // Jika semua validasi lolos, form akan dikirim
}


const checkPhone = () => {
  let inner = 'error_phone_number';
  let phone_number = encodeURI(document.getElementById('phone_number').value);
  let url = './utils/get_order.php?phone_number=' + phone_number;

  let xhr = getXMLHttpRequest();
  xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
          // Menampilkan pesan di bawah input nomor telepon
          document.getElementById(inner).innerHTML = xhr.responseText;

          if (xhr.responseText.includes('Nomor telepon tersedia')) {
              document.getElementById('phone_number').style.borderColor = "green"; 
          } else {
              document.getElementById('phone_number').style.borderColor = "red"; 
          }
      }
  };
  xhr.open('GET', url, true);
  xhr.send();
};


const getModel = (brand_code) => {
  let inner = 'model';
  let url = './utils/get_model.php?brand_code=' + brand_code;

  let xhr = getXMLHttpRequest();
  xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
          document.getElementById(inner).innerHTML = xhr.responseText;
      }
  };
  xhr.open('GET', url, true);
  xhr.send();
};

const addOrder = () => {
  const name = document.getElementById('name').value;
  const phone_number = document.getElementById('phone_number').value;
  const address = document.getElementById('address').value;
  const brand = document.getElementById('brand').value;
  const model = document.getElementById('model').value;
  const colorRadio = document.getElementsByName('color');

  let color;
  for (let i = 0; i < colorRadio.length; i++) {
      if (colorRadio[i].checked) {
          color = colorRadio[i].value;
          break;
      }
  }

  let xhr = getXMLHttpRequest();
  let url = './utils/add_order.php';
  let params =
      'name=' + encodeURI(name) +
      '&phone=' + encodeURI(phone_number) +
      '&address=' + encodeURI(address) +
      '&brand=' + encodeURI(brand) +
      '&model=' + encodeURI(model) +
      '&color=' + encodeURI(color);

  xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
          alert(xhr.responseText);
      }
  };
  xhr.open('POST', url, true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.send(params);

  return false;  // Mencegah form dikirim secara default
};
