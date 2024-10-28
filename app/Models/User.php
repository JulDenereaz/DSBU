<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\HasName;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Filament\Panel;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Group;
use App\Models\Project;

class User extends Authenticatable implements FilamentUser, HasName
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'username',
        'email',
        'password',
        'group_id',
        'is_accepted',
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
            'is_accepted' => 'boolean',
        ];
    }
    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
    public function getFilamentName(): string
    {
        return "{$this->firstname} {$this->lastname}";
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    protected static function booted(): void
    {
        static::created(function (User $user) {
            if(!$user->is_accepted) {
                $user->assignRole('inactive');
            }
        });
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }


}
