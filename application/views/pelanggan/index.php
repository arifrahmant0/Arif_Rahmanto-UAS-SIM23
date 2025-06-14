<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h1 class="m-0"><i class="fas fa-users"></i> Data Pelanggan</h1>
                <a href="<?= base_url('admin/pelanggan/tambah'); ?>" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> Tambah Pelanggan
                </a>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="pelangganTable" class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th style="width: 25%;">Nama</th>
                                    <th style="width: 30%;">Alamat</th>
                                    <th style="width: 15%;">Telepon</th>
                                    <th style="width: 15%;">Dibuat</th>
                                    <th style="width: 10%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($pelanggan)) : ?>
                                    <?php foreach ($pelanggan as $i => $p) : ?>
                                        <tr>
                                            <td><?= $i + 1; ?></td>
                                            <td><?= htmlentities($p->nama); ?></td>
                                            <td><?= htmlentities($p->alamat); ?></td>
                                            <td><?= htmlentities($p->telepon); ?></td>
                                            <td><span class="badge badge-info"><?= date('d-m-Y H:i', strtotime($p->created_at)); ?></span></td>
                                            <td>
                                                <a href="<?= base_url('admin/pelanggan/edit/' . $p->id); ?>" class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="<?= base_url('admin/pelanggan/hapus/' . $p->id); ?>" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Hapus pelanggan ini?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">Belum ada data pelanggan.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>