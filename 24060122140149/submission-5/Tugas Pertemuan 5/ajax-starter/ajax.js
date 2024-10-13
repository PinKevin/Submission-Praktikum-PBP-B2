function getXMLHTTPRequest() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    } else {
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
}

function get_server_time() {
    // TODO 1: Lengkapi fungsi get_server_time()
    var xmlhttp = getXMLHTTPRequest();
    var page = 'get_server_time.php';
    xmlhttp.open("GET", page, true);
    xmlhttp.onreadystatechange = function(){
        document.getElementById('showtime').innerHTML = '<imgsrc="../images/ajax/loader.png"/>';
        if((xmlhttp.readyState == 4) && (xmlhttp.status == 200)){
            document.getElementById('showtime').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.send(null);
}

function add_customer_get() {
    var xmlhttp = getXMLHTTPRequest();

    var name = encodeURI(document.getElementById('name').value);
    var address = encodeURI(document.getElementById('address').value);
    var city = encodeURI(document.getElementById('city').value);

    // Validate
    if (name != "" && address != "" && city != "") {
        // TODO 2: Buatlah sebuah HTTP Request dengan method GET
        let url = "add_customer_get.php?name=" + name + "&address=" + address + "&city=" + city;
        //alert(url)
        let inner = "add_response";
        //open request
        xmlhttp.open('GET', url, true);
        xmlhttp.onreadystatechange = function(){
            document.getElementById(inner).innerHTML = '<img src="images/ajax/loader.png"/>';
            if((xmlhttp.readyState == 4)&&(xmlhttp.status == 200)){
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

    var name = encodeURI(document.getElementById('name').value);
    var address = encodeURI(document.getElementById('address').value);
    var city = encodeURI(document.getElementById('city').value);

    // Validate
    if (name != "" && address != "" && city != "") {
        // TODO 3: Buatlah sebuah HTTP Request dengan method POST
        //set url dan inner
        let url = "add_customer_post.php";alert(url);
        let inner = "add_response";
        //set parameter dan open request
        let params = "name="+name+"&address="+address+"&city="+city;
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader("Content-type",
            "application/x-www-form-urlencoded");
        xmlhttp.onreadystatechange = function(){
            document.getElementById(inner).innerHTML = '<img src="images/ajax/loader.png"/>';
            if((xmlhttp.readyState == 4)&&(xmlhttp.status == 200)){
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
    // TODO 4: Lengkapilah fungsi callAjax()
    var xmlhttp = getXMLHTTPRequest();
    xmlhttp.open('GET', url, true);
    xmlhttp.onreadystatechange=function(){
        document.getElementById(inner).innerHTML = '<img src="images/ajax/loader.png"/>';
        if((xmlhttp.readyState==4)&&(xmlhttp.status==200)){
            document.getElementById(inner).innerHTML =xmlhttp.responseText;
        }
        return false;
    }
    xmlhttp.send(null);
}

function showCustomer(customerid) {
    // TODO 5: Lengkapilah fungsi showCustomer()
    let inner = 'detail_customer';
    let url = 'get_customer.php?id=' + customerid;
    if(customerid == ""){
        document.getElementById(inner).innerHTML = ' ';
    }
    else{
        callAjax(url, inner);
    }
}

function searchBook() {
    var xmlhttp = getXMLHTTPRequest();
    var query = document.getElementById('searchBook').value;

    if (query.trim() !== "") {
        var url = "get_books.php?query=" + encodeURIComponent(query);

        xmlhttp.open("GET", url, true);
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById('bookResults').innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.send(null);
    } else {
        document.getElementById('bookResults').innerHTML = ""; // Kosongkan hasil jika input kosong
    }
}