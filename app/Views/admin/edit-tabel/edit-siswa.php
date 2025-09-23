<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <form id="form-edit" action="<?= base_url('siswa/update/' . $siswa['id_siswa']); ?>" method="post">
            <?php csrf_field(); ?>
            <h5 class="card-title fw-semibold mb-4">Edit Data Siswa</h5>
            <hr>
            <div class="row">
                <div class="col-lg-6">
                    <div>
                        <label for="nama_siswa" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_siswa" id="nama_siswa"
                            placeholder="Muhammad Alex" aria-describedby="defaultFormControlHelp"
                            value="<?= $siswa['nama_siswa']; ?>" />
                    </div>
                    <div class="mt-3">
                        <label for="nisn" class="form-label">NISN</label>
                        <input type="number" class="form-control" name="nisn" id="nisn" placeholder="NISN"
                            aria-describedby="defaultFormControlHelp" value="<?= $siswa['nisn']; ?>" />
                    </div>
                    <div class="mt-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" name="jenis_kelamin" id="jenis_kelamin"
                            aria-label="Default select example">
                            <option disabled>---Pilih Jenis Kelamin---</option>
                            <option value="Laki-laki" <?= ($siswa['jenis_kelamin'] === 'Laki-laki') ? 'selected' : ''; ?>>
                                Laki-laki</option>
                            <option value="Perempuan" <?= ($siswa['jenis_kelamin'] === 'Perempuan') ? 'selected' : ''; ?>>
                                Perempuan</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir"
                            placeholder="Tempat Lahir" aria-describedby="defaultFormControlHelp"
                            value="<?= $siswa['tempat_lahir']; ?>" />
                    </div>
                    <div class="mt-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat"
                            aria-describedby="defaultFormControlHelp" value="<?= $siswa['alamat']; ?>" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div>
                        <label for="nis" class="form-label">NIS</label>
                        <input type="number" class="form-control" name="nis" id="nis" placeholder="NIS"
                            aria-describedby="defaultFormControlHelp" value="<?= $siswa['nis']; ?>" />
                    </div>
                    <div class="mt-3">
                        <label for="id_jurusan" class="form-label">Jurusan</label>
                        <select class="form-select" name="id_jurusan" id="id_jurusan"
                            aria-label="Default select example">
                            <option disabled>---Pilih Jurusan---</option>
                            <?php foreach ($jurusan as $data): ?>
                                <option value="<?= $data['id_jurusan']; ?>" <?= ($siswa['id_jurusan'] == $data['id_jurusan']) ? 'selected' : ''; ?>>
                                    <?= $data['nama_jurusan']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="id_kelas" class="form-label">Kelas</label>
                        <select class="form-select" name="id_kelas" id="id_kelas" aria-label="Default select example">
                            <option disabled>---Pilih Kelas---</option>
                            <!-- Kelas akan diisi otomatis berdasarkan jurusan yang dipilih -->
                            <?php
                            // Pre-populate kelas berdasarkan jurusan siswa saat ini
                            foreach ($kelas as $kelasItem):
                                if ($kelasItem['id_jurusan'] == $siswa['id_jurusan']):
                                    ?>
                                    <option value="<?= $kelasItem['id_kelas']; ?>"
                                        <?= ($siswa['id_kelas'] == $kelasItem['id_kelas']) ? 'selected' : ''; ?>>
                                        <?= $kelasItem['nama_kelas'] . ' ' . ($kelasItem['kode_jurusan'] ?? ''); ?>
                                    </option>
                                <?php
                                endif;
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir"
                            aria-describedby="defaultFormControlHelp" value="<?= $siswa['tanggal_lahir']; ?>" />
                    </div>
                    <div class="mt-3">
                        <label for="no_telp" class="form-label">Telepon</label>
                        <input type="number" class="form-control" name="no_telp" id="no_telp" placeholder="Telepon"
                            aria-describedby="defaultFormControlHelp" value="<?= $siswa['no_telp']; ?>" />
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mt-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" name="status" id="status" aria-label="Default select example">
                            <option disabled>---Pilih Status---</option>
                            <option value="Aktif" <?= ($siswa['status'] === 'Aktif') ? 'selected' : ''; ?>>Aktif</option>
                            <option value="Cuti" <?= ($siswa['status'] === 'Cuti') ? 'selected' : ''; ?>>Cuti</option>
                            <option value="Tidak Aktif" <?= ($siswa['status'] === 'Tidak Aktif') ? 'selected' : ''; ?>>
                                Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="mt-3 d-flex justify-content-center">
                        <button type="submit" id="btn-update" class="btn btn-secondary card-subtitle m-1 text-white">
                            Update Siswa
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Data dari PHP
        let kelasData;
        <?php if (!empty($kelas)): ?>
            kelasData = <?= json_encode($kelas); ?>;
        <?php else: ?>
            kelasData = [];
            console.warn("Data kelas kosong atau tidak tersedia!");
        <?php endif; ?>

        // Data siswa untuk pre-select
        const siswaData = {
            id_jurusan: "<?= $siswa['id_jurusan']; ?>",
            id_kelas: "<?= $siswa['id_kelas']; ?>"
        };

        // Ambil elemen select
        const jurusanSelect = document.getElementById("id_jurusan");
        const kelasSelect = document.getElementById("id_kelas");

        // Validasi elemen ada
        if (!jurusanSelect || !kelasSelect) {
            console.error("Element select tidak ditemukan!");
            return;
        }

        console.log("Data kelas:", kelasData);
        console.log("Data siswa:", siswaData);

        // Fungsi untuk populate kelas berdasarkan jurusan
        function populateKelas(jurusanId, selectedKelasId = null) {
            console.log("Populate kelas untuk jurusan:", jurusanId);

            // Reset dropdown kelas
            kelasSelect.innerHTML = '<option disabled>---Pilih Kelas---</option>';

            // Jika tidak ada jurusan dipilih, keluar
            if (!jurusanId || jurusanId === "") {
                return;
            }

            // Filter kelas berdasarkan jurusan
            const filteredKelas = kelasData.filter(function (kelas) {
                return kelas.id_jurusan == jurusanId;
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

                // Set selected jika ini adalah kelas yang dipilih
                if (selectedKelasId && kelas.id_kelas == selectedKelasId) {
                    option.selected = true;
                }

                kelasSelect.appendChild(option);
            });

            console.log("Berhasil menambahkan", filteredKelas.length, "kelas");
        }

        // Event listener untuk perubahan jurusan
        jurusanSelect.addEventListener("change", function () {
            const jurusanId = this.value;
            console.log("Jurusan berubah ke:", jurusanId);
            populateKelas(jurusanId);
        });

        // Inisialisasi kelas saat pertama kali load (untuk edit mode)
        if (siswaData.id_jurusan) {
            console.log("Menginisialisasi kelas untuk edit mode");
            populateKelas(siswaData.id_jurusan, siswaData.id_kelas);
        }

        // Debugging: log nilai yang dipilih saat ini
        console.log("Jurusan terpilih:", jurusanSelect.value);
        console.log("Kelas terpilih:", kelasSelect.value);
    });
</script>
<?= $this->endSection(); ?>