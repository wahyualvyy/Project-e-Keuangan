<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <form id="form-edit" action="<?= base_url('siswa/create'); ?>" method="post">
            <h5 class="card-title fw-semibold mb-4">Tambah Data Siswa</h5>
            <hr>
            <div class="row">
                <div class="col-lg-6">
                    <div>
                        <label for="nama_siswa" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_siswa" id="nama_siswa"
                            placeholder="Muhammad Alex" aria-describedby="defaultFormControlHelp" />
                    </div>
                    <div class="mt-3">
                        <label for="nisn" class="form-label">NISN</label>
                        <input type="number" class="form-control" name="nisn" id="nisn" placeholder="NISN"
                            aria-describedby="defaultFormControlHelp" />
                    </div>
                    <div class="mt-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" name="jenis_kelamin" id="jenis_kelamin"
                            aria-label="Default select example">
                            <option disabled selected>---Pilih Jenis Kelamin---</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir"
                            placeholder="Tempat Lahir" aria-describedby="defaultFormControlHelp" />
                    </div>
                    <div class="mt-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat"
                            aria-describedby="defaultFormControlHelp" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div>
                        <label for="nis" class="form-label">NIS</label>
                        <input type="number" class="form-control" name="nis" id="nis" placeholder="NIS"
                            aria-describedby="defaultFormControlHelp" />
                    </div>
                    <div class="mt-3">
                        <label for="id_jurusan" class="form-label">Jurusan</label>
                        <select class="form-select select2-searchable" name="id_jurusan" id="id_jurusan"
                            aria-label="Default select example">
                            <option disabled selected>---Pilih Jurusan---</option>
                            <?php foreach ($jurusan as $data): ?>
                                <option value="<?= $data['id_jurusan']; ?>"><?= $data['nama_jurusan']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="id_kelas" class="form-label">Kelas</label>
                        <select class="form-select select2-searchable" name="id_kelas" id="id_kelas"
                            aria-label="Default select example">
                            <option disabled selected>---Pilih Kelas---</option>
                            <?php foreach ($kelas as $data): ?>
                                <option value="<?= $data['id_kelas']; ?>">
                                    <?= $data['nama_kelas'] . ' ' . $data['kode_jurusan']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir"
                            aria-describedby="defaultFormControlHelp" />
                    </div>
                    <div class="mt-3">
                        <label for="no_telp" class="form-label">Telepon</label>
                        <input type="number" class="form-control" name="no_telp" id="no_telp" placeholder="Telepon"
                            aria-describedby="defaultFormControlHelp" />
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mt-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" name="status" id="status" aria-label="Default select example">
                            <option disabled selected>---Pilih Status---</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Cuti">Cuti</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="mt-3 d-flex justify-content-center">
                        <button type="submit" id="btn-update" class="btn btn-secondary card-subtitle m-1 text-white">
                            Simpan Siswa</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <form id="form-edit" action="<?= base_url('siswa/create'); ?>" method="post">
            <h5 class="card-title fw-semibold mb-4">Tambah Data Siswa</h5>
            <hr>
            <div class="row">
                <div class="col-lg-6">
                    <div>
                        <label for="nama_siswa" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_siswa" id="nama_siswa"
                            placeholder="Muhammad Alex" aria-describedby="defaultFormControlHelp" />
                    </div>
                    <div class="mt-3">
                        <label for="nisn" class="form-label">NISN</label>
                        <input type="number" class="form-control" name="nisn" id="nisn" placeholder="NISN"
                            aria-describedby="defaultFormControlHelp" />
                    </div>
                    <div class="mt-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" name="jenis_kelamin" id="jenis_kelamin"
                            aria-label="Default select example">
                            <option disabled selected>---Pilih Jenis Kelamin---</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir"
                            placeholder="Tempat Lahir" aria-describedby="defaultFormControlHelp" />
                    </div>
                    <div class="mt-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat"
                            aria-describedby="defaultFormControlHelp" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div>
                        <label for="nis" class="form-label">NIS</label>
                        <input type="number" class="form-control" name="nis" id="nis" placeholder="NIS"
                            aria-describedby="defaultFormControlHelp" />
                    </div>
                    <div class="mt-3">
                        <label for="id_jurusan" class="form-label">Jurusan</label>
                        <select class="form-select select2-searchable" name="id_jurusan" id="id_jurusan"
                            aria-label="Default select example">
                            <option disabled selected>---Pilih Jurusan---</option>
                            <?php foreach ($jurusan as $data): ?>
                                <option value="<?= $data['id_jurusan']; ?>"><?= $data['nama_jurusan']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="id_kelas" class="form-label">Kelas</label>
                        <select class="form-select select2-searchable" name="id_kelas" id="id_kelas"
                            aria-label="Default select example">
                            <option disabled selected>---Pilih Kelas---</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir"
                            aria-describedby="defaultFormControlHelp" />
                    </div>
                    <div class="mt-3">
                        <label for="no_telp" class="form-label">Telepon</label>
                        <input type="number" class="form-control" name="no_telp" id="no_telp" placeholder="Telepon"
                            aria-describedby="defaultFormControlHelp" />
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mt-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" name="status" id="status" aria-label="Default select example">
                            <option disabled selected>---Pilih Status---</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Cuti">Cuti</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="mt-3 d-flex justify-content-center">
                        <button type="submit" id="btn-update" class="btn btn-secondary card-subtitle m-1 text-white">
                            Simpan Siswa</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    // Ambil data kelas dari PHP → konversi ke JSON
    const kelasData = <?= json_encode($kelas); ?>;

    const jurusanSelect = document.getElementById("id_jurusan");
    const kelasSelect = document.getElementById("id_kelas");

    jurusanSelect.addEventListener("change", function () {
        const jurusanId = this.value;

        // Kosongkan dropdown kelas dulu
        kelasSelect.innerHTML = '<option disabled selected>---Pilih Kelas---</option>';

        // Filter kelas sesuai jurusan (pakai == agar tidak masalah tipe data)
        const filteredKelas = kelasData.filter(k => k.id_jurusan == jurusanId);

        // Tambahkan option baru
        filteredKelas.forEach(k => {
            const opt = document.createElement("option");
            opt.value = k.id_kelas;
            opt.textContent = k.nama_kelas + " " + k.kode_jurusan;
            kelasSelect.appendChild(opt);
        });
    });
</script>
<?= $this->endsection(); ?>
<?= $this->endsection(); ?>