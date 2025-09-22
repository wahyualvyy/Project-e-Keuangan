<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruModel extends Model
{
    protected $table = 'guru';
    protected $primaryKey = 'id_guru';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['nama_guru', 'jenis_kelamin', 'bidang_studi', 'alamat', 'nip', 'no_telp', 'status', 'created_at', 'updated_at'];

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

    public function getAllGuru()
    {
        return $this->findAll();
    }

    public function getAllGuruById($id)
    {
        return $this->where('id_guru', $id)->first();
    }

    public function getData($sort)
    {
        $builder = $this->db->table('guru');

        switch ($sort) {
            case 'nama_asc':
                $builder->orderBy('nama_guru', 'ASC');
                break;
            case 'nama_desc':
                $builder->orderBy('nama_guru', 'DESC');
                break;
            case 'status_aktif':
                $builder->where('status', 'Aktif')->orderBy('nama_guru', 'ASC');
                break;
            case 'status_tidak_aktif':
                $builder->where('status', 'Tidak Aktif')->orderBy('nama_guru', 'ASC');
                break;
            case 'status_cuti':
                $builder->where('status', 'Cuti')->orderBy('nama_guru', 'ASC');
                break;
            case 'terlama':
                $builder->orderBy('created_at', 'ASC');
                break;
            case 'terbaru':
            default:
                $builder->orderBy('created_at', 'DESC');
                break;
        }

        return $builder->get()->getResultArray();

    }
}
