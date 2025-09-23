<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['id_jurusan', 'id_kelas', 'nama_siswa', 'nis', 'nisn', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'no_telp', 'status', 'created_at', 'updated_at'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function getAllSiswaById($id)
    {
        return $this->where('id_siswa', $id)->first();
    }

    public function getSiswaWithAllData()
    {
        $builder = $this->db->table('siswa');

        // 1. Pilih semua kolom yang Anda butuhkan
        $builder->select('
        siswa.*, 
        kelas.nama_kelas, 
        jurusan.nama_jurusan, 
        jurusan.kode_jurusan, 
        guru.nama_guru
    ');

        // 2. JOIN ke tabel 'kelas' terlebih dahulu (ini adalah penghubung utama dari siswa)
        $builder->join('kelas', 'siswa.id_kelas = kelas.id_kelas', 'left');

        // 3. SEKARANG, dari 'kelas', baru JOIN ke 'jurusan'
        $builder->join('jurusan', 'kelas.id_jurusan = jurusan.id_jurusan', 'left');

        // 4. Dan dari 'kelas' juga, JOIN ke 'guru' untuk mendapatkan nama wali kelas
        $builder->join('guru', 'kelas.id_guru = guru.id_guru', 'left');

        return $builder->get()->getResultArray();
    }

    public function getData($sort)
    {
        $builder = $this->db->table('siswa');
        $builder->select('
        siswa.*, 
        kelas.nama_kelas, 
        jurusan.nama_jurusan, 
        jurusan.kode_jurusan, 
        guru.nama_guru
    ');
        $builder->join('kelas', 'siswa.id_kelas = kelas.id_kelas', 'left');
        $builder->join('jurusan', 'kelas.id_jurusan = jurusan.id_jurusan', 'left');
        $builder->join('guru', 'kelas.id_guru = guru.id_guru', 'left');

        // 🔹 Cek apakah sort berupa filter kelas
        if (strpos($sort, 'kelas_') === 0) {
            $idKelas = str_replace('kelas_', '', $sort);
            $builder->where('siswa.id_kelas', $idKelas);
            $builder->orderBy('siswa.nama_siswa', 'ASC'); // default urut nama
            return $builder->get()->getResultArray();
        }

        // 🔹 Kalau bukan kelas, baru switch
        switch ($sort) {
            case 'terbaru':
                $builder->orderBy('siswa.created_at', 'DESC');
                break;
            case 'terlama':
                $builder->orderBy('siswa.created_at', 'ASC');
                break;
            case 'nama_asc':
                $builder->orderBy('siswa.nama_siswa', 'ASC');
                break;
            case 'nama_desc':
                $builder->orderBy('siswa.nama_siswa', 'DESC');
                break;
            case 'status_aktif':
                $builder->where('siswa.status', 'Aktif')->orderBy('siswa.nama_siswa', 'ASC');
                break;
            case 'status_tidak_aktif':
                $builder->where('siswa.status', 'Tidak Aktif')->orderBy('siswa.nama_siswa', 'ASC');
                break;
            case 'status_cuti':
                $builder->where('siswa.status', 'Cuti')->orderBy('siswa.nama_siswa', 'ASC');
                break;
            default:
                $builder->orderBy('siswa.created_at', 'DESC');
                break;
        }

        return $builder->get()->getResultArray();
    }


}
