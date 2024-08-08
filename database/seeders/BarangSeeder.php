<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Barang::insert(
            [
                'kode' => 'B001',
                'nama' => 'Barang A',
                'harga' => 500000,
            ]
        );

        Barang::insert(
            [
                'kode' => 'B002',
                'nama' => 'Barang B',
                'harga' => 1000000,
            ]
        );

        Barang::insert(
            [
                'kode' => 'B003',
                'nama' => 'Barang C',
                'harga' => 1500000,
            ]
        );
    }
}
