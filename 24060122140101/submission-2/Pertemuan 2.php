<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    
<h1>Data Rata-rata Nilai Mahasiswa</h1>

<?php
// Data array mahasiswa
$array_mhs = array(
    'Abdul' => array(89, 90, 54),
    'Budi'  => array(98, 65, 74),
    'Nina'  => array(67, 56, 84),
);

// Fungsi untuk menghitung rata-rata
function hitung_rata($array) {
    return array_sum($array) / count($array);
}

// Fungsi untuk mencetak tabel mahasiswa
function print_mhs($array_mhs) {
    echo "<table>
            <tr>
                <th>Nama</th>
                <th>Nilai 1</th>
                <th>Nilai 2</th>
                <th>Nilai 3</th>
                <th>Rata-rata</th>
            </tr>";

    foreach ($array_mhs as $nama => $nilai) {
        echo "<tr>";
        echo "<td>$nama</td>";
        foreach ($nilai as $n) {
            echo "<td>$n</td>";
        }
        // Hitung rata-rata dan tampilkan
        $rata = hitung_rata($nilai);
        echo "<td>" . number_format($rata, 12) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}

// Panggil fungsi untuk mencetak data mahasiswa
print_mhs($array_mhs);

?>

</body>
</html>
