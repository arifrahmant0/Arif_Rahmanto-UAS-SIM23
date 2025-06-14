<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<a href="#" class="brand-link d-flex align-items-center">
		<img src="<?= base_url('assets/adminlte/dist/img/mj.png') ?>" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8; width: 35px; height: 35px;">
		<span class="brand-text font-weight-light ml-2">PT. Maju Jaya</span>
	</a>

	<div class="sidebar">
		<div class="user-panel mt-3 pb-3 d-flex">
			<div class="info">
				<a href="#" class="d-block"><?php echo ucfirst($this->session->userdata('role')); ?></a>
			</div>
		</div>

		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" role="menu">
				<li class="nav-item">
					<a href="<?php echo base_url($this->session->userdata('role') . '/dashboard'); ?>" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>Dashboard</p>
					</a>
				</li>

				<?php if ($this->session->userdata('role') == 'admin'): ?>
					<li class="nav-item">
						<a href="<?php echo base_url('admin/produk'); ?>" class="nav-link">
							<i class="nav-icon fas fa-box"></i>
							<p>Data Produk</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo base_url('admin/pelanggan'); ?>" class="nav-link">
							<i class="nav-icon fas fa-user-friends"></i>
							<p>Data Pelanggan</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo base_url('admin/sales_order'); ?>" class="nav-link">
							<i class="nav-icon fas fa-file-alt"></i>
							<p>Semua Sales Order</p>
						</a>
					</li>

				<?php elseif ($this->session->userdata('role') == 'sales'): ?>
					<li class="nav-item">
						<a href="<?php echo base_url('sales/order'); ?>" class="nav-link">
							<i class="nav-icon fas fa-cart-plus"></i>
							<p>Buat Sales Order</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo base_url('sales/history'); ?>" class="nav-link">
							<i class="nav-icon fas fa-history"></i>
							<p>Riwayat Order Saya</p>
						</a>
					</li>

				<?php elseif ($this->session->userdata('role') == 'manager'): ?>
					<li class="nav-item">
						<a href="<?php echo base_url('manager/laporan'); ?>" class="nav-link">
							<i class="nav-icon fas fa-chart-line"></i>
							<p>Laporan Penjualan</p>
						</a>
					</li>
				<?php endif; ?>

				<li class="nav-item">
					<a href="<?php echo base_url('auth/logout'); ?>" class="nav-link">
						<i class="nav-icon fas fa-sign-out-alt"></i>
						<p>Logout</p>
					</a>
				</li>
			</ul>
		</nav>
	</div>
</aside>