<div class="content-wrapper">
    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">
            <h3 class="mb-0"><?= $title ?></h3>
            <p class="text-muted">Gunakan filter di bawah ini untuk menampilkan data laporan penjualan sesuai kriteria.</p>
        </div>
    </section>

    <!-- Filter -->
    <section class="content">
        <div class="container-fluid">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <strong><i class="fas fa-filter"></i> Filter Laporan</strong>
                </div>
                <div class="card-body">
                    <form method="get">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label><strong>Dari Tanggal</strong></label>
                                <input type="date" name="start_date" value="<?= set_value('start_date', $this->input->get('start_date')) ?>" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label><strong>Sampai Tanggal</strong></label>
                                <input type="date" name="end_date" value="<?= set_value('end_date', $this->input->get('end_date')) ?>" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label><strong>Sales</strong></label>
                                <select name="sales_id" class="form-control">
                                    <option value="">Semua</option>
                                    <?php foreach ($sales_list as $s): ?>
                                        <option value="<?= $s->id ?>" <?= $this->input->get('sales_id') == $s->id ? 'selected' : '' ?>>
                                            <?= $s->username ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label><strong>Produk</strong></label>
                                <select name="produk_id" class="form-control">
                                    <option value="">Semua</option>
                                    <?php foreach ($produk_list as $p): ?>
                                        <option value="<?= $p->id ?>" <?= $this->input->get('produk_id') == $p->id ? 'selected' : '' ?>>
                                            <?= $p->nama_produk ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>



                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Tampilkan
                            </button>
                            <a href="<?= base_url('manager/laporan/cetak?' . http_build_query($this->input->get())) ?>"
                                target="_blank" class="btn btn-danger ml-2">
                                <i class="fas fa-file-pdf"></i> Cetak PDF
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tabel Data -->
            <div class="card shadow-sm mt-3">
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Tanggal</th>
                                <th>Produk</th>
                                <th>Sales</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; ?>
                            <?php foreach ($laporan as $row): ?>
                                <tr>
                                    <td><?= date('d-m-Y', strtotime($row->created_at)) ?></td>
                                    <td><?= $row->nama_produk ?></td>
                                    <td><?= $row->nama_sales ?></td>
                                    <td><?= $row->jumlah ?></td>
                                    <td>Rp <?= number_format($row->harga_satuan, 0, ',', '.') ?></td>
                                    <td>Rp <?= number_format($row->total_harga, 0, ',', '.') ?></td>
                                    <td>
                                        <span class="badge badge-<?= $row->status === 'selesai' ? 'success' : ($row->status === 'dikirim' ? 'info' : ($row->status === 'dibatalkan' ? 'danger' : 'secondary')) ?>">
                                            <?= ucfirst($row->status) ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php $total += $row->total_harga; ?>
                            <?php endforeach; ?>
                            <?php if (empty($laporan)): ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Tidak ada data untuk ditampilkan.</td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <th colspan="5" class="text-right">Total</th>
                                    <th>Rp <?= number_format($total, 0, ',', '.') ?></th>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
</div>