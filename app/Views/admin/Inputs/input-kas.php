<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <form id="form-edit" action="<?= base_url('data-kas/create-kas') ?>" method="post">
            <?php csrf_field(); ?>
            <h5 class="card-title fw-semibold mb-4">Tambah Data Kas Pemasukan</h5>
            <hr>
            <div class="row">
                <div class="col-lg-6">
                    <div>
                        <label for="kategori" class="form-label">Kategori Kas</label>
                        <select name="kategori" id="kategori" class="form-select">
                            <option value="">Pilih Kategori</option>
                            <option value="pemasukan">Pemasukan</option>
                            <option value="pengeluaran">Pengeluaran</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div>
                        <label for="jumlah" class="form-label">Jumlah Uang Masuk</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Rp.200.000"
                            aria-describedby="defaultFormControlHelp" />
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mt-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <div class="form-floating ">
                            <textarea class="form-control h-25" name="keterangan" placeholder="Leave a comment here"
                                id="keterangan"></textarea>
                            <label for="keterangan">Keterangan</label>
                        </div>
                    </div>
                    <div class="mt-3 d-flex justify-content-center">
                        <button id="btn-update" type="submit"
                            class="btn btn-secondary card-subtitle m-1 text-white">Tambah
                            Data Kas</button>
                    </div>
                </div>
            </div>
    </div>
    </form>
</div>
</div>
<?= $this->endsection(); ?>