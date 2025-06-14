<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h3 class="mb-2"><?= $title ?></h3>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">Informasi Pelanggan</div>
                <div class="card-body">
                    <p><strong>Nama:</strong> <?= $order->nama_pelanggan ?></p>
                    <p><strong>Alamat:</strong> <?= $order->alamat ?></p>
                    <p><strong>Telepon:</strong> <?= $order->telepon ?></p>
                    <p><strong>Status:</strong> <?= ucfirst($order->status) ?></p>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">Detail Produk</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($details as $item): ?>
                                <tr>
                                    <td><?= $item->nama_produk ?></td>
                                    <td><?= $item->jumlah ?></td>
                                    <td>Rp<?= number_format($item->harga_satuan, 0, ',', '.') ?></td>
                                    <td>Rp<?= number_format($item->total_harga, 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>

                </div>

            </div>
            <!-- Tambahkan tombol kembali di bawah section -->
            <div class="container-fluid mb-4">
                <a href="<?= base_url('sales/history') ?>" class="btn btn-info btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali ke Riwayat
                </a>
            </div>
        </div>
    </section>
</div>