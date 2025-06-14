<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Header -->
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0"><?php echo isset($pelanggan) ? 'Edit' : 'Tambah'; ?> Pelanggan</h1>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo isset($pelanggan) ? $pelanggan->nama : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" required><?php echo isset($pelanggan) ? $pelanggan->alamat : ''; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Telepon</label>
                            <input type="text" name="telepon" class="form-control" value="<?php echo isset($pelanggan) ? $pelanggan->telepon : ''; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="<?php echo base_url('admin/pelanggan'); ?>" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>