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

  let xhr = getXMLHttpRequest();
  xhr.open('GET', url, true);
  xhr.onreadystatechange = function(){
    if(xhr.readyState === 4){
      if(xhr.status === 200){
        document.getElementById(inner).innerHTML=xhr.responseText;
      }else{
        document.getElementById(inner).innerHTML='error saat memeriksa nomor telp.';
      }
    }
  };
  xhr.send(null);
  // TODO: Cek apakah nomor telepon sudah digunakan dengan AJAX
};

const getModel = (brand_code) => {
  let inner = 'model';
  let url = './utils/get_model.php?brand_code=' + brand_code;

  let xhr = getXMLHttpRequest();
  xhr.open('GET', url, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        // Memperbarui dropdown model atau menampilkan model
        document.getElementById(inner).innerHTML = xhr.responseText;
      } else {
        // Menangani kesalahan
        document.getElementById(inner).innerHTML = 'Error saat mengambil model.';
      }
    }
  };
  xhr.send(null);
  // TODO: Ambil semua model yang disediakan oleh brand dengan AJAX
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
    name +
    '&phone=' +
    phone_number +
    '&address=' +
    address +
    '&brand=' +
    brand +
    '&model=' +
    model +
    '&color=' +
    color;

  function add_order(){
    var XMLHTTP = getXMLHttpRequest();
    //get input value
    var name = encodeURI(document.getElementById('name').value);
    var phone = encodeURI(document.getElementById('phone').value);
    var address = encodeURI(document.getElementById('address').value);
    var brand = encodeURI(document.getElementById('brand').value);
    var model = encodeURI(document.getElementById('model').value);
    var color = encodeURI(document.getElementById('color').value);
    //validate
    if(name !="" && phone != "" && address != "" && brand !="" && model !="" && color!=""){
      //set url and inner
      var url ="add_order.php?name= "+ name + "&phone=" + phone + "&address" + address + "&brand" + brand + "&model" + model + "&color" + color;
      //alert (url);
      var inner = "add_response";
      //open request
      XMLHTTP.open('GET', url, true);
      XMLHTTP.onreadystatechange = function(){
        document.getElementById(inner).innerHTML ='<img src="images/ajax_loader.png"/>';
        if((XMLHTTP.readyState == 4) && (XMLHTTP.status == 200)){
          document.getElementById(inner).innerHTML = XMLHTTP.responseText;
        }
        return false;
      }
      XMLHTTP.send(null);
    }else{
      alert("Please fill all the fields");
    }
  
  }
  // TODO: Lakukan request POST untuk menambahkan pesanan dengan AJAX.
  // Jika sukses, buat alert sukses
  // Jika gagal, buat alert gagal
};
