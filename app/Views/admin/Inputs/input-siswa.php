<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <form id="form-edit" action="<?= base_url('siswa/create'); ?>" method="post">
            <?php csrf_field() ;?>
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
                        <select class="form-select" name="id_jurusan" id="id_jurusan"
                            aria-label="Default select example">
                            <option disabled selected>---Pilih Jurusan---</option>
                            <?php foreach ($jurusan as $data): ?>
                                <option value="<?= $data['id_jurusan']; ?>"><?= $data['nama_jurusan']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="id_kelas" class="form-label">Kelas</label>
                        <select class="form-select" name="id_kelas" id="id_kelas" aria-label="Default select example">
                            <option disabled selected>---Pilih Kelas---</option>
                            <!-- opsi akan diisi otomatis lewat JS -->
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
    document.addEventListener('DOMContentLoaded', function () {
        // Pastikan data kelas tersedia
        let kelasData;
        <?php if (!empty($kelas)): ?>
            kelasData = <?= json_encode($kelas); ?>;
        <?php else: ?>
            kelasData = [];
            console.warn("Data kelas kosong atau tidak tersedia!");
        <?php endif; ?>

        // Ambil elemen select
        const jurusanSelect = document.getElementById("id_jurusan");
        const kelasSelect = document.getElementById("id_kelas");

        // Validasi elemen ada
        if (!jurusanSelect || !kelasSelect) {
            console.error("Element select tidak ditemukan!");
            return;
        }

        // Event listener untuk perubahan jurusan
        jurusanSelect.addEventListener("change", function () {
            const jurusanId = this.value;
            console.log("Jurusan dipilih:", jurusanId);

            // Reset dropdown kelas
            kelasSelect.innerHTML = '<option disabled selected>---Pilih Kelas---</option>';

            // Jika tidak ada jurusan dipilih, keluar
            if (!jurusanId || jurusanId === "") {
                return;
            }

            // Filter kelas berdasarkan jurusan
            const filteredKelas = kelasData.filter(function (kelas) {
                return kelas.id_jurusan == jurusanId; // Gunakan == untuk menghindari masalah tipe data
            });

            console.log("Kelas yang ditemukan:", filteredKelas);

            // Jika tidak ada kelas ditemukan
            if (filteredKelas.length === 0) {
                const noDataOption = document.createElement("option");
                noDataOption.disabled = true;
                noDataOption.textContent = "Tidak ada kelas tersedia";
                kelasSelect.appendChild(noDataOption);
                return;
            }

            // Tambahkan option kelas
            filteredKelas.forEach(function (kelas) {
                const option = document.createElement("option");
                option.value = kelas.id_kelas;
                option.textContent = kelas.nama_kelas + " " + (kelas.kode_jurusan || "");
                kelasSelect.appendChild(option);
            });

            console.log("Berhasil menambahkan", filteredKelas.length, "kelas");
        });

        // Reset kelas jika jurusan direset
        jurusanSelect.addEventListener("change", function () {
            if (this.value === "" || this.selectedIndex === 0) {
                kelasSelect.innerHTML = '<option disabled selected>---Pilih Kelas---</option>';
            }
        });
    });
</script>
<?= $this->endSection(); ?>