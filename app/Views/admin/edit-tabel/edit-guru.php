<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Tambah Data Guru</h5>
        <hr>
        <form id="form-edit" action="<?= base_url('guru/update/' . $guru['id_guru']); ?>" method="post">
            <?php csrf_field(); ?>
            <div class="row">
                <div class="col-lg-6">
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_guru" class="form-control" id="defaultFormControlInput"
                            placeholder="Muhammad Alex" aria-describedby="defaultFormControlHelp" value="<?= $guru['nama_guru']?>" />
                    </div>
                    <div class="mt-3">
                        <label for="defaultFormControlInput" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" name="jenis_kelamin" id="defaultFormControlInput"
                            aria-label="Default select example">
                            <option disabled selected >---Pilih Jenis Kelamin---</option>
                            <option value="Laki-laki" <?= ($guru['jenis_kelamin'] === 'Laki-laki') ? 'Selected' : '' ;?> >Laki-Laki</option>
                            <option value="Perempuan" <?= ($guru['jenis_kelamin'] === 'Perempuan') ? 'Selected' : '' ;?> >Perempuan</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="defaultFormControlInput" class="form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control" id="defaultFormControlInput"
                            placeholder="Alamat" aria-describedby="defaultFormControlHelp" value="<?= $guru['alamat'];?>" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div>
                        <label for="defaultFormControlInput" class="form-label">NIP</label>
                        <input type="number" name="nip" class="form-control" id="defaultFormControlInput"
                            placeholder="NIP/NIK" aria-describedby="defaultFormControlHelp" value="<?= $guru['nip'];?>" />
                    </div>
                    <div class="mt-3">
                        <label for="defaultFormControlInput" class="form-label">Bidang Studi</label>
                        <input type="text" name="bidang_studi" class="form-control" id="defaultFormControlInput"
                            placeholder="Bidang Studi" aria-describedby="defaultFormControlHelp" value="<?= $guru['bidang_studi']?>"/>
                    </div>
                    <div class="mt-3">
                        <label for="defaultFormControlInput" class="form-label">Telepon</label>
                        <input type="number" name="no_telp" class="form-control" id="defaultFormControlInput"
                            placeholder="Telepon" aria-describedby="defaultFormControlHelp" value="<?= $guru['no_telp']?>" />
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mt-3">
                        <label for="defaultFormControlInput" class="form-label">Status</label>
                        <select class="form-select" name="status" id="defaultFormControlInput"
                            aria-label="Default select example">
                            <option disabled selected>---Pilih Status---</option>
                            <option value="Aktif" <?= ($guru['status'] === 'Aktif') ? 'Selected': '' ;?> >Aktif</option>
                            <option value="Cuti"  <?= ($guru['status'] === 'Cuti') ? 'Selected': '' ;?>>Cuti</option>
                            <option value="Tidak Aktif"<?= ($guru['status'] === 'Tidak Aktif') ? 'Selected': '' ;?>>Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="mt-3 d-flex justify-content-center">
                        <button id="btn-update" type="submit" class="btn btn-secondary card-subtitle m-1 text-white">Update
                            Guru</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endsection(); ?>