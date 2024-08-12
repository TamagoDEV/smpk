<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'nama_lengkap',
        'username',
        'email',
        'password',
        'role',
        'foto',
        'tempat_lahir',
        'tanggal_lahir',
        'instansi',
        'bidang',
        'alamat',
        'no_hp',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Define the roles
    protected static $roleNames = [
        'superadmin' => 'Super Admin',
        'admin' => 'Admin',
        'kepala_bidang' => 'Kepala Bidang',
        'reporter' => 'Reporter',
        'sub_bagian_approval' => 'Sub Bagian Approval',
    ];

    // Method to get the readable role name
    public function getReadableRoleAttribute()
    {
        return self::$roleNames[$this->role] ?? $this->role;
    }

    public function laporanPengajuan()
    {
        return $this->hasMany(LaporanPengajuan::class, 'approved_by');
    }
}
