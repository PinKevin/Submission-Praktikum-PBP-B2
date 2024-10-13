Nama       : Bintang Syafrian Rizal
NIM        : 24060122120031
Lab        : PBP B2

<?php
    $array_mhs = [
        'Abdul' => [89, 90, 54],
        'Budi' => [98, 65, 74],
        'Nina' => [67, 56, 84],
    ];

    function hitung_rata($nilai){
        return array_sum($nilai) / count($nilai);
    }

    function print_mhs($array_mhs){
        echo '
        <style>
            table {
                width: 50%;
                margin: 20px auto;
                border-collapse: collapse;
                font-family: Montserrat, montserrat;
                font-size: 16px;
                color: #333;
            }
            th, td {
                padding: 10px;
                border: 1px solid #ddd;
                text-align: center;
            }
            th {
                background-color: #FA8072;
            }
            tr:nth-child(even) {
                background-color: #f9f9f9;
            }
        </style>
        ';
        echo '<table>';
        echo '<tr><th>Nama</th><th>Nilai 1</th><th>Nilai 2</th><th>Nilai 3</th><th>Rata-rata</th></tr>';
        
        foreach($array_mhs as $nama => $nilai){
            echo '<tr>';
            echo '<td>' . $nama . '</td>';
            foreach($nilai as $n){
                echo '<td>' . $n . '</td>';
            }
            echo '<td>' .hitung_rata($nilai) . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    }

    print_mhs($array_mhs);
?>
