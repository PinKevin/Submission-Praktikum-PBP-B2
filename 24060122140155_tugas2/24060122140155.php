<?php
    $nilai=[
        "Abdul" =>[89,90,54],
        "Budi" =>[78,60,64],
        "Nina" =>[67, 56,84],
    ];
    echo '<table border="1">';
    echo '<tr>
            <td>Nama</td>
            <td>Nilai 1</td>
            <td>Nilai 2</td>
            <td>Nilai 3</td>
            <td>Rata2 </td>
    </tr>';
    foreach($nilai as $nama => $niali_individu){
        $total_nilai = array_sum($niali_individu);
        $jumlah_nilai = count($niali_individu);
        $rata_rata=$total_nilai/$jumlah_nilai;

        echo "<tr>";
        echo "<td>$nama</td>";
        foreach($niali_individu as $nilai){
            echo "<td>$nilai</td>";
        }
        echo "<td>" .number_format($rata_rata, 2) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>