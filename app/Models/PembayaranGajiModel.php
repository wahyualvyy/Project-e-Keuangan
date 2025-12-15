<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranGajiModel extends Model
{
    protected $table            = 'pembayaran_gaji';
    protected $primaryKey       = 'id_pembayaran_gaji';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_gaji', 'tanggal_bayar', 'status_pembayaran', 'created_at', 'updated_at', 'deleted_at'];

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

    public function getRelationshipData()
    {
        return $this->select('id_pembayaran_gaji, gaji.id_gaji, gaji.biaya_gaji, guru.nama_guru, guru.id_guru, guru.bidang_studi, pembayaran_gaji.status_pembayaran, pembayaran_gaji.tanggal_bayar')
                    ->join('gaji', 'pembayaran_gaji.id_gaji = gaji.id_gaji')
                    ->join('guru', 'gaji.id_guru = guru.id_guru')
                    ->findAll();
    }
    public function getRelationshipDataId($id)
    {
        return $this->select('id_pembayaran_gaji, gaji.id_gaji, gaji.biaya_gaji, guru.nama_guru, guru.id_guru, guru.bidang_studi, pembayaran_gaji.status_pembayaran, pembayaran_gaji.tanggal_bayar')
                    ->join('gaji', 'pembayaran_gaji.id_gaji = gaji.id_gaji')
                    ->join('guru', 'gaji.id_guru = guru.id_guru')
                    ->where('pembayaran_gaji.id_pembayaran_gaji', $id)
                    ->first();
    }
}
