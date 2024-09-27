<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';  // Ensure this table name matches your database

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
