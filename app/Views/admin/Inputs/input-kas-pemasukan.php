<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Tambah Data Kas Pemasukan</h5>
        <hr>
        <div class="row">
            <div class="col-lg-6">
                <div>
                    <label for="defaultFormControlInput" class="form-label">Pemasukan</label>
                    <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Uang Masuk Pemerintah"
                        aria-describedby="defaultFormControlHelp" />
                </div>
            </div>
            <div class="col-lg-6">
                <div>
                    <label for="defaultFormControlInput" class="form-label">Jumlah Uang Masuk</label>
                    <input type="number" class="form-control" id="defaultFormControlInput" placeholder="Rp.200.000"
                        aria-describedby="defaultFormControlHelp" />
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
                    <a href="<?= base_url('admin/kas-pemasukan'); ?>">
                        <button type="button" class="btn btn-secondary card-subtitle m-1 text-white">Tambah
                            Data Kas Pemasukan</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>