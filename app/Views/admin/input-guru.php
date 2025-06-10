<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Tambah Data Guru</h5>
        <hr>
        <div class="row">
            <div class="col-lg-6">
                <div>
                    <label for="defaultFormControlInput" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Muhammad Alex"
                        aria-describedby="defaultFormControlHelp" />
                </div>
                <div class="mt-3">
                    <label for="defaultFormControlInput" class="form-label">Jenis Kelamin</label>
                    <select class="form-select" id="defaultFormControlInput" aria-label="Default select example">
                        <option selected>---Pilih Jenis Kelamin---</option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label for="defaultFormControlInput" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Alamat"
                        aria-describedby="defaultFormControlHelp" />
                </div>
            </div>
            <div class="col-lg-6">
                <div>
                    <label for="defaultFormControlInput" class="form-label">NIP/NIK</label>
                    <input type="text" class="form-control" id="defaultFormControlInput" placeholder="NIP/NIK"
                        aria-describedby="defaultFormControlHelp" />
                </div>
                <div class="mt-3">
                    <label for="defaultFormControlInput" class="form-label">Bidang Studi</label>
                    <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Bidang Studi"
                        aria-describedby="defaultFormControlHelp" />
                </div>
                <div class="mt-3">
                    <label for="defaultFormControlInput" class="form-label">Telepon</label>
                    <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Telepon"
                        aria-describedby="defaultFormControlHelp" />
                </div>
            </div>
            <div class="col-lg-12">
                <div class="mt-3">
                    <label for="defaultFormControlInput" class="form-label">Status</label>
                    <select class="form-select" id="defaultFormControlInput" aria-label="Default select example">
                        <option selected>---Pilih Status---</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Cuti">Cuti</option>
                        <option value="Berhenti">Berhenti</option>
                    </select>
                </div>
                <div class="mt-3 d-flex justify-content-center">
                    <a href="<?= base_url('admin/data-guru'); ?>">
                        <button type="button" class="btn btn-secondary card-subtitle m-1 text-white">Tambah
                            Data Guru</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>