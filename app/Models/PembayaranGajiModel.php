<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranGajiModel extends Model
{
    protected $table = 'pembayaran_gaji';
    protected $primaryKey = 'id_pembayaran_gaji';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['id_gaji', 'tanggal_bayar', 'status_pembayaran', 'created_at', 'updated_at', 'deleted_at'];

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

    public function getSortedData($sort, $bulan = null, $tahun = null)
    {
        $builder = $this->select('pembayaran_gaji.id_pembayaran_gaji, gaji.id_gaji, gaji.biaya_gaji, guru.nama_guru, guru.id_guru, guru.bidang_studi, pembayaran_gaji.status_pembayaran, pembayaran_gaji.tanggal_bayar, pembayaran_gaji.created_at')
            ->join('gaji', 'pembayaran_gaji.id_gaji = gaji.id_gaji')
            ->join('guru', 'gaji.id_guru = guru.id_guru');

        // Filter berdasarkan status pembayaran
        if ($sort === 'lunas') {
            $builder->where('pembayaran_gaji.status_pembayaran', 'Lunas');
        } elseif ($sort === 'belum_lunas') {
            $builder->where('pembayaran_gaji.status_pembayaran', 'Belum Lunas');
        }

        // Filter berdasarkan bulan dan tahun
        $bulanFilter = ($bulan !== null && $bulan !== '');
        $tahunFilter = ($tahun !== null && $tahun !== '');

        if ($bulanFilter || $tahunFilter) {
            if ($sort === 'lunas') {
                // Untuk status Lunas, gunakan tanggal_bayar
                if ($bulanFilter) {
                    $builder->where('MONTH(pembayaran_gaji.tanggal_bayar)', intval($bulan));
                }
                if ($tahunFilter) {
                    $builder->where('YEAR(pembayaran_gaji.tanggal_bayar)', intval($tahun));
                }
            } elseif ($sort === 'belum_lunas') {
                // Untuk status Belum Lunas, gunakan created_at
                if ($bulanFilter) {
                    $builder->where('MONTH(pembayaran_gaji.created_at)', intval($bulan));
                }
                if ($tahunFilter) {
                    $builder->where('YEAR(pembayaran_gaji.created_at)', intval($tahun));
                }
            } else {
                // Untuk 'semua', cek keduanya dengan OR condition
                $builder->groupStart();

                if ($bulanFilter && $tahunFilter) {
                    // Jika keduanya ada, gunakan kombinasi bulan DAN tahun
                    $builder->groupStart()
                        ->groupStart()
                        ->where('MONTH(pembayaran_gaji.tanggal_bayar)', intval($bulan))
                        ->where('YEAR(pembayaran_gaji.tanggal_bayar)', intval($tahun))
                        ->groupEnd()
                        ->orGroupStart()
                        ->where('MONTH(pembayaran_gaji.created_at)', intval($bulan))
                        ->where('YEAR(pembayaran_gaji.created_at)', intval($tahun))
                        ->groupEnd()
                        ->groupEnd();
                } elseif ($bulanFilter) {
                    // Hanya filter bulan
                    $builder->groupStart()
                        ->where('MONTH(pembayaran_gaji.tanggal_bayar)', intval($bulan))
                        ->orWhere('MONTH(pembayaran_gaji.created_at)', intval($bulan))
                        ->groupEnd();
                } elseif ($tahunFilter) {
                    // Hanya filter tahun
                    $builder->groupStart()
                        ->where('YEAR(pembayaran_gaji.tanggal_bayar)', intval($tahun))
                        ->orWhere('YEAR(pembayaran_gaji.created_at)', intval($tahun))
                        ->groupEnd();
                }

                $builder->groupEnd();
            }
        }

        // Ordering - gunakan orderBy dengan string langsung untuk COALESCE
        $builder->orderBy('pembayaran_gaji.status_pembayaran', 'ASC'); // Belum Lunas dulu
        $builder->orderBy('CASE WHEN pembayaran_gaji.tanggal_bayar IS NOT NULL THEN pembayaran_gaji.tanggal_bayar ELSE pembayaran_gaji.created_at END', 'DESC', false);

        return $builder->get()->getResultArray();
    }
}
