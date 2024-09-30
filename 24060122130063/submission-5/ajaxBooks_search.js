function getXMLHTTPRequest() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    } else {
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
}

function searchBook() {
    var title = document.getElementById('book_title').value;

    if (title.length == 0) {
        // Clear search results and book details if the input is empty
        document.getElementById('search_results').innerHTML = '';
        document.getElementById('book_details').innerHTML = '';
        return;
    }

    var xmlhttp = getXMLHTTPRequest();
    var url = "search_books.php?title=" + encodeURI(title);

    xmlhttp.open("GET", url, true);
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // Show search results in the 'search_results' div
            document.getElementById('search_results').innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.send(null);
}

function showBookDetails(bookId) {
    var xmlhttp = getXMLHTTPRequest();
    var url = "get_book_details.php?id=" + bookId;

    xmlhttp.open("GET", url, true);
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // Show book details in the 'book_details' div
            document.getElementById('book_details').innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.send(null);
}
