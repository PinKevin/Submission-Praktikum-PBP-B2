// fungsi untuk membuat object XMLHTTPRequest
function getXMLHTTPRequest() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    } else {
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
}

function get_server_time() {
    var xmlHTTP = getXMLHTTPRequest();
    var inner = 'showtime';
    var page = 'get_server_time.php';
    xmlHTTP.open("GET", page, true);
    xmlHTTP.onreadystatechange = function() {
        document.getElementById(inner).innerHTML = 'loading';
        if (xmlHTTP.readyState == 4 && xmlHTTP.status == 200) {
            document.getElementById(inner).innerHTML = xmlHTTP.responseText;
        }
    }
    xmlHTTP.send(null);
}

function add_customer_get() {
    // create new xmlHTTP object
    var xmlHTTP = getXMLHTTPRequest();

    // get input value
    var name = encodeURI(document.getElementById('name').value);
    var address = encodeURI(document.getElementById('address').value);
    var city = encodeURI(document.getElementById('city').value);

    // validate
    if (name != "" && address != "" && city != "") {
        // set url and inner
        var url = "add_customer_get.php?name="+name+"&address="+address+"&city="+city;
        var inner = "add_response";

        // open request
        xmlHTTP.open("GET", url, true);
        xmlHTTP.onreadystatechange = function() {
            document.getElementById(inner).innerHTML = "Loading Ajax";
            if (xmlHTTP.readyState == 4 && xmlHTTP.status == 200) {
                document.getElementById(inner).innerHTML = xmlHTTP.responseText;
            }
            return true;
        }
        xmlHTTP.send(null);
    } else {
        alert("Pealse fill all the fields");
    }
}

function add_customer_post() {
    // create new xmlHTTP object
    var xmlHTTP = getXMLHTTPRequest();

    // get input value
    var name = encodeURI(document.getElementById('name').value);
    var address = encodeURI(document.getElementById('address').value);
    var city = encodeURI(document.getElementById('city').value);

    // validate
    if (name != "" && address != "" && city != "") {
        // set url and inner
        var url = "add_customer_post.php";
        var inner = "add_response";
        
        // set parameters and open request
        var params = "name="+name+"&address="+address+"&city="+city;
        xmlHTTP.open("POST", url, true);
        xmlHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHTTP.onreadystatechange = function() {
            document.getElementById(inner).innerHTML = "Loading Ajax";
            if (xmlHTTP.readyState == 4 && xmlHTTP.status == 200) {
                document.getElementById(inner).innerHTML = xmlHTTP.responseText;
            }
            return true;
        }
        xmlHTTP.send(params);
    } else {
        alert("Pealse fill all the fields");
    }
}

function callAjax(url, inner) {
    var xmlHTTP = getXMLHTTPRequest();
    
    xmlHTTP.open("GET", url, true);

    xmlHTTP.onreadystatechange = function() {   
        document.getElementById(inner).innerHTML = '<img src="../images/ajax_loader.png"/>';
        if (((xmlHTTP.readyState == 4) && (xmlHTTP.status == 200))) {
            document.getElementById(inner).innerHTML = xmlHTTP.responseText;
        }
    };

     xmlHTTP.send(null);
}

function showCustomer(customerid) {
    var inner = 'detail_customer';
    
    var url = 'get_customer.php?id='+customerid;

    if (customerid == "") {
        document.getElementById(inner).innerHTML = '';
    } else {
        callAjax(url, inner);
    }
}

function searchBookByTitle(){    
    var input = 'search-book';
    var inner = 'display-result';
    var book_title = document.getElementById(input).value;
    
    // if (book_title.trim() === "") {
    //     document.getElementById(inner).innerHTML = "";
    // } 
    
    var url = 'get_book.php?title='+book_title;

    var xmlHTTP = getXMLHTTPRequest();
    xmlHTTP.open("GET", url, true);

    xmlHTTP.onreadystatechange = function() {
        if (xmlHTTP.readyState == 4 && xmlHTTP.status == 200) {
            document.getElementById(inner).innerHTML = xmlHTTP.responseText;
        }
    }

    xmlHTTP.send(null);
}

