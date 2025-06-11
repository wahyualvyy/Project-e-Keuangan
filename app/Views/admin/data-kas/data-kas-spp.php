<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="d-md-flex align-items-center">
                <div>
                    <h4 class="card-title">Tabel Data Kas SPP</h4>
                    <a href="<?= base_url('admin/input-data-kas-spp'); ?>">
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
                                Jumlah SPP
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
                            <td class="px-0">1</td>
                            <td class="px-0">
                                <div class="d-flex align-items-center">
                                    <img src="<?= base_url('assets/img/photo-profile.jpg'); ?>" class="rounded-circle"
                                        width="40" alt="flexy" />
                                    <div class="ms-3">
                                        <h6 class="mb-0 fw-bolder">Sunil Joshi</h6>
                                    </div>
                                </div>
                            </td>
                            <td class="px-0">Elite Admin</td>
                            </td>
                            <td class="px-0">
                                <span class="badge bg-success">Aktif</span>
                            </td>
                            <td class="px-0 text-dark fw-medium text-center">
                                <div class="dropdown">
                                    <a href="javascript:void(0)" class="text-muted" id="year1-dropdown"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ti ti-dots fs-7"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="year1-dropdown">
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0)">
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>