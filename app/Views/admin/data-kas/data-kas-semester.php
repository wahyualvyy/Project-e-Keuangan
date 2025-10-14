<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="d-md-flex align-items-center">
                <div>
                    <h4 class="card-title">Tabel Data Kas Semester</h4>
                    <a href="<?= base_url('data-kas/input-semester'); ?>">
                        <button type="button" class="btn btn-secondary card-subtitle m-1 text-white">Tambah
                            Data</button>
                    </a>
                </div>
                <div class="ms-auto mt-3 mt-md-0">
                    <select class="form-select theme-select border-0" aria-label="Default select example">
                        <option value="1">March 2025</option>
                        <option value="2">March 2025</option>
                        <option value="3">March 2025</option>
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
                                Tahun Ajaran
                            </th>
                            <th scope="col" class="px-0 text-muted">
                                Jurusan
                            </th>
                            <th scope="col" class="px-0 text-muted">
                                Jumlah Uang Ganjil/Genap
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
                        foreach ($semester as $data): ?>
                            <tr>
                                <td class="px-0"><?= $no++; ?></td>
                                <td class="px-0">
                                    <div class="d-flex align-items-center">
                                        <div class="ms-3">
                                            <h6 class="mb-0 fw-bolder"><?= $data['tahun_ajaran']; ?></h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-0"><?= $data['nama_jurusan']; ?></td>
                                <td class="px-0">Rp. <?= number_format($data['nominal'],'0',',','.'); ?></td>
                                </td>
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
                                                <a class="dropdown-item" href="<?= base_url('data-kas/edit-semester/' . $data['id_semester']);?>">
                                                    <i class="ti ti-edit fs-6 mb-0"></i>
                                                    <span class="mb-0 fs-3">Edit</span></a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)">
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
        </div>
    </div>
</div>
<?= $this->endSection(); ?>