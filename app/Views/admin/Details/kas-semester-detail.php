<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="d-md-flex align-items-center">
                <div>
                    <h4 class="card-title">Data Pembayaran Uang Semester</h4>
                </div>
                <div class="ms-auto mt-3 mt-md-0">

                </div>
            </div>
            <div class="table-responsive mt-4">
                <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                    <thead>
                        <tr>
                            <th scope="col" class="px-0 text-muted">
                                Nama Siswa
                            </th>
                            <th scope="col" class="px-0 text-muted">
                                Jumlah Uang Semester
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
                        <tr>
                            <td class="px-0">
                                <div class="d-flex align-items-center">
                                    <img src="<?= base_url('assets/img/photo-profile.jpg'); ?>" class="rounded-circle"
                                        width="40" alt="flexy" />
                                    <div class="ms-3">
                                        <h6 class="mb-0 fw-bolder">Sunil Joshi</h6>
                                    </div>
                                </div>
                            </td>
                            <td class="px-0">
                                Rp. <?= number_format($data['biaya_semester'], '0', ',', '.'); ?>
                            </td>
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
                                            <a class="dropdown-item" href="<?= base_url('kas-masuk/semester'); ?>">
                                                <i class="ti ti-arrow-back-up fs-6 mb-0"></i>
                                                <span class="mb-0 fs-3">Kembali</span></a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item btn-delete-single" href="<?= base_url('kas-masuk/semester-delete/' . $data['id_pembayaran_semester']) ?>">
                                                <i class="ti ti-trash fs-6 mb-0"></i>
                                                <span class="mb-0 fs-3">Hapus</span></a></a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>