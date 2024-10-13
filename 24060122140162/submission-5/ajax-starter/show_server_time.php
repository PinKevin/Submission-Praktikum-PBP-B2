<?php include('./header.php'); ?>

<!--  
Nama        : Zahra Nisaa' Fitria Nur'Afifah
NIM         : 24060122140162
File        : show_server_time.php
Deskripsi   : Menampilkan waktu server dengan ajax -->

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Ajax Server Time
                </div>
                <div class="card-body">
                    <button class="btn btn-success" onclick="get_server_time()">Show Server Time</button>
                    <div id="show_time" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('./footer.php'); ?>