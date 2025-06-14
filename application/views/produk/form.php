<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0">
                <?php echo isset($produk) ? 'Edit Produk' : 'Tambah Produk'; ?>
            </h1>
        </div>
    </div>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label>Kode Produk</label>
                            <input type="text" name="kode_produk" class="form-control" value="<?php echo isset($produk) ? $produk->kode_produk : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control" value="<?php echo isset($produk) ? $produk->nama_produk : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="number" name="harga" class="form-control" value="<?php echo isset($produk) ? $produk->harga : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Stok</label>
                            <input type="number" name="stok" class="form-control" value="<?php echo isset($produk) ? $produk->stok : ''; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="<?php echo base_url('admin/produk'); ?>" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>