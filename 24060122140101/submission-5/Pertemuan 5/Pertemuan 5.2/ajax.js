function searchBooks() {
    var query = document.getElementById("searchQuery").value;
    if (query.length == 0) {
        document.getElementById("results").innerHTML = "";
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);
            
            if (response.status === 'not found') {
                // Menampilkan pesan jika buku tidak ditemukan
                document.getElementById("results").innerHTML = "<p class='text-center'>Books not found</p>";
            } else {
                // Tampilkan hasil buku dalam format tabel
                var resultHTML = "<table class='table table-striped'>";
                resultHTML += "<thead><tr><th>ISBN</th><th>Title</th><th>Author</th><th>Price</th></tr></thead><tbody>";
                
                for (var i = 0; i < response.length; i++) {
                    resultHTML += "<tr>";
                    resultHTML += "<td>" + response[i].isbn + "</td>";
                    resultHTML += "<td>" + response[i].title + "</td>";
                    resultHTML += "<td>" + response[i].author + "</td>";
                    resultHTML += "<td>" + response[i].price + "</td>";
                    resultHTML += "</tr>";
                }

                resultHTML += "</tbody></table>";
                document.getElementById("results").innerHTML = resultHTML;
            }
        }
    };
    xhr.open("GET", "get_books.php?q=" + query, true);
    xhr.send();
}
