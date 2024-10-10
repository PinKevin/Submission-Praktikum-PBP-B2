function getXMLHttpRequest() {
  if (window.XMLHttpRequest) {
    //code for modern browser
    return new XMLHttpRequest();
  } else {
    //code for old IE browser
    return new ActiveXObject('Microsoft.XMLHTTP');
  }
}

const checkPhone = () => {
  let inner = 'error_phone_number';
  let phone_number = encodeURI(document.getElementById('phone_number').value);
  let url = './utils/get_order.php?phone_number=' + phone_number;

  // TODO: Cek apakah nomor telepon sudah digunakan dengan AJAX
  let xhr = getXMLHttpRequest();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      document.getElementById('error_phone_number').innerHTML = xhr.responseText;
    }
  };

  xhr.open('GET', url, true);
  xhr.send();
};

const getModel = (brand_code) => {
  let inner = 'model';
  let url = './utils/get_model.php?brand_code=' + brand_code;

  // TODO: Ambil semua model yang disediakan oleh brand dengan AJAX
  
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      document.getElementById('model').innerHTML = xhr.responseText;
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

  if (!name) {
    alert("Nama tidak boleh kosong.");
    return false;
  }
  if (!phone_number) {
    alert("Nomor telepon tidak boleh kosong.");
    return false;
  }
  if (!address) {
    alert("Alamat tidak boleh kosong.");
    return false;
  }
  if (!brand) {
    alert("Pilih merek mobil.");
    return false;
  }
  if (!model) {
    alert("Pilih model mobil.");
    return false;
  }
  if (!color) {
    alert("Pilih warna mobil.");
    return false;
  }

  let xhr = getXMLHttpRequest();
  let url = './utils/add_order.php';
  let inner = 'form-status';
  let params =
    'name=' +
    encodeURIComponent(name) +
    '&phone=' +
    encodeURIComponent(phone_number) +
    '&address=' +
    encodeURIComponent(address) +
    '&brand=' +
    encodeURIComponent(brand) +
    '&model=' +
    encodeURIComponent(model) +
    '&color=' +
    encodeURIComponent(color);

  xhr.open('POST', url, true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Cek respons dari server
      if (xhr.responseText === "Sukses") {
        alert("Data pesanan berhasil ditambahkan.");
        // Reset form setelah berhasil
        document.getElementById('order-form').reset();
      } else {
        alert("Gagal menambahkan pesanan: " + xhr.responseText);
      }
    }
  };

  xhr.send(params);

  return false;

  
};
