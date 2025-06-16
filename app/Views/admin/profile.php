<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Profile Identitas Sekolah</h5>
        <hr>
        <div class="row">
            <div class="col-lg-6">
                <div>
                    <label for="defaultFormControlInput" class="form-label">NPSN</label>
                    <input type="number" class="form-control" id="defaultFormControlInput" placeholder="20123923"
                        aria-describedby="defaultFormControlHelp" />
                </div>
                <div class="mt-3">
                    <label for="defaultFormControlInput" class="form-label">Alamat Sekolah</label>
                    <div class="form-floating ">
                        <textarea class="form-control" placeholder="Leave a comment here"
                            id="floatingTextarea"></textarea>
                        <label for="floatingTextarea">Alamat Sekolah</label>
                    </div>
                </div>
                <div class="mt-3">
                    <label for="defaultFormControlInput" class="form-label">Kecamatan</label>
                    <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Kecamatan"
                        aria-describedby="defaultFormControlHelp" />
                </div>
                <div class="mt-3">
                    <label for="defaultFormControlInput" class="form-label">Kode Pos</label>
                    <input type="number" class="form-control" id="defaultFormControlInput" placeholder="Kode Pos"
                        aria-describedby="defaultFormControlHelp" />
                </div>
                <div class="mt-3">
                    <label for="defaultFormControlInput" class="form-label">Nama Kepala Sekolah</label>
                    <input type="text" class="form-control" id="defaultFormControlInput"
                        placeholder="Nama Kepala Sekolah" aria-describedby="defaultFormControlHelp" />
                </div>
            </div>
            <div class="col-lg-6">
                <div>
                    <label for="defaultFormControlInput" class="form-label">Nama Sekolah</label>
                    <input type="text" class="form-control" id="defaultFormControlInput"
                        placeholder="Smk Hasyim Asy'ari" aria-describedby="defaultFormControlHelp" />
                </div>
                <div class="mt-4">
                    <label for="defaultFormControlInput" class="form-label">Kabupaten</label>
                    <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Kabupaten"
                        aria-describedby="defaultFormControlHelp" />
                </div>
                <div class="mt-4">
                    <label for="defaultFormControlInput" class="form-label">Desa</label>
                    <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Desa"
                        aria-describedby="defaultFormControlHelp" />
                </div>
                <div class="mt-3">
                    <label for="defaultFormControlInput" class="form-label">No Telepon</label>
                    <input type="text" class="form-control" id="defaultFormControlInput" placeholder="No Telepon"
                        aria-describedby="defaultFormControlHelp" />
                </div>
                <div class="mt-3">
                    <label for="defaultFormControlInput" class="form-label">Status</label>
                    <select class="form-select" id="defaultFormControlInput" aria-label="Default select example">
                        <option>---Pilih Status---</option>
                        <option value="Swasta" selected>Swasta</option>
                        <option value="Negeri">Negeri</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="my-3 text-center">
                    <label for="formFile" class="form-label my-3 text-center">Logo Sekolah</label>
                </div>
                <div class="my-3 text-center">
                    <img id="previewImage" src="#" alt="Preview Logo Sekolah" class="img-thumbnail mb-3 d-none"
                        style="max-height: 200px;">
                    <input class="form-control" type="file" id="formFile" accept="image/*">
                </div>

                <div class="mt-3 d-flex justify-content-center">
                    <a href="<?= base_url('admin/data-siswa'); ?>">
                        <button type="button" class="btn btn-secondary card-subtitle m-1 text-white">Update
                            Profile</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('formFile').addEventListener('change', function (event) {
        const input = event.target;
        const preview = document.getElementById('previewImage');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            };

            reader.readAsDataURL(input.files[0]);
        }
    });
</script>
<?= $this->endsection(); ?>