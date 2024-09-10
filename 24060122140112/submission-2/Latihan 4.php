<?php

// Array mahasiswa beserta nilainya
$array_mhs = array(
    'Abdul' => array(89, 90, 54),
    'Budi' => array(78, 60, 64),
    'Nina' => array(67, 56, 84),
    'Budi' => array(67, 89, 50),
    'Budi' => array(98, 65, 74)
);

// Fungsi untuk menghitung rata-rata dari nilai
function hitung_rata($array) {
    $total = array_sum($array); 
    $jumlah_nilai = count($array);
    return $total / $jumlah_nilai; 
}

// Fungsi untuk menampilkan data mahasiswa beserta nilai dan rata-rata
function print_mhs($array_mhs) {
    echo "<table border='1'>";
    echo "<tr><th>Nama</th><th>Nilai 1</th><th>Nilai 2</th><th>Nilai 3</th><th>Rata-rata</th></tr>";

    foreach ($array_mhs as $nama => $nilai) {
        echo "<tr>";
        echo "<td>$nama</td>";
        echo "<td>{$nilai[0]}</td>";
        echo "<td>{$nilai[1]}</td>";
        echo "<td>{$nilai[2]}</td>";
        echo "<td>" . hitung_rata($nilai) . "</td>"; 
        echo "</tr>";
    }

    echo "</table>";
}

// Panggil fungsi untuk menampilkan tabel mahasiswa
print_mhs($array_mhs);

?>
