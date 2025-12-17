<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="d-md-flex align-items-center">
                <div>
                    <h4 class="card-title">Laporan Transaksi (Buku Kas)</h4>
                    <p class="card-subtitle mb-0">History Pemasukan dan Pengeluaran</p>
                </div>
                <div class="ms-auto mt-3 mt-md-0 d-flex gap-2">
                    <select class="form-select" name="bulan" id="filterBulan" style="width: auto;">
                        <option value="">Semua Bulan</option>
                        <option value="1" <?= (isset($bulan) && $bulan == 1) ? 'selected' : ''; ?>>Januari</option>
                        <option value="2" <?= (isset($bulan) && $bulan == 2) ? 'selected' : ''; ?>>Februari</option>
                        <option value="3" <?= (isset($bulan) && $bulan == 3) ? 'selected' : ''; ?>>Maret</option>
                        <option value="4" <?= (isset($bulan) && $bulan == 4) ? 'selected' : ''; ?>>April</option>
                        <option value="5" <?= (isset($bulan) && $bulan == 5) ? 'selected' : ''; ?>>Mei</option>
                        <option value="6" <?= (isset($bulan) && $bulan == 6) ? 'selected' : ''; ?>>Juni</option>
                        <option value="7" <?= (isset($bulan) && $bulan == 7) ? 'selected' : ''; ?>>Juli</option>
                        <option value="8" <?= (isset($bulan) && $bulan == 8) ? 'selected' : ''; ?>>Agustus</option>
                        <option value="9" <?= (isset($bulan) && $bulan == 9) ? 'selected' : ''; ?>>September</option>
                        <option value="10" <?= (isset($bulan) && $bulan == 10) ? 'selected' : ''; ?>>Oktober</option>
                        <option value="11" <?= (isset($bulan) && $bulan == 11) ? 'selected' : ''; ?>>November</option>
                        <option value="12" <?= (isset($bulan) && $bulan == 12) ? 'selected' : ''; ?>>Desember</option>
                    </select>

                    <select class="form-select" name="tahun" id="filterTahun" style="width: auto;">
                        <option value="">Semua Tahun</option>
                        <?php
                        $currentYear = date('Y');
                        for ($y = $currentYear; $y >= ($currentYear - 5); $y--):
                        ?>
                            <option value="<?= $y; ?>" <?= (isset($tahun) && $tahun == $y) ? 'selected' : ''; ?>>
                                <?= $y; ?>
                            </option>
                        <?php endfor; ?>
                    </select>

                    <select class="form-select theme-select border-0" name="jenis" id="filterJenis" style="width: auto;">
                        <option value="">Semua Jenis</option>
                        <option value="pemasukan" <?= (isset($jenis) && $jenis === 'pemasukan') ? 'selected' : ''; ?>>Pemasukan</option>
                        <option value="pengeluaran" <?= (isset($jenis) && $jenis === 'pengeluaran') ? 'selected' : ''; ?>>Pengeluaran</option>
                    </select>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card bg-success-subtle">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="bg-success rounded-circle p-3">
                                    <i class="ti ti-trending-up text-white fs-6"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-0 text-muted">Total Pemasukan</h6>
                                    <h4 class="mb-0 fw-bold text-success">
                                        Rp. <?= number_format($total_pemasukan ?? 0, 0, ',', '.'); ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-danger-subtle">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="bg-danger rounded-circle p-3">
                                    <i class="ti ti-trending-down text-white fs-6"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-0 text-muted">Total Pengeluaran</h6>
                                    <h4 class="mb-0 fw-bold text-danger">
                                        Rp. <?= number_format($total_pengeluaran ?? 0, 0, ',', '.'); ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-primary-subtle">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary rounded-circle p-3">
                                    <i class="ti ti-wallet text-white fs-6"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-0 text-muted">Saldo</h6>
                                    <h4 class="mb-0 fw-bold text-primary">
                                        Rp. <?= number_format($saldo ?? 0, 0, ',', '.'); ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive mt-4">
                <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                    <thead>
                        <tr>
                            <th scope="col" class="px-0 text-muted">No</th>
                            <th scope="col" class="px-0 text-muted">Tanggal</th>
                            <th scope="col" class="px-0 text-muted">Kategori</th>
                            <th scope="col" class="px-0 text-muted">Jenis</th>
                            <th scope="col" class="px-0 text-muted">Nama</th>
                            <th scope="col" class="px-0 text-muted">Nominal</th>
                            <th scope="col" class="px-0 text-muted">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($transaksi)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <p class="text-muted mb-0">Tidak ada data transaksi</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1;
                            foreach ($transaksi as $data): ?>
                                <tr>
                                    <td class="px-0"><?= $no++; ?></td>
                                    <td class="px-0">
                                        <?= date('d/m/Y', strtotime($data['tanggal'])); ?>
                                    </td>
                                    <td class="px-0">
                                        <?php
                                        $badgeClass = 'bg-secondary';
                                        switch ($data['kategori']) {
                                            case 'SPP':
                                                $badgeClass = 'bg-info';
                                                break;
                                            case 'SEMESTER':
                                                $badgeClass = 'bg-warning';
                                                break;
                                            case 'GAJI':
                                                $badgeClass = 'bg-primary';
                                                break;
                                            default:
                                                $badgeClass = 'bg-secondary';
                                        }
                                        ?>
                                        <span class="badge <?= $badgeClass; ?>"><?= $data['kategori']; ?></span>
                                    </td>
                                    <td class="px-0">
                                        <?php if ($data['jenis_transaksi'] === 'pemasukan'): ?>
                                            <span class="badge bg-success">
                                                <i class="ti ti-arrow-up"></i> Pemasukan
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">
                                                <i class="ti ti-arrow-down"></i> Pengeluaran
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-0">
                                        <?php
                                        // Tampilkan nama berdasarkan kategori
                                        if ($data['kategori'] == 'GAJI') {
                                            echo $data['nama_guru'] ?? '-';
                                            echo '<br><small class="text-muted">' . ($data['nip'] ?? '') . '</small>';
                                        } else {
                                            echo $data['nama_siswa'] ?? '-';
                                            echo '<br><small class="text-muted">' . ($data['nis'] ?? '') . '</small>';
                                        }
                                        ?>
                                    </td>
                                    <td class="px-0">
                                        <?php if ($data['jenis_transaksi'] === 'pemasukan'): ?>
                                            <span class="text-success fw-bold">
                                                + Rp. <?= number_format($data['nominal'], 0, ',', '.'); ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="text-danger fw-bold">
                                                - Rp. <?= number_format($data['nominal'], 0, ',', '.'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-0">
                                        <small class="text-muted">
                                            <?= $data['keterangan'] ?? '-'; ?>
                                        </small>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr class="border-top border-2">
                            <td colspan="5" class="text-end fw-bold px-0">TOTAL:</td>
                            <td class="px-0">
                                <span class="fw-bold <?= ($saldo >= 0) ? 'text-success' : 'text-danger'; ?>">
                                    Rp. <?= number_format($saldo ?? 0, 0, ',', '.'); ?>
                                </span>
                            </td>
                            <td class="px-0"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function filterData() {
        const bulan = document.getElementById('filterBulan').value;
        const tahun = document.getElementById('filterTahun').value;
        const jenis = document.getElementById('filterJenis').value;

        let url = '<?= base_url('laporan/transaksi') ?>?';
        let params = [];

        if (bulan) params.push('bulan=' + bulan);
        if (tahun) params.push('tahun=' + tahun);
        if (jenis) params.push('jenis=' + jenis);

        window.location.href = url + params.join('&');
    }

    // Attach event listeners
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('filterBulan').addEventListener('change', filterData);
        document.getElementById('filterTahun').addEventListener('change', filterData);
        document.getElementById('filterJenis').addEventListener('change', filterData);
    });
</script>

<?= $this->endSection(); ?>