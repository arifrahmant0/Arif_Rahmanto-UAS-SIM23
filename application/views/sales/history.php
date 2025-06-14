<div class="content-wrapper">
    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="m-0 text-dark"><i class="fas fa-history"></i> <?= $title ?></h3>
            </div>

            <!-- Filter Status -->
            <form method="GET" action="<?= base_url('sales/history') ?>" class="form-inline">
                <div class="form-group mr-2">
                    <label for="status" class="mr-2">Filter Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">Semua</option>
                        <option value="draft" <?= ($this->input->get('status') == 'draft') ? 'selected' : '' ?>>Draft</option>
                        <option value="selesai" <?= ($this->input->get('status') == 'selesai') ? 'selected' : '' ?>>Selesai</option>
                        <option value="dibatalkan" <?= ($this->input->get('status') == 'dibatalkan') ? 'selected' : '' ?>>Dibatalkan</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-filter"></i> Terapkan
                </button>
            </form>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-sm">
                <div class="card-header bg-gradient-info">
                    <h5 class="card-title text-white mb-0"><i class="fas fa-list-alt"></i> Daftar Riwayat Order</h5>
                </div>
                <div class="card-body table-responsive p-0">
                    <table id="historyTable" class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width: 20%;">Tanggal</th>
                                <th style="width: 35%;">Pelanggan</th>
                                <th style="width: 25%;">Status</th>
                                <th style="width: 20%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td><?= date('d-m-Y', strtotime($order->created_at)) ?></td>
                                    <td><?= $order->nama_pelanggan ?></td>
                                    <td>
                                        <?php if ($order->status == 'draft'): ?>
                                            <span class="badge badge-warning"><i class="fas fa-edit"></i> Draft</span>
                                        <?php elseif ($order->status == 'selesai'): ?>
                                            <span class="badge badge-success"><i class="fas fa-check-circle"></i> Selesai</span>
                                        <?php elseif ($order->status == 'dibatalkan'): ?>
                                            <span class="badge badge-danger"><i class="fas fa-times-circle"></i> Dibatalkan</span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary"><?= ucfirst($order->status) ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('sales/history/detail/' . $order->id) ?>" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <?php if (empty($orders)): ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        <i class="fas fa-box-open fa-2x mb-2"></i><br>
                                        Tidak ada data order untuk ditampilkan.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>