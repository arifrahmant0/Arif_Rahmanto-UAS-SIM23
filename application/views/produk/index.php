<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <h1 class="m-0 text-dark"><i class="fas fa-box-open mr-2"></i>Data Produk</h1>
            <a href="<?= base_url('admin/produk/tambah'); ?>" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Tambah Produk
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-sm">
                <div class="card-body">
                    <?php if (empty($produk)) : ?>
                        <div class="alert alert-warning text-center">Belum ada produk yang ditambahkan.</div>
                    <?php else : ?>
                        <div class="table-responsive">
                            <table id="produkTable" class="table table-bordered table-hover">

                                <thead class="thead-dark">
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Kode</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($produk as $i => $p) : ?>
                                        <tr>
                                            <td class="text-center"><?= $i + 1; ?></td>
                                            <td><?= $p->kode_produk; ?></td>
                                            <td><?= $p->nama_produk; ?></td>
                                            <td>Rp<?= number_format($p->harga, 0, ',', '.'); ?></td>
                                            <td class="text-center"><?= $p->stok; ?></td>
                                            <td><?= date('d M Y, H:i', strtotime($p->created_at)); ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('admin/produk/edit/' . $p->id); ?>" class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="<?= base_url('admin/produk/hapus/' . $p->id); ?>" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Hapus produk ini?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>