//  Nama        : Zahra Nisaa' Fitria Nur'Afifah
//  NIM         : 24060122140162
//  File        : ajax.js
//  Deskripsi   : Fungsi-fungsi javascript yang dipanggil oleh file request

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
  
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
      let infoElement = document.getElementById(inner);
      let phoneInput = document.getElementById('phone_number');
      
      infoElement.textContent = xhr.responseText;
      
      if (xhr.responseText === "Nomor telepon sudah digunakan") {
        infoElement.style.color = 'red';
        phoneInput.classList.add('is-invalid');
        phoneInput.classList.remove('is-valid');
      } else {
        infoElement.style.color = 'green';
        phoneInput.classList.remove('is-invalid');
        phoneInput.classList.add('is-valid');
      }
    }
  };
  
  xhr.open('GET', url, true);
  xhr.send();
};


const getModel = (brand_code) => {
  let inner = 'model';
  let url = './utils/get_model.php?brand_code=' + brand_code;

  // TODO: Ambil semua model yang disediakan oleh brand dengan AJAX
  let xhr = getXMLHttpRequest();
  
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
      let modelSelect = document.getElementById(inner);
      modelSelect.innerHTML = xhr.responseText;
      
      // Aktifkan kembali select model jika sebelumnya dinonaktifkan
      modelSelect.disabled = false;
    }
  };
  
  xhr.open('GET', url, true);
  xhr.send();

  // Nonaktifkan select model selama loading
  document.getElementById(inner).disabled = true;
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

  // TODO: Lakukan request POST untuk menambahkan pesanan dengan AJAX.
  // Jika sukses, buat alert sukses
  // Jika gagal, buat alert gagal
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4) {
      if (xhr.status == 200) {
        if (xhr.responseText.trim() === "Isi semua kolom terlebih dahulu") {
          showCustomAlert(xhr.responseText);
          // Opsional: Reset form
          document.getElementById('orderForm').reset();
        } else {
            alert(xhr.responseText);
        }
      } else {
        alert('Terjadi kesalahan saat menghubungi server. Status: ' + xhr.status);
      }
    }
  };

  xhr.open('POST', url, true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.send(params);

  // Mencegah form dari submit default
  return false;
};

function showCustomAlert(message) {
  // Buat elemen alert
  const alertDiv = document.createElement('div');
  alertDiv.style.position = 'fixed';
  alertDiv.style.top = '50%';
  alertDiv.style.left = '50%';
  alertDiv.style.transform = 'translate(-50%, -50%)';
  alertDiv.style.backgroundColor = 'white';
  alertDiv.style.padding = '20px';
  alertDiv.style.borderRadius = '5px';
  alertDiv.style.boxShadow = '0 2px 10px rgba(0,0,0,0.2)';
  alertDiv.style.zIndex = '1000';

  // Tambahkan konten
  alertDiv.innerHTML = `
      <p style="margin-bottom: 15px;">${message}</p>
      <button onclick="this.parentElement.remove()" style="background-color: #4CAF50; color: white; border: none; padding: 10px 20px; border-radius: 3px; cursor: pointer;">OK</button>
  `;

  // Tambahkan ke body
  document.body.appendChild(alertDiv);
}