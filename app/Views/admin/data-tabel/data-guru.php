<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <form action="<?= base_url('guru/bulk-action') ?>" method="post">
                <?= csrf_field(); ?>
                <div class="d-md-flex align-items-center">
                    <div>
                        <h4 class="card-title">Tabel Data Guru</h4>
                        <a href="<?= base_url('guru/input'); ?>">
                            <button type="button" class="btn btn-secondary card-subtitle m-1 text-white">Tambah
                                Data</button>
                        </a>
                    </div>
                    <div class="ms-auto mt-3 mt-md-0 d-flex">
                        <select class="form-select theme-select border-0" name="aksi_massal" required
                            aria-label="Default select example" id="aksi-massal-select">
                            <option value="" disabled selected>-- Pilih Aksi --</option>
                            <optgroup label="Ubah Status">
                                <option value="set_aktif">Jadikan Aktif</option>
                                <option value="set_tidak_aktif">Jadikan Tidak Aktif</option>
                                <option value="set_cuti">Jadikan Cuti</option>
                            </optgroup>
                            <optgroup label="Ekspor">
                                <option value="export_excel">Ekspor ke Excel</option>
                            </optgroup>
                            <optgroup label="Tindakan Berbahaya">
                                <option value="hapus">Hapus yang Dipilih</option>
                            </optgroup>
                        </select>
                        <button type="submit" class="btn btn-primary ms-2 btn-bulk-delete" id="btn-bulk-action">
                            <i class="ti ti-menu-4 fs-6 mb-0" id="bulk-action-icon"></i>
                        </button>
                    </div>
                    <div class="ms-auto mt-3 mt-md-0">
                        <select class="form-select theme-select border-0" name="sort"
                            onchange="window.location.href='<?= base_url('guru') ?>?sort=' + this.value"
                            aria-label="Default select example">
                            <option value="terbaru" <?= ($sort === 'terbaru') ? 'selected' : ''; ?>>Terbaru Dibuat
                            </option>
                            <option value="terlama" <?= ($sort === 'terlama') ? 'selected' : ''; ?>>Terlama Dibuat
                            </option>
                            <option value="nama_asc" <?= ($sort === 'nama_asc') ? 'selected' : ''; ?>>Nama Guru
                                (A-Z)
                            </option>
                            <option value="nama_desc" <?= ($sort === 'nama_desc') ? 'selected' : ''; ?>>Nama Guru
                                (Z-A)
                            </option>
                            <option value="status_aktif" <?= ($sort === 'status_aktif') ? 'selected' : ''; ?>>Aktif
                            </option>
                            <option value="status_tidak_aktif" <?= ($sort === 'status_tidak_aktif') ? 'selected' : ''; ?>>
                                Tidak Aktif
                            </option>
                            <option value="status_cuti" <?= ($sort === 'status_cuti') ? 'selected' : ''; ?>>Cuti
                            </option>
                        </select>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <input class="form-check-input" type="checkbox" id="select-all">
                                </th>
                                <th scope="col" class="px-0 text-muted">
                                    No
                                </th>
                                <th scope="col" class="px-0 text-muted">
                                    Nama
                                </th>
                                <th scope="col" class="px-0 text-muted">
                                    NIP/NIK
                                </th>
                                <th scope="col" class="px-0 text-muted">
                                    JK
                                </th>
                                <th scope="col" class="px-0 text-muted">
                                    Alamat
                                </th>
                                <th scope="col" class="px-0 text-muted">
                                    Telepon
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
                            <?php $no = 1;
                            foreach ($guru as $data): ?>
                                <tr>
                                    <td>
                                        <input class="form-check-input row-checkbox" type="checkbox" name="guru_ids[]"
                                            value="<?= $data['id_guru']; ?>">
                                    </td>
                                    <td class="px-0"><?= $no++; ?></td>
                                    <td class="px-0">
                                        <div class="d-flex align-items-center">
                                            <img src="<?= base_url('assets/img/photo-profile.jpg'); ?>"
                                                class="rounded-circle" width="40" alt="flexy" />
                                            <div class="ms-3">
                                                <h6 class="mb-0 fw-bolder"><?= $data['nama_guru']; ?></h6>
                                                <span class="text-muted"><?= $data['bidang_studi']; ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-0"><?= $data['nip']; ?></td>
                                    <td class="px-0"><?= $data['jenis_kelamin']; ?></td>
                                    <td class="px-0"><?= word_limiter($data['alamat'], 4); ?></td>
                                    <td class="px-0"><?= $data['no_telp']; ?></td>
                                    <td class="px-0">
                                        <?php
                                        if ($data['status'] === 'Aktif') {
                                            echo '<span class="badge bg-success">' . $data['status'] . '</span>';
                                        } elseif ($data['status'] === 'Cuti') {
                                            echo '<span class="badge bg-warning">' . $data['status'] . '</span>';
                                        } else {
                                            echo '<span class="badge bg-danger">' . $data['status'] . '</span>';
                                        }
                                        ?>
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
                                                        href="<?= base_url('guru/edit/' . $data['id_guru']); ?>">
                                                        <i class="ti ti-edit fs-6 mb-0"></i>
                                                        <span class="mb-0 fs-3">Edit</span></a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item btn-delete-single"
                                                        href="<?= base_url('guru/delete/' . $data['id_guru']); ?>">
                                                        <i class="ti ti-eraser-off fs-6 mb-0"></i>
                                                        <span class="mb-0 fs-3">Delete</span></a></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>