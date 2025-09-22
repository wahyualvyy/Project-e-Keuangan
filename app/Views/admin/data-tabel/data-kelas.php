<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <form action="<?= base_url('kelas/bulk-action') ?>" method="post">
                <?php csrf_field(); ?>
                <div class="d-md-flex align-items-center">
                    <div>
                        <h4 class="card-title">Tabel Data Kelas</h4>
                        <a href="<?= base_url('kelas/input'); ?>">
                            <button type="button" class="btn btn-secondary card-subtitle m-1 text-white">Tambah
                                Data</button>
                        </a>
                    </div>
                    <div class="ms-auto mt-3 mt-md-0 d-flex">
                        <select class="form-select theme-select border-0" name="aksi_massal" required
                            aria-label="Default select example" id="aksi-massal-select">
                            <option value="" disabled selected>-- Pilih Aksi --</option>
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
                            onchange="window.location.href='<?= base_url('kelas') ?>?sort=' + this.value"
                            aria-label="Default select example">
                            <option value="terbaru" <?= ($sort === 'terbaru') ? 'selected' : ''; ?>>Terbaru Dibuat
                            </option>
                            <option value="terlama" <?= ($sort === 'terlama') ? 'selected' : ''; ?>>Terlama Dibuat
                            </option>
                            <option value="nama_asc" <?= ($sort === 'nama_asc') ? 'selected' : ''; ?>>Nama Kelas
                                (A-Z)
                            </option>
                            <option value="nama_desc" <?= ($sort === 'nama_desc') ? 'selected' : ''; ?>>Nama Kelas
                                (Z-A)
                            <option value="wali_asc" <?= ($sort === 'wali_asc') ? 'selected' : ''; ?>>Nama Wali
                                (A-Z)
                            </option>
                            <option value="wali_desc" <?= ($sort === 'wali_desc') ? 'selected' : ''; ?>>Nama Wali
                                (Z-A)
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
                                    Kelas
                                </th>
                                <th scope="col" class="px-0 text-muted">
                                    Wali Kelas
                                </th>
                                <th scope="col" class="px-0 text-muted">
                                    Keterangan
                                </th>
                                <th scope="col" class="px-0 text-muted text-center">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($kelas as $data): ?>
                                <tr>
                                    <td>
                                        <input class="form-check-input row-checkbox" type="checkbox" name="kelas_ids[]"
                                            value="<?= $data['id_kelas']; ?>">
                                    </td>
                                    <td class="px-0"><?= $no++; ?></td>
                                    <td class="px-0">
                                        <div class="d-flex align-items-center">
                                            <img src="<?= base_url('assets/img/photo-profile.jpg'); ?>"
                                                class="rounded-circle" width="40" alt="flexy" />
                                            <div class="ms-3">
                                                <h6 class="mb-0 fw-bolder">
                                                    <?= $data['nama_kelas'] . ' ' . substr($data['kode_jurusan'], 0, 3); ?>
                                                </h6>
                                                <span class="text-muted"><?= $data['nama_jurusan']; ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-0"><?= $data['nama_guru']; ?></td>
                                    <td class="px-0"><?= $data['keterangan']; ?></td>
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
                                                        href="<?= base_url('kelas/edit/' . $data['id_kelas']); ?>">
                                                        <i class="ti ti-edit fs-6 mb-0"></i>
                                                        <span class="mb-0 fs-3">Edit</span></a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item btn-delete-single"
                                                        href="<?= base_url('kelas/delete/' . $data['id_kelas']); ?>">
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