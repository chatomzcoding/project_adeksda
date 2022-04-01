<?php
header('Content-Type: application/vnd.msword');
header('Content-Disposition: attachment; filename="test.doc"');
header('Cache-Control: private, max-age=0, must-revalidate');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        @page {
            size: A4 landscape;
            margin: 1.25cm 2cm 1.5cm 2cm;
        }
        p { font-size:16px; margin-top:0; padding-top:0 }
        table { font-size:14.3px }
        h1 { font-size:18.5px; text-align:center;  }
        h2 { font-size:16px; text-align:left; margin-bottom:0; padding-bottom:0 }
        </style>
</head>
<body>
    <table class="table table-bordered" style="border: 1px solid black" width="100%">
        <tr>
            <td width="20%">
                <img src="{{ asset('img/bg-login.png') }}" alt="" width="10px">
            </td>
            <td>nomor</td>
            <td>nama</td>
        </tr>
    </table>
</body>
</html>
