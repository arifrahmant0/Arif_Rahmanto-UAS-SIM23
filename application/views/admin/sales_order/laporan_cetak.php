<div class="content-wrapper" onload="window.print()">
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <img src="<?= base_url('assets/adminlte/dist/img/mj.png') ?>" alt="Logo" height="50" class="mr-3">
                <h3 class="mb-0">PT Maju Jaya</h3>
            </div>
            <small class="text-muted"><?= $title ?> - Dicetak pada <?= date('d-m-Y H:i') ?></small>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Status: </strong>
                        <?= $this->input->get('status') ? ucfirst($this->input->get('status')) : 'Semua' ?>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width:5%;">#</th>
                                    <th style="width:20%;">Tanggal Order</th>
                                    <th style="width:45%;">Nama Pelanggan</th>
                                    <th style="width:30%;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($orders)): ?>
                                    <?php foreach ($orders as $i => $order): ?>
                                        <tr>
                                            <td><?= $i + 1 ?></td>
                                            <td><?= date('d-m-Y', strtotime($order->created_at)) ?></td>
                                            <td><?= $order->nama_pelanggan ?></td>
                                            <td>
                                                <?php
                                                $status = $order->status;
                                                $badge = 'secondary';
                                                if ($status == 'dikirim') $badge = 'info';
                                                elseif ($status == 'selesai') $badge = 'success';
                                                elseif ($status == 'dibatalkan') $badge = 'danger';
                                                ?>
                                                <span class="badge badge-<?= $badge ?>"><?= ucfirst($status) ?></span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Tidak ada data order.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-center text-muted mt-4">
                        <small>&copy; <?= date('Y') ?> PT. Maju Jaya – Laporan ini dicetak otomatis oleh sistem Sales Order</small>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<script>
    window.onload = function() {
        window.print();
    }
</script>