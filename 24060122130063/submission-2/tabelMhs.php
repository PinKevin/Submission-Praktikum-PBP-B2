<!DOCTYPE html>
<html>
    <head>
        <title>Tugas Prak 2</title>
        <style>
            body{
                font-family: Times New Roman;
                margin: 10px;
            }

        </style>
    </head>
    <body>
        <h2>Data nilai mahasiswa</h2>

        <?php
            require_once("rataRata.php");
            $array_mhs = [
                ['Abdul' => [89, 90, 54]],
                ['Budi' => [98, 65, 74]],
                ['Nina' => [67, 56, 84]]
            ];
            function print_mhs($array_mhs){
                echo '<table border="1">';
                echo '<tr>
                        <td>Nama</td>
                        <td>Nilai 1</td>
                        <td>Nilai 2</td>
                        <td>Nilai 3</td>
                        <td>Rata2</td>
                </tr>';
                foreach ($array_mhs as $arr){
                    foreach($arr as $nama => $array){
                        echo '<tr>';
                        echo '<td>'.$nama.'</td>';
                        echo '<td>'.$array[0].'</td>';
                        echo '<td>'.$array[1].'</td>';
                        echo '<td>'.$array[2].'</td>';
                        echo '<td>'.hitung_rata($array).'</td>';
                        echo '</tr>';
                    }
                }
                echo '</table>';
            }
            print_mhs($array_mhs);
        ?>
    </body>
</html>

