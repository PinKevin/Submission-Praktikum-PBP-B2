<?php include('./header.php'); ?>

<br>
<div class="row w-50 mx-auto mt-5">
    <div class="col">
        <div class="card">
            <div class="card-header">Search Book</div>
            <div class="card-body">
                <input type="text" id="searchBook" class="form-control" onkeyup="searchBook()" placeholder="Enter Book Title">
                <br>
                <div id="bookResults"></div>
            </div>
        </div>
    </div>
</div>

<?php include('./footer.php'); ?>
