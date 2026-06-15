<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'nidn';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['nidn', 'nama', 'email', 'no_telepon', 'alamat'];

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'nidn', 'nidn');
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'nidn', 'nidn');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'nidn', 'nidn');
    }
}