<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
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

        h3 {
            margin: 0;
            padding-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
        <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo">
        <div class="company">PT Maju Jaya</div>
    </div>

    <h3>Laporan Penjualan</h3>

    <?php if ($this->input->get('start_date') && $this->input->get('end_date')): ?>
        <p>Periode: <strong><?= date('d-m-Y', strtotime($this->input->get('start_date'))) ?> s/d <?= date('d-m-Y', strtotime($this->input->get('end_date'))) ?></strong></p>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>Sales</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $grand_total = 0;
            foreach ($laporan as $row): ?>
                <tr>
                    <td><?= date('d-m-Y', strtotime($row->created_at)) ?></td>
                    <td><?= $row->nama_produk ?></td>
                    <td><?= $row->nama_sales ?></td>
                    <td><?= number_format($row->jumlah, 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($row->harga_satuan, 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($row->total_harga, 0, ',', '.') ?></td>
                </tr>
                <?php $grand_total += $row->total_harga; ?>
            <?php endforeach; ?>
            <tr>
                <th colspan="5" class="text-right">Total</th>
                <th>Rp <?= number_format($grand_total, 0, ',', '.') ?></th>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>&copy; <?= date('Y') ?> PT. Maju Jaya - Laporan ini dicetak otomatis oleh sistem</p>
    </div>
</body>

</html>