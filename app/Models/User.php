<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Carbon;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    // Константы для ролей
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'last_login_at' => 'datetime',
    ];

    /**
     * Отношение к истории входов
     */
    public function logins()
    {
        return $this->hasMany(Login::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isUser(): bool
    {
        return $this->role === self::ROLE_USER;
    }

    public function scopeAdmins($query)
    {
        return $query->where('role', self::ROLE_ADMIN);
    }

    public function scopeUsers($query)
    {
        return $query->where('role', self::ROLE_USER);
    }

    public function scopeActive($query, $days = 7)
    {
        return $query->where('last_login_at', '>', now()->subDays($days));
    }

    public function scopeNew($query, $days = 30)
    {
        return $query->where('created_at', '>', now()->subDays($days));
    }

    /**
     * Обновляет время последнего входа и создает запись в истории
     * 
     * @param string|null $ip IP-адрес пользователя
     * @return bool
     */
    public function updateLastLogin(?string $ip = null): bool
    {
        // Обновляем поле last_login_at
        $this->last_login_at = now();
        $saved = $this->save();
        
        // Создаем запись в истории логинов
        if ($saved) {
            $this->logins()->create([
                'ip_address' => $ip,
                'created_at' => now(),
            ]);
        }
        
        return $saved;
    }

    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    /**
     * Форматированное время последнего входа (для отображения)
     */
    public function getLastLoginAttribute(): string
    {
        return $this->last_login_at 
            ? $this->last_login_at->diffForHumans() 
            : 'Никогда';
    }

    /**
     * Получить последнюю запись о входе
     */
    public function getLastLoginRecordAttribute()
    {
        return $this->logins()->latest()->first();
    }

    /**
     * Scope для загрузки последнего времени входа
     */
    public function scopeWithLastLogin($query)
    {
        return $query->addSelect([
                'last_login_at' => Login::select('created_at')
                    ->whereColumn('user_id', 'users.id')
                    ->latest()
                    ->take(1)
            ])->withCasts(['last_login_at' => 'datetime']);
    }
}