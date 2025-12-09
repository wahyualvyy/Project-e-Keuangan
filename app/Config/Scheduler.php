<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Scheduler extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Scheduled Tasks
     * --------------------------------------------------------------------------
     *
     * Konfigurasi scheduled tasks yang akan berjalan otomatis.
     * Format: 'expression' => 'command'
     * 
     * Contoh expression (Cron):
     * '* * * * *'           => setiap menit
     * '0 * * * *'           => setiap jam
     * '0 0 * * *'           => setiap hari pukul 00:00
     * '0 0 1 * *'           => setiap tanggal 1 bulan pukul 00:00
     * '0 0 * * 0'           => setiap hari Minggu pukul 00:00
     */
    public array $tasks = [
        // Generate pembayaran semester setiap awal bulan pukul 00:00
        '0 0 1 * *' => 'semester:generate-pembayaran',

        // Generate pembayaran SPP setiap awal bulan pukul 00:05
        '5 0 1 * *' => 'spp:generate-pembayaran',

        // Generate pembayaran gaji setiap awal bulan pukul 00:10
        '10 0 1 * *' => 'gaji:generate-pembayaran',
    ];
}
