function getXMLHTTPRequest() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    } else {
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
}

function get_server_time() {
    var xmlhttp = new XMLHttpRequest();  // Membuat objek XMLHttpRequest
    var page = 'get_server_time.php';    // Menentukan halaman server untuk request

    // Konfigurasi request AJAX
    xmlhttp.open("GET", page, true);

    // Fungsi yang akan dieksekusi ketika status request berubah
    xmlhttp.onreadystatechange = function() {
        // Menampilkan loader saat request sedang berlangsung
        document.getElementById('showtime').innerHTML = '<img src="../images/ajax_loader.png"/>';

        // Jika request selesai dan sukses (status 200)
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('showtime').innerHTML = xmlhttp.responseText;  // Menampilkan waktu dari server
        }
    };

    // Mengirim request ke server
    xmlhttp.send(null);
}


function add_customer_get() {
    var xmlhttp = getXMLHTTPRequest();

    // Ambil nilai input
    var name = encodeURI(document.getElementById('name').value);
    var address = encodeURI(document.getElementById('address').value);
    var city = encodeURI(document.getElementById('city').value);

    // Validasi input
    if (name != "" && address != "" && city != "") {

        // Set url dan elemen untuk menampilkan hasil
        var url = "add_customer_get.php?name=" + name + "&address=" + address + "&city=" + city;
        var inner = "add_response";

        // Buka request
        xmlhttp.open('GET', url, true);

        xmlhttp.onreadystatechange = function() {
            document.getElementById(inner).innerHTML = '<img src="images/ajax_loader.png" />';

            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById(inner).innerHTML = xmlhttp.responseText;
            }
            return false;
        }
        xmlhttp.send(null);
    } else {
        alert("Please fill all the fields");
    }
}


function add_customer_post() {
    var xmlhttp = getXMLHTTPRequest();

    // Ambil nilai input
    var name = encodeURI(document.getElementById('name').value);
    var address = encodeURI(document.getElementById('address').value);
    var city = encodeURI(document.getElementById('city').value);

    // Validasi input
    if (name != "" && address != "" && city != "") {

        // Set url dan elemen untuk menampilkan hasil
        var url = "add_customer_post.php";
        var inner = "add_response";

        // Set parameter dan buka request
        var params = "name=" + name + "&address=" + address + "&city=" + city;

        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xmlhttp.onreadystatechange = function() {
            // Tampilkan loader saat request sedang berlangsung
            document.getElementById(inner).innerHTML = '<img src="images/ajax_loader.png" />';

            // Jika request berhasil, tampilkan hasil dari response
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById(inner).innerHTML = xmlhttp.responseText;
            }
            return false;
        }
        xmlhttp.send(params);
    } else {
        alert("Please fill all the fields");
    }
}


function callAjax(url, inner) {
    var xmlhttp = getXMLHTTPRequest();

    xmlhttp.open('GET', url, true);

    xmlhttp.onreadystatechange = function() {
        // Menampilkan loader selama proses ajax berlangsung
        document.getElementById(inner).innerHTML = '<img src="images/ajax_loader.png" />';

        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // Tampilkan hasil jika permintaan sukses
            document.getElementById(inner).innerHTML = xmlhttp.responseText;
        }
        return false;
    }
    xmlhttp.send(null);
}

function showCustomer(customerid) {
    var inner = 'detail_customer';
    var url = 'get_customer.php?id=' + customerid;

    if (customerid == "") {
        document.getElementById(inner).innerHTML = '';
    } else {
        callAjax(url, inner);
    }
}


function searchBooks() {
    var query = document.getElementById('searchQuery').value;

    // Cek jika query kosong
    if (query.length === 0) {
        document.getElementById('results').innerHTML = ''; // Kosongkan hasil jika tidak ada input
        return; // Keluar dari fungsi
    }

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "get_books.php?q=" + encodeURIComponent(query), true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('results').innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}



