<?php include('./header.php') ?>
<head>
    <title>Book Search</title>
    <script src="ajaxBooks_search.js"></script>
</head>
<div class="row w-50 mx-auto mt-5">
    <dic class = "col">
        <div class = "card">
            <div class="card-header">Search for a book</div>
            <div class="card-body">
                <!-- Input for searching book by title -->
                <input type="text" id="book_title"  class="form-control" onkeyup="searchBook(this.value)" placeholder="Enter book title" />
               
                
                <!-- Area for displaying search results -->
                <div id="search_results"></div>
            </div>
        </div>
    </div> 
</div>
<?php include('./footer.php') ?>
