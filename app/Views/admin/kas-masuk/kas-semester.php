<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="d-md-flex align-items-center">
                <div>
                    <h4 class="card-title">Data Pembayaran Uang Semester</h4>
                </div>
                <div class="ms-auto mt-3 mt-md-0 d-flex gap-2">
                    <select class="form-select" name="semester" id="filterSemester" style="width: auto;">
                        <option value="">Semua Semester</option>
                        <option value="1" <?= (isset($semester) && $semester == 1) ? 'selected' : ''; ?>>Semester 1
                        </option>
                        <option value="2" <?= (isset($semester) && $semester == 2) ? 'selected' : ''; ?>>Semester 2
                        </option>
                    </select>

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

                    <select class="form-select theme-select border-0" name="sort" id="filterSort" style="width: auto;">
                        <option value="semua" <?= ($sort === 'semua') ? 'selected' : ''; ?>>Semua</option>
                        <option value="lunas" <?= ($sort === 'lunas') ? 'selected' : ''; ?>>Lunas</option>
                        <option value="belum_lunas" <?= ($sort === 'belum_lunas') ? 'selected' : ''; ?>>Belum Lunas
                        </option>
                    </select>
                </div>
            </div>
            <div class="table-responsive mt-4">
                <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                    <thead>
                        <tr>
                            <th scope="col" class="px-0 text-muted">
                                No
                            </th>
                            <th scope="col" class="px-0 text-muted">
                                Nama Siswa
                            </th>
                            <th scope="col" class="px-0 text-muted">
                                Semester
                            </th>
                            <th scope="col" class="px-0 text-muted">
                                Tahun Ajaran
                            </th>
                            <th scope="col" class="px-0 text-muted">
                                Biaya Semester
                            </th>
                            <th scope="col" class="px-0 text-muted">
                                Status
                            </th>
                            <th scope="col" class="px-0 text-muted text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($pembayaran_semester as $data): ?>
                            <tr>
                                <td class="px-0"><?= $i++; ?></td>
                                <td class="px-0">
                                    <div class="d-flex align-items-center">
                                        <img src="<?= base_url('assets/img/photo-profile.jpg'); ?>" class="rounded-circle"
                                            width="40" alt="flexy" />
                                        <div class="ms-3">
                                            <h6 class="mb-0 fw-bolder"><?= $data['nama_siswa']; ?></h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-0">Semester <?= $data['nomor_semester']; ?></td>
                                <td class="px-0"><?= $data['tahun_ajaran']; ?></td>
                                <td class="px-0">Rp. <?= number_format($data['biaya_semester'], '0', ',', '.'); ?></td>
                                <td class="px-0">
                                    <?php if ($data['status_pembayaran'] === 'Lunas'): ?>
                                        <span class="badge bg-success">Lunas</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Belum Lunas</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-0 text-dark fw-medium text-center">
                                    <div class="dropdown">
                                        <a href="javascript:void(0)" class="text-muted" id="year1-dropdown"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ti ti-dots fs-7"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="year1-dropdown">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="<?= base_url('kas-masuk/semester/detail/' . $data['id_pembayaran_semester']); ?>">
                                                    <i class="ti ti-eye fs-6 mb-0"></i>
                                                    <span class="mb-0 fs-3">Detail</span></a>
                                            </li>
                                            <?php if ($data['status_pembayaran'] !== 'Lunas'): ?>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="<?= base_url('kas-masuk/semester/bayar/' . $data['id_pembayaran_semester']); ?>">
                                                        <i class="ti ti-cash-banknote fs-6 mb-0"></i>
                                                        <span class="mb-0 fs-3">Bayar</span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function filterData() {
        const semester = document.getElementById('filterSemester').value;
        const bulan = document.getElementById('filterBulan').value;
        const tahun = document.getElementById('filterTahun').value;
        const sort = document.getElementById('filterSort').value;

        let url = '<?= base_url('kas-masuk/semester') ?>?';
        let params = [];

        if (semester) params.push('semester=' + semester);
        if (sort) params.push('sort=' + sort);
        if (bulan) params.push('bulan=' + bulan);
        if (tahun) params.push('tahun=' + tahun);

        window.location.href = url + params.join('&');
    }

    // Attach event listeners
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('filterSemester').addEventListener('change', filterData);
        document.getElementById('filterBulan').addEventListener('change', filterData);
        document.getElementById('filterTahun').addEventListener('change', filterData);
        document.getElementById('filterSort').addEventListener('change', filterData);
    });
</script>
<?= $this->endSection(); ?>