<!-- Nama =  Zahra Nisaa' Fitria Nur'Afifah
     NIM  = 24060122140162
     Praktikum  = B2 -->
<html>
<head>
    <style>
        /* Styling tabel */
        table {
            width: 50%;
            border-collapse: collapse;
        }

        /* Gaya untuk semua border di tabel */
        table, th, td {
            border: 1px solid black;
        }

        /* Warna latar belakang untuk header "Nama" */
        th.nama-header {
            background-color: #0000CD; /* Warna Medium Blue untuk header "Nama" */
            color: white;
            padding: 8px;
        }

        /* Warna latar belakang untuk header "Nilai 1, 2, 3" */
        th.nilai-header {
            background-color: #228B22; /* Warna Forest Green untuk header nilai */
            color: white;
            padding: 8px;
        }

        /* Warna latar belakang untuk header "Rata2" */
        th.rata-header {
            background-color: #B22222; /* Warna merah Firebrick untuk header rata-rata */
            color: white;
            padding: 8px;
        }

        /* Warna latar belakang untuk baris-baris tabel */
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
        }

        /* Gaya untuk sel di tabel */
        td {
            text-align: center;
            padding: 8px;
        }

        /* Warna untuk saat mouse berada di atas baris */
        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

<?php

// Fungsi untuk menghitung nilai rata-rata dari array
function hitung_rata($array) {
    $total = 0; // Variabel untuk menyimpan total nilai
    $count = count($array); // Menghitung jumlah elemen dalam array
    
    // Menggunakan perulangan 'for' untuk menjumlahkan semua nilai dalam array
    for ($i = 0; $i < $count; $i++) {
        $total = $total + $array[$i]; // Menambahkan setiap elemen ke total
    }
    
    return $total / $count; // Mengembalikan hasil pembagian total dengan jumlah elemen, yaitu rata-rata
}

// Fungsi untuk mencetak data mahasiswa dalam bentuk tabel
function print_mhs($array_mhs) {
    // Mendapatkan kunci (nama mahasiswa) dari array $array_mhs
    $names = array_keys($array_mhs);

    // Memulai tabel HTML
    echo "<table>"; 
    echo "<tr><th class='nama-header'>Nama</th>"; // Header untuk kolom "Nama" dengan warna biru
    echo "<th class='nilai-header'>Nilai 1</th>"; // Header untuk kolom "Nilai 1" dengan warna hijau
    echo "<th class='nilai-header'>Nilai 2</th>"; // Header untuk kolom "Nilai 2" dengan warna hijau
    echo "<th class='nilai-header'>Nilai 3</th>"; // Header untuk kolom "Nilai 3" dengan warna hijau
    echo "<th class='rata-header'>Rata2</th></tr>"; // Header untuk kolom "Rata-rata" dengan warna merah

    // Menggunakan perulangan 'for' untuk mengakses setiap mahasiswa dan nilai-nilainya
    for ($i = 0; $i < count($names); $i++) {
        $name = $names[$i]; // Mengambil nama mahasiswa
        $nilai = $array_mhs[$name]; // Mengambil nilai mahasiswa berdasarkan nama
        $rata_rata = hitung_rata($nilai); // Menghitung rata-rata nilai mahasiswa menggunakan fungsi hitung_rata

        // Mencetak setiap baris data mahasiswa ke dalam tabel
        echo "<tr>";
        echo "<td>$name</td>"; // Mencetak nama mahasiswa
        echo "<td>{$nilai[0]}</td>"; // Mencetak nilai 1
        echo "<td>{$nilai[1]}</td>"; // Mencetak nilai 2
        echo "<td>{$nilai[2]}</td>"; // Mencetak nilai 3
        echo "<td>$rata_rata</td>"; // Mencetak rata-rata nilai
        echo "</tr>";
    }

    // Menutup tabel HTML
    echo "</table>";
}

// Data contoh berupa array mahasiswa
$array_mhs = array(
    'Abdul' => array(89, 90, 54), // Nilai Abdul
    'Budi' => array(98, 65, 74),  // Nilai Budi
    'Nina' => array(67, 56, 84)   // Nilai Nina
);

// Memanggil fungsi untuk menampilkan tabel data mahasiswa
print_mhs($array_mhs);

?>

</body>
</html>
