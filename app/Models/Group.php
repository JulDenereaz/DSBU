<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Project;
class Group extends Model
{
    use HasFactory;
    protected $table = 'groups'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'settings',
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
