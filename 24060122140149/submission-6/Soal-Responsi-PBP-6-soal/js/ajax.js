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
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4 && xhr.status == 200){
      let response = xhr.responseText;
      document.getElementById(inner).innerHTML = response;
    }
  }
  xhr.open('GET', url, true);
  xhr.send();

};

const getModel = (brand_code) => {
  let inner = 'model';
  let url = './utils/get_model.php?brand_code=' + brand_code;

  // TODO: Ambil semua model yang disediakan oleh brand dengan AJAX
  let xhr = getXMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4 && xhr.status == 200){
      let response = xhr.responseText;
      document.getElementById(inner).innerHTML = response;
    }
  }
  xhr.open('GET', url, true);
  xhr.send();
};

// const addOrder = () => {
//   const name = document.getElementById('name').value;
//   const phone_number = document.getElementById('phone_number').value;
//   const address = document.getElementById('address').value;
//   const brand = document.getElementById('brand').value;
//   const model = document.getElementById('model').value;
//   const colorRadio = document.getElementsByName('color');

//   let color;
//   for (let i = 0; i < colorRadio.length; i++) {
//     if (colorRadio[i].checked) {
//       color = colorRadio[i].value;
//       break;
//     }
//   }

//   let xhr = getXMLHttpRequest();
//   let url = './utils/add_order.php';
//   let inner = 'form-status';
//   let params =
//     'name=' +
//     name +
//     '&phone=' +
//     phone_number +
//     '&address=' +
//     address +
//     '&brand=' +
//     brand +
//     '&model=' +
//     model +
//     '&color=' +
//     color;

//   // TODO: Lakukan request POST untuk menambahkan pesanan dengan AJAX.
//   // Jika sukses, buat alert sukses
//   // Jika gagal, buat alert gagal
//   xhr.open('POST', url, true);
//   xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//   xhr.send(params);

//   xhr.onreadystatechange = function(){
//     if(xhr.readyState == 4){
//       if(xhr.status == 200){
//         alert('Orded added succesfully!!');
//       }
//       else{
//         alert('Failed to add order');
//       }
//     }
//   }
// };

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

  // Buat body request yang akan dikirim
  const params = new URLSearchParams();
  params.append('name', name);
  params.append('phone', phone_number);
  params.append('address', address);
  params.append('brand', brand);
  params.append('model', model);
  params.append('color', color);

  // Lakukan request POST dengan fetch
  fetch('./utils/add_order.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: params.toString(),
  })
    .then((response) => {
      if (response.ok) {
        alert('Order added successfully!');
      } else {
        alert('Failed to add order');
      }
    })
    .catch((error) => {
      console.error('Error:', error);
      alert('Failed to add order due to network error');
    });
};
