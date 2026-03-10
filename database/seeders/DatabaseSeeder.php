<?php

namespace Database\Seeders;

use App\Models\LostItem;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        LostItem::insert([
            [
                'item_name' => 'Dompet Hitam',
                'description' => 'Berisi kartu identitas dan kartu mahasiswa.',
                'location_lost' => 'Gedung F lantai 2',
                'date_lost' => '2026-03-08',
                'reporter_name' => 'Raka Pratama',
                'contact' => '081234567890',
                'status' => 'lost',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => 'Flashdisk 32GB',
                'description' => 'Warna hitam, terdapat stiker biru.',
                'location_lost' => 'Lab Pemrograman',
                'date_lost' => '2026-03-09',
                'reporter_name' => 'Nadia Putri',
                'contact' => '089876543210',
                'status' => 'found',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
