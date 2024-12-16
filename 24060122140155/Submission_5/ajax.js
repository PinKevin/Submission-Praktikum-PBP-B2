//fungsi untuk membuat objek XMLHttpRequest
function getXMLHTTPRequest(){
    if(window.XMLHttpRequest){
        //code for modern browsers
        return new XMLHttpRequest();
    }else{
        //code for old IE browsers
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
}
//fungsi untuk melakukan request. ke get_server_time.php
function get_server_time(){
    var XMLHTTP = getXMLHTTPRequest();
    var page= 'get_server_time.php';
    XMLHTTP.onreadystatechange = function(){
        document.getElementById('showtime').innerHTML='<img src=';
        if((XMLHTTP.readyState == 4) && (XMLHTTP.status == 200)){
            document.getElementById('showtime').innerHTML = XMLHTTP.responseText;
        }
    }
    XMLHTTP.send(null);
}
function add_book_get(){
    var XMLHTTP = getXMLHTTPRequest();
    //get input value
    var name = encodeURI()
}