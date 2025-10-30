<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranSPPModel extends Model
{
    protected $table = 'pembayaran_spp';
    protected $primaryKey = 'id_pembayaran_spp';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['id_spp', 'id_siswa', 'tanggal_bayar', 'status_pembayaran', 'created_at', 'updated_at'];

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

    public function getData()
    {
        return $this->findAll();
    }
    public function getDataById($id)
    {
        return $this->where('id_pembayaran_spp', $id)->first();
    }

    public function getDataSort($sort, $bulan = null, $tahun = null)
    {
        $builder = $this->select('pembayaran_spp.*, siswa.nama_siswa, spp.biaya_spp, kelas.nama_kelas')
            ->join('siswa', 'siswa.id_siswa = pembayaran_spp.id_siswa')
            ->join('spp', 'spp.id_spp = pembayaran_spp.id_spp')
            ->join('kelas', 'kelas.id_kelas = siswa.id_kelas');

        // Filter status pembayaran
        if ($sort === 'lunas') {
            $builder->where('pembayaran_spp.status_pembayaran', 'Lunas');
        } elseif ($sort === 'belum_lunas') {
            $builder->where('pembayaran_spp.status_pembayaran', 'Belum Lunas');
        }

        // Filter bulan dan tahun
        $hasDateFilter = ($bulan !== null && $bulan !== '') || ($tahun !== null && $tahun !== '');
        if ($hasDateFilter) {
            if ($sort === 'lunas') {
                // Filter berdasarkan tanggal_bayar untuk yang Lunas
                if ($bulan !== null && $bulan !== '') {
                    $builder->where('MONTH(pembayaran_spp.tanggal_bayar)', intval($bulan));
                }
                if ($tahun !== null && $tahun !== '') {
                    $builder->where('YEAR(pembayaran_spp.tanggal_bayar)', intval($tahun));
                }
            } elseif ($sort === 'belum_lunas') {
                // Filter berdasarkan created_at untuk yang Belum Lunas
                if ($bulan !== null && $bulan !== '') {
                    $builder->where('MONTH(pembayaran_spp.created_at)', intval($bulan));
                }
                if ($tahun !== null && $tahun !== '') {
                    $builder->where('YEAR(pembayaran_spp.created_at)', intval($tahun));
                }
            } else {
                // Untuk "semua", tampilkan semua tapi filter yang punya tanggal_bayar atau created_at
                $builder->groupStart();
                if ($bulan !== null && $bulan !== '') {
                    $builder->groupStart()
                        ->where('MONTH(pembayaran_spp.tanggal_bayar)', intval($bulan))
                        ->orWhere('MONTH(pembayaran_spp.created_at)', intval($bulan))
                        ->groupEnd();
                }
                if ($tahun !== null && $tahun !== '') {
                    $builder->groupStart()
                        ->where('YEAR(pembayaran_spp.tanggal_bayar)', intval($tahun))
                        ->orWhere('YEAR(pembayaran_spp.created_at)', intval($tahun))
                        ->groupEnd();
                }
                $builder->groupEnd();
            }
        }

        // Urutkan
        $builder->orderBy('pembayaran_spp.status_pembayaran', 'DESC');
        $builder->orderBy('pembayaran_spp.tanggal_bayar', 'DESC');
        $builder->orderBy('pembayaran_spp.created_at', 'DESC');
        $builder->orderBy('pembayaran_spp.id_pembayaran_spp', 'DESC');

        return $builder->get()->getResultArray();
    }

    public function getDataWithRelations()
    {
        return $this->select('pembayaran_spp.*, siswa.nama_siswa, spp.tahun_ajaran, spp.biaya_spp')
            ->join('siswa', 'pembayaran_spp.id_siswa = siswa.id_siswa')
            ->join('spp', 'pembayaran_spp.id_spp = spp.id_spp')
            ->findAll();
    }
    public function getDataWithRelationsById($id)
    {
        return $this->select('pembayaran_spp.*, siswa.nama_siswa, siswa.jenis_kelamin, siswa.nis , spp.tahun_ajaran, spp.biaya_spp')
            ->join('siswa', 'pembayaran_spp.id_siswa = siswa.id_siswa')
            ->join('spp', 'pembayaran_spp.id_spp = spp.id_spp')
            ->where('pembayaran_spp.id_pembayaran_spp', $id)
            ->first();
    }
}
