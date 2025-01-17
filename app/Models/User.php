<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'no_telp',
        'status',
        'role_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the role of the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the UMKM associated with the user.
     */
    public function umkm()
    {
        return $this->hasOne(UMKM::class);
    }

    /**
     * Define if the user can access Filament.
     */
    public function canAccessFilament(): bool
    {
        return true;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // Jika panel adalah panel admin, hanya role 1 dan 2 yang boleh mengakses
        if ($panel->getId() === 'admin') {
            return in_array($this->role_id, [1, 2]); // Role ID 1 atau 2 bisa mengakses panel admin
        }

        // Jika panel adalah panel user, hanya role 3 yang boleh mengakses
        if ($panel->getId() === 'user') {
            return $this->role_id === 3; // Role ID 3 bisa mengakses panel user
        }

        // Jika tidak ada ketentuan khusus, akses tetap diberikan
        return true;
    }
}
