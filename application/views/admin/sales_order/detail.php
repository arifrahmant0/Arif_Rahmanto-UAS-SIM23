<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <h3 class="text-primary font-weight-bold"><?= $title ?></h3>
            <a href="<?= base_url('admin/sales_order/cetak_detail/' . $order->id) ?>" target="_blank" class="btn btn-outline-primary">
                <i class="fas fa-print"></i> Cetak Laporan
            </a>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card shadow-sm mb-3">
                <div class="card-header bg-light">
                    <strong>Informasi Order</strong>
                </div>
                <div class="card-body">
                    <p><strong>Tanggal Order:</strong> <?= date('d-m-Y', strtotime($order->created_at)) ?></p>
                    <p><strong>Pelanggan:</strong> <?= $order->nama_pelanggan ?></p>
                    <p><strong>Status:</strong>
                        <span class="badge badge-<?= $order->status == 'selesai' ? 'success' : ($order->status == 'dikirim' ? 'info' : ($order->status == 'draft' ? 'warning' : 'danger')) ?>">
                            <?= ucfirst($order->status) ?>
                        </span>
                    </p>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <strong>Daftar Produk</strong>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
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

                    <a href="<?= base_url('admin/sales_order') ?>" class="btn btn-secondary mt-3">Kembali</a>
                </div>
            </div>

        </div>
    </section>
</div>