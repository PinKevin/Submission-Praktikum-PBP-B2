<?php
function hitung_rata($array) {
    $total = array_sum($array);
    $jumlah_nilai = count($array);
    return $total / $jumlah_nilai;
}
?>