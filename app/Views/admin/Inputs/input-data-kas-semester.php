<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Tambah Data Kas Semester</h5>
        <hr>
        <form id="form-edit" action="<?= base_url('data-kas/create-semester'); ?>" method="POST">
            <?php csrf_field(); ?>
            <div class="row">
                <div class="col-lg-6">
                    <div>
                        <label for="tahun-ajaran1" class="form-label">Tahun Ajaran</label>
                        <select class="form-select" id="tahun-ajaran1" name="tahun-ajaran1" required>
                            <option selected>Pilih tahun Ajaran</option>
                            <?php
                            $tahunSekarang = date('Y');
                            $tahunDepan = $tahunSekarang + 5;
                            for ($tahun = $tahunDepan; $tahun >= 1950; $tahun--) {
                                echo "<option value=\"$tahun\">$tahun</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="id_jurusan" class="form-label">Nama Jurusan</label>
                        <select id="id_jurusan" name="id_jurusan" class="form-select select2-searchable"
                            id="defaultFormControlInput" aria-label="Default select example">
                            <option disabled selected>---Pilih Jurusan---</option>
                            <?php foreach ($jurusan as $data): ?>
                                <option value="<?= $data['id_jurusan'] ?>"><?= $data['nama_jurusan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div>
                        <label for="tahun-ajaran2" class="form-label">Sampai Tahun Ajaran</label>
                        <select class="form-select" id="tahun-ajaran2" name="tahun-ajaran2" required>
                            <option disabled selected>Pilih tahun Ajaran</option>
                            <?php
                            $tahunSekarang = date('Y');
                            $tahunDepan = $tahunSekarang + 5;
                            for ($tahun = $tahunDepan; $tahun >= 1950; $tahun--) {
                                echo "<option value=\"$tahun\">$tahun</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="biaya_semester" class="form-label">Uang SPP Pendaftaran</label>
                        <input type="number" class="form-control" id="biaya_semester" name="biaya_semester"
                            placeholder="Rp.200.000" aria-describedby="defaultFormControlHelp" />
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mt-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" name="status" id="status" aria-label="Default select example">
                            <option disabled selected>---Pilih Status---</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="mt-3 d-flex justify-content-center">
                        <button id="btn-update" type="submit"
                            class="btn btn-secondary card-subtitle m-1 text-white">Simpan Kas
                            Semester</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endsection(); ?>