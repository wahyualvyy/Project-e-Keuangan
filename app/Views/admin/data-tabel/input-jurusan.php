<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Tambah Data Jurusan</h5>
        <hr>
        <div class="row">
            <form action="">
                @crsf_fie
                <div class="col-lg-6">
                    <label for="defaultFormControlInput" class="form-label">Nama Jurusan</label>
                    <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Multimedia"
                        aria-describedby="defaultFormControlHelp" />
                </div>
                <div class="col-lg-6">
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Kode Jurusan</label>
                        <select class="form-select" id="defaultFormControlInput" aria-label="Default select example"
                            disabled>
                            <option selected>--- Random Kode ---</option>
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
            </form>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>