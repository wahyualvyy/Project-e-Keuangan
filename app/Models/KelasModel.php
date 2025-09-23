<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['nama_kelas', 'id_jurusan', 'id_guru', 'keterangan', 'created_at', 'updated_at'];

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

    public function getKelas()
    {
        return $this->findAll();
    }

    public function getKelasById($id)
    {
        return $this->select('kelas.*, jurusan.nama_jurusan, guru.nama_guru')
            ->join('jurusan', 'kelas.id_jurusan = jurusan.id_jurusan', 'left')
            ->join('guru', 'kelas.id_guru = guru.id_guru', 'left')
            ->where('kelas.id_kelas', $id)
            ->first();
    }

    public function getKelasByIds(array $ids)
    {
        return $this->select('kelas.*, jurusan.nama_jurusan, guru.nama_guru')
            ->join('jurusan', 'kelas.id_jurusan = jurusan.id_jurusan', 'left')
            ->join('guru', 'kelas.id_guru = guru.id_guru', 'left')
            ->whereIn('kelas.id_kelas', $ids)
            ->findAll();
    }


    public function getKelasWithRelations()
    {
        return $this->select('kelas.*, jurusan.nama_jurusan, jurusan.kode_jurusan, guru.nama_guru')
            ->join('jurusan', 'kelas.id_jurusan = jurusan.id_jurusan', 'left')
            ->join('guru', 'kelas.id_guru = guru.id_guru', 'left')
            ->findAll();
    }

    public function getJurusanFromKelas()
    {
        return $this->select('jurusan.id_jurusan, jurusan.nama_jurusan')
            ->join('jurusan', 'kelas.id_jurusan = jurusan.id_jurusan', 'left')
            ->groupBy('jurusan.id_jurusan, jurusan.nama_jurusan')
            ->findAll();
    }


    public function getData($sort)
    {
        $builder = $this->db->table('kelas')
            ->select('kelas.*, jurusan.nama_jurusan, jurusan.kode_jurusan, guru.nama_guru')
            ->join('jurusan', 'kelas.id_jurusan = jurusan.id_jurusan', 'left')
            ->join('guru', 'kelas.id_guru = guru.id_guru', 'left');

        switch ($sort) {
            case 'nama_asc':
                $builder->orderBy('kelas.nama_kelas', 'ASC');
                break;
            case 'nama_desc':
                $builder->orderBy('kelas.nama_kelas', 'DESC');
                break;
            case 'wali_asc':
                $builder->orderBy('guru.nama_guru', 'ASC');
                break;
            case 'wali_desc':
                $builder->orderBy('guru.nama_guru', 'DESC');
                break;
            case 'terbaru':
                $builder->orderBy('kelas.created_at', 'DESC');
                break;
            case 'terlama':
                $builder->orderBy('kelas.created_at', 'ASC');
                break;
            default:
                // Default sorting (if needed)
                $builder->orderBy('kelas.created_at', 'DESC');
                break;
        }

        return $builder->get()->getResultArray();
    }
}
