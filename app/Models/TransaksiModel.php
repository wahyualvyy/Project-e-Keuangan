<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['id_pembayaran_spp', 'id_pembayaran_semester', 'id_pembayaran_gaji', 'tanggal', 'jenis_transaksi', 'kategori', 'nominal', 'keterangan', 'created_at', 'updated_at'];

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

    /**
     * Catat transaksi pemasukan SPP
     */
    public function catatPemasukanSPP($idPembayaran, $nominal, $keterangan = null)
    {
        return $this->insert([
            'id_pembayaran_spp' => $idPembayaran,
            'tanggal' => date('Y-m-d'),
            'jenis_transaksi' => 'pemasukan',
            'kategori' => 'SPP',
            'nominal' => $nominal,
            'keterangan' => $keterangan
        ]);
    }

    /**
     * Catat transaksi pemasukan Semester
     */
    public function catatPemasukanSemester($idPembayaran, $nominal, $keterangan = null)
    {
        return $this->insert([
            'id_pembayaran_semester' => $idPembayaran,
            'tanggal' => date('Y-m-d'),
            'jenis_transaksi' => 'pemasukan',
            'kategori' => 'SEMESTER',
            'nominal' => $nominal,
            'keterangan' => $keterangan
        ]);
    }

    /**
     * Catat transaksi pengeluaran Gaji
     */
    public function catatPengeluaranGaji($idPembayaran, $nominal, $keterangan = null)
    {
        return $this->insert([
            'id_pembayaran_gaji' => $idPembayaran,
            'tanggal' => date('Y-m-d'),
            'jenis_transaksi' => 'pengeluaran',
            'kategori' => 'GAJI',
            'nominal' => $nominal,
            'keterangan' => $keterangan
        ]);
    }

    /**
     * Get total pemasukan
     */
    public function getTotalPemasukan($bulan = null, $tahun = null)
    {
        $builder = $this->builder();
        $builder->selectSum('nominal');
        $builder->where('jenis_transaksi', 'pemasukan');

        if ($bulan) {
            $builder->where('MONTH(tanggal)', $bulan);
        }
        if ($tahun) {
            $builder->where('YEAR(tanggal)', $tahun);
        }

        $result = $builder->get()->getRowArray();
        return $result['nominal'] ?? 0;
    }

    /**
     * Get total pengeluaran
     */
    public function getTotalPengeluaran($bulan = null, $tahun = null)
    {
        $builder = $this->builder();
        $builder->selectSum('nominal');
        $builder->where('jenis_transaksi', 'pengeluaran');

        if ($bulan) {
            $builder->where('MONTH(tanggal)', $bulan);
        }
        if ($tahun) {
            $builder->where('YEAR(tanggal)', $tahun);
        }

        $result = $builder->get()->getRowArray();
        return $result['nominal'] ?? 0;
    }

    /**
     * Get saldo
     */
    public function getSaldo($bulan = null, $tahun = null)
    {
        $pemasukan = $this->getTotalPemasukan($bulan, $tahun);
        $pengeluaran = $this->getTotalPengeluaran($bulan, $tahun);
        return $pemasukan - $pengeluaran;
    }

    /**
     * Get laporan transaksi dengan relasi
     */
    public function getLaporanTransaksi($bulan = null, $tahun = null, $jenis = null)
    {
        $builder = $this->builder();

        $builder->select('transaksi.*, 
                     COALESCE(siswa.nama_siswa, siswa2.nama_siswa) AS nama_siswa,
                     COALESCE(siswa.nis, siswa2.nis) AS nis,
                     guru.nama_guru,
                     guru.nip')
            ->join('pembayaran_spp', 'transaksi.id_pembayaran_spp = pembayaran_spp.id_pembayaran_spp', 'left')
            ->join('siswa', 'pembayaran_spp.id_siswa = siswa.id_siswa', 'left')
            ->join('pembayaran_semester', 'transaksi.id_pembayaran_semester = pembayaran_semester.id_pembayaran_semester', 'left')
            ->join('siswa AS siswa2', 'pembayaran_semester.id_siswa = siswa2.id_siswa', 'left')

            // 🔑 OPSI 1: JOIN lewat tabel gaji
            ->join('pembayaran_gaji', 'transaksi.id_pembayaran_gaji = pembayaran_gaji.id_pembayaran_gaji', 'left')
            ->join('gaji', 'pembayaran_gaji.id_gaji = gaji.id_gaji', 'left')
            ->join('guru', 'gaji.id_guru = guru.id_guru', 'left')

            ->orderBy('transaksi.tanggal', 'DESC')
            ->orderBy('transaksi.created_at', 'DESC');

        if ($bulan) {
            $builder->where('MONTH(transaksi.tanggal)', $bulan);
        }

        if ($tahun) {
            $builder->where('YEAR(transaksi.tanggal)', $tahun);
        }

        if ($jenis) {
            $builder->where('transaksi.jenis_transaksi', $jenis);
        }

        return $builder->get()->getResultArray();
    }

}
