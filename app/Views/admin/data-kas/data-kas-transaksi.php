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

                    <select class="form-select" name="jenis" id="filterJenis" style="width: auto;">
                        <option value="">Semua Jenis</option>
                        <option value="pemasukan" <?= (isset($jenis) && $jenis === 'pemasukan') ? 'selected' : ''; ?>>Pemasukan</option>
                        <option value="pengeluaran" <?= (isset($jenis) && $jenis === 'pengeluaran') ? 'selected' : ''; ?>>Pengeluaran</option>
                    </select>

                    <a href="<?= base_url('data-kas/laporan/transaksi/export?format=excel' . (isset($bulan) ? '&bulan=' . $bulan : '') . (isset($tahun) ? '&tahun=' . $tahun : '') . (isset($jenis) ? '&jenis=' . $jenis : '')); ?>" 
                       class="btn btn-success">
                        <i class="ti ti-file-export"></i> Export Excel
                    </a>
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

            <!-- Search Box -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text"><i class="ti ti-search"></i></span>
                        <input type="text" class="form-control" id="searchInput" placeholder="Cari transaksi...">
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <span class="text-muted">Menampilkan <span id="rowCount">0</span> data</span>
                </div>
            </div>

            <div class="table-responsive mt-4">
                <table class="table mb-0 text-nowrap align-middle" id="transaksiTable">
                    <thead>
                        <tr>
                            <th scope="col" class="sortable" data-column="0">
                                No <i class="ti ti-chevron-up-down"></i>
                            </th>
                            <th scope="col" class="sortable" data-column="1">
                                Tanggal <i class="ti ti-chevron-up-down"></i>
                            </th>
                            <th scope="col" class="sortable" data-column="2">
                                Kategori <i class="ti ti-chevron-up-down"></i>
                            </th>
                            <th scope="col" class="sortable" data-column="3">
                                Jenis <i class="ti ti-chevron-up-down"></i>
                            </th>
                            <th scope="col" class="sortable" data-column="4">
                                Nama <i class="ti ti-chevron-up-down"></i>
                            </th>
                            <th scope="col" class="sortable" data-column="5">
                                Nominal <i class="ti ti-chevron-up-down"></i>
                            </th>
                            <th scope="col" class="sortable" data-column="6">
                                Keterangan <i class="ti ti-chevron-up-down"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($transaksi)): ?>
                            <tr class="no-data">
                                <td colspan="7" class="text-center py-4">
                                    <p class="text-muted mb-0">Tidak ada data transaksi</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1;
                            foreach ($transaksi as $data): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td data-date="<?= $data['tanggal']; ?>">
                                        <?= date('d/m/Y', strtotime($data['tanggal'])); ?>
                                    </td>
                                    <td>
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
                                    <td>
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
                                    <td>
                                        <?php
                                        if ($data['kategori'] == 'GAJI') {
                                            echo $data['nama_guru'] ?? '-';
                                            echo '<br><small class="text-muted">' . ($data['nip'] ?? '') . '</small>';
                                        } else {
                                            echo $data['nama_siswa'] ?? '-';
                                            echo '<br><small class="text-muted">' . ($data['nis'] ?? '') . '</small>';
                                        }
                                        ?>
                                    </td>
                                    <td data-nominal="<?= $data['nominal']; ?>">
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
                                    <td>
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
                            <td colspan="5" class="text-end fw-bold">TOTAL:</td>
                            <td>
                                <span class="fw-bold <?= ($saldo >= 0) ? 'text-success' : 'text-danger'; ?>">
                                    Rp. <?= number_format($saldo ?? 0, 0, ',', '.'); ?>
                                </span>
                            </td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.sortable {
    cursor: pointer;
    user-select: none;
    position: relative;
    transition: background-color 0.2s;
}

.sortable:hover {
    background-color: rgba(0, 0, 0, 0.05);
}

.sortable i {
    font-size: 14px;
    opacity: 0.5;
    transition: opacity 0.2s;
}

.sortable:hover i {
    opacity: 1;
}

.sortable.asc i::before {
    content: "\eb79" !important; /* ti-chevron-up */
}

.sortable.desc i::before {
    content: "\eb7a" !important; /* ti-chevron-down */
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const table = document.getElementById('transaksiTable');
    const tbody = table.querySelector('tbody');
    const searchInput = document.getElementById('searchInput');
    const rowCount = document.getElementById('rowCount');
    
    let sortColumn = -1;
    let sortDirection = 'asc';

    // Update row count
    function updateRowCount() {
        const visibleRows = tbody.querySelectorAll('tr:not(.no-data):not([style*="display: none"])').length;
        rowCount.textContent = visibleRows;
    }

    // Initial count
    updateRowCount();

    // Filter functionality
    function filterData() {
        const bulan = document.getElementById('filterBulan').value;
        const tahun = document.getElementById('filterTahun').value;
        const jenis = document.getElementById('filterJenis').value;

        let url = '<?= base_url('data-kas/laporan/transaksi') ?>?';
        let params = [];

        if (bulan) params.push('bulan=' + bulan);
        if (tahun) params.push('tahun=' + tahun);
        if (jenis) params.push('jenis=' + jenis);

        window.location.href = url + params.join('&');
    }

    // Attach filter event listeners
    document.getElementById('filterBulan').addEventListener('change', filterData);
    document.getElementById('filterTahun').addEventListener('change', filterData);
    document.getElementById('filterJenis').addEventListener('change', filterData);

    // Search functionality
    searchInput.addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = tbody.querySelectorAll('tr:not(.no-data)');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        updateRowCount();
    });

    // Sorting functionality
    const sortableHeaders = document.querySelectorAll('.sortable');
    
    sortableHeaders.forEach(header => {
        header.addEventListener('click', function() {
            const column = parseInt(this.dataset.column);
            
            // Remove sort classes from all headers
            sortableHeaders.forEach(h => {
                h.classList.remove('asc', 'desc');
            });
            
            // Determine sort direction
            if (sortColumn === column) {
                sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                sortDirection = 'asc';
            }
            
            sortColumn = column;
            this.classList.add(sortDirection);
            
            sortTable(column, sortDirection);
        });
    });

    function sortTable(column, direction) {
        const rows = Array.from(tbody.querySelectorAll('tr:not(.no-data)'));
        
        rows.sort((a, b) => {
            let aValue = a.cells[column].textContent.trim();
            let bValue = b.cells[column].textContent.trim();
            
            // Special handling for different columns
            if (column === 1) { // Tanggal
                aValue = a.cells[column].dataset.date;
                bValue = b.cells[column].dataset.date;
            } else if (column === 5) { // Nominal
                aValue = parseFloat(a.cells[column].dataset.nominal) || 0;
                bValue = parseFloat(b.cells[column].dataset.nominal) || 0;
            } else if (column === 0) { // No
                aValue = parseInt(aValue) || 0;
                bValue = parseInt(bValue) || 0;
            }
            
            // Compare values
            if (typeof aValue === 'number' && typeof bValue === 'number') {
                return direction === 'asc' ? aValue - bValue : bValue - aValue;
            } else {
                if (direction === 'asc') {
                    return aValue > bValue ? 1 : -1;
                } else {
                    return aValue < bValue ? 1 : -1;
                }
            }
        });
        
        // Re-append sorted rows
        rows.forEach((row, index) => {
            row.cells[0].textContent = index + 1; // Update row number
            tbody.appendChild(row);
        });
    }
});
</script>

<?= $this->endSection(); ?>