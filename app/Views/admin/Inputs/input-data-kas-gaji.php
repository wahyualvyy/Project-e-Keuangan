<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Tambah Data Kas Gaji</h5>
        <hr>
        <div class="row">
            <div class="col-lg-6">
                <div>
                    <label for="defaultFormControlInput" class="form-label">Nama Guru</label>
                    <select class="form-select" id="defaultFormControlInput" aria-label="Default select example">
                        <option selected>---Pilih Guru---</option>
                        <option value="Pak Bambang">Pak Bambang</option>
                        <option value="Pak Budi">Pak Budi</option>
                        <option value="Bu Melly">Bu Melly</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label for="defaultFormControlInput" class="form-label">Jurusan</label>
                    <select class="form-select" id="defaultFormControlInput" aria-label="Default select example">
                        <option selected>---Pilih Jurusan---</option>
                        <option value="Multimedia">Multimedia</option>
                        <option value="Teknis Bisnis Sepeda Motor">Teknis Bisnis Sepeda Motor</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div>
                    <label for="defaultFormControlInput" class="form-label">Uang Gaji Perjam</label>
                    <input type="number" class="form-control" id="defaultFormControlInput" placeholder="Rp.200.000"
                        aria-describedby="defaultFormControlHelp" />
                </div>
                <div class="mt-3">
                    <label for="defaultFormControlInput" class="form-label">Jumlah Jam Mengajar 1    Minggu</label>
                    <input type="number" class="form-control" id="defaultFormControlInput" placeholder="2 Jam"
                        aria-describedby="defaultFormControlHelp" />
                </div>
            </div>
            <div class="col-lg-12">
                <div class="mt-3 d-flex justify-content-center">
                    <a href="<?= base_url('admin/data-kas-gaji'); ?>">
                        <button type="button" class="btn btn-secondary card-subtitle m-1 text-white">Tambah
                            Data Kas Gaji</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>