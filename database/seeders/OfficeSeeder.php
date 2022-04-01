<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('offices')->insert(
            [

                [
                    'name' => 'admin',
                    'email' => 'admin@gmail.com',
                    'password' => Hash::make('admin'),
                    'role' => 'admin',
                    'isAktif' => 1,

                ],
                [
                    'name' => 'produksi',
                    'email' => 'produksi@gmail.com',
                    'password' => Hash::make('produksi'),
                    'role' => 'produksi',
                    'isAktif' => 1,

                ],
                [
                    'name' => 'gudang',
                    'email' => 'gudang@gmail.com',
                    'password' => Hash::make('gudang'),
                    'role' => 'gudang',
                    'isAktif' => 1,

                ],
            ]


        );
    }
}
