<?php

require_once 'koneksi.php';

$no_faktur = $_GET['fk'];
$sql = "SELECT * FROM tbl_penjualan WHERE nofaktur = '$no_faktur'";


$result = $koneksi->query($sql);



if ($result->num_rows > 0) {
    $total = 0;
    while ($row = $result->fetch_assoc()) {
        $nofaktur = $row['nofaktur'];
        $tgl = date('d M Y', strtotime($row['tanggal']));
        $total += (int) $row['harga'];
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .receipt-container {
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .receipt-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .receipt-header h1 {
            margin: 0;
        }

        .receipt-details,
        .receipt-footer {
            margin-bottom: 30px;
        }

        .receipt-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .receipt-details th,
        .receipt-details td {
            border: 1px solid #ccc;
            padding: 15px;
            text-align: left;
        }

        .receipt-details th {
            background-color: lightgray;
        }

        .total {
            font-weight: bold;
            font-size: 1.2em;
        }

        .receipt-footer {
            text-align: center;
        }
    </style>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</head>

<body>
    <div class="receipt-container">
        <div class="receipt-header">
            <h1>Struk Transaksi PT Himari Pharm</h1>
        </div>
        <div class="receipt-details">
            <p><strong>No Faktur:</strong> # <?= $no_faktur ?></p>
            <p><strong>Tanggal:</strong> <?= $tgl ?></p>
            <!-- <p><strong>Customer:</strong> John Doe</p> -->
            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Kuantitas</th>
                        <th>Harga Satuan</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $results = $koneksi->query("SELECT * FROM tbl_penjualan WHERE nofaktur = '$no_faktur'");

                    while ($rows = $results->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?= $rows['nama_barang'] ?></td>
                            <td>Rp. <?= number_format($rows['hsatuan']) ?></td>
                            <td><?= $rows['jumlah_jual'] ?></td>
                            <td>Rp. <?= number_format($rows['harga']) ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan="5" class="total">Grand Total</td>
                        <td class="total">Rp. <?= number_format($total) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="receipt-footer">
            <p>==============================================</p>
            <p><strong>PT Himari Pharm</strong><br>
            <p>Terima Kasih Sudah Membeli! Jangan Lupa Datang Lagi!</p>
            </p>
        </div>
    </div>
</body>

</html>