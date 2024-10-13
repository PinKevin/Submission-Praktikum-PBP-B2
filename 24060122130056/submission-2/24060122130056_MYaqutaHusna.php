<?php

function hitung_rata($array) {
    $total = 0;
    $count = count($array);
    foreach ($array as $nilai) {
        $total += $nilai;
    }
    return $total / $count;
}


function print_mhs($array_mhs) {
    echo "<table border='1'>";
    echo "<tr><th>Nama</th><th>Nilai 1</th><th>Nilai 2</th><th>Nilai 3</th><th>Rata-rata</th></tr>";
    
    foreach ($array_mhs as $mhs) {
        $rata2 = hitung_rata([$mhs['nilai1'], $mhs['nilai2'], $mhs['nilai3']]);
        echo "<tr>";
        echo "<td>{$mhs['nama']}</td>";
        echo "<td>{$mhs['nilai1']}</td>";
        echo "<td>{$mhs['nilai2']}</td>";
        echo "<td>{$mhs['nilai3']}</td>";
        echo "<td>" . number_format($rata2, 2) . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
}


$array_mhs = [
    ['nama' => 'Abdul', 'nilai1' => 89, 'nilai2' => 90, 'nilai3' => 54],
    ['nama' => 'Budi', 'nilai1' => 98, 'nilai2' => 65, 'nilai3' => 74],
    ['nama' => 'Nina', 'nilai1' => 67, 'nilai2' => 56, 'nilai3' => 84]
];

print_mhs($array_mhs);
?>
