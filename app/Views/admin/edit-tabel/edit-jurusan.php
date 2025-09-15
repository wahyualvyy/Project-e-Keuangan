    <?= $this->extend('layout/template'); ?>
    <?= $this->section('content'); ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Tambah Data Jurusan</h5>
            <hr>
            <form id="form-edit" action="<?= base_url('/admin/update-jurusan' . '/'. $jurusan['id_jurusan']); ?>" method="post">
                <?= @csrf_field(); ?>
                <div class="row">
                    <div class="col-lg-6">
                        <div>
                            <label for="defaultFormControlInput" class="form-label">Nama Jurusan</label>
                            <input type="text" class="form-control" name="nama_jurusan" id="defaultFormControlInput" placeholder="Multimedia"
                                aria-describedby="defaultFormControlHelp" value="<?= $jurusan['nama_jurusan']; ?>"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <label for="defaultFormControlInput" class="form-label">Kode Jurusan</label>
                            <select class="form-select" id="defaultFormControlInput" aria-label="Default select example"
                                disabled>
                                <option selected value="<?= $jurusan['kode_jurusan'];?>"><?= $jurusan['kode_jurusan']; ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mt-3">
                            <label for="defaultFormControlInput" class="form-label">Keterangan</label>
                            <div class="form-floating ">
                                <textarea class="form-control h-25" name ="keterangan" placeholder="Leave a comment here"
                                    id="floatingTextarea"><?= $jurusan['keterangan']; ?></textarea>
                                <label for="floatingTextarea">Keterangan</label>
                            </div>
                        </div>
                        <div class="mt-3 d-flex justify-content-center">
                            <button type="submit" id ="btn-update"class="btn btn-secondary card-subtitle m-1 text-white" >Tambah
                                Data Kelas</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?= $this->endsection(); ?>