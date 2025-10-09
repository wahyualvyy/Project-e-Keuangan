<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Edit Data Kelas</h5>
        <hr>
        <form id="form-edit" action="<?= base_url('kelas/update/' . $kelas['id_kelas']) ?>" method="post">
            <?php csrf_field(); ?>
            <div class="row">
                <div class="col-lg-6">
                    <div>
                        <label for="nama_kelas" class="form-label">Tingkatan
                            Kelas</label>
                        <select class="form-select" name="nama_kelas" id="nama_kelas"
                            aria-label="Default select example">
                            <option disabled selected>---Pilih Kelas---</option>
                            <option value="10" <?= ($kelas['nama_kelas'] === 'X') ? 'selected' : '' ?>>X</option>
                            <option value="11" <?= ($kelas['nama_kelas'] === 'XI') ? 'selected' : '' ?>>XI</option>
                            <option value="12" <?= ($kelas['nama_kelas'] === 'XII') ? 'selected' : '' ?>>XII</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div>
                        <label for="id_jurusan" class="form-label">Nama Jurusan</label>
                        <select id="id_jurusan" name="id_jurusan" class="form-select select2-searchable"
                            id="defaultFormControlInput" aria-label="Default select example">
                            <option disabled selected>---Pilih Jurusan---</option>
                            <?php foreach ($jurusan as $row): ?>
                                <option value="<?= $row['id_jurusan'] ?>" <?= (isset($kelas['id_jurusan']) && $row['id_jurusan'] == $kelas['id_jurusan']) ? 'selected' : '' ?>>
                                    <?= $row['nama_jurusan'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mt-3">
                        <label for="id_guru" class="form-label">Nama Wali</label>
                        <select id="id_guru" name="id_guru" class="form-select select2-searchable"
                            id="defaultFormControlInput" aria-label="Default select example">
                            <option disabled selected>---Pilih Wali---</option>
                            <?php foreach ($guru as $row): ?>
                                <option value="<?= $row['id_guru'] ?>" <?= (isset($kelas['id_guru']) && $row['id_guru'] === $kelas['id_guru']) ? 'selected' : '' ?> ><?= $row['nama_guru'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <div class="form-floating ">
                            <textarea class="form-control h-25" name="keterangan" id="keterangan"
                                placeholder="Leave a comment here"><?= $kelas['keterangan']; ?></textarea>
                            <label for="floatingTextarea">Keterangan</label>
                        </div>
                    </div>
                    <div class="mt-3 d-flex justify-content-center">
                        <button id="btn-update" type="submit"
                            class="btn btn-secondary card-subtitle m-1 text-white">Simpan
                            Kelas</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endsection(); ?>