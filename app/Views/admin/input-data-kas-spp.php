<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Tambah Data Kas SPP</h5>
        <hr>
        <div class="row">
            <div class="col-lg-6">
                <div>
                    <label for="tahunLahir" class="form-label">Tahun Ajaran</label>
                    <select class="form-select" id="tahunLahir" name="tahun_lahir" required>
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
            </div>
            <div class="col-lg-6">
                <div>
                    <label for="tahunLahir" class="form-label">Sampai Tahun Ajaran</label>
                    <select class="form-select" id="tahunLahir" name="tahun_lahir" required>
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
            </div>
            <div class="col-lg-12">
                <div class="mt-3">
                    <label for="defaultFormControlInput" class="form-label">Uang SPP Perbulan</label>
                    <input type="number" class="form-control" id="defaultFormControlInput" placeholder="Rp.200.000"
                        aria-describedby="defaultFormControlHelp" />
                </div>
                <div class="mt-3 d-flex justify-content-center">
                    <a href="<?= base_url('admin/data-kas-spp'); ?>">
                        <button type="button" class="btn btn-secondary card-subtitle m-1 text-white">Tambah
                            Data Kas SPP</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>