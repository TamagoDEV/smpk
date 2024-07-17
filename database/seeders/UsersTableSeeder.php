<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nama_depan' => 'John',
                'nama_belakang' => 'Doe',
                'nama_lengkap' => 'John Doe',
                'username' => 'superadmin',
                'email' => 'superadmin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'superadmin',
                'foto' => null,
                'tempat_lahir' => 'City A',
                'tanggal_lahir' => '1980-01-01',
                'instansi' => 'Instansi A',
                'bidang' => 'Bidang A',
                'alamat' => 'Jl. Example No. 1',
                'no_hp' => '08123456789',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_depan' => 'Jane',
                'nama_belakang' => 'Doe',
                'nama_lengkap' => 'Jane Doe',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'admin',
                'foto' => null,
                'tempat_lahir' => 'City B',
                'tanggal_lahir' => '1990-02-02',
                'instansi' => 'Instansi B',
                'bidang' => 'Bidang B',
                'alamat' => 'Jl. Example No. 2',
                'no_hp' => '08123456780',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_depan' => 'Albert',
                'nama_belakang' => 'Smith',
                'nama_lengkap' => 'Albert Smith',
                'username' => 'kepala_bidang',
                'email' => 'kepala_bidang@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'kepala_bidang',
                'foto' => null,
                'tempat_lahir' => 'City C',
                'tanggal_lahir' => '1985-03-03',
                'instansi' => 'Instansi C',
                'bidang' => 'Bidang C',
                'alamat' => 'Jl. Example No. 3',
                'no_hp' => '08123456781',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_depan' => 'Emily',
                'nama_belakang' => 'Johnson',
                'nama_lengkap' => 'Emily Johnson',
                'username' => 'reporter',
                'email' => 'reporter@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'reporter',
                'foto' => null,
                'tempat_lahir' => 'City D',
                'tanggal_lahir' => '1995-04-04',
                'instansi' => 'Instansi D',
                'bidang' => 'Bidang D',
                'alamat' => 'Jl. Example No. 4',
                'no_hp' => '08123456782',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_depan' => 'Michael',
                'nama_belakang' => 'Brown',
                'nama_lengkap' => 'Michael Brown',
                'username' => 'sub_bagian_approval',
                'email' => 'sub_bagian_approval@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'sub_bagian_approval',
                'foto' => null,
                'tempat_lahir' => 'City E',
                'tanggal_lahir' => '1975-05-05',
                'instansi' => 'Instansi E',
                'bidang' => 'Bidang E',
                'alamat' => 'Jl. Example No. 5',
                'no_hp' => '08123456783',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
