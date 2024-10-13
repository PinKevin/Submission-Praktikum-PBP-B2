<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERTEMUAN2</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
        $array_mhs = array('Abdul' => array(89,90,54),
            'Budi' => array(98,65,74),
            'Nina' => array(67,56,84)
        );
        
        //Fungsi menghitung rata-rata
        function hitung_rata($array) {
            $jumlah = array_sum($array);
            $banyak = count($array);
            return $jumlah / $banyak;
        }

        // Fungsi untuk menampilkan data mahasiswa
        function print_mhs($array_mhs) {
            echo "<table border='1'>";
            echo "<tr>";
            echo "<th>Nama</th>";
            echo "<th>Nilai 1</th>";
            echo "<th>Nilai 2</th>";
            echo "<th>Nilai 3</th>";
            echo "<th>Rata2</th>";
            echo "</tr>";
            foreach ($array_mhs as $nama => $nilai) {
                $rata = hitung_rata($nilai);
                echo "<tr>";
                echo "<td>$nama</td>";
                echo "<td>$nilai[0]</td>";
                echo "<td>$nilai[1]</td>";
                echo "<td>$nilai[2]</td>";
                echo "<td>" . $rata . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }

        print_mhs($array_mhs);

    ?>
</body>
</html>