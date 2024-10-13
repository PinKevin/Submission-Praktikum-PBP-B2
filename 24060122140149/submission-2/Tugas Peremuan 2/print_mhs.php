<!-- Nama: Demina Ayunda Chesara
     NIM: 24060122140149
     Tanggal: 10 September 2024
Praktikum Pemrograman Berbasis Objek B2 -->
<html>
    <head>
        <title>Data Mahasiswa</title>
    </head>
    <body>
        <?php
        require_once("function.php");
        function print_mhs($array_mhs){
            echo '<table border="1">';
            echo '<tr>
                <td>Nama</td>
                <td>Nilai 1</td>
                <td>Nilai 2</td>
                <td>Nilai 3</td>
                <td>Rata2</td>
                <td>Nilai Huruf</td>
                <td>Keterangan</td>
            </tr>';

            foreach($array_mhs as $nama => $nilai){
                $rata2 = hitung_rata($nilai);
                $nilai_huruf = nilai_huruf($rata2);
                $ket = keterangan($nilai_huruf);
                echo "<tr>
                        <td>$nama</td>
                        <td>{$nilai[0]}</td>
                        <td>{$nilai[1]}</td>
                        <td>{$nilai[2]}</td>
                        <td>$rata2</td>
                        <td>$nilai_huruf</td>
                        <td>$ket</td>
                        
                </tr>";
            }
            echo'</table>';
        }
        $array_mhs = array(
            'Abdul' => array(89, 90, 54),
            'Budi' => array(98, 65, 74),
            'Nina' => array(67, 56, 84)
        );

        print_mhs($array_mhs);
        
        ?>
    </body>
<html>