<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'nama_perusahaan' => 'perusahaan',
            'no_telp' => null,
            'email' => null,
            'alamat' => null,
            'pajak' => 0,

        ]);
    }
}
