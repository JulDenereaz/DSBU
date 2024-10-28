<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';

    protected $fillable = [
        'name',
        'funding',
        'start_date',
        'end_date',
        'group_id',
    ];


    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

        public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
