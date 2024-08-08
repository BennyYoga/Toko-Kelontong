<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustumerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Customer::insert(
            [
                'kode' => 'C001',
                'nama' => 'Customer A',
                'telp' => '08123456789',
            ]
        );

        Customer::insert(
            [
                'kode' => 'C002',
                'nama' => 'Customer B',
                'telp' => '08123456789',
            ]
        );

        Customer::insert(
            [
                'kode' => 'C003',
                'nama' => 'Customer C',
                'telp' => '08123456789',
            ]
        );
    }
}
