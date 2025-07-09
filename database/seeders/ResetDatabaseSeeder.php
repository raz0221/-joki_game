<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ResetDatabaseCommand extends Command
{
    protected $signature = 'db:reset-all';
    protected $description = 'Hapus semua data dan seed ulang database';

    public function handle()
    {
        if (!app()->environment('local')) {
            $this->error('Perintah hanya bisa dijalankan di lingkungan lokal!');
            return;
        }

        // Migrasi fresh
        Artisan::call('migrate:fresh', [
            '--force' => true,
        ]);

        // Jalankan seeder reset khusus
        Artisan::call('db:seed', [
            '--class' => 'ResetDatabaseSeeder',
            '--force' => true,
        ]);

        $this->info('Database berhasil di-reset dan di-seed ulang!');
    }
}