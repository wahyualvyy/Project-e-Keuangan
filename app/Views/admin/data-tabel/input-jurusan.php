<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Tambah Data Jurusan</h5>
        <hr>
        <form id="form-edit" action="<?= base_url('jurusan/create'); ?>" method="post">
            <?= csrf_field(); ?>

            <div class="row">
                <div class="col-lg-6">
                    <div>
                        <label for="nama_jurusan" class="form-label">Nama Jurusan</label>
                        <input type="text" class="form-control" name="nama_jurusan" id="nama_jurusan"
                            placeholder="Multimedia" aria-describedby="defaultFormControlHelp" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div>
                        <label for="kode_jurusan" class="form-label">Kode Jurusan</label>
                        <select class="form-select" id="kode_jurusan" aria-label="Default select example" disabled>
                            <option selected>--- Otomatis Generate Kode ---</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mt-3">
                        <label class="form-label">Keterangan</label>
                        <div class="form-floating">
                            <textarea class="form-control" style="height: 100px;" name="keterangan"
                                placeholder="Leave a comment here" id="keterangan"></textarea>
                            <label for="keterangan">Keterangan</label>
                        </div>
                    </div>
                    <div class="mt-3 d-flex justify-content-center">
                        <button id="btn-update" type="submit" class="btn btn-primary card-subtitle m-1 text-white">Simpan
                            Jurusan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endsection(); ?>