<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cetak Detail Sales Order</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            font-size: 13px;
            color: #333;
            margin: 40px;
        }

        .header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header img {
            height: 60px;
            margin-right: 15px;
        }

        .header .company {
            font-size: 20px;
            font-weight: bold;
        }

        .section {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px 10px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            margin-top: 40px;
            font-size: 12px;
            text-align: center;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="<?= base_url('assets/adminlte/dist/img/mj.png') ?>" alt="Logo">
        <div class="company">PT Maju Jaya</div>
    </div>

    <h3>Detail Sales Order</h3>

    <div class="section">
        <p><strong>Tanggal Order:</strong> <?= date('d-m-Y', strtotime($order->created_at)) ?></p>
        <p><strong>Pelanggan:</strong> <?= $order->nama_pelanggan ?></p>
        <p><strong>Status:</strong> <?= ucfirst($order->status) ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php $grand_total = 0;
            foreach ($details as $item): ?>
                <tr>
                    <td><?= $item->nama_produk ?></td>
                    <td><?= $item->jumlah ?></td>
                    <td>Rp <?= number_format($item->harga_satuan, 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($item->total_harga, 0, ',', '.') ?></td>
                </tr>
                <?php $grand_total += $item->total_harga; ?>
            <?php endforeach; ?>
            <tr>
                <th colspan="3" class="text-right">Total</th>
                <th>Rp <?= number_format($grand_total, 0, ',', '.') ?></th>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>&copy; <?= date('Y') ?> PT. Maju Jaya - Laporan ini dicetak otomatis oleh sistem</p>
    </div>

    <script>
        window.print();
    </script>
</body>

</html>