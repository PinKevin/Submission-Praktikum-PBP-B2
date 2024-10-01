function getXMLHttpRequest() {
  if (window.XMLHttpRequest) {
    return new XMLHttpRequest();
  } else {
    return new ActiveXObject('Microsoft.XMLHTTP');
  }
}

const checkPhone = () => {
  let phone_number = encodeURI(document.getElementById('phone_number').value);
  let url = './utils/get_order.php?phone_number=' + phone_number;
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
  let url = './utils/get_model.php?brand_code=' + brand_code;
  let xhr = getXMLHttpRequest();

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


}