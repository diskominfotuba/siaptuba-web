<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BkppKatpengajuan;
class KatPengajuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id_bidang' => '1',
                'nama_kategori' => 'Kenaikan Pangkat Reguler/Staf/Pelaksana',
                'slug' => 'kenaikan-pangkat-regular',
            ],
            [
                'id_bidang' => '1',
                'nama_kategori' => 'Kenaikan Pangkat Fungsional',
                'slug' => 'kenaikan-pangkat-fungsional',
            ],
            [
                'id_bidang' => '1',
                'nama_kategori' => 'Kenaikan Pangkat Struktural',
                'slug' => 'kenaikan-pangkat-struktural',
            ],
            [
                'id_bidang' => '1',
                'nama_kategori' => 'Pencantuman Gelar',
                'slug' => 'pencantuman-gelar',
            ],
            [
                'id_bidang' => '1',
                'nama_kategori' => 'Penyesuaian Ijasah',
                'slug' => 'penyesuaian-ijasah',
            ],
            [
                'id_bidang' => '2',
                'nama_kategori' => 'Mutasi Masuk',
                'slug' => 'mutasi-masuk',
            ],
            [
                'id_bidang' => '2',
                'nama_kategori' => 'Mutasi Keluar',
                'slug' => 'mutasi-keluar',
            ],
            [
                'id_bidang' => '2',
                'nama_kategori' => 'Mutasi Dalam',
                'slug' => 'mutasi-dalam',
            ],
            [
                'id_bidang' => '3',
                'nama_kategori' => 'Karis/Karsu',
                'slug' => 'karis-karsu',
            ],
        ];
        foreach ($data as $value) {
            BkppKatpengajuan::create($value);
        }
    }
}
