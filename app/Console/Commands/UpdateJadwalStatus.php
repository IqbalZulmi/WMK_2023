<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateJadwalStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jadwal:updatestatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status jadwal lapangan dan pemesanan';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        DB::transaction(function () {
            // Ambil id jadwal yang akan diupdate
            $ids = DB::table('pemesanans')
                    ->where('status', 'draft')
                    ->where('updated_at', '<=', now()->subMinutes(10))
                    ->pluck('id_jadwal_lapangan');

            // Update status pemesanan
            DB::table('pemesanans')
                ->where('status', 'draft')
                ->where('updated_at', '<=', now()->subMinutes(10))
                ->update([
                    'status' => 'gagal',
                    'komentar' => 'Dibatalkan oleh sistem'
                ]);

            // Update status jadwal lapangan
            DB::table('jadwal_lapangans')
                ->whereIn('id', $ids)
                ->update(['status' => 'tersedia']);
        });

        $this->info('Status jadwal lapangan dan pemesanan berhasil diperbarui.');
    }
}
