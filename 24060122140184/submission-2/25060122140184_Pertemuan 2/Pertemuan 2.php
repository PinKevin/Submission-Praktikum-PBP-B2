<?php
function print_mhs($array_mhs){
    echo "<table border = '1'>";
    echo "<tr><th>Nama</th><th>Nilai 1</th><th>Nilai 2</th><th>Nilai 3</th><th>Rata-rata</th></tr>";

    foreach ($array_mhs as $nama => $nilai) {
        $rata = array_sum($nilai) / count($nilai);
        echo "<tr>";
        echo "<td>$nama</td>";
        echo "<td>$nilai[0]</td>";
        echo "<td>$nilai[1]</td>";
        echo "<td>$nilai[2]</td>";
        echo "<td>$rata</td>";
        echo "</tr>";
    }

    echo "</table>";
}

    $array_mhs = array('abdul' => array(89,90,54),
                        'Budi' => array(78,60,64),
                        'Nina' => array(67,56,84),
                        'Dewi' => array(87,69,50),
                        'Rudi' => array(98,65,74));

    print_mhs($array_mhs);
?>
