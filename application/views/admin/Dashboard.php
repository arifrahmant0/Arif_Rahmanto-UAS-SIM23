<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard Admin</h1>
                    <p class="text-muted">Selamat datang, <strong><?= $this->session->userdata('username'); ?></strong>. Anda login sebagai <strong>Admin</strong>.</p>
                </div>
                <div class="col-sm-6 text-sm-end">
                    <span class="badge bg-info text-white p-2">Akses Penuh</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">

            <!-- Row of Statistic Cards -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?= $total_user ?></h3>
                            <p>Pengguna</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="<?= base_url('admin/user') ?>" class="small-box-footer">Kelola <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $total_produk ?></h3>
                            <p>Produk</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <a href="<?= base_url('admin/produk') ?>" class="small-box-footer">Kelola <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $total_order ?></h3>
                            <p>Pesanan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <a href="<?= base_url('admin/sales_order') ?>" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $total_laporan ?></h3>
                            <p>Laporan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <a href="<?= base_url('admin/sales_order/laporan') ?>" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Informasi Tambahan -->
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Panduan Penggunaan</h5>
                    <p class="card-text">Gunakan menu navigasi di sebelah kiri untuk mengelola data aplikasi seperti user, produk, pesanan, dan laporan. Pastikan selalu logout setelah selesai menggunakan sistem.</p>
                </div>
            </div>

        </div>
    </div>
</div>