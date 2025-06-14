<div class="content-wrapper">
    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">
            <h3><?= $title ?></h3>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Informasi Order -->
            <div class="card mb-3">
                <div class="card-body">
                    <p><strong>Tanggal:</strong> <?= date('d-m-Y', strtotime($order->created_at)) ?></p>
                    <p><strong>Status:</strong> <?= ucfirst($order->status) ?></p>
                    <hr>
                    <p><strong>Nama Pelanggan:</strong> <?= $order->nama_pelanggan ?></p>
                    <p><strong>Alamat:</strong> <?= $order->alamat ?></p>
                    <p><strong>Telepon:</strong> <?= $order->telepon ?></p>
                </div>
            </div>

            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>


            <!-- Tabel Produk -->
            <div class="card">
                <div class="card-body table-responsive">
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
                            <?php $total = 0;
                            foreach ($details as $d): ?>
                                <tr>
                                    <td><?= $d->nama_produk ?></td>
                                    <td><?= $d->jumlah ?></td>
                                    <td>Rp <?= number_format($d->harga_satuan) ?></td>
                                    <td>Rp <?= number_format($d->total_harga) ?></td>
                                </tr>
                                <?php $total += $d->total_harga; ?>
                            <?php endforeach; ?>
                            <tr>
                                <th colspan="3" class="text-right">Total</th>
                                <th>Rp <?= number_format($total) ?></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
</div>