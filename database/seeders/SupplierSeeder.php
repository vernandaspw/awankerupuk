<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insert([

            'name' => 'supplier',
            'email' => 'supplier@gmail.com',
            'password' => Hash::make('supplier'),
            'provinsi' => 'sumatera selatan',
            'kota' => 'palembang',
            'kecamatan' => 'sukarami',
            'alamat' => 'jl. koaming',
            'bank' => 'BRI',
            'an' => 'supplier',
            'norek' => '52452525',

        ]);
    }
}
