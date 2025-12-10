<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranSemesterModel extends Model
{
    protected $table = 'pembayaran_semester';
    protected $primaryKey = 'id_pembayaran_semester';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['id_semester', 'id_siswa', 'tanggal_bayar', 'status_pembayaran', 'created_at', 'updated_at'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
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

    public function getWithRelation()
    {
        return $this->select('pembayaran_semester.*, semester.tahun_ajaran, semester.nomor_semester, semester.biaya_semester, siswa.nama_siswa')
            ->join('semester', 'pembayaran_semester.id_semester = semester.id_semester')
            ->join('siswa', 'pembayaran_semester.id_siswa = siswa.id_siswa')
            ->findAll();
    }
    public function getDetailById($id)
    {
        return $this->select('pembayaran_semester.*, semester.tahun_ajaran, semester.nomor_semester, semester.biaya_semester, siswa.nama_siswa')
            ->join('semester', 'pembayaran_semester.id_semester = semester.id_semester')
            ->join('siswa', 'pembayaran_semester.id_siswa = siswa.id_siswa')
            ->where('pembayaran_semester.id_pembayaran_semester', $id)
            ->first();
    }
    public function getDataSort($sort, $bulan = null, $tahun = null, $semester = null)
    {
        $builder = $this->select('pembayaran_semester.*, siswa.nama_siswa, semester.biaya_semester, semester.tahun_ajaran, semester.nomor_semester, kelas.nama_kelas')
            ->join('siswa', 'siswa.id_siswa = pembayaran_semester.id_siswa')
            ->join('semester', 'semester.id_semester = pembayaran_semester.id_semester')
            ->join('kelas', 'kelas.id_kelas = siswa.id_kelas');

        // Filter semester
        if ($semester !== null && $semester !== '') {
            $builder->where('semester.nomor_semester', intval($semester));
        }

        // Filter status pembayaran
        if ($sort === 'lunas') {
            $builder->where('pembayaran_semester.status_pembayaran', 'Lunas');
        } elseif ($sort === 'belum_lunas') {
            $builder->where('pembayaran_semester.status_pembayaran', 'Belum Lunas');
        }

        // Filter bulan dan tahun
        $hasDateFilter = ($bulan !== null && $bulan !== '') || ($tahun !== null && $tahun !== '');
        if ($hasDateFilter) {
            if ($sort === 'lunas') {
                // Filter berdasarkan tanggal_bayar untuk yang Lunas
                if ($bulan !== null && $bulan !== '') {
                    $builder->where('MONTH(pembayaran_semester.tanggal_bayar)', intval($bulan));
                }
                if ($tahun !== null && $tahun !== '') {
                    $builder->where('YEAR(pembayaran_semester.tanggal_bayar)', intval($tahun));
                }
            } elseif ($sort === 'belum_lunas') {
                // Filter berdasarkan created_at untuk yang Belum Lunas
                if ($bulan !== null && $bulan !== '') {
                    $builder->where('MONTH(pembayaran_semester.created_at)', intval($bulan));
                }
                if ($tahun !== null && $tahun !== '') {
                    $builder->where('YEAR(pembayaran_semester.created_at)', intval($tahun));
                }
            } else {
                // Untuk "semua", tampilkan semua tapi filter yang punya tanggal_bayar atau created_at
                $builder->groupStart();
                if ($bulan !== null && $bulan !== '') {
                    $builder->groupStart()
                        ->where('MONTH(pembayaran_semester.tanggal_bayar)', intval($bulan))
                        ->orWhere('MONTH(pembayaran_semester.created_at)', intval($bulan))
                        ->groupEnd();
                }
                if ($tahun !== null && $tahun !== '') {
                    $builder->groupStart()
                        ->where('YEAR(pembayaran_semester.tanggal_bayar)', intval($tahun))
                        ->orWhere('YEAR(pembayaran_semester.created_at)', intval($tahun))
                        ->groupEnd();
                }
                $builder->groupEnd();
            }
        }

        // Urutkan
        $builder->orderBy('pembayaran_semester.status_pembayaran', 'DESC');
        $builder->orderBy('pembayaran_semester.tanggal_bayar', 'DESC');
        $builder->orderBy('pembayaran_semester.created_at', 'DESC');
        $builder->orderBy('pembayaran_semester.id_pembayaran_semester', 'DESC');

        return $builder->get()->getResultArray();
    }
}
