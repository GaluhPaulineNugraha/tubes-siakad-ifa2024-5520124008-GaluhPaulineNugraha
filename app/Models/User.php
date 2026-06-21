<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'mahasiswa_id',
        'nidn',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'npm');
    }
    
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }
    
    
    public function hasRole($role)
    {
        if ($role == 'admin' && $this->email == 'admin@gmail.com') {
            return true;
        }
        if ($role == 'dosen' && $this->nidn != null) {
            return true;
        }
        if ($role == 'mahasiswa' && $this->mahasiswa_id != null) {
            return true;
        }
        return false;
    }
    
  
    public function getRole()
    {
        if ($this->email == 'admin@gmail.com') {
            return 'admin';
        }
        if ($this->nidn != null) {
            return 'dosen';
        }
        if ($this->mahasiswa_id != null) {
            return 'mahasiswa';
        }
        return 'guest';
    }
}