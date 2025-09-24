<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <form action="<?= base_url('jurusan/bulk-action') ?>" method="post">
                <?= csrf_field(); ?>
                <div class="d-md-flex align-items-center">
                    <div>
                        <h4 class="card-title">Tabel Data Jurusan</h4>
                        <a href="<?= base_url('jurusan/input'); ?>">
                            <button type="button" class="btn btn-secondary card-subtitle m-1 text-white">Tambah
                                Data</button>
                        </a>
                    </div>
                    <div class="ms-auto mt-3 mt-md-0 d-flex">
                        <select class="form-select theme-select border-0" name="aksi_massal" required
                            aria-label="Default select example">
                            <option value="">-- Pilih Aksi --</option>
                            <option value="hapus">Hapus yang Dipilih</option>
                        </select>
                        <button type="submit" class="btn btn-primary ms-2 btn-bulk-delete">
                            <i class="ti ti-menu-4 fs-6 mb-0"></i>
                        </button>
                    </div>
                    <div class="ms-auto mt-3 mt-md-0">
                        <select class="form-select theme-select border-0" name="sort"
                            onchange="window.location.href='<?= base_url('jurusan') ?>?sort=' + this.value"
                            aria-label="Default select example">
                            <option value="terbaru" <?= ($sort === 'terbaru') ? 'selected' : ''; ?>>Terbaru Dibuat
                            </option>
                            <option value="terlama" <?= ($sort === 'terlama') ? 'selected' : ''; ?>>Terlama Dibuat
                            </option>
                            <option value="nama_asc" <?= ($sort === 'nama_asc') ? 'selected' : ''; ?>>Nama Jurusan
                                (A-Z)
                            </option>
                            <option value="nama_desc" <?= ($sort === 'nama_desc') ? 'selected' : ''; ?>>Nama Jurusan
                                (Z-A)
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
                            foreach ($jurusanData as $data): ?>
                                <tr>
                                    <td>
                                        <input class="form-check-input row-checkbox" type="checkbox" name="jurusan_ids[]"
                                            value="<?= $data['id_jurusan']; ?>">
                                    </td>
                                    <td class="px-0"><?= $no++; ?></td>
                                    <td class="px-0">
                                        <div class="d-flex align-items-center">
                                            <div class="ms-3">
                                                <h6 class="mb-0 fw-bolder"><?= $data['nama_jurusan']; ?></h6>
                                                <span class="text-muted"><?= $data['kode_jurusan']; ?></span>
                                            </div>
                                        </div>
                                    </td>
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
                                                        href="<?= base_url('jurusan/edit/' . $data['id_jurusan']); ?>">
                                                        <i class="ti ti-edit fs-6 mb-0"></i>
                                                        <span class="mb-0 fs-3">Edit</span></a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item btn-delete-single"
                                                        href="<?= base_url('jurusan/delete/' . $data['id_jurusan']); ?>">
                                                        <i class="ti ti-eraser-off fs-6 mb-0"></i>
                                                        <span class="mb-0 fs-3">Delete</span></a>
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