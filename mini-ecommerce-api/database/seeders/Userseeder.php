<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'ID' => 1, 'USERNAME' => 'adin', 'PASS' => '$2y$10$hwbGXKyRhBP/CFqrkPQCHOBE/ee7An7yIrwYdPlselw2.wcACryKG', 
                'NAMA_LENGKAP' => 'MUHAMMAD SAIFUDDIN', 'NO_TLP' => '+62 812 3580 7937', 'EMAIL' => 'adin@dnproject.my.id', 
                'ROLE' => 'PEMBELI', 'FOTO_USERS' => '57717d6c54430bdbf77a884dcc109e93.png', 'STATUS' => '1'
            ],
            [
                'ID' => 3, 'USERNAME' => 'mulyono', 'PASS' => 'mobil esemka', 
                'NAMA_LENGKAP' => 'bapak mulyono', 'NO_TLP' => '+62 097 3843 2473', 'EMAIL' => 'ratapansolo@solo.com', 
                'ROLE' => 'PEMBELI', 'FOTO_USERS' => 'default.jpg', 'STATUS' => '1'
            ],
            [
                'ID' => 4, 'USERNAME' => 'atemin_nyata', 'PASS' => 'ini atemin ygy', 
                'NAMA_LENGKAP' => 'pokok admin', 'NO_TLP' => '+62 097384434736', 'EMAIL' => 'adminUntukNyata@gmail.com', 
                'ROLE' => 'ADMIN', 'FOTO_USERS' => 'default.jpg', 'STATUS' => '1'
            ],
            [
                'ID' => 5, 'USERNAME' => 'EBADRUS', 'PASS' => 'GURU PPLG', 
                'NAMA_LENGKAP' => 'PAK BADRUS', 'NO_TLP' => '+62 097 3444 3473', 'EMAIL' => 'guru@ebadrus.com', 
                'ROLE' => 'PEMBELI', 'FOTO_USERS' => 'default.jpg', 'STATUS' => '1'
            ],
            [
                'ID' => 13, 'USERNAME' => 'admin', 'PASS' => '$2y$10$Jr4drTCswbJ6U3QtLGUY5.YbuH9.be2FEvWon.kQ307/8gx8rPlNu', 
                'NAMA_LENGKAP' => 'admin nyata banget coy versi password hash', 'NO_TLP' => '+62 56789765', 'EMAIL' => 'atemin@gmail.com', 
                'ROLE' => 'ADMIN', 'FOTO_USERS' => 'default.jpg', 'STATUS' => '1'
            ],
            [
                'ID' => 24, 'USERNAME' => 'penjual1', 'PASS' => '$2y$10$6.LPzla5U57eX/sDU9LdJuCPmyKZFGK3V2xRtijLFwARRgey6f1py', 
                'NAMA_LENGKAP' => 'Bu Dian', 'NO_TLP' => '+62 81235807939', 'EMAIL' => 'penju1al@gmail.com', 
                'ROLE' => 'PENJUAL', 'FOTO_USERS' => 'user_24_1780476731.jpg', 'STATUS' => '1'
            ],
            [
                'ID' => 40, 'USERNAME' => 'monyet', 'PASS' => '$2y$10$aICiso2vUAWNYNjt.kDmAeVjGeEatiN4gARzzIxQZoPoKAX5xyRna', 
                'NAMA_LENGKAP' => 'monyet asli indonesia', 'NO_TLP' => '+62 81235807933', 'EMAIL' => 'monyet23@gmail.com', 
                'ROLE' => 'PEMBELI', 'FOTO_USERS' => 'default.jpg', 'STATUS' => '1'
            ],
            [
                'ID' => 42, 'USERNAME' => 'penjual4', 'PASS' => '$2y$10$gDbbS/ATzZQ5czY4ldPUI.Rv8DcOBz4YYCWLOEr1CH64Say2FyVDq', 
                'NAMA_LENGKAP' => 'Pak Agus', 'NO_TLP' => '+62 090897876564', 'EMAIL' => 'penjual5@gmail.com', 
                'ROLE' => 'PENJUAL', 'FOTO_USERS' => 'default.jpg', 'STATUS' => '1'
            ]
        ]);
    }
}
