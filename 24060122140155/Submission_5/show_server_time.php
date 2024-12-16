<?php include('./header.php'); ?><br>
<div class="card">
<div class="card-header">Ajax Server Time</div>
<div class="card-body">
    <button class="btn btn-success" onclick="get_server_time()">Show Server Time</button>
    <br><br>
    <div id="showtime"></div>
    <?php
    //menampilkan waktu server
    echo date('H:i:s');
?>
</div>
</div>
<?php include('./footer.php'); ?><br>