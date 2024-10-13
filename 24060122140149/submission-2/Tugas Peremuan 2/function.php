<!-- Nama: Demina Ayunda Chesara
     NIM: 24060122140149
     Tanggal: 10 September 2024
Praktikum Pemrograman Berbasis Objek B2 --> 
 <html>
    <head>
        <title>Function</title>
    </head>
    <body>
        <?php
        function hitung_rata($array){
            $total = 0;
            $jumlah_nilai = count($array);

            foreach($array as $nilai){
                $total = $total + $nilai;
            }
            return $total/$jumlah_nilai;
        }

        function nilai_huruf($rata2){
            if ($rata2 >= 80 && $rata2 <= 100){
                return 'A';
            }
            elseif ($rata2 >= 60 && $rata2 < 80){
                return 'B';
            }
            elseif ($rata2 >= 40 && $rata2 < 60){
                return 'C';
            }
            elseif ($rata2 >= 20 && $rata2 < 40){
                return 'D';
            }
            elseif ($rata2 >= 0 && $rata2 < 20){
                return 'E';
            }
            else{
                return 'Invalid nilai';
            }
                
        }

        function keterangan($nilai_huruf){
            switch($nilai_huruf){
                case "A":
                    return "Sangat Baik";
                    break;
                case "B":
                    return "Baik";
                    break;
                case "C":
                    return "Cukup";
                    break;
                case "D":
                    return "Kurang";
                    break;
                case "E":
                    return "Tidak Lulus";
                    break;
                default:
                    return "Invalid nilai!";
                    break;
            }
        }
        ?>
    </body>
<html>