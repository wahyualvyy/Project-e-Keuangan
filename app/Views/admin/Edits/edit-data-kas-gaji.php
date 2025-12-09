<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Tambah Data Kas Gaji</h5>
        <hr>
        <form id="form-edit" action="<?= base_url('data-kas/update-gaji/' . $gaji['id_gaji']); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <label for="id_guru" class="form-label">Nama Guru</label>
                        <select id="id_guru" name="id_guru" class="form-select select2-searchable"
                            id="defaultFormControlInput" aria-label="Default select example">
                            <option disabled>---Pilih Nama Guru---</option>
                            <?php foreach ($guru as $row): ?>
                                <option value="<?= $row['id_guru'] ?>" <?= (isset($kelas['id_guru']) && $row['id_guru'] === $kelas['id_guru']) ? 'selected' : '' ?>><?= $row['nama_guru'] ?>
                                </option>
                            <?php endforeach; ?>    
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mt-3">
                        <label for="biaya" class="form-label">Uang Gaji Perjam</label>
                        <input type="number" class="form-control" id="biaya" name="biaya_gaji" value="<?= $biaya_gaji; ?>" placeholder="Rp.200.000"
                            aria-describedby="defaultFormControlHelp" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mt-3">
                        <label for="jam" class="form-label">Jumlah Jam Mengajar 1 Minggu</label>
                        <input type="number" class="form-control" id="jam" name="jumlah_jam" placeholder="2 Jam"
                            aria-describedby="defaultFormControlHelp" value="<?= $jumlah_jam; ?>" />
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mt-3 d-flex justify-content-center">
                        <button type="submit" id="btn-update"
                            class="btn btn-secondary card-subtitle m-1 text-white">Tambah
                            Data Kas Gaji</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endsection(); ?>