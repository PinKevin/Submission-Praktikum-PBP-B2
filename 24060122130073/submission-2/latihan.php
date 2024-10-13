<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan</title>
</head>
<body>
    <?php
    $array_mhs = array('Abdul' => array(89,90,54),
                        'Budi' => array(78,60,64),
                        'Nina' => array(67,56,84),
            );
    
    function rata($array_mhs){
        $rata_mhs = array();

        foreach($array_mhs as $nama => $nilai){
            $n = count($nilai);
            $total_nilai = array_sum($nilai);
            $rata_rata = $total_nilai/$n;

            $rata_mhs[$nama]=$rata_rata;
        }
        return $rata_mhs;
    }

    function print_mhs($array_mhs){
        $n = sizeof($array_mhs);
        $rata_mhs = rata($array_mhs);
        echo '<table border="1">';
        echo '<tr>
                <td>Nama</td>
                <td>Nilai 1</td>
                <td>Nilai 2</td>
                <td>Nilai 3</td>
                <td>Rata-rata</td>
             </tr>';
        foreach($array_mhs as $nama => $nilai){
            echo '<tr>';
            echo '<td>'.($nama).' </td>';
            echo '<td>'.($nilai[0]).'</td>';
            echo '<td>'.($nilai[1]).'</td>';
            echo '<td>'.($nilai[2]).'</td>';    
            echo '<td>'.($rata_mhs[$nama]). '</td>';
            echo '</tr>';    
        }

        echo '</table>';
        
    }
    print_mhs($array_mhs);
    ?>
</body>
</html>