<!-- Nama : Fathia Rahma
     NIM : 240601221300
     Praktikum PBP B2
     -->

     <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        table {
            width: 60%;
            border-collapse: separate;
            border-spacing: 0;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        table, th, td {
            border: 1px solid #dddddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #2196F3;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
            transition: background-color 0.3s;
        }
        caption {
            font-size: 1.5em;
            margin: 10px;
            color: #333;
        }
    </style>
</head>
<body>
    <?php
    function hitung_rata($array){
        return array_sum($array) / count($array);
    }

    function print_mhs($array_mhs) {
        echo "<table>";
        echo "<caption>Daftar Nilai Mahasiswa</caption>";
        echo "<tr><th>Nama</th><th>Nilai 1</th><th>Nilai 2</th><th>Nilai 3</th><th>Rata2</th></tr>";
    
        foreach ($array_mhs as $nama => $nilai) {
            echo "<tr>";
            echo "<td>$nama</td>";
            echo "<td>{$nilai[0]}</td>";
            echo "<td>{$nilai[1]}</td>";
            echo "<td>{$nilai[2]}</td>";
            $rata2 = hitung_rata($nilai);
            echo "<td>$rata2</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    };
    
    //array mahasiswa
    $array_mhs = array(
        'Abdul' => array(89,90,54), 
        'Budi' => array(78,60,64), 
        'Nina' => array(67,56,84)
    ); 
    
    print_mhs($array_mhs);
    ?>
</body>
</html>
