<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1 class="m-0">Dashboard Manager</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="alert alert-info">
                Selamat datang, <strong><?= $this->session->userdata('username'); ?></strong>! Anda login sebagai <strong>Manager</strong>.
            </div>

            <div class="row">
                <!-- Pie Chart: Penjualan per Produk -->
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title">Persentase Penjualan per Produk</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="pieChart" height="300"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Bar Chart: Penjualan per Bulan -->
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h5 class="card-title">Penjualan per Bulan</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="barChart" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Data Pie Chart
        const pieData = {
            labels: <?= json_encode(array_column($produk_data, 'nama_produk')) ?>,
            datasets: [{
                label: 'Penjualan Produk',
                data: <?= json_encode(array_map('intval', array_column($produk_data, 'total_penjualan'))) ?>,
                backgroundColor: [
                    '#007bff', '#28a745', '#ffc107', '#dc3545', '#6f42c1',
                    '#17a2b8', '#fd7e14', '#20c997', '#6610f2', '#6c757d'
                ]
            }]
        };

        new Chart(document.getElementById('pieChart'), {
            type: 'pie',
            data: pieData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Data Bar Chart
        const barData = {
            labels: <?= json_encode(array_column($bulan_data, 'bulan')) ?>,
            datasets: [{
                label: 'Total Penjualan',
                data: <?= json_encode(array_map('intval', array_column($bulan_data, 'total'))) ?>,
                backgroundColor: '#28a745'
            }]
        };

        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: barData,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    });
</script>