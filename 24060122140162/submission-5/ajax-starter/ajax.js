//  Nama        : Zahra Nisaa' Fitria Nur'Afifah
//  NIM         : 24060122140162
//  File        : ajax.js
//  Deskripsi   : Fungsi-fungsi javascript yang dipanggil oleh file request

function getXMLHTTPRequest() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    } else {
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
}

function get_server_time() {
    // TODO 1: Lengkapi fungsi get_server_time()
    var xhr = getXMLHTTPRequest();
    var url = 'get_server_time.php';
    xhr.open("GET", url, true);
    xhr.onreadystatechange = function() {
        document.getElementById('show_time').innerHTML = '<img src="./images/ajax_loader.png"/>';
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('show_time').innerHTML = xhr.responseText;
        }
    }
    xhr.send();
}

function add_customer_get() {
    var xmlhttp = getXMLHTTPRequest();
    //get input value
    var name = encodeURI(document.getElementById('name').value);
    var address = encodeURI(document.getElementById('address').value);
    var city = encodeURI(document.getElementById('city').value);
    // Validate
    if (name != "" && address != "" && city != "") {
        var url = "add_customer_get.php?name=" + name + "&address=" + address + "&city=" +city;
        //alert(url)
        var inner = "add response";
        // TODO 2: Buatlah sebuah HTTP Request dengan method GET
        xmlhttp.open('GET', url, true);
        xmlhttp.onreadystatechange = function() {
            document.getElementById('add_response').innerHTML = '<img src="images/ajax_loader.png"/>';
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById('add_response').innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.send(null);
    } else {
        alert("Please fill all the fields");
    }
}

function add_customer_post() {
    var xmlhttp = getXMLHTTPRequest();

    var name = encodeURI(document.getElementById('name').value);
    var address = encodeURI(document.getElementById('address').value);
    var city = encodeURI(document.getElementById('city').value);

    // Validate
    if (name != "" && address != "" && city != "") {
        // TODO 3: Buatlah sebuah HTTP Request dengan method POST
        var url = "add_customer_post.php";
        var params = "name=" + name + "&address=" + address + "&city=" + city;
        
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        xmlhttp.onreadystatechange = function() {
            document.getElementById('add_response').innerHTML = '<img src="images/ajax_loader.png"/>';
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById('add_response').innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.send(params);
    } else {
        alert("Please fill all the fields");
    }
}

function callAjax(url, inner) {
    // TODO 4: Lengkapilah fungsi callAjax()
    var xmlhttp = getXMLHTTPRequest();
    xmlhttp.open("GET", url, true);

    xmlhttp.onreadystatechange = function() {
        document.getElementById(inner).innerHTML = '<img src="images/ajax_loader.png"/>';
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById(inner).innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.send(null);
    return false;
}

function showCustomer(customerId) {
    if (customerId == "") {
        document.getElementById("detail_customer").innerHTML = "";
        return;
    }
    var xmlhttp = getXMLHTTPRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("detail_customer").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "get_customer.php?id=" + customerId, true);
    xmlhttp.send();
}

function searchBooks(event) {
    if (event) event.preventDefault();
    const searchTerm = document.getElementById('searchTerm').value.trim();
    
    if (searchTerm === '') {
        document.getElementById('searchResults').innerHTML = '';
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('searchResults').innerHTML = xhr.responseText;
        }
    };
    
    xhr.open('GET', 'search_book.php?ajax=1&term=' + encodeURIComponent(searchTerm), true);
    xhr.send();
}

document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('searchForm');
    const searchInput = document.getElementById('searchTerm');

    if (searchForm) {
        searchForm.addEventListener('submit', searchBooks);
    }

    if (searchInput) {
        let debounceTimer;
        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function() {
                searchBooks();
            }, 300);
        });
    }
});