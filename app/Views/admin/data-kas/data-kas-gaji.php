<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="d-md-flex align-items-center">
                <div>
                    <h4 class="card-title">Tabel Data Kas Gaji</h4>
                    <a href="<?= base_url('data-kas/input-gaji'); ?>">
                        <button type="button" class="btn btn-secondary card-subtitle m-1 text-white">Tambah
                            Data</button>
                    </a>
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
                                Nama Guru
                            </th>
                            <th scope="col" class="px-0 text-muted">
                                Jumlah Jam Mengajar
                            </th>
                            <th scope="col" class="px-0 text-muted">
                                Jumlah Gaji 1 Bulan
                            </th>
                            <th scope="col" class="px-0 text-muted text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($gaji as $data):
                            ?>
                            <tr>
                                <td class="px-0"><?= $i++; ?></td>
                                <td class="px-0">
                                    <div class="d-flex align-items-center">
                                        <img src="<?= base_url('assets/img/photo-profile.jpg'); ?>" class="rounded-circle"
                                            width="40" alt="flexy" />
                                        <div class="ms-3">
                                            <h6 class="mb-0 fw-bolder"><?= $data['nama_guru']; ?></h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-0"><?= $data['jumlah_jam']; ?> Jam</td>
                                <td class="px-0">Rp. <?= number_format($data['biaya_gaji'], 0, ',', '.'); ?></td>
                                </td>
                                <td class="px-0 text-dark fw-medium text-center">
                                    <div class="dropdown">
                                        <a href="javascript:void(0)" class="text-muted" id="year1-dropdown"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ti ti-dots fs-7"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="year1-dropdown">
                                            <li>
                                                <a class="dropdown-item" href="<?= base_url('data-kas/edit-gaji/' . $data['id_gaji']); ?>">
                                                    <i class="ti ti-edit fs-6 mb-0"></i>
                                                    <span class="mb-0 fs-3">Edit</span></a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item btn-delete-single" href="<?= base_url('data-kas/delete-gaji/' . $data['id_gaji']); ?>">
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