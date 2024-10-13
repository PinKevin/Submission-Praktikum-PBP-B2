<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menghitung Nilai</title>
</head>
<body>
<style>
    body{
        font-family: Arial, sans-serif;
        background-color: azure;
        margin: 0;
        padding: 20px;
    }

    table{
        width: 60%;
        margin: 0 auto;
        border-collapse: collapse;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        background-color: #fff;
        border-radius: 10px;
        overflow: hidden;
    }
    th, td {
            padding: 12px 15px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
        }
        td {
            color: #333;
            background-color: #f9f9f9;
        }
        h1 {
            text-align: center;
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
</style>



    <?php 
    $array_mhs = array(
        'Abdul' => array(89,90,54),
        'Budi' => array(78,60,64),
        'Nina' => array(67,56,84)
    );
    function hitung_rata($array){
        if(is_array($array)&&count($array) > 0){
            return array_sum($array) / count($array);
        }
        return 0;
    }

    function print_mhs($array_mhs){
        echo '<table border="1">';
        echo '<tr>
        <td>Nama</td>
        <td>Nilai 1</td>
        <td>Nilai 2</td>
        <td>Nilai 3</td>
        <td>Rata-rata</td>
        </tr>';

        foreach($array_mhs as $nama => $nilai)
        {
       
        $nilai1 = $nilai[0];
        $nilai2 = $nilai[1];
        $nilai3 = $nilai[2];
        
        
        $rata_rata = ($nilai1 + $nilai2 + $nilai3) / 3;

        echo '<tr>';
        echo '<td>'.$nama.'</td>';
        echo '<td>'.$nilai1.'  </td>';
        echo '<td>'.$nilai2.'  </td>';
        echo '<td>'.$nilai3.  '</td>';
        echo '<td>'.number_format($rata_rata, 2).'</td>';
        echo '</tr>';
        }
    }
    print_mhs($array_mhs);
    ?>

    <h1>Table Nilai Mahasiswa</h1>
</body>
</html>