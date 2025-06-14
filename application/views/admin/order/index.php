<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h3 class="mb-2"><?= $title ?></h3>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card shadow-sm">
                <div class="card-header bg-gradient-primary">
                    <h5 class="card-title text-white mb-0">Riwayat Sales Order</h5>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover" id="datatable">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width: 20%;">Tanggal</th>
                                <th style="width: 25%;">Pelanggan</th>
                                <th style="width: 20%;">Status</th>
                                <th style="width: 20%;">Aksi</th>
                                <th style="width: 15%;">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td><?= date('d-m-Y', strtotime($order->created_at)) ?></td>
                                    <td><?= $order->nama_pelanggan ?></td>
                                    <td>
                                        <form action="<?= base_url('admin/order/update_status/' . $order->id) ?>" method="POST" class="form-inline">
                                            <select name="status" class="form-control form-control-sm mr-2">
                                                <option value="draft" <?= $order->status === 'draft' ? 'selected' : '' ?>>Draft</option>
                                                <option value="dikirim" <?= $order->status === 'dikirim' ? 'selected' : '' ?>>Dikirim</option>
                                                <option value="selesai" <?= $order->status === 'selesai' ? 'selected' : '' ?>>Selesai</option>
                                                <option value="dibatalkan" <?= $order->status === 'dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-primary">Ubah</button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('admin/order/detail/' . $order->id) ?>" class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
</div>