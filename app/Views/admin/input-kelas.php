<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Tambah Data Kelas</h5>
        <hr>
        <div class="row">
            <div class="col-lg-6">
                <div>
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
                    <label for="defaultFormControlInput" class="form-label">Nama Wali</label>
                    <select class="form-select" id="defaultFormControlInput" aria-label="Default select example">
                        <option selected>---Pilih Wali---</option>
                        <option value="Pak Bambang">Pak Bambang</option>
                        <option value="Pak Budi">Pak Budi</option>
                        <option value="Bu Melly">Bu Melly</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="mt-3">
                    <label for="defaultFormControlInput" class="form-label">Keterangan</label>
                    <div class="form-floating ">
                        <textarea class="form-control h-25" placeholder="Leave a comment here"
                            id="floatingTextarea"></textarea>
                        <label for="floatingTextarea">Keterangan</label>
                    </div>
                </div>
                <div class="mt-3 d-flex justify-content-center">
                    <a href="<?= base_url('admin/data-kelas'); ?>">
                        <button type="button" class="btn btn-secondary card-subtitle m-1 text-white">Tambah
                            Data Kelas</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>