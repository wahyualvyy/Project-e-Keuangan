<?php

namespace App\Models;

use CodeIgniter\Model;

class JurusanModel extends Model
{
    protected $table            = 'jurusan';
    protected $primaryKey       = 'id_jurusan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_jurusan', 'kode_jurusan','keterangan', 'created_at', 'updated_at'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getAllJurusan()
    {
        return $this->findAll();
    }

    public function getIdJurusan($id)
    {
        return $this->where('id_jurusan', $id)->first();
    }

    public function getData($sort)
    {
        $builder = $this->db->table('jurusan');

        switch ($sort) {
            case 'terbaru':
                $builder->orderBy('created_at', 'DESC');
                break;
            case 'terlama':
                $builder->orderBy('created_at', 'ASC');
                break;
            case 'nama_asc':
                $builder->orderBy('nama_jurusan', 'ASC');
                break;
            case 'nama_desc':
                $builder->orderBy('nama_jurusan', 'DESC');
                break;
            default:
                $builder->orderBy('created_at', 'DESC');
                break;
        }

        return $builder->get()->getResultArray();
    }
}
