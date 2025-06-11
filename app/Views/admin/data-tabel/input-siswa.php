<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Tambah Data Siswa</h5>
        <hr>
        <div class="row">
            <div class="col-lg-6">
                <div>
                    <label for="defaultFormControlInput" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Muhammad Alex"
                        aria-describedby="defaultFormControlHelp" />
                </div>
                <div class="mt-3">
                    <label for="defaultFormControlInput" class="form-label">NISN</label>
                    <input type="text" class="form-control" id="defaultFormControlInput" placeholder="NISN"
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
                    <label for="defaultFormControlInput" class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Tempat Lahir"
                        aria-describedby="defaultFormControlHelp" />
                </div>
                <div class="mt-3">
                    <label for="defaultFormControlInput" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Alamat"
                        aria-describedby="defaultFormControlHelp" />
                </div>
                <div class="mt-3">
                    <label for="defaultFormControlInput" class="form-label">Kelas</label>
                    <select class="form-select" id="defaultFormControlInput" aria-label="Default select example">
                        <option selected>---Pilih Kelas---</option>
                        <option value="10 MM">10 MM</option>
                        <option value="11 TBSM">11 TBSM</option>
                        <option value="12 TBSM">12 TBSM</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div>
                    <label for="defaultFormControlInput" class="form-label">NIS</label>
                    <input type="text" class="form-control" id="defaultFormControlInput" placeholder="NIS"
                        aria-describedby="defaultFormControlHelp" />
                </div>
                <div class="mt-3">
                    <label for="defaultFormControlInput" class="form-label">Jurusan</label>
                    <select class="form-select" id="defaultFormControlInput" aria-label="Default select example">
                        <option selected>---Pilih Jurusan---</option>
                        <option value="Multimedia">Multimedia</option>
                        <option value="Teknis Bisnis Sepeda Motor">Teknis Bisnis Sepeda Motor</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label for="defaultFormControlInput" class="form-label">Nama Wali</label>
                    <select class="form-select" id="defaultFormControlInput" aria-label="Default select example">
                        <option selected>---Pilih Wali---</option>
                        <option value="Pak Bambang">Pak Bambang</option>
                        <option value="Pak Budi">Pak Budi</option>
                        <option value="Bu Melly">Bu Melly</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label for="defaultFormControlInput" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="defaultFormControlInput"
                        aria-describedby="defaultFormControlHelp" />
                </div>
                <div class="mt-3">
                    <label for="defaultFormControlInput" class="form-label">Telepon</label>
                    <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Telepon"
                        aria-describedby="defaultFormControlHelp" />
                </div>
                <div class="mt-3">
                    <label for="defaultFormControlInput" class="form-label">Status</label>
                    <select class="form-select" id="defaultFormControlInput" aria-label="Default select example">
                        <option selected>---Pilih Status---</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Cuti">Cuti</option>
                        <option value="Berhenti">Berhenti</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="mt-3 d-flex justify-content-center">
                    <a href="<?= base_url('admin/data-siswa'); ?>">
                        <button type="button" class="btn btn-secondary card-subtitle m-1 text-white">Tambah
                            Data Siswa</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>