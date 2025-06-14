<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>

<div class="content-wrapper">
    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">
            <h1 class="m-0 text-dark"><i class="fas fa-user-tie"></i> Dashboard Sales</h1>
            <small class="text-muted">Pantau dan kelola aktivitas penjualan Anda</small>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Welcome Alert -->
            <div class="alert alert-success shadow-sm" role="alert">
                <h5 class="mb-1"><i class="fas fa-smile-wink"></i> Selamat Datang!</h5>
                <p class="mb-0">
                    Halo, <strong><?= $this->session->userdata('username'); ?></strong>! Anda login sebagai <strong>Sales</strong>.
                </p>
            </div>

            <!-- Card: Panduan Penggunaan -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0"><i class="fas fa-info-circle"></i> Panduan Penggunaan</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check-circle text-success"></i> Gunakan menu <strong>Buat Sales Order</strong> untuk mencatat pesanan pelanggan.</li>
                        <li><i class="fas fa-history text-info"></i> Lihat riwayat pesanan melalui menu <strong>Riwayat Order Saya</strong>.</li>
                        <li><i class="fas fa-user-friends text-warning"></i> Jaga hubungan baik dengan pelanggan melalui pengelolaan pesanan yang tepat waktu.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('templates/footer'); ?>