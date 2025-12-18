<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Cards Summary -->
<div class="col-lg-3 col-md-6">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="round-48 text-bg-success rounded-circle d-flex align-items-center justify-content-center">
                    <i class="ti ti-arrow-up-right fs-6"></i>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0 fw-semibold">Pemasukan Bulan Ini</h6>
                    <h4 class="mb-0">Rp <?= number_format($pemasukanBulanan, 0, ',', '.'); ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-3 col-md-6">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="round-48 text-bg-danger rounded-circle d-flex align-items-center justify-content-center">
                    <i class="ti ti-arrow-down-right fs-6"></i>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0 fw-semibold">Pengeluaran Bulan Ini</h6>
                    <h4 class="mb-0">Rp <?= number_format($pengeluaranBulanan, 0, ',', '.'); ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-3 col-md-6">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="round-48 text-bg-info rounded-circle d-flex align-items-center justify-content-center">
                    <i class="ti ti-wallet fs-6"></i>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0 fw-semibold">Saldo Bulan Ini</h6>
                    <h4 class="mb-0">Rp <?= number_format($saldoBulanan, 0, ',', '.'); ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-3 col-md-6">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="round-48 text-bg-primary rounded-circle d-flex align-items-center justify-content-center">
                    <i class="ti ti-report-money fs-6"></i>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0 fw-semibold">Saldo Tahun Ini</h6>
                    <h4 class="mb-0">Rp <?= number_format($saldoTahunan, 0, ',', '.'); ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Grafik Bulanan -->
<div class="col-lg-8">
    <div class="card w-100">
        <div class="card-body">
            <div class="d-md-flex align-items-center">
                <div>
                    <h4 class="card-title">Laporan Keuangan 12 Bulan Terakhir</h4>
                    <p class="card-subtitle">Pemasukan vs Pengeluaran</p>
                </div>
                <div class="ms-auto">
                    <ul class="list-unstyled mb-0">
                        <li class="list-inline-item text-success">
                            <span class="round-8 text-bg-success rounded-circle me-1 d-inline-block"></span>
                            Pemasukan
                        </li>
                        <li class="list-inline-item text-danger">
                            <span class="round-8 text-bg-danger rounded-circle me-1 d-inline-block"></span>
                            Pengeluaran
                        </li>
                    </ul>
                </div>
            </div>
            <div id="chart-bulanan" class="mt-4 mx-n6"></div>
        </div>
    </div>
</div>

<!-- Top Pengeluaran & Transaksi Terbaru -->
<div class="col-lg-4">
    <div class="card overflow-hidden">
        <div class="card-body pb-0">
            <div class="d-flex align-items-start">
                <div>
                    <h4 class="card-title">Top Pengeluaran Bulan Ini</h4>
                    <p class="card-subtitle">Berdasarkan kategori</p>
                </div>
            </div>
            
            <?php if (!empty($topPengeluaran)): ?>
                <?php 
                $icons = ['ti-shopping-cart', 'ti-users', 'ti-building', 'ti-tool'];
                $colors = ['primary', 'warning', 'success', 'info'];
                foreach ($topPengeluaran as $index => $item): 
                ?>
                <div class="<?= $index > 0 ? 'py-3' : 'mt-4 pb-3' ?> d-flex align-items-center">
                    <span class="btn btn-<?= $colors[$index] ?? 'secondary' ?> rounded-circle round-48 hstack justify-content-center">
                        <i class="ti <?= $icons[$index] ?? 'ti-circle' ?> fs-6"></i>
                    </span>
                    <div class="ms-3">
                        <h5 class="mb-0 fw-bolder fs-4"><?= esc($item['kategori']); ?></h5>
                        <span class="text-muted fs-3">Rp <?= number_format($item['total'], 0, ',', '.'); ?></span>
                    </div>
                    <div class="ms-auto">
                        <span class="badge bg-secondary-subtle text-muted">
                            <?= $pengeluaranBulanan > 0 ? round(($item['total'] / $pengeluaranBulanan) * 100, 1) : 0 ?>%
                        </span>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted mt-3">Belum ada data pengeluaran bulan ini</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Grafik Mingguan -->
<div class="col-lg-6">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Laporan 4 Minggu Terakhir</h4>
            <p class="card-subtitle">Perbandingan mingguan</p>
            <div id="chart-mingguan" class="mt-4"></div>
        </div>
    </div>
</div>

<!-- Transaksi Terbaru -->
<div class="col-lg-6">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h4 class="card-title mb-0">Transaksi Terbaru</h4>
                <a href="<?= base_url('/data-kas/laporan/transaksi'); ?>" class="btn btn-sm btn-primary">
                    Lihat Semua
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Jenis</th>
                            <th class="text-end">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($transaksiTerbaru)): ?>
                            <?php foreach (array_slice($transaksiTerbaru, 0, 8) as $trx): ?>
                            <tr>
                                <td><?= date('d/m/Y', strtotime($trx['tanggal'])); ?></td>
                                <td><?= esc($trx['kategori']); ?></td>
                                <td>
                                    <span class="badge bg-<?= $trx['jenis_transaksi'] == 'Pemasukan' ? 'success' : 'danger' ?>-subtle text-<?= $trx['jenis_transaksi'] == 'Pemasukan' ? 'success' : 'danger' ?>">
                                        <?= esc($trx['jenis_transaksi']); ?>
                                    </span>
                                </td>
                                <td class="text-end fw-bold">Rp <?= number_format($trx['nominal'], 0, ',', '.'); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada transaksi</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data dari PHP
    const dataBulanan = <?= $dataGrafikBulanan; ?>;
    const dataMingguan = <?= $dataGrafikMingguan; ?>;

    // Grafik Bulanan
    const optionsBulanan = {
        series: [{
            name: 'Pemasukan',
            data: dataBulanan.map(d => d.pemasukan)
        }, {
            name: 'Pengeluaran',
            data: dataBulanan.map(d => d.pengeluaran)
        }],
        chart: {
            type: 'area',
            height: 350,
            toolbar: { show: false }
        },
        colors: ['#28a745', '#dc3545'],
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 2 },
        xaxis: {
            categories: dataBulanan.map(d => d.bulan)
        },
        yaxis: {
            labels: {
                formatter: function(val) {
                    return 'Rp ' + val.toLocaleString('id-ID');
                }
            }
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return 'Rp ' + val.toLocaleString('id-ID');
                }
            }
        },
        legend: {
            position: 'top',
            horizontalAlign: 'right'
        }
    };

    const chartBulanan = new ApexCharts(document.querySelector("#chart-bulanan"), optionsBulanan);
    chartBulanan.render();

    // Grafik Mingguan
    const optionsMingguan = {
        series: [{
            name: 'Pemasukan',
            data: dataMingguan.map(d => d.pemasukan)
        }, {
            name: 'Pengeluaran',
            data: dataMingguan.map(d => d.pengeluaran)
        }],
        chart: {
            type: 'bar',
            height: 350,
            toolbar: { show: false }
        },
        colors: ['#28a745', '#dc3545'],
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: { enabled: false },
        stroke: { show: true, width: 2, colors: ['transparent'] },
        xaxis: {
            categories: dataMingguan.map(d => d.minggu)
        },
        yaxis: {
            labels: {
                formatter: function(val) {
                    return 'Rp ' + val.toLocaleString('id-ID');
                }
            }
        },
        fill: { opacity: 1 },
        tooltip: {
            y: {
                formatter: function(val) {
                    return 'Rp ' + val.toLocaleString('id-ID');
                }
            }
        }
    };

    const chartMingguan = new ApexCharts(document.querySelector("#chart-mingguan"), optionsMingguan);
    chartMingguan.render();
});
</script>

<?= $this->endsection(); ?>