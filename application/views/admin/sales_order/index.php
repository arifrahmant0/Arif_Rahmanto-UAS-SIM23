<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h3 class="m-0"><?= $title ?></h3>
                <a href="<?= base_url('admin/sales_order/laporan_cetak') ?>" class="btn btn-primary shadow-sm">
                    <i class="fas fa-print"></i> Cetak Laporan
                </a>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-history mr-1"></i> Riwayat Sales Order</h5>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover" id="datatable">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width: 20%;">Tanggal</th>
                                <th style="width: 30%;">Pelanggan</th>
                                <th style="width: 30%;">Status</th>
                                <th style="width: 20%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td><?= date('d-m-Y', strtotime($order->created_at)) ?></td>
                                    <td><?= htmlentities($order->nama_pelanggan) ?></td>
                                    <td>
                                        <?php if ($order->status === 'draft'): ?>
                                            <span class="badge badge-secondary">Draft</span>
                                            <div class="mt-1">
                                                <a href="<?= base_url('admin/sales_order/update_status/' . $order->id . '/dikirim') ?>" class="btn btn-sm btn-success">Dikirim</a>
                                                <a href="<?= base_url('admin/sales_order/update_status/' . $order->id . '/dibatalkan') ?>" class="btn btn-sm btn-danger">Batal</a>
                                            </div>
                                        <?php elseif ($order->status === 'dikirim'): ?>
                                            <span class="badge badge-info">Dikirim</span>
                                            <a href="<?= base_url('admin/sales_order/update_status/' . $order->id . '/selesai') ?>" class="btn btn-sm btn-success">Selesai</a>
                                        <?php elseif ($order->status === 'selesai'): ?>
                                            <span class="badge badge-success">Selesai</span>
                                        <?php elseif ($order->status === 'dibatalkan'): ?>
                                            <span class="badge badge-danger">Dibatalkan</span>
                                        <?php else: ?>
                                            <span class="badge badge-light"><?= ucfirst($order->status) ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('admin/sales_order/detail/' . $order->id) ?>" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($orders)) : ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Belum ada data Sales Order.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>