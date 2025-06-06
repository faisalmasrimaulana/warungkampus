<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

/**
 * Model User
 * @property int $id
 * @property string $nama
 * @property string $email
 * @property string $password
 * @property string $nim
 * @property string|null $whatsapp
 * @property string|null $instagram
 * @property string $ktm
 * @property string|null $alamat
 * @property string|null $foto_profil
 * @property bool $is_verified
 */

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'nim',
        'whatsapp',
        'instagram',
        'ktm',
        'alamat',
        'foto_profil',
        'is_verified',
        'is_blocked',
    ];

    public function produk(){
        return $this->hasMany(Product::class, 'mahasiswa_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
            'password' => 'hashed',
        ];
    }

    public function verifikasi(){
        $this->update(['is_verified' => true]);
    }

    public function block(){
        $this->update((['is_blocked' => true]));
    }

    public function unblock(){
        $this-> update(['is_blocked' => false]);
    }

    public function deleteKtm()
    {
        if ($this->ktm && Storage::disk('public')->exists($this->ktm)) {
            Storage::disk('public')->delete($this->ktm);
        }
    }
    
}
