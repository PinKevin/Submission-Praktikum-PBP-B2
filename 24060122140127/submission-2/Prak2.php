<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prak2</title>
</head>
<body>
    <?php
    
    function hitung_rata($array) {
        $jumlah = array_sum($array);  
        $rata_rata = $jumlah / count($array);  
        return $rata_rata;
    }

    
    function print_mhs($array_mhs) {
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr><th>Nama</th><th>Nilai 1</th><th>Nilai 2</th><th>Nilai 3</th><th>Rata-rata</th></tr>";

        foreach ($array_mhs as $nama => $nilai) {
            $rata = hitung_rata($nilai);  
            echo "<tr>";
            echo "<td>" . $nama . "</td>";
            echo "<td>" . $nilai[0] . "</td>";
            echo "<td>" . $nilai[1] . "</td>";
            echo "<td>" . $nilai[2] . "</td>";
            echo "<td>" . $rata . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }

    $array_mhs = array(
        'Abdul' => array(89, 90, 54),
        'Budi' => array(98, 65, 74),
        'Nina' => array(67, 56, 84),
    );

    print_mhs($array_mhs);
    ?>
</body>
</html>
