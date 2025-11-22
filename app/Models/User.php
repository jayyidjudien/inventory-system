<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',     // optional string role (e.g. 'admin' or 'warehouse')
        'role_id',  // optional FK to roles table if you use roles relation
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * If you use a roles table, keep this relation and role_id column.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Helper to get role name from relation or fallback to 'role' column.
     */
    public function getRoleNameAttribute()
    {
        if ($this->relationLoaded('role') && $this->role) {
            return $this->role->name ?? null;
        }

        return $this->attributes['role'] ?? null;
    }

    /**
     * Check single role (string) or multiple roles (array/comma separated).
     */
    public function hasRole($roles): bool
    {
        $current = $this->role_name;
        if (is_null($current)) {
            return false;
        }

        if (is_string($roles)) {
            $roles = array_map('trim', explode(',', $roles));
        }

        return in_array($current, (array) $roles, true);
    }

    /**
     * Mutator to ensure password is hashed.
     */
    public function setPasswordAttribute($value)
    {
        if (empty($value)) {
            return;
        }

        $this->attributes['password'] = Hash::needsRehash($value) ? Hash::make($value) : $value;
    }

    /**
     * Convenience checkers used across the app.
     * Use ->isAdmin(), ->isWarehouse() or ->isRole('admin')
     */
    public function isRole(string $role): bool
    {
        $current = $this->role_name;
        if (is_null($current)) {
            return false;
        }

        return strtolower($current) === strtolower(trim($role));
    }

    public function isAdmin(): bool
    {
        return $this->isRole('admin');
    }

    public function isWarehouse(): bool
    {
        // allow 'warehouse' or 'kasir' if you use localized names
        $current = $this->role_name;
        if (is_null($current)) {
            return false;
        }
        $r = strtolower($current);
        return in_array($r, ['warehouse', 'kasir', 'cashier'], true);
    }
}